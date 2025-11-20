<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $this->handleAvatarUpload($request->file('avatar'), $user);
            $request->merge(['avatar' => $avatarPath]);
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete avatar file if exists
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Handle Avatar Upload
     */
    private function handleAvatarUpload($file, $user)
    {
        // Delete old avatar if exists
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'avatars/' . date('Y/m');

        // Create directory if not exists
        $fullPath = storage_path('app/public/' . $path);
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        // Resize and save avatar (300x300)
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover(width: 300, height: 300);
        $image->save($fullPath . '/' . $filename, quality: 85);

        return $path . '/' . $filename;
    }
}
