@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">Kelola Users</h2>
            <a href="{{ route('admin.users.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                + Tambah User
            </a>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Verifikasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bergabung</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($user->is_verified ?? false)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Verified
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 mb-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i> Unverified
                                            </span>
                                            @if(($user->role ?? 'user') !== 'admin') {{-- Admin tidak perlu diverifikasi karena otomatis bypass --}}
                                            <form action="{{ route('admin.users.verify', $user) }}" method="POST" class="block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="return confirm('Verifikasi email user {{ $user->name }} secara manual?')" class="text-xs text-indigo-600 hover:text-indigo-900 underline font-medium">
                                                    Verifikasi Manual
                                                </button>
                                            </form>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <span class="px-2 py-1 text-xs rounded font-medium {{ ($user->role ?? '') == 'admin' ? 'bg-red-100 text-red-800' : (($user->role ?? '') == 'penulis' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ ucfirst($user->role ?? 'user') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        
                                        @if($user->id != auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin mau hapus user ini?')" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada user</p>
            @endif
        </div>
    </div>
</div>
@endsection