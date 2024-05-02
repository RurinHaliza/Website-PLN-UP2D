<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrafoController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ValidatorController;
use App\Http\Controllers\KTTController;
use App\Http\Controllers\GIController;
use App\Http\Controllers\PenyulangController;

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
    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan');
    
    //Trafo
    Route::get('bebantrafo', [TrafoController::class, 'index'])->name('bebantrafo');
    Route::get('DetailTrafo/{id}',[TrafoController::class, 'detail'])->name('detail.trafo.admin');

    //Penyulang
    Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang');
    Route::get('Detail/{id}',[PenyulangController::class, 'detail'])->name('detail.penyulang.admin');

    Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');
    
    //KTT
    Route::get('bebanktt', [KTTController::class, 'index'])->name('bebanktt');
    Route::get('DetailKTT/{id}',[KTTController::class, 'Detail' ])->name('detail.ktt.admin');

    //GI
    Route::get('BebanGI',[GIController::class,'index'])->name('beban.GI');
    Route::get('DetailGI/{id}',[GIController::class, 'detail' ])->name('detail.gi.admin');

    //MVCELL
    Route::get('mvcell',[MenuController::class, 'mvcell'])->name('data.mvcell');
    Route::get('mvcell/{id}',[MenuController::class, 'DetailMVCELL'])->name('detail.mvcell');
    Route::get('EditMVCELL/{id}',[MenuController::class, 'EditMVCELL'])->name('edit.mvcell');

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
    Route::get('ScadaFail',[OperatorController::class,'ScadaFailIndex'])->name('scadafail');

    //Tabel Trafo 
    Route::get('DataTrafo', [TrafoController::class, 'index'])->name('trafo.operator');
    Route::get('DetailTrafo/{id}',[TrafoController::class, 'detail'])->name('detail.trafo.operator');

    //MVCELL
    Route::get('mvcell',[MenuController::class, 'mvcell'])->name('data.mvcell.operator');
    Route::get('mvcell/{id}',[MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.operator');

    //Penyulang
    Route::get('penyulang', [PenyulangController::class, 'index'])->name('penyulang.operator');
    Route::get('Detail/{id}',[PenyulangController::class, 'detail'])->name('detail.penyulang.operator');

    //KTT
    Route::get('KTT', [KTTController::class, 'index'])->name('ktt.operator');
    Route::get('DetailKTT/{id}',[KTTController::class, 'Detail' ])->name('detail.ktt.operator');

    //GI
    Route::get('GI',[GIController::class,'index'])->name('GI.operator');
    Route::get('DetailGI/{id}',[GIController::class, 'detail' ])->name('detail.gi.operator');

});

Route::group(['prefix' => 'Opsis', 'middleware' => ['auth', 'role:ValidatorOpsis']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.validopsis');
    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.opsis');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.opsis');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.opsis');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.opsis');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.opsis');
    
    //Trafo
    Route::get('bebantrafo', [TrafoController::class, 'index'])->name('bebantrafo.opsis');
    Route::get('DetailTrafo/{id}',[TrafoController::class, 'detail'])->name('detail.trafo.opsis');

    //Penyulang
    Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang.opsis');
    Route::get('Detail/{id}',[PenyulangController::class, 'detail'])->name('detail.penyulang.opsis');

    Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');
    
    //KTT
    Route::get('bebanktt', [KTTController::class, 'index'])->name('bebanktt.opsis');
    Route::get('DetailKTT/{id}',[KTTController::class, 'Detail' ])->name('detail.ktt.opsis');

    //GI
    Route::get('BebanGI',[GIController::class,'index'])->name('beban.GI.opsis');
    Route::get('DetailGI/{id}',[GIController::class, 'detail' ])->name('detail.gi.opsis');

    //MVCELL
    Route::get('mvcell',[MenuController::class, 'mvcell'])->name('data.mvcell.opsis');
    Route::get('mvcell/{id}',[MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.opsis');
    Route::get('EditMVCELL/{id}',[MenuController::class, 'EditMVCELL'])->name('edit.mvcell.opsis');
    
    Route::get('ApprovalScadaFail',[ValidatorController::class,'index'])->name('approval.opsis');
});

Route::group(['prefix' => 'ValidatorFasop', 'middleware' => ['auth', 'role:ValidatorFasop']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.validfasop');
    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.fasop');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.fasop');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.fasop');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.fasop');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.fasop');
    
    //Trafo
    Route::get('bebantrafo', [TrafoController::class, 'index'])->name('bebantrafo.fasop');
    Route::get('DetailTrafo/{id}',[TrafoController::class, 'detail'])->name('detail.trafo.fasop');

    //Penyulang
    Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang.fasop');
    Route::get('Detail/{id}',[PenyulangController::class, 'detail'])->name('detail.penyulang.fasop');

    Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');
    
    //KTT
    Route::get('bebanktt', [KTTController::class, 'index'])->name('bebanktt.fasop');
    Route::get('DetailKTT/{id}',[KTTController::class, 'Detail' ])->name('detail.ktt.fasop');

    //GI
    Route::get('BebanGI',[GIController::class,'index'])->name('beban.GI.fasop');
    Route::get('DetailGI/{id}',[GIController::class, 'detail' ])->name('detail.gi.fasop');

    //MVCELL
    Route::get('mvcell',[MenuController::class, 'mvcell'])->name('data.mvcell.fasop');
    Route::get('mvcell/{id}',[MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.fasop');
    Route::get('EditMVCELL/{id}',[MenuController::class, 'EditMVCELL'])->name('edit.mvcell.fasop');

   });

Route::group(['prefix' => 'EditorOpsis', 'middleware' => ['auth', 'role:EditorOpsis']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.editorop');
});

Route::group(['prefix' => 'Visitor', 'middleware' => ['auth', 'role:Visitor']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.visitor');

    //Tabel Trafo 
    Route::get('trafo', [MenuController::class, 'bebantrafo'])->name('trafo.visitor');

    //MVCELL
    Route::get('mvcell',[MenuController::class, 'mvcell'])->name('data.mvcell.visitor');

    //Penyulang
    Route::get('penyulang', [MenuController::class, 'bebanpenyulang'])->name('penyulang.visitor');

    //KTT
    Route::get('KTT', [MenuController::class, 'bebanktt'])->name('ktt.visitor');

    //GI
    Route::get('GI',[MenuController::class,'GI'])->name('GI.visitor');


});

// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});
