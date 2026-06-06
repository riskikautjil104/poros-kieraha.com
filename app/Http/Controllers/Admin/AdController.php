<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::ordered()->get();
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|in:sidebar,content,footer',
            'is_active' => 'boolean',
            'is_premium' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Buat folder jika belum ada
            $uploadPath = public_path('assets/img/ads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($uploadPath, $filename);
            $imagePath = $filename;
        }

        Ad::create([
            'title' => $request->title,
            'link' => $request->link,
            'image' => $imagePath,
            'position' => $request->position,
            'is_active' => $request->boolean('is_active'),
            'is_premium' => $request->boolean('is_premium'),
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.ads.index')
            ->with('success', 'Iklan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|in:sidebar,content,footer',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = $ad->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($ad->image && file_exists(public_path('assets/img/ads/' . $ad->image))) {
                unlink(public_path('assets/img/ads/' . $ad->image));
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/ads'), $filename);
            $imagePath = $filename;
        }

        $ad->update([
            'title' => $request->title,
            'link' => $request->link,
            'image' => $imagePath,
            'position' => $request->position,
            'is_active' => $request->boolean('is_active'),
            'is_premium' => $request->boolean('is_premium'),
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.ads.index')
            ->with('success', 'Iklan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        // Delete image file
        if ($ad->image && file_exists(public_path('assets/img/ads/' . $ad->image))) {
            unlink(public_path('assets/img/ads/' . $ad->image));
        }

        $ad->delete();

        return redirect()->route('admin.ads.index')
            ->with('success', 'Iklan berhasil dihapus');
    }

    /**
     * Track ad click
     */
    public function click(Ad $ad)
    {
        $ad->incrementClick();

        if ($ad->link) {
            return redirect($ad->link);
        }

        return redirect()->back();
    }
}
