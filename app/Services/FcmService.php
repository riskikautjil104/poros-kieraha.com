<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\News;
use App\Models\Partner;
use App\Models\YoutubeVideo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FcmService
{
    /**
     * Kirim notifikasi berita baru yang diterbitkan.
     */
    public static function sendNewsNotification(News $news): bool
    {
        $title = 'Berita Terbaru: ' . Str::limit($news->title, 65);
        $body = !empty($news->excerpt) 
            ? Str::limit(strip_tags($news->excerpt), 120)
            : Str::limit(strip_tags($news->content), 120);

        $imageUrl = $news->image ? url(\Illuminate\Support\Facades\Storage::url($news->image)) : null;

        return self::sendToTopic('news', $title, $body, [
            'type' => 'news',
            'slug' => (string) $news->slug,
            'id'   => (string) $news->id,
        ], $imageUrl);
    }

    /**
     * Kirim notifikasi iklan / promo baru.
     */
    public static function sendAdNotification(Ad $ad): bool
    {
        $title = 'Info Promo & Sponsor: ' . Str::limit($ad->title ?: 'Promo Baru', 60);
        $body = 'Ada penawaran menarik terbaru di Poros Kie Raha. Ketuk untuk melihat info lengkap.';
        $imageUrl = $ad->image_url ?? null;

        return self::sendToTopic('ads', $title, $body, [
            'type' => 'ad',
            'id'   => (string) $ad->id,
            'link' => (string) ($ad->link ?? ''),
        ], $imageUrl);
    }

    /**
     * Kirim notifikasi video YouTube baru.
     */
    public static function sendVideoNotification(YoutubeVideo $video): bool
    {
        $title = 'Video Liputan Baru: ' . Str::limit($video->title, 60);
        $body = !empty($video->description)
            ? Str::limit(strip_tags($video->description), 110)
            : 'Tonton video liputan terkini sekarang di aplikasi Poros Kie Raha!';

        $thumbnail = null;
        if (!empty($video->thumbnail)) {
            $thumbnail = Str::startsWith($video->thumbnail, ['http://', 'https://'])
                ? $video->thumbnail
                : url(\Illuminate\Support\Facades\Storage::url($video->thumbnail));
        } elseif (!empty($video->youtube_url)) {
            // Coba ekstrak ID YouTube untuk thumbnail hqdefault
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video->youtube_url, $match)) {
                $thumbnail = 'https://img.youtube.com/vi/' . $match[1] . '/hqdefault.jpg';
            }
        }

        return self::sendToTopic('videos', $title, $body, [
            'type'        => 'video',
            'id'          => (string) $video->id,
            'youtube_url' => (string) ($video->youtube_url ?? ''),
        ], $thumbnail);
    }

    /**
     * Kirim notifikasi media partner baru.
     */
    public static function sendPartnerNotification(Partner $partner): bool
    {
        $title = 'Media Partner Resmi: ' . Str::limit($partner->name, 60);
        $body = 'Poros Kie Raha kini resmi menjalin kerja sama dengan ' . $partner->name . '.';

        return self::sendToTopic('partners', $title, $body, [
            'type' => 'partner',
            'id'   => (string) $partner->id,
            'link' => (string) ($partner->link ?? ''),
        ], $partner->image_url ?? null);
    }

    /**
     * Kirim Push Notification ke Topik FCM.
     * Topik 'poros_kieraha_updates' menerima semua jenis broadcast.
     */
    public static function sendToTopic(string $subTopic, string $title, string $body, array $data = [], ?string $imageUrl = null): bool
    {
        try {
            // Selalu kirim ke topik induk siaran umum 'poros_kieraha_updates'
            $topics = array_unique(['poros_kieraha_updates', $subTopic]);

            foreach ($topics as $topic) {
                self::dispatchFcm($topic, $title, $body, $data, $imageUrl);
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('FCM Send Exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Eksekusi pengiriman FCM ke Firebase (HTTP v1 atau Legacy Server Key).
     */
    private static function dispatchFcm(string $topic, string $title, string $body, array $data = [], ?string $imageUrl = null): void
    {
        // 1. Cek konfigurasi Firebase Service Account (HTTP v1 - Modern)
        $credentialsConfig = env('FIREBASE_CREDENTIALS', 'storage/app/firebase_credentials.json');
        $credentialsPath = (Str::startsWith($credentialsConfig, '/') || preg_match('/^[A-Za-z]:\\\\/', $credentialsConfig))
            ? $credentialsConfig
            : base_path($credentialsConfig);

        if (file_exists($credentialsPath)) {
            self::sendHttpV1($credentialsPath, $topic, $title, $body, $data, $imageUrl);
            return;
        }

        // 2. Cek konfigurasi Legacy Server Key
        $serverKey = env('FCM_SERVER_KEY');
        if (!empty($serverKey)) {
            self::sendLegacy($serverKey, $topic, $title, $body, $data, $imageUrl);
            return;
        }

        // 3. Fallback: Catat di log bahwa notifikasi siap dikirim (mode dev)
        Log::info("FCM Broadcast (Dev Mode): Topik [{$topic}] -> Judul: [{$title}] | Pesan: [{$body}]");
    }

    /**
     * Pengiriman menggunakan Firebase Cloud Messaging HTTP v1 API (OAuth2 JWT).
     */
    private static function sendHttpV1(string $credentialsPath, string $topic, string $title, string $body, array $data, ?string $imageUrl): void
    {
        $serviceAccount = json_decode(file_get_contents($credentialsPath), true);
        if (!is_array($serviceAccount) || empty($serviceAccount['project_id'])) {
            Log::warning('FCM Service Account JSON tidak valid.');
            return;
        }

        $projectId = $serviceAccount['project_id'];
        $accessToken = self::getGoogleAccessToken($serviceAccount);
        if (!$accessToken) {
            Log::warning('FCM Gagal mendapatkan Google OAuth2 Access Token.');
            return;
        }

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $message = [
            'topic' => $topic,
            'notification' => [
                'title' => $title,
                'body'  => $body,
            ],
            'data' => array_map('strval', $data),
            'android' => [
                'priority' => 'high',
                'notification' => [
                    'sound'        => 'default',
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ],
            ],
        ];

        if (!empty($imageUrl)) {
            $message['notification']['image'] = $imageUrl;
            $message['android']['notification']['image'] = $imageUrl;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type'  => 'application/json; UTF-8',
        ])->post($url, ['message' => $message]);

        if (!$response->successful()) {
            Log::error('FCM HTTP v1 Error: ' . $response->body());
        } else {
            Log::info("FCM HTTP v1 Success to topic [{$topic}]: " . $response->body());
        }
    }

    /**
     * Pengiriman menggunakan FCM Legacy Protocol.
     */
    private static function sendLegacy(string $serverKey, string $topic, string $title, string $body, array $data, ?string $imageUrl): void
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $payload = [
            'to' => '/topics/' . $topic,
            'priority' => 'high',
            'notification' => [
                'title' => $title,
                'body'  => $body,
                'sound' => 'default',
            ],
            'data' => array_merge($data, [
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            ]),
        ];

        if (!empty($imageUrl)) {
            $payload['notification']['image'] = $imageUrl;
        }

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type'  => 'application/json',
        ])->post($url, $payload);

        if (!$response->successful()) {
            Log::error('FCM Legacy Error: ' . $response->body());
        } else {
            Log::info("FCM Legacy Success to topic [{$topic}]");
        }
    }

    /**
     * Dapatkan OAuth2 Access Token dari Google menggunakan Service Account JWT.
     */
    private static function getGoogleAccessToken(array $sa): ?string
    {
        $cacheKey = 'fcm_google_access_token_' . md5($sa['client_email']);
        if ($cachedToken = Cache::get($cacheKey)) {
            return $cachedToken;
        }

        $now = time();
        $jwtHeader = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $jwtClaim = json_encode([
            'iss'   => $sa['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now,
        ]);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtHeader));
        $base64UrlClaim  = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtClaim));
        $dataToSign      = $base64UrlHeader . '.' . $base64UrlClaim;

        $privateKey = $sa['private_key'] ?? '';
        $signature  = '';

        $success = openssl_sign($dataToSign, $signature, $privateKey, 'SHA256');
        if (!$success) {
            Log::error('Gagal membuat digital signature OpenSSL untuk FCM.');
            return null;
        }

        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        $jwt = $dataToSign . '.' . $base64UrlSignature;

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ]);

        if ($response->successful()) {
            $tokenData = $response->json();
            $accessToken = $tokenData['access_token'] ?? null;
            if ($accessToken) {
                // Cache token selama 50 menit
                Cache::put($cacheKey, $accessToken, now()->addMinutes(50));
                return $accessToken;
            }
        }

        Log::error('Gagal mengambil Google Token: ' . $response->body());
        return null;
    }
}
