<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use App\Models\Item;
use App\Exports\LendingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $lendings = Lending::with(['item', 'user'])->latest()->get();
    return view('lending.index', compact('lendings'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        return view('lending.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'item_id' => 'required|array',
            'total_items' => 'required|array',
            'keterangan' => 'required|string',
        ]);

        foreach ($request->item_id as $key => $itemId) {
            $item = Item::findOrFail($itemId);
            $requestedTotal = $request->total_items[$key];

            $available = $item->total - $item->repair - $item->lending_id;

            if ($requestedTotal > $available) {
                return redirect()->back()->withInput()->with('error', 'Total item more than available!');
            }
        }

        foreach ($request->item_id as $key => $itemId) {
            $item = Item::findOrFail($itemId);
            $requestedTotal = $request->total_items[$key];

            Lending::create([
                'item_id' => $itemId,
                'user_id' => auth()->id() ?? 1,
                'name' => $request->name,
                'total_items' => $requestedTotal,
                'keterangan' => $request->keterangan,
                'date' => now(),
            ]);

            $item->update([
                'lending_id' => $item->lending_id + $requestedTotal
            ]);
        }

        return redirect()->route('lendings.index')->with('success', 'Success add new lending item!');
    }

    /**
     * Display the specified resource.
     */
    public function show(lending $lending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lending $lending)
    {
        $lending->update([
            'return_date' => now()
        ]);

        $item = $lending->item;
        $item->update([
            'lending_id' => $item->lending_id - $lending->total_items
        ]);

        return redirect()->route('lendings.index')->with('success', 'Item is returned!');
    }

    public function export()
    {
        return Excel::download(new LendingsExport, 'lendings.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lending $lending)
    {
        if (is_null($lending->return_date)) {
            $item = $lending->item;
            $item->update([
                'lending_id' => $item->lending_id - $lending->total_items
            ]);
        }

        $lending->delete();

        return redirect()->route('lendings.index')->with('warning', 'Success deleted one data lending!');
    }
}
