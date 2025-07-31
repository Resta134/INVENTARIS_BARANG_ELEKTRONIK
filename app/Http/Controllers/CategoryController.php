<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;

        $categories = Category::when($q, function ($query, $search) {
            $query->where('nama_kategori', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('dashboard.categories.index', compact('categories', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category-images', 'public');
        }

        Category::create([
            'nama_kategori' => $request->nama_kategori,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('kategori.index')->with('successMessage', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Category::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|max:255|unique:categories,nama_kategori,' . $kategori->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $kategori->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category-images', 'public');
        }

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('kategori.index')->with('successMessage', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Category::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('successMessage', 'Kategori berhasil dihapus.');
    }
}
