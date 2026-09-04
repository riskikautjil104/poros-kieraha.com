<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Newsletter;
use App\Models\Partner;
use App\Models\SiteVisit;
use App\Models\Tag;
use App\Models\YoutubeVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MiscellaneousController extends BaseApiController
{
    /**
     * Get active YouTube videos.
     */
    public function videos(): JsonResponse
    {
        $videos = YoutubeVideo::active()
            ->ordered()
            ->get()
            ->map(function ($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'youtube_url' => $video->youtube_url,
                    'embed_url' => $video->embed_url,
                    'description' => $video->description,
                    'thumbnail' => $video->thumbnail ? asset('storage/' . $video->thumbnail) : null,
                ];
            });

        return $this->sendResponse($videos, 'Daftar video YouTube berhasil dimuat');
    }

    /**
     * Get active partners.
     */
    public function partners(): JsonResponse
    {
        $partners = Partner::active()
            ->orderBy('sort_order')
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'category' => $p->category,
                    'image_url' => $p->image_url,
                    'link' => $p->link,
                ];
            });

        return $this->sendResponse($partners, 'Daftar partner berhasil dimuat');
    }

    /**
     * Get tags with news count.
     */
    public function tags(): JsonResponse
    {
        $tags = Tag::withCount([
            'news' => function ($query) {
                $query->published();
            }
        ])
            ->having('news_count', '>', 0)
            ->orderBy('news_count', 'desc')
            ->get(['id', 'name', 'slug']);

        return $this->sendResponse($tags, 'Daftar tag berhasil dimuat');
    }

    /**
     * Subscribe to newsletter.
     */
    public function newsletter(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi email gagal', 422, $validator->errors()->toArray());
        }

        Newsletter::updateOrCreate(
            ['email' => $request->input('email')],
            ['is_active' => true]
        );

        return $this->sendResponse([
            'email' => $request->input('email'),
            'subscribed' => true,
        ], 'Terima kasih! Anda berhasil berlangganan newsletter Poros Kie Raha.');
    }

    /**
     * Get public visitor statistics and client IP/device info.
     */
    public function stats(Request $request): JsonResponse
    {
        // Detect client device & browser
        $ua = $request->userAgent() ?? '';
        if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $ua)) {
            $device = 'Tablet';
        } elseif (preg_match('/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|NetFront|Silk-Accelerated|(hpw|web)OS|Fennec|Minimo|Opera M(obi|ini)|Blazer|Dolfin|Dolphin|Skyfire|Zune/i', $ua)) {
            $device = 'Smartphone';
        } else {
            $device = 'Desktop';
        }

        $browser = 'Browser';
        if (str_contains($ua, 'OPR') || str_contains($ua, 'Opera')) {
            $browser = 'Opera';
        } elseif (str_contains($ua, 'Chrome')) {
            $browser = 'Chrome';
        } elseif (str_contains($ua, 'Safari')) {
            $browser = 'Safari';
        } elseif (str_contains($ua, 'Firefox')) {
            $browser = 'Firefox';
        } elseif (str_contains($ua, 'MSIE') || str_contains($ua, 'Trident')) {
            $browser = 'Internet Explorer';
        }

        $data = [
            'visitors' => [
                'today' => SiteVisit::countToday(),
                'week'  => SiteVisit::countWeek(),
                'month' => SiteVisit::countMonth(),
                'year'  => SiteVisit::countYear(),
                'total' => SiteVisit::countTotal(),
            ],
            'client' => [
                'ip'      => $request->ip(),
                'device'  => $device,
                'browser' => $browser,
            ],
        ];

        return $this->sendResponse($data, 'Statistik situs berhasil dimuat');
    }
}
