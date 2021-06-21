<?php

// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;

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
Auth::routes();

Route::resource('/', HomeController::class);
Route::resource('/menu', MenuController::class);

Route::get('/tampil-menu', [HomeController::class,'tampilmenu'])->name('tampil-menu');
Route::get('/table/menu',[MenuController::class,'table'])->name('table-menu');
Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});
// Route::post('/product/action',[MenuController::class,'action'])->name('product.action');
