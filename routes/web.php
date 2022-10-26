<?php

use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('test', [\App\Http\Controllers\TestController::class, 'index']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('favourites', [FavouriteController::class, 'index'])->name('favourites');
    Route::post('favourites', [FavouriteController::class, 'store'])->name('favourites.store');
    Route::post('query-weather-details', [WeatherController::class, 'queryWeatherDetails'])->name('query.weather.details');
});

require __DIR__.'/auth.php';
