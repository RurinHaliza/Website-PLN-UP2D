<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrafoController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ValidatorController;
use App\Http\Controllers\KttController;
use App\Http\Controllers\GIController;
use App\Http\Controllers\PenyulangController;
use App\Http\Controllers\DataForm;
use App\Http\Controllers\OpsisController;
use App\Http\Controllers\BebanPenyulang\BebanPenyulangController;
use App\Http\Controllers\BebanUP3\BebanUP3Controller;
use App\Http\Controllers\BebanUP3\BebanUP3NewController;
use App\Http\Controllers\BebanUP3\MonitoringBebanUP3NewController;
use App\Http\Controllers\FeederController;

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

//Data Beban Penyulang
Route::get('BebanPenyulangKeseluruhan', [BebanPenyulangController::class, 'index'])->name('bebanpenyulang2');
Route::get('/data', [BebanPenyulangController::class, 'datagi'])->name('datagi');
Route::get('/dataperGI', [BebanPenyulangController::class, 'BebanTertinggiPenyulang'])->name('data.tertinggi.penyulang');
Route::get('/dataHarian', [BebanPenyulangController::class, 'dataHarian'])->name('dataHarian.penyulang');
Route::get('/dataMingguanPenyulang', [BebanPenyulangController::class, 'dataMingguan'])->name('dataMingguan.penyulang');
Route::get('/dataBulananPenyulang', [BebanPenyulangController::class, 'dataBulanan'])->name('databulanan.penyulang');
Route::get('/getDataChart', [BebanPenyulangController::class, 'getDataChart'])->name('datachartpenyulang');
Route::get('/CardBebanHariPenyulang', [BebanPenyulangController::class, 'bebanTertinggiPerhari'])->name('card.bebanpenyulang.perhari');
Route::get('/CardBebanMingguanPenyulang', [BebanPenyulangController::class, 'bebanTertinggiMingguan'])->name('card.bebanpenyulang.mingguan');
Route::get('/CardBebanBulananPenyulang', [BebanPenyulangController::class, 'bebanTertinggiPerbulan'])->name('card.bebanpenyulang.perbulan');

//Data Beban UP3
Route::get('BebanUP3', [BebanUP3Controller::class, 'index'])->name('data.bebanup3');
Route::get('/BebanHarianUP3', [BebanUP3Controller::class, 'dataHarian'])->name('dataHarian.up3');
Route::get('/BebanMingguanUP3', [BebanUP3Controller::class, 'dataMingguan'])->name('dataMingguan.up3');
Route::get('/BebanBulananUP3', [BebanUP3Controller::class, 'dataBulanan'])->name('dataBulanan.up3');
Route::get('/CardBebanHariUP3', [BebanUP3Controller::class, 'bebanTertinggiPerhari'])->name('card.beban.perhari');
Route::get('/CardBebanMingguanUP3', [BebanUP3Controller::class, 'bebanTertinggiMingguan'])->name('card.beban.mingguan');
Route::get('/CardBebanBulananUP3', [BebanUP3Controller::class, 'bebanTertinggiPerbulan'])->name('card.beban.perbulan');

//Data Beban UP3New
Route::get('BebanUP3-new', [BebanUP3NewController::class, 'index'])->name('data.bebanup3new');
Route::get('BebanUP3-new/data', [BebanUP3NewController::class, 'getData'])->name('beban.data');
Route::get('BebanUP3-new/data-mingguan', [BebanUP3NewController::class, 'getDataMingguan'])->name('beban.data.mingguan');
Route::get('BebanUP3-new/data-bulanan', [BebanUP3NewController::class, 'getDataBulanan'])->name('beban.data.bulanan');
Route::get('/beban/export', [BebanUp3NewController::class, 'exportHarian'])->name('beban.export.harian');
Route::get('/beban/export/mingguan', [BebanUp3NewController::class, 'exportMingguan'])->name('beban.export.mingguan');
Route::get('/beban/export-bulanan', [BebanUP3NewController::class, 'exportBulanan'])->name('beban.export.bulanan');

Route::get('BebanUP3-new/filter', [BebanUP3NewController::class, 'filter'])->name('admin.bebanUp3New.filter');
Route::get('/Admin/getFeederByJenis', [BebanUP3NewController::class, 'getFeederByJenis'])->name('admin.getFeederByJenis');
Route::get('/admin/beban-up3-new/export', [BebanUP3NewController::class, 'exportAll'])->name('admin.bebanUp3New.export');


//Monitoring Beban UP3New
Route::get('MonitoringBebanUP3-new', [MonitoringBebanUP3NewController::class, 'index'])->name('data.monitoringbebanup3new');
Route::get('/api/max-values', [MonitoringBebanUP3NewController::class, 'getMaxValues']);
Route::get('/total-penyulang-tertinggi', [MonitoringBebanUP3NewController::class, 'totalPenyulangTertinggi']);
Route::get('/beban-penyulang-tertinggi', [MonitoringBebanUP3NewController::class, 'getBebanPenyulangTertinggi']);

//Punya Rima
Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang');
Route::get('DetailPenyulang/{id}', [PenyulangController::class, 'detail'])->name('penyulang.detail.admin');
Route::get('CreatePenyulang', [PenyulangController::class, 'create'])->name('create.penyulang');
Route::post('storedatapenyulang', [PenyulangController::class, 'store'])->name('store.penyulang');
Route::get('EditPenyulang/{id}', [PenyulangController::class, 'editPenyulang'])->name('edit.penyulang.admin');
Route::put('UpdateDataPenyulang/{id}', [PenyulangController::class, 'update'])->name('penyulang.update');
Route::delete('DeletePenyulang/{id}', [PenyulangController::class, 'destroy'])->name('penyulang.delete');
Route::get('ExportPenyulang', [PenyulangController::class, 'Export'])->name('download.excel.adminpenyulang');
Route::post('get-kubikel', [PenyulangController::class, 'getKubikel'])->name('get.kubikel');
Route::get('get-detail-kubikel/{nama_kubikel}',[PenyulangController::class, 'getKubikelDetail'])->name('get.kubikel.detail');
Route::prefix('Feeder')->group(function () {
    Route::get('Detail/{idfeeder}', [FeederController::class, 'detail'])->name('feeder.detail.admin');
    Route::get('Edit/{idfeeder}', [FeederController::class, 'edit'])->name('feeder.edit.admin');
    Route::put('Update/{idfeeder}', [FeederController::class, 'update'])->name('feeder.update');
    Route::delete('Delete/{idfeeder}', [FeederController::class, 'destroy'])->name('feeder.delete');
    Route::get('/bebanfeeder/export', [FeederController::class, 'Export'])->name('download.excel.adminfeeder');
});

Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');

Route::group(['prefix' => 'Admin', 'middleware' => ['auth', 'role:Administrator']], function () {

    //Data Beban UP3New
    Route::get('BebanUP3-new', [BebanUP3NewController::class, 'index'])->name('data.bebanup3new');
    Route::get('BebanUP3-new/data', [BebanUP3NewController::class, 'getData'])->name('beban.data');
    Route::get('BebanUP3-new/data-mingguan', [BebanUP3NewController::class, 'getDataMingguan'])->name('beban.data.mingguan');
    Route::get('BebanUP3-new/data-bulanan', [BebanUP3NewController::class, 'getDataBulanan'])->name('beban.data.bulanan');

    //Scada Fail
    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('ScadaFail', [OperatorController::class, 'ScadaFailIndex'])->name('scadafail.admin');
    Route::get('ScadaFailData', [OperatorController::class, 'data'])->name('scadafail.datatable');
    Route::get('ScadaFailEdit/{id}', [OperatorController::class, 'editDataFail'])->name('editscadafail.admin');
    Route::post('/scadafail/update/{id}', [OperatorController::class, 'update'])->name('scadafail.update');

    //Approval
    Route::get('Approval', [OpsisController::class, 'index'])->name('admin.approval');
    Route::get('Approvaldata', [OpsisController::class, 'data'])->name('data.approval.datatable');
    Route::post('/action-approval', [OpsisController::class, 'ActionApproval'])->name('action.approval');

    Route::get('DetailGI/{idgi}', [DashboardController::class, 'detailmaps'])->name('detail.gi.maps');
    Route::get('DownloadTrafo', [DashboardController::class, 'downloadTrafo80'])->name('download.trafo.80');
    Route::get('DownloadTrafo30', [DashboardController::class, 'downloadTrafo30'])->name('download.trafo.30');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan');

    //Trafo
    Route::get('bebantrafo', [TrafoController::class, 'index'])->name('bebantrafo');
    Route::get('DetailTrafo/{id}', [TrafoController::class, 'detail'])->name('detail.trafo.admin');
    Route::get('TambahTrafo', [TrafoController::class, 'create'])->name('trafo.create');
    Route::post('StoreTrafo', [TrafoController::class, 'store'])->name('trafo.store');
    Route::get('EditTrafo/{id}', [TrafoController::class, 'edit'])->name('edit.trafo.admin');
    Route::post('UpdateDataTrafo/{id}', [TrafoController::class, 'update'])->name('update.data.trafo');
    Route::get('ExportTrafo', [TrafoController::class, 'Export'])->name('download.excel.admintrafo');

    //Penyulang
    Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang');
    Route::get('DetailPenyulang/{id}', [PenyulangController::class, 'detail'])->name('penyulang.detail.admin');
    Route::get('TambahPenyulang', [PenyulangController::class, 'create'])->name('create.penyulang');
    Route::post('storedatapenyulang', [PenyulangController::class, 'store'])->name('store.penyulang');
    Route::get('EditPenyulang/{id}', [PenyulangController::class, 'editPenyulang'])->name('edit.penyulang.admin');
    Route::post('UPdateDataPenyulang/{id}', [PenyulangController::class, 'update'])->name('update.data.penyulang');
    Route::get('ExportPenyulang', [PenyulangController::class, 'Export'])->name('download.excel.adminpenyulang');

    Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');

    //KTT 
    Route::get('bebanktt', [KttController::class, 'index'])->name('bebanktt');
    Route::get('DetailPenyulang/{id}', [PenyulangController::class, 'detail'])->name('detail.ktt.admin');
    Route::get('Tambah', [KttController::class, 'create'])->name('ktt.create');
    Route::post('storedata', [KttController::class, 'store'])->name('store.ktt');
    Route::get('EditKTT/{id}', [KttController::class, 'Edit'])->name('edit.ktt.admin');
    Route::post('UpdateData/{id}', [KttController::class, 'updateData'])->name('update.ktt.admin');
    Route::get('ExportExcel', [KttController::class, 'Export'])->name('download.excel.adminktt');

    //GI
    Route::get('BebanGI', [GIController::class, 'index'])->name('beban.GI');
    Route::get('DetailGITabular/{id}', [GIController::class, 'detail'])->name('detail.gitable2.admin');
    Route::get('ExportExcel', [KttController::class, 'Export'])->name('download.excel.adminGI');

    //MVCELL
    Route::get('mvcell', [MenuController::class, 'mvcell'])->name('data.mvcell');
    Route::get('mvcell/{id}', [MenuController::class, 'DetailMVCELL'])->name('detail.mvcell');
    Route::get('EditMVCELL/{id}', [MenuController::class, 'EditMVCELL'])->name('edit.mvcell');
    Route::get('DownloadMVCELL', [MenuController::class, 'downloadMVCELL'])->name('download.menu.mvcelladmin');

    //Management user
    Route::get('UserManagement', [UserController::class, 'index'])->name('user.admin');
    Route::get('TambahUser', [UserController::class, 'create'])->name('user.create');
    Route::post('TambahUserPost', [UserController::class, 'store'])->name('user.store');

    Route::get('create', [UserController::class, 'create'])->name('create');
    Route::resource('createuser', \App\Http\Controllers\UserController::class);
    //REGISTER
    Route::post('createuser', [UserController::class, 'actionregister'])->name('actionregister');

    // Form
    Route::get('DataForm', [DataForm::class, 'index'])->name('dataform.index');
    Route::get('TambahData', [DataForm::class, 'TambahData'])->name('tambahdataform.admin');
    Route::post('/dataform/store', [DataForm::class, 'store'])->name('dataform.store');
});

Route::group(['prefix' => 'Operator', 'middleware' => ['auth', 'role:operator']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.operator');
    Route::get('DetailGI/{idgi}', [DashboardController::class, 'detailmaps'])->name('detail.gioperator.maps');

    Route::get('ScadaFail', [OperatorController::class, 'ScadaFailIndex'])->name('scadafail.operator');
    Route::get('ScadaFailData', [OperatorController::class, 'data'])->name('scadafail.datatable.operator');
    Route::get('ScadaFailEdit/{id}', [OperatorController::class, 'editDataFail'])->name('editscadafail.operator');
    Route::post('/scadafail/update/{id}', [OperatorController::class, 'update'])->name('scadafail.update.operator');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.operator');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.operator');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.operator');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.operator');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.operator');
    //Tabel Trafo 
    Route::get('DataTrafo', [TrafoController::class, 'index'])->name('trafo.operator');
    Route::get('DetailTrafo/{id}', [TrafoController::class, 'detail'])->name('detail.trafo.operator');
    Route::get('ExportTrafo', [TrafoController::class, 'Export'])->name('download.excel.operatortrafo');

    //MVCELL
    Route::get('mvcell', [MenuController::class, 'mvcell'])->name('data.mvcell.operator');
    Route::get('mvcell/{id}', [MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.operator');
    Route::get('DownloadMVCELL', [MenuController::class, 'downloadMVCELL'])->name('download.mvcell.operator');

    //Penyulang
    Route::get('penyulang', [PenyulangController::class, 'index'])->name('penyulang.operator');
    Route::get('Detail/{id}', [PenyulangController::class, 'detail'])->name('detail.penyulang.operator');
    Route::get('ExportPenyulang', [PenyulangController::class, 'Export'])->name('download.penyulang.operator');

    //KTT
    Route::get('KTT', [KttController::class, 'index'])->name('ktt.operator');
    Route::get('DetailKTT/{id}', [KttController::class, 'Detail'])->name('detail.ktt.operator');
    Route::get('DownloadKTT', [KttController::class, 'Export'])->name('download.ktt2.operator');

    //GI
    Route::get('GI', [GIController::class, 'index'])->name('GI.operator');
    Route::get('DetailGI/{id}', [GIController::class, 'detail'])->name('detail.gitable.operator');
    Route::get('DetailGIOperator/{id}', [GIController::class, 'detail'])->name('detail.tabelgi.operator');

    Route::get('ExportExcel', [KttController::class, 'Export'])->name('download.gi.operator');

    Route::get('DataForm', [DataForm::class, 'index'])->name('dataform.index.operator');
    Route::get('TambahData', [DataForm::class, 'TambahData'])->name('tambahdataform.operator');
    Route::post('/dataform/store', [DataForm::class, 'store'])->name('dataform.store.operator');
});

Route::group(['prefix' => 'ValidatorOpsis', 'middleware' => ['auth', 'role:ValidatorOpsis']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.validopsis');
    Route::get('DetailGI/{idgi}', [DashboardController::class, 'detailmaps'])->name('detail.gimaps.opsis');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.opsis');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.opsis');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.opsis');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.opsis');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.opsis');

    //Approval
    Route::get('Approval', [OpsisController::class, 'index'])->name('approval.opsis');
    Route::get('Approvaldata', [OpsisController::class, 'data'])->name('data.approval.datatable.opsis');
    Route::post('/action-approval', [OpsisController::class, 'ActionApproval'])->name('action.approval.opsis');

    //Trafo
    Route::get('bebantrafo', [TrafoController::class, 'index'])->name('bebantrafo.opsis');
    Route::get('DetailTrafo/{id}', [TrafoController::class, 'detail'])->name('detail.trafo.opsis');


    //Penyulang
    Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang.opsis');
    Route::get('DetailPenyulang/{id}', [PenyulangController::class, 'detail'])->name('detail.penyulang.opsis');

    //KTT
    Route::get('bebanktt', [KttController::class, 'index'])->name('bebanktt.opsis');
    Route::get('DetailKTT/{id}', [KttController::class, 'Detail'])->name('detail.ktt.opsis');

    //GI
    Route::get('BebanGI', [GIController::class, 'index'])->name('beban.GI.opsis');
    Route::get('DetailGIOpsis/{id}', [GIController::class, 'detail'])->name('detail.gi.opsis');

    //MVCELL
    Route::get('mvcell', [MenuController::class, 'mvcell'])->name('data.mvcell.opsis');
    Route::get('mvcell/{id}', [MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.opsis');
    Route::get('EditMVCELL/{id}', [MenuController::class, 'EditMVCELL'])->name('edit.mvcell.opsis');

    Route::get('ApprovalScadaFail', [ValidatorController::class, 'index'])->name('approval.opsis');

    Route::get('DataForm', [DataForm::class, 'index'])->name('dataform.index.opsis');
    Route::get('TambahData', [DataForm::class, 'TambahData'])->name('tambahdataform.opsis');
    Route::post('/dataform/store', [DataForm::class, 'store'])->name('dataform.store.opsis');
});

Route::group(['prefix' => 'ValidatorFasop', 'middleware' => ['auth', 'role:ValidatorFasop']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.validfasop');
    Route::get('DetailGI/{idgi}', [DashboardController::class, 'detailmaps'])->name('detail.gimaps.fasop');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.validfasop');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.validfasop');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.validfasop');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.validfasop');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.validfasop');

    //Trafo
    Route::get('bebantrafo', [TrafoController::class, 'index'])->name('bebantrafo.fasop');
    Route::get('DetailTrafo/{id}', [TrafoController::class, 'detail'])->name('detail.trafo.fasop');

    //Penyulang
    Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang.fasop');
    Route::get('Detail/{id}', [PenyulangController::class, 'detail'])->name('detail.penyulang.fasop');

    Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');

    //KTT
    Route::get('bebanktt', [KttController::class, 'index'])->name('bebanktt.fasop');
    Route::get('DetailKTT/{id}', [KttController::class, 'Detail'])->name('detail.ktt.fasop');

    //GI
    Route::get('BebanGI', [GIController::class, 'index'])->name('beban.GI.fasop');
    Route::get('DetailGIFasop/{id}', [GIController::class, 'detail'])->name('detail.gi.fasop');

    //MVCELL
    Route::get('mvcell', [MenuController::class, 'mvcell'])->name('data.mvcell.fasop');
    Route::get('mvcell/{id}', [MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.fasop');
    Route::get('EditMVCELL/{id}', [MenuController::class, 'EditMVCELL'])->name('edit.mvcell.fasop');

    Route::get('DataForm', [DataForm::class, 'index'])->name('dataform.index.fasop');
    Route::get('TambahData', [DataForm::class, 'TambahData'])->name('tambahdataform.fasop');
    Route::post('/dataform/store', [DataForm::class, 'store'])->name('dataform.store.fasop');

    //Approval
    Route::get('Approval', [OpsisController::class, 'index'])->name('approval.validfasop');
});

Route::group(['prefix' => 'EditorOpsis', 'middleware' => ['auth', 'role:EditorOpsis']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.editorop');
    Route::get('DetailGI/{idgi}', [DashboardController::class, 'detailmaps'])->name('detail.gimaps.editoropsis');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.editorop');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.editorop');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.editorop');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.editorop');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.editorop');


    //Trafo
    Route::get('bebantrafo', [TrafoController::class, 'index'])->name('bebantrafo.edops');
    Route::get('DetailTrafo/{id}', [TrafoController::class, 'detail'])->name('detail.trafo.edops');

    //Penyulang
    Route::get('bebanpenyulang', [PenyulangController::class, 'index'])->name('bebanpenyulang.edops');
    Route::get('Detail/{id}', [PenyulangController::class, 'detail'])->name('detail.penyulang.edops');

    Route::get('bebanup3', [MenuController::class, 'bebanup3'])->name('bebanup3');

    //KTT
    Route::get('bebanktt', [KttController::class, 'index'])->name('bebanktt.edops');
    Route::get('DetailKTT/{id}', [KttController::class, 'Detail'])->name('detail.ktt.edops');

    //GI
    Route::get('BebanGI', [GIController::class, 'index'])->name('beban.GI.edops');
    Route::get('DetailGIFasop/{id}', [GIController::class, 'detail'])->name('detail.gi.edops');

    //MVCELL
    Route::get('mvcell', [MenuController::class, 'mvcell'])->name('data.mvcell.edops');
    Route::get('mvcell/{id}', [MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.edops');
    Route::get('EditMVCELL/{id}', [MenuController::class, 'EditMVCELL'])->name('edit.mvcell.edops');

    Route::get('DataForm', [DataForm::class, 'index'])->name('dataform.index.edops');
    Route::get('TambahData', [DataForm::class, 'TambahData'])->name('tambahdataform.edops');
    Route::post('/dataform/store', [DataForm::class, 'store'])->name('dataform.store.edops');
});

Route::group(['prefix' => 'Visitor', 'middleware' => ['auth', 'role:Visitor']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.visitor');
    Route::get('DetailGI/{idgi}', [DashboardController::class, 'detailmaps'])->name('detail.gimaps.visitor');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.visitor');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.visitor');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.visitor');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.visitor');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.visitor');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.visitor');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.visitor');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.visitor');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.visitor');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.visitor');

    //Tabel Trafo 
    Route::get('trafo', [TrafoController::class, 'index'])->name('trafo.visitor');
    Route::get('DetailTrafo/{id}', [TrafoController::class, 'detail'])->name('trafo.detail.visitor');

    //MVCELL
    Route::get('mvcell', [MenuController::class, 'mvcell'])->name('data.mvcell.visitor');
    Route::get('Detailmvcell/{id}', [MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.visitor');

    //Penyulang
    Route::get('penyulang', [PenyulangController::class, 'index'])->name('penyulang.visitor');
    Route::get('DetailPenyulang/{id}', [PenyulangController::class, 'detail'])->name('detail.penyulang.visitor');

    //KTT
    Route::get('KTT', [KttController::class, 'index'])->name('ktt.visitor');
    Route::get('KTTDetail/{id}', [KttController::class, 'Detail'])->name('detail.ktt.visitor');

    //GI
    Route::get('GI', [GIController::class, 'index'])->name('GI.visitor');
    Route::get('DetailGIVisitor/{id}', [GIController::class, 'detail'])->name('detail.gi.visitor');

    Route::get('DataForm', [DataForm::class, 'index'])->name('dataform.index.visitor');
    Route::get('TambahData', [DataForm::class, 'TambahData'])->name('tambahdataform.visitor');
    Route::post('/dataform/store', [DataForm::class, 'store'])->name('dataform.store.visitor');
});

Route::group(['prefix' => 'Manager', 'middleware' => ['auth', 'role:Manager']], function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('dashboard.manager');
    Route::get('DetailGI/{idgi}', [DashboardController::class, 'detailmaps'])->name('detail.gimaps.manager');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.manager');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.manager');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.manager');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.manager');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.manager');

    Route::get('bebansemua', [MenuController::class, 'semua'])->name('bebansemua.manager');
    Route::get('detailbeban', [MenuController::class, 'detail'])->name('detailbeban.manager');
    Route::get('bebanharian', [MenuController::class, 'harian'])->name('bebanharian.manager');
    Route::get('bebanminggu', [MenuController::class, 'mingguan'])->name('bebanminggu.manager');
    Route::get('bebanbulan', [MenuController::class, 'bulanan'])->name('bebanbulan.manager');

    //Tabel Trafo 
    Route::get('trafo', [TrafoController::class, 'index'])->name('trafo.manager');
    Route::get('DetailTrafo/{id}', [TrafoController::class, 'detail'])->name('trafo.detail.manager');

    //MVCELL
    Route::get('mvcell', [MenuController::class, 'mvcell'])->name('mvcell.manager');
    Route::get('Detailmvcell/{id}', [MenuController::class, 'DetailMVCELL'])->name('detail.mvcell.manager');

    //Penyulang
    Route::get('penyulang', [PenyulangController::class, 'index'])->name('manager.penyulang');
    Route::get('DetailPenyulang/{id}', [PenyulangController::class, 'detail'])->name('detail.penyulang.manager');

    //KTT
    Route::get('KTT', [KttController::class, 'index'])->name('manager.ktt');
    Route::get('KTTDetail/{id}', [KttController::class, 'Detail'])->name('detail.ktt.manager');

    //GI
    Route::get('GI', [GIController::class, 'index'])->name('manager.gi');
    Route::get('DetailGIManager/{id}', [GIController::class, 'detail'])->name('detail.gi.manager');

    Route::get('DataForm', [DataForm::class, 'index'])->name('dataform.index.manager');
    Route::get('TambahData', [DataForm::class, 'TambahData'])->name('tambahdataform.manager');
    Route::post('/dataform/store', [DataForm::class, 'store'])->name('dataform.store.manager');
});


// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});