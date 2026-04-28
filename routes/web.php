<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ResepsionisController;

// Redirect root ke items
Route::get('/', function () {
    return redirect()->route('items.index');
});

// Items - public 
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// Items - butuh login
Route::middleware('auth')->group(function () {

    // Dashboard user
    Route::get('/dashboard', function () {
        $myItems = \App\Models\Item::where('user_id', auth()->id())
            ->latest()->paginate(20);
        $recentItems = \App\Models\Item::with('user')
            ->latest()->take(5)->get();
        return view('dashboard', compact('myItems', 'recentItems'));
    })->middleware(['verified'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Items CRUD
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    // Comments
    Route::post('/items/{item}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Resepsionis routes
    Route::middleware('role:resepsionis')->prefix('resepsionis')->name('resepsionis.')->group(function () {
        Route::get('/dashboard', [ResepsionisController::class, 'dashboard'])->name('dashboard');
        Route::patch('/items/{item}/status', [ResepsionisController::class, 'updateStatus'])->name('updateStatus');
    });

});

// Detail item taruh paling bawah
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

require __DIR__.'/auth.php';