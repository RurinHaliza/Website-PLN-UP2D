<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('loginform');
Route::post('loginPost', [LoginController::class, 'LoginPost'])->name('loginpost');
Route::post('logout', [LoginController::class, 'logout'])->name('logout.post');

Route::group(['prefix' => 'Admin', 'middleware' => ['auth', 'role:Administrator']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan');
    Route::get('bebantrafo', [MenuController::class, 'bebantrafo'])->name('bebantrafo');
    Route::get('bebanpenyulang', [MenuController::class, 'bebanpenyulang'])->name('bebanpenyulang');
    Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');
    Route::get('bebanktt', [MenuController::class, 'bebanktt'])->name('bebanktt');

    //Management user
    Route::get('UserManagement',[UserController::class,'index'])->name('user.admin');
    Route::get('TambahUser',[UserController::class,'create'])->name('user.create');
    Route::post('TambahUserPost',[UserController::class,'store'])->name('user.store');
    
    Route::get('create', [UserController::class, 'create'])->name('create');
    Route::resource('createuser', \App\Http\Controllers\UserController::class);
    //REGISTER
    Route::post('createuser', [UserController::class, 'actionregister'])->name('actionregister');
});


Route::group(['prefix' => 'Operator', 'middleware' => ['auth', 'role:operator']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.operator');
});

Route::group(['prefix' => 'ValidatorOpsis', 'middleware' => ['auth', 'role:ValidatorOpsis']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.validopsis');
});

Route::group(['prefix' => 'ValidatorFasop', 'middleware' => ['auth', 'role:ValidatorFasop']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.validfasop');
});

Route::group(['prefix' => 'EditorOpsis', 'middleware' => ['auth', 'role:EditorOpsis']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.editorop');
});

Route::group(['prefix' => 'Visitor', 'middleware' => ['auth', 'role:Visitor']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.visitor');

});

// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});
