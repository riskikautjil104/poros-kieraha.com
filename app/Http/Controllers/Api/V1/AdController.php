<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\AdResource;
use App\Models\Ad;
use Illuminate\Http\JsonResponse;

class AdController extends BaseApiController
{
    /**
     * Display all active ads grouped by placement position.
     */
    public function index(): JsonResponse
    {
        $premiumPopupAd = Ad::active()->premium()->ordered()->first();
        $contentAds     = Ad::active()->content()->ordered()->get();
        $sidebarAds     = Ad::active()->sidebar()->ordered()->get();
        $footerAds      = Ad::active()->footer()->ordered()->get();

        $data = [
            'popup'   => $premiumPopupAd ? new AdResource($premiumPopupAd) : null,
            'content' => AdResource::collection($contentAds),
            'sidebar' => AdResource::collection($sidebarAds),
            'footer'  => AdResource::collection($footerAds),
        ];

        return $this->sendResponse($data, 'Daftar iklan aktif berhasil diambil');
    }

    /**
     * Record an ad click from mobile application and return target link.
     */
    public function click(int $id): JsonResponse
    {
        $ad = Ad::find($id);

        if (!$ad) {
            return $this->sendError('Iklan tidak ditemukan', 404);
        }

        $ad->incrementClick();

        return $this->sendResponse([
            'id' => $ad->id,
            'target_link' => $ad->link,
            'click_count' => $ad->click_count,
        ], 'Klik iklan berhasil dicatat');
    }
}
