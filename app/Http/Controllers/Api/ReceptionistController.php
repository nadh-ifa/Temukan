<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function updateStatus(Request $request, Item $item)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:ada_di_resepsionis,sudah_diambil,ditutup'],
        ]);

        $item->update([
            'status' => $validated['status'],
            'validated_by' => $request->user()->id,
            'validated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Status laporan berhasil diperbarui.',
            'data' => $item->fresh(),
        ]);
    }
}