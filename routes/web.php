<?php

use App\Http\Controllers\FilmesController;
use App\Http\Controllers\SeriesController;
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
Route::get('/oi', function () {
    echo ('oi');
});

Route::get('/serie', [SeriesController::class, 'index']);
Route::get('/serie/criar', [SeriesController::class, 'create']);
Route::post("/serie/salvar", [SeriesController::class, 'store']);

Route::get('/filmes/criar', [FilmesController::class, 'create']);
Route::get('/filmes', [FilmesController::class, 'index']);
Route::post("/filmes/salvar", [FilmesController::class, 'store']);