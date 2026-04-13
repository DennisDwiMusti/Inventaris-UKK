<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // unique:nama_tabel,nama_kolom
            'name' => 'required|string|max:255|unique:categories,name',
            'division' => 'required|in:Sarpras,Tata Usaha,Tefa'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah ada, gunakan nama lain.',
            'division.required' => 'Divisi wajib dipilih.'
        ]);

        Categories::create([
            'name' => $request->name,
            'division' => $request->division,
            'total_items' => 0,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Categories $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            // unique:nama_tabel,nama_kolom,kecualikan_id
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'division' => 'required|in:Sarpras,Tata Usaha,Tefa'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah ada.',
            'division.required' => 'Divisi wajib dipilih.'
        ]);

        $category->update([
            'name' => $request->name,
            'division' => $request->division,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
