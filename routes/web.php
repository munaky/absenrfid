<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\FilterDataController;
use App\Http\Controllers\AddDataController;
use App\Http\Controllers\EditDataController;
use App\Http\Controllers\DeleteDataController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\APIGetController;
use App\Http\Controllers\RFIDController;
use App\Http\Controllers\TestController;

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

//GET Method
Route::middleware(['loginValid'])->group(function () {
    Route::get('/test', [GetDataController::class, 'getApi']);

    Route::get('/about', function(){
        return view('about');
    });

    Route::get('/', function(){
        return redirect('/dashboard');
    });

    Route::get('/ruang/{id}', [PageController::class, 'viewRoom']);

    Route::get('/filter/{page}', [PageController::class, 'withFilter']);

    Route::get('/export/absensi', [ExportController::class, 'exportFile']);

    Route::get('/{page}', [PageController::class, 'withSidebar']);

});

Route::get('/auth/login', function () {
    return view('login');
});

Route::get('/auth/logout', [LoginController::class, 'logout']);


//POST Method
Route::post('/auth/login', [LoginController::class, 'login']);

Route::post('/add/data_users', [AddDataController::class, 'addUser']);
Route::post('/edit/data_users', [EditDataController::class, 'editUser']);
Route::post('/delete/data_users', [DeleteDataController::class, 'deleteUser']);

Route::post('/add/data_murid', [AddDataController::class, 'addMurid']);
Route::post('/edit/data_murid', [EditDataController::class, 'editMurid']);
Route::post('/delete/data_murid', [DeleteDataController::class, 'deleteMurid']);
Route::post('/filter/data_murid', [FilterDataController::class, 'filterMurid']);

Route::post('/add/data_kelas', [AddDataController::class, 'addKelas']);
Route::post('/edit/data_kelas', [EditDataController::class, 'editKelas']);
Route::post('/delete/data_kelas', [DeleteDataController::class, 'deleteKelas']);

Route::post('/add/data_guru', [AddDataController::class, 'addGuru']);
Route::post('/edit/data_guru', [EditDataController::class, 'editGuru']);
Route::post('/delete/data_guru', [DeleteDataController::class, 'deleteGuru']);

Route::post('/edit/jadwal_pelajaran', [EditDataController::class, 'editJadwalPelajaran']);
Route::post('/filter/jadwal_pelajaran', [FilterDataController::class, 'filterJadwalPelajaran']);

Route::post('/edit/absensi', [EditDataController::class, 'editAbsensi']);

Route::post('/filter/rekap_absensi', [FilterDataController::class, 'filterRekapAbsensi']);

Route::post('/add/setting_api', [AddDataController::class, 'addApi']);
Route::post('/edit/setting_api', [EditDataController::class, 'editApi']);
Route::post('/delete/setting_api', [DeleteDataController::class, 'deleteApi']);

Route::post('/add/setting_ruang', [AddDataController::class, 'addRuang']);
Route::post('/edit/setting_ruang', [EditDataController::class, 'editRuang']);
Route::post('/delete/setting_ruang', [DeleteDataController::class, 'deleteRuang']);

//API
Route::post('/api/test', [APIGetController::class, 'dashboard']);

//RFID API
Route::post('/api/rfid', [RFIDController::class, 'selectMode']);
Route::post('/api/validToken', [RFIDController::class, 'validToken']);

//Get Data API
Route::post('/api/table/murid', [APIGetController::class, 'tableMurid']);
Route::post('/api/table/muridEmpty', [APIGetController::class, 'tableMuridEmptyCard']);
Route::post('/api/table/pendaftar', [APIGetController::class, 'tablePendaftar']);
Route::post('/api/detail/ruang', [APIGetController::class, 'detailRuang']);
Route::get('/api/dashboard', [APIGetController::class, 'dashboard']);

//Add Data API
Route::post('/api/add/pendaftar', [APIController::class, 'addPendaftar']);

//Delete Data API
Route::post('/api/delete/pendaftar', [APIController::class, 'deletePendaftar']);

#Artisan API Via Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
Route::get('/api/cmd', function(Request $req){
    $UsersModel = App\Models\UsersModel::class;

    if($req->missing(['username', ['password']])){
        return response('fail');
    }

    $input = $req->all();

    $user = $UsersModel::where([
        ['username', $input['username']],
        ['password', $input['password']]
    ])
    ->first();

    if($user === null){
        return response('fail');
    }

    /* Command Here */
    Artisan::call($input['c']);

    return response('success');
});
