<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use App\Models\Item;
use App\Exports\LendingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LendingController extends Controller
{
    /**
     * Tampilkan daftar riwayat peminjaman dengan filter waktu.
     */
    public function index(Request $request)
    {
        $query = Lending::with(['item', 'user'])->latest();

        if ($request->filled('filter')) {
            $filter = $request->filter;
            if ($filter == 'day') {
                $query->where('date', '>=', Carbon::now()->subDay());
            } elseif ($filter == 'week') {
                $query->where('date', '>=', Carbon::now()->subWeek());
            } elseif ($filter == 'month') {
                $query->where('date', '>=', Carbon::now()->subMonth());
            }
        }

        $lendings = $query->get();
        return view('lending.index', compact('lendings'));
    }

    /**
     * Tampilkan halaman konfirmasi tanda tangan sebelum pengembalian.
     */
    public function confirm(Request $request, $id)
    {
        $lending = Lending::with('item')->findOrFail($id);

        // Menangkap data broken_items dari halaman index jika diisi di tabel
        $broken_items = $request->query('broken_items', 0);

        return view('lending.confirm-return', compact('lending', 'broken_items'));
    }

    /**
     * Form tambah peminjaman baru.
     */
    public function create()
    {
        $items = Item::all();
        return view('lending.create', compact('items'));
    }

    /**
     * Simpan data peminjaman baru dan update stok item.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'item_id' => 'required|array',
            'total_items' => 'required|array',
            'keterangan' => 'required|string',
        ]);

        // Validasi stok tersedia
        foreach ($request->item_id as $key => $itemId) {
            $item = Item::findOrFail($itemId);
            $requestedTotal = $request->total_items[$key];
            $available = $item->total - $item->repair - $item->lending_id;

            if ($requestedTotal > $available) {
                return redirect()->back()->withInput()->with('error', "Stok barang {$item->name} tidak mencukupi!");
            }
        }

        // Simpan data
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

        return redirect()->route('lendings.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Proses pengembalian barang, update stok fisik, dan download struk PDF.
     */
    public function update(Request $request, Lending $lending)
    {
        $request->validate([
            'broken_items' => 'required|numeric|min:0|max:' . $lending->total_items,
            'signature_peminjam' => 'required',
            'signature_petugas' => 'required'
        ]);

        // 1. Update Stok di tabel Item
        $item = $lending->item;
        $item->update([
            'lending_id' => $item->lending_id - $lending->total_items,
            'repair' => $item->repair + $request->broken_items
        ]);

        // 2. Tandai pengembalian selesai
        $lending->update(['return_date' => now()]);

        // 3. Generate Struk PDF dengan 2 tanda tangan
        $pdf = Pdf::loadView('lending.receipt_pdf', [
            'lending' => $lending,
            'broken_items' => $request->broken_items,
            'signature_peminjam' => $request->signature_peminjam,
            'signature_petugas' => $request->signature_petugas
        ]);

        // 4. Download file PDF secara otomatis
        return $pdf->download('Struk-Kembali-'.$lending->name.'.pdf');
    }

    /**
     * Export data peminjaman ke Excel.
     */
    public function export()
    {
        return Excel::download(new LendingsExport, 'lendings.xlsx');
    }

    /**
     * Hapus riwayat peminjaman (Kembalikan stok jika belum dikembalikan).
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
        return redirect()->route('lendings.index')->with('warning', 'Satu data peminjaman berhasil dihapus.');
    }
}
