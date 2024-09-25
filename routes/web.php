<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\ExtractionController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\MemoController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/playlists.create', function () {
    return view('playlists.create');
})->middleware(['auth', 'verified'])->name('playlists.create');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// 🔽 追加
    Route::resource('uploads', UploadController::class);
});

require __DIR__.'/auth.php';






Route::post('/upload', [UploadController::class, 'store'])->name('upload');
Route::get('/uploads', [UploadController::class, 'index'])->name('uploads.index');

Route::get('/extractions/create/{upload}', [ExtractionController::class, 'create'])->name('extractions.create');
Route::post('/extraction', [ExtractionController::class, 'store'])->name('extractions.store');
Route::get('/extractions', [ExtractionController::class, 'index'])->name('extractions.index');
Route::get('/extractions/{extraction}', [ExtractionController::class, 'show'])->name('extractions.show');
Route::delete('/extractions/{extraction}', [ExtractionController::class, 'destroy'])->name('extractions.destroy');


Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
Route::get('/playlist/play/{id}', [PlaylistController::class, 'play'])->name('playlists.play');

Route::get('/memos/create/{extraction}', [MemoController::class, 'create'])->name('memos.create');
Route::post('/memos/{extraction}', [MemoController::class, 'store'])->name('memos.store');
Route::get('/memos', [MemoController::class, 'index'])->name('memos.index');
Route::get('/memos/{memo}', [MemoController::class, 'show'])->name('memos.show');
Route::delete('/memos/{memo}', [MemoController::class, 'destroy'])->name('memos.destroy');
Route::get('/memos/{memo}/edit', [MemoController::class, 'edit'])->name('memos.edit');
Route::put('/memos/{extraction}', [MemoController::class, 'update'])->name('memos.update');
