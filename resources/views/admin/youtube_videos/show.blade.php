@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail YouTube Video</h2>
            <a href="{{ route('admin.youtube-videos.index') }}" class="text-blue-600 hover:text-blue-900 font-semibold">&larr; Kembali</a>
        </div>

        <div class="max-w-3xl">
            <p class="text-sm text-gray-500">Judul</p>
            <h3 class="text-xl font-bold mb-4">{{ $video->title }}</h3>

            <p class="text-sm text-gray-500">URL</p>
            <p class="mb-4">
                @if($video->youtube_url)
                    <a href="{{ $video->youtube_url }}" target="_blank" class="text-blue-600 hover:text-blue-900">{{ $video->youtube_url }}</a>
                @else
                    <span class="text-gray-400">-</span>
                @endif
            </p>

            <p class="text-sm text-gray-500">Deskripsi</p>
            <p class="mb-6">{{ $video->description ?: '-' }}</p>

            <div>
                <h4 class="font-bold mb-2">Embed</h4>
                @if($video->embed_url)
                    <div class="aspect-video">
                        <iframe class="w-full h-full" src="{{ $video->embed_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @else
                    <p class="text-sm text-gray-500">Tidak bisa membuat embed dari URL.</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

