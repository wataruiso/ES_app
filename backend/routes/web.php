<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CompanyController;

use App\Http\Livewire\EntryEdit;
use App\Http\Livewire\EntryEditAnswer;

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

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    
    Route::prefix('todo')->group(function(){
        
        Route::get('/', [TodoController::class, 'index'])->name('todo');

    });
    
    Route::prefix('entry')->group(function(){
        Route::get('/', [EntryController::class, 'index'])->name('entry');
        Route::get('/{id}/edit', [EntryController::class, 'edit']);
    });

    Route::prefix('question')->group(function(){

        Route::get('/', [QuestionController::class, 'index'])->name('question');

    });
    Route::prefix('template')->group(function(){

        Route::get('/', [TemplateController::class, 'index'])->name('template');

    });
    Route::prefix('company')->group(function(){

        Route::get('/', [CompanyController::class, 'index'])->name('company');

    });
});
