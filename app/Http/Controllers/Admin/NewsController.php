<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver; 

class NewsController extends Controller
{
    public function index()
    {
        $query = News::with(['category', 'user']);
        
        // Admin bisa lihat semua, Penulis hanya berita sendiri
        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }
        
        $news = $query->latest()->paginate(10);
        
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::orderBy('name')->get();
        return view('admin.news.create', compact('categories', 'tags'));
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|max:255',
    //         'category_id' => 'required|exists:categories,id',
    //         'content' => 'required',
    //         'excerpt' => 'nullable',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
    //         'status' => 'required|in:draft,published', 
    //             'tags' => 'nullable|array', // 🔥 TAMBAH INI
    // 'tags.*' => 'exists:tags,id'
    //     ]);

    //     // Generate slug
    //     $validated['slug'] = Str::slug($validated['title']);
    //     $validated['user_id'] = auth()->id();

    //     // Handle & Optimize Image Upload
    //     if ($request->hasFile('image')) {
    //         $validated['image'] = $this->handleImageUpload($request->file('image'));
    //     }

    //     // Set published_at jika status published
    //     if ($validated['status'] == 'published') {
    //         $validated['published_at'] = now();
    //     }

    //     News::create($validated);
    //     if ($request->has('tags')) {
    //         $news->tags()->attach($request->tags);
    //     }

    //     return redirect()->route('admin.news.index')
    //         ->with('success', 'Berita berhasil dibuat! 🎉');
    // }
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required',
        'excerpt' => 'nullable',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'status' => 'required|in:draft,published',
        'tags' => 'nullable|array',
        'tags.*' => 'exists:tags,id'
    ]);

    $validated['slug'] = Str::slug($validated['title']);
    $validated['user_id'] = auth()->id();

    if ($request->hasFile('image')) {
        $validated['image'] = $this->handleImageUpload($request->file('image'));
    }

    if ($validated['status'] == 'published') {
        $validated['published_at'] = now();
    }

    // ✅ Simpan ke variabel
    $news = News::create($validated);

    // ✅ Attach tags setelah news dibuat
    if (!empty($validated['tags'])) {
        $news->tags()->attach($validated['tags']);
    }

    return redirect()->route('admin.news.index')
        ->with('success', 'Berita berhasil dibuat! 🎉');
}

    public function show(News $news)
    {
        $news->load('tags');
        // Penulis hanya bisa lihat berita sendiri
        if (!auth()->user()->isAdmin() && $news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        // Penulis hanya bisa edit berita sendiri
        if (!auth()->user()->isAdmin() && $news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        $tags = Tag::orderBy('name')->get();
        return view('admin.news.edit', compact('news', 'categories', 'tags'));
    }

    public function update(Request $request, News $news)
    {
        // Penulis hanya bisa update berita sendiri
        if (!auth()->user()->isAdmin() && $news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'excerpt' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:draft,published',
                'tags' => 'nullable|array', // 🔥 TAMBAH INI
    'tags.*' => 'exists:tags,id'
        ]);

        // Update slug jika title berubah
        $validated['slug'] = Str::slug($validated['title']);

        // Handle & Optimize Image Upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($news->image) {
                Storage::delete($news->image);
            }
            
            $validated['image'] = $this->handleImageUpload($request->file('image'));
        }

        // Set published_at jika status berubah ke published dan belum pernah published
        if ($validated['status'] == 'published' && !$news->published_at) {
            $validated['published_at'] = now();
        }

        $news->update($validated);
        if ($request->has('tags')) {
            $news->tags()->sync($request->tags);
        } else {
            $news->tags()->detach(); // Hapus semua tags
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diupdate! ✨');
    }

    public function destroy(News $news)
    {
        // Admin bisa hapus semua, Penulis hanya berita sendiri
        if (!auth()->user()->isAdmin() && $news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus gambar jika ada
        if ($news->image) {
            Storage::delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus! 🗑️');
    }

    /**
     * Handle Image Upload dengan Optimasi
     */
    // private function handleImageUpload($file)
    // {
    //     // Generate nama file unik
    //     $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        
    //     // Path untuk menyimpan
    //     $path = 'news/' . date('Y/m');
    //     $fullPath = storage_path('app/public/' . $path);
        
    //     // Buat folder jika belum ada
    //     if (!file_exists($fullPath)) {
    //         mkdir($fullPath, 0755, true);
    //     }

    //     // Resize & Optimize gambar
    //     $image = Image::make($file);
        
    //     // Resize ke max width 1200px, maintain aspect ratio
    //     if ($image->width() > 1200) {
    //         $image->resize(1200, null, function ($constraint) {
    //             $constraint->aspectRatio();
    //             $constraint->upsize();
    //         });
    //     }
        
    //     // Optimize quality (80% quality, good balance)
    //     $image->save($fullPath . '/' . $filename, 80);
        
    //     // Generate thumbnail (300x300)
    //     $thumbnailFilename = 'thumb_' . $filename;
    //     Image::make($file)
    //         ->fit(300, 300)
    //         ->save($fullPath . '/' . $thumbnailFilename, 75);

    //     return $path . '/' . $filename;
    // }
    private function handleImageUpload($file)
{
    $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
    $path = 'news/' . date('Y/m');
    $fullPath = storage_path('app/public/' . $path);
    
    if (!file_exists($fullPath)) {
        mkdir($fullPath, 0755, true);
    }

    // Init manager (v3 syntax)
    $manager = new ImageManager(new Driver());

    // Resize utama
    $image = $manager->read($file);
    if ($image->width() > 1200) {
        $image->scale(width: 1200);
    }
    $image->save($fullPath . '/' . $filename, quality: 80);

    // Thumbnail
    $thumb = $manager->read($file);
    $thumb->cover(width: 300, height: 300);
    $thumb->save($fullPath . '/thumb_' . $filename, quality: 75);

    return $path . '/' . $filename;
}
}