@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit YouTube Video</h2>
            <a href="{{ route('admin.youtube-videos.index') }}" class="text-blue-600 hover:text-blue-900 font-semibold">&larr; Kembali</a>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.youtube-videos.update', $video) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ $video->title }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">YouTube URL</label>
                    <input type="text" name="youtube_url" value="{{ $video->youtube_url }}" class="w-full border rounded px-3 py-2" placeholder="watch?v=... / youtu.be/... / embed/..." required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ $video->description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail (opsional)</label>
                    <input type="text" name="thumbnail" value="{{ $video->thumbnail }}" class="w-full border rounded px-3 py-2" placeholder="nama file atau URL">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="sort_order" value="{{ $video->sort_order }}" class="w-full border rounded px-3 py-2" min="0">
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" value="1" {{ $video->is_active ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Update</button>
                <a href="{{ route('admin.youtube-videos.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded">Batal</a>
            </div>
        </form>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-3">Preview Embed</h3>
            @if($video->embed_url)
                <div class="aspect-video max-w-3xl">
                    <iframe class="w-full h-full" src="{{ $video->embed_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            @else
                <p class="text-sm text-gray-500">Tidak bisa membuat embed dari URL.</p>
            @endif
        </div>

    </div>
</div>
@endsection

