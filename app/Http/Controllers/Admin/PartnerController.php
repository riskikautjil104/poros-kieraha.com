<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FcmService;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = \App\Models\Partner::orderBy('sort_order')->latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:2048',
            'link' => 'nullable|url|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $partner = \App\Models\Partner::create([
            'name' => $request->name,
            'category' => $request->category,
            'image_url' => $request->image_url,
            'link' => $request->link,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($partner->is_active) {
            FcmService::sendPartnerNotification($partner);
        }

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan');
    }

    public function edit(\App\Models\Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, \App\Models\Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:2048',
            'link' => 'nullable|url|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $partner->update([
            'name' => $request->name,
            'category' => $request->category,
            'image_url' => $request->image_url,
            'link' => $request->link,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui');
    }

    public function destroy(\App\Models\Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus');
    }
}
