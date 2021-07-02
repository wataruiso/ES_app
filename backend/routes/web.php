<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Auth\LoginController;
use Laravel\Socialite\Facades\Socialite;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [TodoController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/todo/create', [TodoController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->post('/todo', [TodoController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->get('/todo/{id}/edit', [TodoController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->put('/todo/{id}', [TodoController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->delete('/todo/{id}', [TodoController::class, 'delete']);


Route::prefix('oauth/{provider}')->where(['provider' => '(line|twitter|facebook|google|yahoo)'])->group(function(){
    Route::get('/redirect', [LoginController::class, 'redirectToProvider']);
    Route::get('/callback', [LoginController::class, 'handleProviderCallback']);
});