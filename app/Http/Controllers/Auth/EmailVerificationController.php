<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\EmailVerificationMail;

class EmailVerificationController extends Controller
{
    // Tampilkan halaman notice verifikasi
    public function notice()
    {
        return view('auth.verify-email');
    }

    // Kirim ulang email verifikasi
    public function sendVerificationEmail(Request $request)
    {
        $user = auth()->user();

        if ($user->is_verified) {
            return redirect()->back()->with('success', 'Email Anda sudah terverifikasi!');
        }

        // Generate token baru
        $token = Str::random(64);
        $user->update([
            'email_verification_token' => Hash::make($token),
            'email_verification_token_expires_at' => now()->addHours(24),
            'is_verified' => false,
        ]);

        // Kirim email verifikasi
        Mail::to($user->email)->send(new EmailVerificationMail($token));

        return redirect()->back()->with('success', 'Link verifikasi telah dikirim ulang ke email Anda!');
    }

    // Verifikasi email via token
    public function verifyEmail(Request $request, $token)
    {
        $user = User::where('email_verification_token', '!=', null)
            ->where('email_verification_token_expires_at', '>', now())
            ->get()
            ->first(function ($user) use ($token) {
                return Hash::check($token, $user->email_verification_token);
            });

        if (!$user) {
            return redirect('/login')->with('error', 'Token verifikasi tidak valid atau sudah expired!');
        }

        $user->update([
            'is_verified' => true,
            'email_verification_token' => null,
            'email_verification_token_expires_at' => null,
            'email_verified_at' => now(),
        ]);

        auth()->login($user);

        return redirect('/dashboard')->with('success', 'Email berhasil diverifikasi! Selamat datang!');
    }
}
