<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

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

Route::redirect('/', '/dashboard-general-dashboard');

Route::get('/',[LoginController::class,'showLoginForm'])->name('loginform');
Route::post('loginPost',[LoginController::class,'LoginPost'])->name('loginpost');
Route::post('logout',[LoginController::class,'logout'])->name('logout.post');

Route::group(['prefix' => 'Admin', 'middleware' => ['auth', 'role:Administrator']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');

});

Route::get('/dashboard-general-dashboard', function () {
    return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
});

Route::get('/dashboard-ecommerce-dashboard', function () {
    return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
});


Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian');
Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu');
Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan');
Route::get('bebantrafo', [MenuController::class, 'bebantrafo'])->name('bebantrafo');
Route::get('bebanpenyulang', [MenuController::class, 'bebanpenyulang'])->name('bebanpenyulang');
Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');
Route::get('bebanktt', [MenuController::class, 'bebanktt'])->name('bebanktt');


// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});
