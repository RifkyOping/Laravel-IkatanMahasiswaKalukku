<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'source_link' => 'nullable|url',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif'
        ], [
            'images.max' => 'Maksimal gambar yang diizinkan adalah 3.',
        ]);

        $data = $request->only(['title', 'content', 'source_link']);
        $data['slug'] = Str::slug($request->title) . '-' . time();

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('news', 'public');
            }
        }
        $data['images'] = $imagePaths;

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'source_link' => 'nullable|url',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif'
        ], [
            'images.max' => 'Maksimal gambar yang diizinkan adalah 3.',
        ]);

        $data = $request->only(['title', 'content', 'source_link']);
        
        // Only update slug if title changed significantly (optional, keeping it simple here)
        if ($request->title !== $news->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        if ($request->hasFile('images')) {
            // Delete old images
            if ($news->images && is_array($news->images)) {
                foreach ($news->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('news', 'public');
            }
            $data['images'] = $imagePaths;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->images && is_array($news->images)) {
            foreach ($news->images as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
