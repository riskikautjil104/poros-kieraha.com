<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Middleware: hanya admin yang bisa akses
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of tags
     */
    public function index()
    {
        $tags = Tag::withCount('news')
                   ->orderBy('name')
                   ->paginate(15);

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created tag
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create($validated);

        return redirect()->route('admin.tags.index')
                        ->with('success', 'Tag berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the tag
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the tag
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')
                        ->with('success', 'Tag berhasil diupdate!');
    }

    /**
     * Remove the tag
     */
    public function destroy(Tag $tag)
    {
        // Cek apakah tag masih dipakai
        if ($tag->news()->count() > 0) {
            return redirect()->route('admin.tags.index')
                            ->with('error', 'Tag tidak bisa dihapus karena masih digunakan di ' . $tag->news()->count() . ' berita!');
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')
                        ->with('success', 'Tag berhasil dihapus!');
    }
}