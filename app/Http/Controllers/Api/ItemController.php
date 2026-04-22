<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['user:id,name,email', 'validator:id,name,email'])
            ->latest()
            ->get();

        return response()->json($items);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:hilang,ditemukan'],
            'location' => ['required', 'string', 'max:150'],
            'date_event' => ['required', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'dilaporkan';

        $item = Item::create($validated);

        return response()->json([
            'message' => 'Laporan berhasil dibuat.',
            'data' => $item->load('user:id,name,email'),
        ], 201);
    }

    public function show(Item $item)
    {
        $item->load([
            'user:id,name,email',
            'validator:id,name,email',
            'comments.user:id,name,email',
            'proofImages',
        ]);

        return response()->json($item);
    }

    public function update(Request $request, Item $item)
    {
        if ($request->user()->id !== $item->user_id) {
            return response()->json([
                'message' => 'Kamu tidak berhak mengubah laporan ini.'
            ], 403);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:150'],
            'description' => ['sometimes', 'required', 'string'],
            'type' => ['sometimes', 'required', 'in:hilang,ditemukan'],
            'location' => ['sometimes', 'required', 'string', 'max:150'],
            'date_event' => ['sometimes', 'required', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return response()->json([
            'message' => 'Laporan berhasil diperbarui.',
            'data' => $item->fresh(),
        ]);
    }

    public function destroy(Request $request, Item $item)
    {
        if ($request->user()->id !== $item->user_id) {
            return response()->json([
                'message' => 'Kamu tidak berhak menghapus laporan ini.'
            ], 403);
        }

        $item->delete();

        return response()->json([
            'message' => 'Laporan berhasil dihapus.'
        ]);
    }
}