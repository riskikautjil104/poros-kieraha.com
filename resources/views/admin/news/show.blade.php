{{-- @extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-3xl font-bold mb-2">{{ $news->title }}</h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $news->user->name }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $news->category->name }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $news->created_at->format('d M Y H:i') }}
                        </span>
                        <span class="px-2 py-1 text-xs rounded {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($news->status) }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.news.edit', $news) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>

            @if($news->image)
                <div class="mb-6">
                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full max-h-96 object-cover rounded-lg">
                </div>
            @endif

            @if($news->excerpt)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border-l-4 border-indigo-500">
                    <p class="text-lg text-gray-700 italic">{{ $news->excerpt }}</p>
                </div>
            @endif

            <div class="prose max-w-none">
                {!! nl2br(e($news->content)) !!}
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    <p><strong>Dibuat:</strong> {{ $news->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Terakhir diupdate:</strong> {{ $news->updated_at->format('d M Y H:i') }}</p>
                    @if($news->published_at)
                        <p><strong>Dipublikasi:</strong> {{ $news->published_at->format('d M Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
               @if($news->tags->count() > 0)
    <div class="mt-4 flex flex-wrap gap-2">
        <span class="text-sm text-gray-500">Tags:</span>
        @foreach($news->tags as $tag)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                #{{ $tag->name }}
            </span>
        @endforeach
    </div>
@endif
                <div>
                    <h2 class="text-3xl font-bold mb-2">{{ $news->title }}</h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $news->user->name }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $news->category->name }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $news->created_at->format('d M Y H:i') }}
                        </span>
                        <span class="px-2 py-1 text-xs rounded {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($news->status) }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.news.edit', $news) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        ✏️ Edit
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        ← Kembali
                    </a>
                </div>
            </div>

            @if($news->image)
                <div class="mb-6">
                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" 
                         class="w-full max-h-96 object-cover rounded-lg shadow-lg">
                </div>
            @endif

            @if($news->excerpt)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border-l-4 border-indigo-500">
                    <p class="text-lg text-gray-700 italic">{{ $news->excerpt }}</p>
                </div>
            @endif

            <!-- Rich Text Content Display -->
            <div class="prose prose-lg max-w-none">
                {!! $news->content !!}
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500 space-y-1">
                    <p><strong>Dibuat:</strong> {{ $news->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Terakhir diupdate:</strong> {{ $news->updated_at->format('d M Y H:i') }}</p>
                    @if($news->published_at)
                        <p><strong>Dipublikasi:</strong> {{ $news->published_at->format('d M Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Prose Styling untuk Rich Content */
    .prose {
        color: #374151;
        max-width: 100%;
    }
    .prose h1 { font-size: 2em; font-weight: bold; margin-top: 0.5em; }
    .prose h2 { font-size: 1.5em; font-weight: bold; margin-top: 0.5em; }
    .prose h3 { font-size: 1.25em; font-weight: bold; margin-top: 0.5em; }
    .prose p { margin: 1em 0; line-height: 1.75; }
    .prose a { color: #4f46e5; text-decoration: underline; }
    .prose strong { font-weight: 600; }
    .prose em { font-style: italic; }
    .prose ul, .prose ol { margin: 1em 0; padding-left: 2em; }
    .prose li { margin: 0.5em 0; }
    .prose img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1.5em 0; }
    .prose blockquote { 
        border-left: 4px solid #e5e7eb; 
        padding-left: 1em; 
        margin: 1.5em 0; 
        font-style: italic; 
        color: #6b7280;
    }
    .prose code {
        background: #f3f4f6;
        padding: 0.2em 0.4em;
        border-radius: 0.25rem;
        font-size: 0.875em;
    }
    .prose pre {
        background: #1f2937;
        color: #f9fafb;
        padding: 1em;
        border-radius: 0.5rem;
        overflow-x: auto;
    }
    .prose table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5em 0;
    }
    .prose th, .prose td {
        border: 1px solid #e5e7eb;
        padding: 0.75em;
        text-align: left;
    }
    .prose th {
        background: #f9fafb;
        font-weight: 600;
    }
</style>
@endsection