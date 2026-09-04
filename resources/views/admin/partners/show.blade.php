@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
   <div class="p-6 bg-white border-b border-gray-200">
      <div class="flex justify-between items-center mb-6">
         <h2 class="text-2xl font-bold text-gray-800">Detail Partner Of</h2>
         <a href="{{ route('admin.partners.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
         </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
         <div>
            <div class="text-sm font-medium text-gray-700 mb-2">Nama</div>
            <div class="text-gray-900 font-semibold">{{ $partner->name }}</div>
         </div>
         <div>
            <div class="text-sm font-medium text-gray-700 mb-2">Kategori</div>
            <div class="text-gray-900 font-semibold">{{ $partner->category ?: '-' }}</div>
         </div>
         <div class="md:col-span-2">
            <div class="text-sm font-medium text-gray-700 mb-2">Gambar</div>
            <div>
               @if($partner->image_url)
               <img src="{{ $partner->image_url }}" alt="{{ $partner->name }}" class="max-h-40 rounded">
               @else
               <span class="text-gray-400">Tidak ada gambar</span>
               @endif
            </div>
         </div>
         <div class="md:col-span-2">
            <div class="text-sm font-medium text-gray-700 mb-2">Link</div>
            <div>
               @if($partner->link)
               <a href="{{ $partner->link }}" target="_blank" class="text-blue-600 hover:text-blue-900">{{ $partner->link }}</a>
               @else
               <span class="text-gray-400">-</span>
               @endif
            </div>
         </div>
         <div>
            <div class="text-sm font-medium text-gray-700 mb-2">Status</div>
            <div>
               @if($partner->is_active)
               <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
               @else
               <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
               @endif
            </div>
         </div>
         <div>
            <div class="text-sm font-medium text-gray-700 mb-2">Urutan</div>
            <div class="text-gray-900 font-semibold">{{ $partner->sort_order }}</div>
         </div>
      </div>

      <div class="mt-6 flex justify-end gap-3">
         <a href="{{ route('admin.partners.edit', $partner) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-edit mr-2"></i>Edit
         </a>
      </div>
   </div>
</div>
@endsection
