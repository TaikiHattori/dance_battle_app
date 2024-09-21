<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\ExtractionController;
use App\Http\Controllers\PlaylistController;


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