<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ResepsionisController extends Controller
{
    public function dashboard()
    {
        $items = Item::latest()->paginate(10);

        $stats = [
            'total' => Item::count(),
            'dilaporkan' => Item::where('status', 'dilaporkan')->count(),
            'ada_di_resepsionis' => Item::where('status', 'ada_di_resepsionis')->count(),
            'sudah_diambil' => Item::where('status', 'sudah_diambil')->count(),
            'ditutup' => Item::where('status', 'ditutup')->count(),
            'hilang' => Item::where('type', 'hilang')->count(),
            'ditemukan' => Item::where('type', 'ditemukan')->count(),
        ];

        $pendingItems = Item::where('status', 'dilaporkan')
            ->latest()
            ->take(5)
            ->get();

        return view('resepsionis.dashboard', compact('items', 'stats', 'pendingItems'));
    }

    public function updateStatus(Request $request, Item $item)
    {
        $validated = $request->validate([
            'status' => 'required|in:dilaporkan,ada_di_resepsionis,sudah_diambil,ditutup',
        ]);

        $item->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}