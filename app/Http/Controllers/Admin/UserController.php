<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;            // 👈 tambahin ini
use Illuminate\Support\Facades\Hash; // 👈 tambahin ini juga

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10); // 👈 ambil data dari model User urut terbaru
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,penulis,user'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,penulis,user',
            'password' => 'nullable|min:8|confirmed'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }

    /**
     * Manually verify a user's email address.
     */
    public function verify(User $user)
    {
        $user->update([
            'is_verified' => true,
            'email_verification_token' => null,
            'email_verification_token_expires_at' => null,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Email untuk user {$user->name} berhasil diverifikasi secara manual!");
    }
}