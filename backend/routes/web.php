<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\EntryController;
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



Route::prefix('oauth/{provider}')->where(['provider' => '(line|twitter|facebook|google|yahoo)'])->group(function(){
    Route::get('/redirect', [LoginController::class, 'redirectToProvider']);
    Route::get('/callback', [LoginController::class, 'handleProviderCallback']);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::get('/dashboard', [TodoController::class, 'index'])->name('dashboard');

    Route::prefix('todo')->group(function(){

        Route::get('/create', [TodoController::class, 'create']);
        Route::post('/', [TodoController::class, 'store']);
        Route::get('/{id}/edit', [TodoController::class, 'edit']);
        Route::put('/{id}', [TodoController::class, 'update']);
        Route::delete('/{id}', [TodoController::class, 'delete']);

    });
    
    Route::prefix('entry')->group(function(){

        Route::get('/', [EntryController::class, 'index'])->name('entry');
        Route::get('/create', [EntryController::class, 'create']);
        
    });
});
