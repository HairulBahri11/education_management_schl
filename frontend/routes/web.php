<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\programCotroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('index');
});

// Route::get('program', function () {
//     return view('program');
// });

Route::group(['prefix' => 'program'], function () {
    Route::get('/', [programController::class, 'index'])->name('program.index');
    Route::get('/{id}', [programController::class, 'show'])->name('program.show');
    Route::post('/store', [programController::class, 'store'])->name('program.store');
    Route::post('/{id}/update', [programController::class, 'update'])->name('program.update');
    Route::delete('/{id}/destroy', [programController::class, 'destroy'])->name('program.destroy');
});
