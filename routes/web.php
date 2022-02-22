<?php

use App\Http\Controllers\CustomerController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers.export');
Route::resource('/customers', CustomerController::class)->only(['index', 'show', 'store', 'create','export']);

Route::get('/customers/createwordpressaccount/{id}', [CustomerController::class, 'createwordpressaccount'])->name('customers.createwordpressaccount');
require __DIR__.'/auth.php';
