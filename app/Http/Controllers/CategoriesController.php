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
        'name' => 'required|string|max:255',
        'division' => 'required|in:Sarpras,Tata Usaha,Tefa'
    ], [
        'name.required' => 'The name field is required.',
        'division.required' => 'The division pj field is required.'
    ]);

    Categories::create([
        'name' => $request->name,
        'division' => $request->division,
        'total_items' => 0,
    ]);

    return redirect()->route('categories.index')->with('success', 'Category added successfully!');
}

    public function show(Categories $categories)
    {
        //
    }
    public function edit(Categories $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|in:Sarpras,Tata Usaha,Tefa'
        ], [
            'name.required' => 'The name field is required.',
            'division.required' => 'The division pj field is required.'
        ]);

        $category->update([
            'name' => $request->name,
            'division' => $request->division,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
