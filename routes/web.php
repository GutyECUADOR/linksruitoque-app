<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/faq', function () {
    return view('faq');
})->name('preguntas-frecuentes');

Route::get('/return/{referencia}', function () {
    return view('return');
})->name('return-page');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::post('/invoices', [InvoiceController::class, 'consultar'])->name('invoices.consultar');
Route::resource('/pagos', PagosController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/anulacion-facturas', function () {
    return view('anulacion-facturas.index');
})->middleware(['auth', 'verified'])->name('anulacion-facturas');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
