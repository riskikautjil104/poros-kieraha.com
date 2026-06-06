<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YoutubeVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = \App\Models\YoutubeVideo::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.youtube_videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.youtube_videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'sort_order' => 'sometimes|integer|min:0',
        ]);

        \App\Models\YoutubeVideo::create([
            'title' => $validated['title'],
            'youtube_url' => $validated['youtube_url'],
            'description' => $validated['description'] ?? null,
            'thumbnail' => $validated['thumbnail'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.youtube-videos.index')
            ->with('success', 'YouTube video berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video = \App\Models\YoutubeVideo::findOrFail($id);

        return view('admin.youtube_videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = \App\Models\YoutubeVideo::findOrFail($id);

        return view('admin.youtube_videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $video = \App\Models\YoutubeVideo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'sort_order' => 'sometimes|integer|min:0',
        ]);

        $video->update([
            'title' => $validated['title'],
            'youtube_url' => $validated['youtube_url'],
            'description' => $validated['description'] ?? null,
            'thumbnail' => $validated['thumbnail'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.youtube-videos.index')
            ->with('success', 'YouTube video berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = \App\Models\YoutubeVideo::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.youtube-videos.index')
            ->with('success', 'YouTube video berhasil dihapus!');
    }
}

