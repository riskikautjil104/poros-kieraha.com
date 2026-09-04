@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
   <div class="p-6 bg-white border-b border-gray-200">
      <div class="flex justify-between items-center mb-6">
         <h2 class="text-2xl font-bold text-gray-800">Tambah Partner Of</h2>
         <a href="{{ route('admin.partners.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
         </a>
      </div>

      @if($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
         <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif

      <form action="{{ route('admin.partners.store') }}" method="POST">
         @csrf

         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
               <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Partner <span class="text-red-500">*</span></label>
               <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Nama partner">
            </div>

            <div>
               <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
               <input type="text" name="category" id="category" value="{{ old('category') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Mis. Media Partner">
            </div>

            <div class="md:col-span-2">
               <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
               <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="https://...">
               <p class="mt-1 text-sm text-gray-500">Sementara upload gambar belum dibuat; pakai URL agar kompatibel dengan UI yang ada.</p>
            </div>

            <div class="md:col-span-2">
               <label for="link" class="block text-sm font-medium text-gray-700 mb-2">Link Klik</label>
               <input type="url" name="link" id="link" value="{{ old('link') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="https://...">
            </div>

            <div>
               <label class="block text-sm font-medium text-gray-700 mb-2">Status Aktif</label>
               <div class="flex items-center">
                  <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                  <label for="is_active" class="ml-2 block text-sm text-gray-900">Aktifkan</label>
               </div>
            </div>

            <div>
               <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
               <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
         </div>

         <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
               <i class="fas fa-save mr-2"></i>Simpan Partner
            </button>
         </div>
      </form>
   </div>
</div>
@endsection
