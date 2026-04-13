<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Exports\ItemExport;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('item.index', compact('items'));
    }

    public function create()
    {
        $categories = Categories::all();

        return view('item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total' => 'required|numeric|min:1',
        ], [
            'name.required' => 'The name field is required.',
            'category_id.required' => 'The category field is required.',
            'total.required' => 'The total field is required.',
        ]);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'repair' => 0,
            'lending_id' => 1,
        ]);

        return redirect()->route('items.index')->with('success', 'Item added successfully!');
    }

    public function show(Item $item)
    {
        //
    }

   public function edit(Item $item)
    {
        $categories = Categories::all();

        return view('item.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total' => 'required|numeric|min:1',
            'new_broke_item' => 'nullable|numeric|min:0',
        ]);

        $broken_input = $request->new_broke_item ? $request->new_broke_item : 0;
        $new_repair_total = $item->repair + $broken_input;

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'repair' => $new_repair_total,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    public function export()
    {
        return Excel::download(new ItemExport, 'items.xlsx');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
    }
}
