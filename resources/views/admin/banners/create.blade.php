@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
   <div class="p-6 bg-white border-b border-gray-200">
      <div class="flex justify-between items-center mb-6">
         <h2 class="text-2xl font-bold text-gray-800">Tambah Banner Baru</h2>
         <a href="{{ route('admin.banners.index') }}"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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

      <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
         @csrf

         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div>
               <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                  Judul Banner <span class="text-gray-500">(Opsional)</span>
               </label>
               <input type="text" name="title" id="title" value="{{ old('title') }}"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  placeholder="Masukkan judul banner">
            </div>

            <!-- Link -->
            <div>
               <label for="link" class="block text-sm font-medium text-gray-700 mb-2">
                  Link Klik <span class="text-gray-500">(Opsional)</span>
               </label>
               <input type="url" name="link" id="link" value="{{ old('link') }}"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  placeholder="https://example.com">
            </div>

            <!-- Image -->
            <div class="md:col-span-2">
               <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                  Gambar Banner <span class="text-red-500">*</span>
               </label>
               <input type="file" name="image" id="image" accept="image/*"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  onchange="previewImage(event)">
               <p class="mt-1 text-sm text-gray-500">
                  Format: JPEG, PNG, JPG, GIF. Ukuran maksimal: 2MB. Dimensi optimal: 559x71px
               </p>
            </div>

            <!-- Image Preview -->
            <div class="md:col-span-2">
               <label class="block text-sm font-medium text-gray-700 mb-2">Preview Gambar</label>
               <div id="image-preview" class="border-2 border-dashed border-gray-300 rounded-md p-4 text-center hidden">
                  <img id="preview-img" src="" alt="Preview" class="max-w-full h-auto mx-auto">
               </div>
            </div>

            <!-- Sort Order -->
            <div>
               <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                  Urutan Tampilan
               </label>
               <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Is Active -->
            <div>
               <label class="block text-sm font-medium text-gray-700 mb-2">
                  Status Banner
               </label>
               <div class="flex items-center">
                  <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : ''
                     }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                  <label for="is_active" class="ml-2 block text-sm text-gray-900">
                     Aktifkan banner ini
                  </label>
               </div>
            </div>
         </div>

         <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
               <i class="fas fa-save mr-2"></i>Simpan Banner
            </button>
         </div>
      </form>
   </div>
</div>

<script>
   function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection