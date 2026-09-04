<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseApiController
{
    /**
     * User Login.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422, $validator->errors()->toArray());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('Email atau kata sandi tidak cocok.', 401);
        }

        $token = self::generateToken($user);

        return $this->sendResponse([
            'token' => $token,
            'user'  => $this->formatUserResponse($user),
        ], 'Login berhasil! Selamat datang kembali.');
    }

    /**
     * User Registration.
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format alamat email tidak valid.',
            'email.unique'      => 'Email ini sudah terdaftar. Silakan gunakan email lain atau langsung Masuk.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min'      => 'Kata sandi minimal 6 karakter.',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422, $validator->errors()->toArray());
        }

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'user',
            'is_verified' => true,
        ]);

        // Auto subscribe newsletter
        try {
            Newsletter::updateOrCreate(
                ['email' => $user->email],
                ['is_active' => true]
            );
        } catch (\Exception $e) {
            // Ignore newsletter error
        }

        $token = self::generateToken($user);

        return $this->sendResponse([
            'token' => $token,
            'user'  => [
                'id'         => $user->id,
                'name'       => $user->name,
        return $this->sendResponse([
            'token' => $token,
            'user'  => $this->formatUserResponse($user),
        ], 'Pendaftaran akun berhasil! Selamat datang di Poros Kie Raha.', 201);
    }

    /**
     * Google Single Sign-On (Direct Login / Register).
     */
    public function googleLogin(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'google_id' => 'nullable|string|max:255',
            'avatar'    => 'nullable|string|max:1000',
        ], [
            'name.required'  => 'Nama pengguna dari Google diperlukan.',
            'email.required' => 'Email dari Google diperlukan.',
            'email.email'    => 'Format email Google tidak valid.',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422, $validator->errors()->toArray());
        }

        $email = trim(strtolower($request->email));
        $user = User::where('email', $email)->first();

        if (!$user) {
            // New user via Google: automatically verified without manual email verification
            $user = User::create([
                'name'        => $request->name,
                'email'       => $email,
                'password'    => Hash::make(\Illuminate\Support\Str::random(32)),
                'role'        => 'user',
                'avatar'      => $request->avatar,
                'is_verified' => true,
            ]);

            // Auto subscribe to newsletter for news updates
            try {
                Newsletter::updateOrCreate(
                    ['email' => $user->email],
                    ['is_active' => true]
                );
            } catch (\Exception $e) {
                // Ignore newsletter error
            }
        } else {
            // Existing user: ensure marked as verified and sync avatar if empty
            $updates = [];
            if (!$user->is_verified) {
                $updates['is_verified'] = true;
            }
            if (empty($user->avatar) && !empty($request->avatar)) {
                $updates['avatar'] = $request->avatar;
            }
            if (!empty($updates)) {
                $user->update($updates);
            }
        }

        $token = self::generateToken($user);

        return $this->sendResponse([
            'token' => $token,
            'user'  => $this->formatUserResponse($user),
        ], 'Login dengan Google berhasil! Selamat datang, ' . $user->name . '.');
    }

    /**
     * Get Current Authenticated User Profile.
     */
    public function me(Request $request): JsonResponse
    {
        $user = $this->getAuthenticatedUser($request);

        if (!$user) {
            return $this->sendError('Sesi login telah berakhir atau token tidak valid.', 401);
        }

        return $this->sendResponse([
            'user' => $this->formatUserResponse($user),
        ], 'Profil pengguna berhasil diambil');
    }

    /**
     * Logout.
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->sendResponse(null, 'Logout berhasil.');
    }

    /**
     * Format user array for API responses.
     */
    private function formatUserResponse(User $user): array
    {
        $avatar = null;
        if (!empty($user->avatar)) {
            if (filter_var($user->avatar, FILTER_VALIDATE_URL)) {
                $avatar = $user->avatar;
            } else {
                $avatar = asset('storage/' . $user->avatar);
            }
        }

        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'role'       => $user->role,
            'avatar'     => $avatar,
            'created_at' => $user->created_at?->toIso8601String(),
        ];
    }
}
