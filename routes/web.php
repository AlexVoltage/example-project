<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuRelationController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\CityMenuController;

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

Route::post('/relations/create', [MenuRelationController::class, 'create']);
Route::post('/relations/getAll', [MenuRelationController::class, 'getAll']);
Route::get('/select/', [SelectController::class, 'select']);
Route::get('/cityMenu/', [CityMenuController::class, 'addToDatabase']);
