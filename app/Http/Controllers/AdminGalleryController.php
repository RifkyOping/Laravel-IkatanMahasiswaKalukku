<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest('date')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'date' => 'required|date',
            'images' => 'required|array|min:1|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif'
        ], [
            'images.max' => 'Maksimal foto yang diizinkan adalah 3.',
            'images.required' => 'Minimal harus mengunggah 1 foto.',
        ]);

        $data = $request->only(['title', 'content', 'date']);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('galleries', 'public');
            }
        }
        $data['images'] = $imagePaths;

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'date' => 'required|date',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif'
        ], [
            'images.max' => 'Maksimal foto yang diizinkan adalah 3.',
        ]);

        $data = $request->only(['title', 'content', 'date']);

        if ($request->hasFile('images')) {
            if ($gallery->images && is_array($gallery->images)) {
                foreach ($gallery->images as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('galleries', 'public');
            }
            $data['images'] = $imagePaths;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->images && is_array($gallery->images)) {
            foreach ($gallery->images as $oldImage) {
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus!');
    }
}
