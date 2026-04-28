<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
public function index(Request $request)
{
    $query = Item::query();

    // SEARCH
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%')
              ->orWhere('location', 'like', '%' . $search . '%');
        });
    }

    // FILTER TYPE
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // FILTER STATUS
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $items = $query->latest()->paginate(10)->withQueryString();

    $stats = [
        'total' => Item::count(),
        'hilang' => Item::where('type', 'hilang')->count(),
        'ditemukan' => Item::where('type', 'ditemukan')->count(),
        'sudah_diambil' => Item::where('status', 'sudah_diambil')->count(),
    ];

    return view('items.index', compact('items', 'stats'));
}

    public function show(Item $item)
    {
        $item->load('user', 'comments.user', 'proofImages');

        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'type' => 'required|in:hilang,ditemukan',
            'location' => 'required|string|max:150',
            'date_event' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'dilaporkan';

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Laporan berhasil dibuat!');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'type' => 'required|in:hilang,ditemukan',
            'location' => 'required|string|max:150',
            'date_event' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('items.show', $item)->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Laporan berhasil dihapus!');
    }
}