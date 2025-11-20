@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
   <div class="p-6 bg-white border-b border-gray-200">
      <div class="flex justify-between items-center mb-6">
         <h2 class="text-2xl font-bold text-gray-800">Detail Banner</h2>
         <div>
            <a href="{{ route('admin.banners.edit', $banner) }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
               <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.banners.index') }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
               <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
         </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
         <!-- Banner Image -->
         <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Banner</label>
            @if($banner->image)
            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
               class="w-full h-auto object-cover rounded border">
            @else
            <div class="w-full h-32 bg-gray-200 rounded border flex items-center justify-center">
               <span class="text-gray-500">Tidak ada gambar</span>
            </div>
            @endif
         </div>

         <!-- Title -->
         <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Banner</label>
            <p class="text-gray-900">{{ $banner->title ?: 'Tanpa Judul' }}</p>
         </div>

         <!-- Link -->
         <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Link Klik</label>
            @if($banner->link)
            <a href="{{ $banner->link }}" target="_blank" class="text-blue-600 hover:text-blue-900">
               {{ $banner->link }}
            </a>
            @else
            <p class="text-gray-500">-</p>
            @endif
         </div>

         <!-- Status -->
         <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            @if($banner->is_active)
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
               Aktif
            </span>
            @else
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
               Tidak Aktif
            </span>
            @endif
         </div>

         <!-- Sort Order -->
         <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampilan</label>
            <p class="text-gray-900">{{ $banner->sort_order }}</p>
         </div>

         <!-- Created At -->
         <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Dibuat Pada</label>
            <p class="text-gray-900">{{ $banner->created_at->format('d M Y H:i') }}</p>
         </div>

         <!-- Updated At -->
         <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Diupdate Pada</label>
            <p class="text-gray-900">{{ $banner->updated_at->format('d M Y H:i') }}</p>
         </div>
      </div>
   </div>
</div>
@endsection