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
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', 422, $validator->errors()->toArray());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('Email atau kata sandi tidak cocok.', 401);
        }

        $token = self::generateToken($user);

        return $this->sendResponse([
            'token' => $token,
            'user'  => [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'role'       => $user->role,
                'avatar'     => $user->avatar ? asset('storage/' . $user->avatar) : null,
                'created_at' => $user->created_at?->toIso8601String(),
            ],
        ], 'Login berhasil! Selamat datang kembali.');
    }

    /**
     * User Registration.
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi registrasi gagal', 422, $validator->errors()->toArray());
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
                'email'      => $user->email,
                'role'       => $user->role,
                'avatar'     => null,
                'created_at' => $user->created_at?->toIso8601String(),
            ],
        ], 'Pendaftaran akun berhasil! Selamat datang di Poros Kie Raha.', 201);
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
            'user' => [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'role'       => $user->role,
                'avatar'     => $user->avatar ? asset('storage/' . $user->avatar) : null,
                'created_at' => $user->created_at?->toIso8601String(),
            ],
        ], 'Profil pengguna berhasil diambil');
    }

    /**
     * Logout.
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->sendResponse(null, 'Logout berhasil.');
    }
}
