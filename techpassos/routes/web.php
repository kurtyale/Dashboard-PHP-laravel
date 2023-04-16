<?php

use App\Http\Controllers\TemperaturaController;
use App\Http\Controllers\UmidadeController;
use App\Services\UmidadeService;
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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/dashboard', [UmidadeController::class, 'index'])->name('umidade')->middleware('auth');
Route::get('/get_chart_data', [UmidadeController::class, 'getData']);
Route::get('/get_chart_umidade', [UmidadeController::class, 'getUmidade']);


Route::fallback(function () {
    return view('404');
});

Route::redirect('/', '/dashboard');
