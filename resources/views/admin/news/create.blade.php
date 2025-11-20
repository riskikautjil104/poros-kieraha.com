{{-- @extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Tulis Berita Baru</h2>

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Masukkan judul berita...">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar Cover</label>
                    <input type="file" name="image" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Format: JPG, PNG. Maksimal 2MB</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ringkasan/Excerpt</label>
                    <textarea name="excerpt" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ringkasan singkat berita (opsional)...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konten Berita *</label>
                    <textarea name="content" rows="15" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Tulis konten berita lengkap di sini...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </a>
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}
{{-- 
@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Tulis Berita Baru</h2>

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Masukkan judul berita...">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Cover</label>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mb-3 hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-w-md h-64 object-cover rounded-lg border-2 border-gray-300">
                        <button type="button" onclick="removeImage()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                            ❌ Hapus Gambar
                        </button>
                    </div>

                    <input type="file" name="image" id="imageInput" accept="image/*"
                        onchange="previewImage(event)"
                        class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        📸 Format: JPG, PNG, GIF. Maksimal 5MB. Gambar akan otomatis dioptimasi.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ringkasan/Excerpt</label>
                    <textarea name="excerpt" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ringkasan singkat berita untuk preview (opsional)...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita * 
                        <span class="text-xs text-gray-500">(Gunakan editor untuk format teks)</span>
                    </label>
                    <textarea name="content" id="tinymce-editor" required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>📝 Draft (Belum Dipublikasi)</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>✅ Published (Langsung Tayang)</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                        Batal
                    </a>
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                        💾 Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/49rrs3hwm9ic154z90gt1ya5jlwgmyqvd203mmhl7ek0lm7y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#tinymce-editor',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                 'forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
                 'bullist numlist outdent indent | link image media | removeformat code fullscreen',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 16px; line-height: 1.6; }',
        
        // Konfigurasi Upload Gambar di Editor (Opsional)
        images_upload_url: '/admin/news/upload-image', // Buat route ini nanti kalau mau
        automatic_uploads: true,
        images_reuse_filename: true,
        
        // Style default
        content_css: 'default',
        
        // Bahasa Indonesia (Opsional)
        language: 'id_ID',
        language_url: 'https://cdn.tiny.cloud/1/49rrs3hwm9ic154z90gt1ya5jlwgmyqvd203mmhl7ek0lm7y/tinymce/6/langs/id_ID.js'
    });

    // Image Preview Function
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('previewImg').src = '';
    }
</script>
@endsection --}}
@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Tulis Berita Baru</h2>

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Masukkan judul berita...">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Cover</label>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mb-3 hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-w-md h-64 object-cover rounded-lg border-2 border-gray-300">
                        <button type="button" onclick="removeImage()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                            ❌ Hapus Gambar
                        </button>
                    </div>

                    <input type="file" name="image" id="imageInput" accept="image/*"
                        onchange="previewImage(event)"
                        class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        📸 Format: JPG, PNG, GIF. Maksimal 5MB. Gambar akan otomatis dioptimasi.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ringkasan/Excerpt</label>
                    <textarea name="excerpt" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ringkasan singkat berita untuk preview (opsional)...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita * 
                        <span class="text-xs text-gray-500">(Gunakan editor untuk format teks)</span>
                    </label>
                    <textarea name="content" id="ckeditor">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
<!-- INPUT TAGS -->
<div>
   <label class="block text-sm font-medium text-gray-700 mb-2">Tags (Opsional)</label>
   <div class="space-y-2">
       @foreach($tags as $tag)
           <label class="inline-flex items-center mr-4">
               <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                   {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-indigo-600 shadow-sm">
               <span class="ml-2 text-sm text-gray-700">#{{ $tag->name }}</span>
           </label>
       @endforeach
   </div>
   @if($tags->count() == 0)
       <p class="text-sm text-gray-500 mt-2">
           Belum ada tag. <a href="{{ route('admin.tags.create') }}" class="text-indigo-600">Buat tag baru</a>
       </p>
   @endif
</div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>📝 Draft (Belum Dipublikasi)</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>✅ Published (Langsung Tayang)</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                        Batal
                    </a>
                    <button type="submit" id="submitBtn" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                        💾 Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    let editorInstance;

    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#ckeditor'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'link', 'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo', '|',
                    'alignment'
                ]
            },
            language: 'id',
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            }
        })
        .then(editor => {
            editorInstance = editor;
            window.editor = editor;
            console.log('CKEditor loaded successfully!');
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });

    // Handle form submit - Update textarea dengan data dari CKEditor
    document.querySelector('form').addEventListener('submit', function(e) {
        if (editorInstance) {
            const content = editorInstance.getData();
            document.querySelector('#ckeditor').value = content;
            
            // Validasi kalau konten kosong
            if (!content || content.trim() === '') {
                e.preventDefault();
                alert('❌ Konten berita tidak boleh kosong!');
                return false;
            }
        }
    });

    // Image Preview Function
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('previewImg').src = '';
    }
</script>
@endsection