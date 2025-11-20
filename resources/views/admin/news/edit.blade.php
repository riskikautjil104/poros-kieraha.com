{{-- @extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Edit Berita</h2>

            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
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
                    
                    @if($news->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-48 h-48 object-cover rounded">
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    
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
                    <p class="text-gray-500 text-xs mt-1">Upload gambar baru jika ingin mengganti. Format: JPG, PNG. Maksimal 2MB</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ringkasan/Excerpt</label>
                    <textarea name="excerpt" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $news->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konten Berita *</label>
                    <textarea name="content" rows="15" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
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
                        Update Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Edit Berita</h2>

            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
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
                    
                    <!-- Current Image -->
                    @if($news->image)
                        <div class="mb-3" id="currentImage">
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" 
                                 class="max-w-md h-64 object-cover rounded-lg border-2 border-gray-300">
                            <p class="text-xs text-gray-500 mt-1">📷 Gambar saat ini</p>
                        </div>
                    @endif
                    
                    <!-- New Image Preview -->
                    <div id="newImagePreview" class="mb-3 hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-w-md h-64 object-cover rounded-lg border-2 border-indigo-300">
                        <p class="text-xs text-indigo-600 mt-1">🆕 Gambar baru (belum disimpan)</p>
                        <button type="button" onclick="removeNewImage()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                            ❌ Batal Ganti Gambar
                        </button>
                    </div>

                    <input type="file" name="image" id="imageInput" accept="image/*"
                        onchange="previewNewImage(event)"
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
                        📸 Upload gambar baru jika ingin mengganti. Format: JPG, PNG, GIF. Maksimal 5MB.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ringkasan/Excerpt</label>
                    <textarea name="excerpt" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $news->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita * 
                        <span class="text-xs text-gray-500">(Gunakan editor untuk format teks)</span>
                    </label>
                    <textarea name="content" id="ckeditor">{{ old('content', $news->content) }}</textarea>
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
                   {{ in_array($tag->id, old('tags', $news->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-indigo-600 shadow-sm">
               <span class="ml-2 text-sm text-gray-700">#{{ $tag->name }}</span>
           </label>
       @endforeach
   </div>
</div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                        <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>✅ Published</option>
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
                        💾 Update Berita
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

    // New Image Preview Function
    function previewNewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('newImagePreview');
        const previewImg = document.getElementById('previewImg');
        const currentImage = document.getElementById('currentImage');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                if (currentImage) {
                    currentImage.style.opacity = '0.5';
                }
            }
            reader.readAsDataURL(file);
        }
    }

    function removeNewImage() {
        const currentImage = document.getElementById('currentImage');
        document.getElementById('imageInput').value = '';
        document.getElementById('newImagePreview').classList.add('hidden');
        document.getElementById('previewImg').src = '';
        if (currentImage) {
            currentImage.style.opacity = '1';
        }
    }
</script>
@endsection
{{-- @extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Edit Berita</h2>

            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
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
                    
                    <!-- Current Image -->
                    @if($news->image)
                        <div class="mb-3" id="currentImage">
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" 
                                 class="max-w-md h-64 object-cover rounded-lg border-2 border-gray-300">
                            <p class="text-xs text-gray-500 mt-1">📷 Gambar saat ini</p>
                        </div>
                    @endif
                    
                    <!-- New Image Preview -->
                    <div id="newImagePreview" class="mb-3 hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-w-md h-64 object-cover rounded-lg border-2 border-indigo-300">
                        <p class="text-xs text-indigo-600 mt-1">🆕 Gambar baru (belum disimpan)</p>
                        <button type="button" onclick="removeNewImage()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                            ❌ Batal Ganti Gambar
                        </button>
                    </div>

                    <input type="file" name="image" id="imageInput" accept="image/*"
                        onchange="previewNewImage(event)"
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
                        📸 Upload gambar baru jika ingin mengganti. Format: JPG, PNG, GIF. Maksimal 5MB.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ringkasan/Excerpt</label>
                    <textarea name="excerpt" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $news->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita * 
                        <span class="text-xs text-gray-500">(Gunakan editor untuk format teks)</span>
                    </label>
                    <textarea name="content" id="tinymce-editor" required>{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                        <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>✅ Published</option>
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
                        💾 Update Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
        
        content_css: 'default',
        
        language: 'id_ID',
        language_url: 'https://cdn.tiny.cloud/1/no-api-key/tinymce/6/langs/id_ID.js'
    });

    // New Image Preview Function
    function previewNewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('newImagePreview');
        const previewImg = document.getElementById('previewImg');
        const currentImage = document.getElementById('currentImage');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                if (currentImage) {
                    currentImage.style.opacity = '0.5';
                }
            }
            reader.readAsDataURL(file);
        }
    }

    function removeNewImage() {
        const currentImage = document.getElementById('currentImage');
        document.getElementById('imageInput').value = '';
        document.getElementById('newImagePreview').classList.add('hidden');
        document.getElementById('previewImg').src = '';
        if (currentImage) {
            currentImage.style.opacity = '1';
        }
    }
</script>
@endsection --}}