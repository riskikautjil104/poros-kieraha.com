@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
   <div class="p-6 bg-white border-b border-gray-200">
      <div class="flex justify-between items-center mb-6">
         <h2 class="text-2xl font-bold text-gray-800">Kelola Banner</h2>
         <a href="{{ route('admin.banners.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i>Tambah Banner
         </a>
      </div>

      @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
         {{ session('success') }}
      </div>
      @endif

      <div class="overflow-x-auto">
         <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
               <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
               </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
               @forelse($banners as $banner)
               <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                     @if($banner->image)
                     <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                        class="h-12 w-auto object-cover rounded">
                     @else
                     <span class="text-gray-400">No Image</span>
                     @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                     {{ $banner->title ?: 'Tanpa Judul' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                     @if($banner->link)
                     <a href="{{ $banner->link }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                        {{ Str::limit($banner->link, 30) }}
                     </a>
                     @else
                     <span class="text-gray-400">-</span>
                     @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                     @if($banner->is_active)
                     <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Aktif
                     </span>
                     @else
                     <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Tidak Aktif
                     </span>
                     @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                     {{ $banner->sort_order }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                     <a href="{{ route('admin.banners.edit', $banner) }}"
                        class="text-indigo-600 hover:text-indigo-900 mr-3">
                        <i class="fas fa-edit"></i> Edit
                     </a>
                     <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="inline-block"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                           <i class="fas fa-trash"></i> Hapus
                        </button>
                     </form>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                     Belum ada banner yang dibuat.
                  </td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection