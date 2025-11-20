<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Store newsletter subscription
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah terdaftar atau tidak valid.'
            ], 422);
        }

        Newsletter::create([
            'email' => $request->email,
            'is_active' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Anda telah berhasil berlangganan newsletter kami.'
        ]);
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:newsletters,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan.'
            ], 404);
        }

        $newsletter = Newsletter::where('email', $request->email)->first();
        $newsletter->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Anda telah berhasil berhenti berlangganan newsletter.'
        ]);
    }
}
