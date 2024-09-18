<?php

use App\Http\Controllers\PageController;
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


Route::get('/send-mail', [PageController::class, 'sendmail']);
Route::get('/login', [PageController::class, 'login'] )->name('Leads.login');
Route::get('/register', [PageController::class, 'register'] )->name('Leads.register');
Route::get('/', function () {
    return view('welcome');
} );

Route::group(['prefix' => 'crm'], function () { 
    Route::get('/login', [PageController::class, 'loginCRM'] )->name('crm.login');
    Route::get('/register', [PageController::class, 'registerCRM'] )->name('crm.register');

    Route::middleware(['auth.login'])->group(function () {
        Route::get('/', function () {
            return view('welcome');
        } );       
    });
    

});