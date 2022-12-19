<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Holiday;
use App\Models\Position;
use App\Models\Presence;
// use Brian2694\Toastr\Toastr;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardAdminController;


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




Route::get('/', [LoginController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('/', function(){
    return redirect('/login');
});
Route::get('/coba', function () {
    return now();
});



Route::middleware('admin')->group(function(){
    Route::get('/dashboard', [DashboardAdminController::class,'showDashboard']);
    Route::get('/lokasi', [DashboardAdminController::class,'showLokasi']);
    Route::get('/laporankehadiran', [DashboardAdminController::class, 'laporanKehadiran']);
    Route::get('/cetakKehadiran/{tanggal_awal}/{tanggal_akhir}', [DashboardAdminController::class, 'LaporanKehadiranPerTanggal']);
    Route::patch('/myprofile/{user}', [MyprofileController::class,'update']);
    Route::resource('/attendance', AttendanceController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/dosen', DosenController::class);
    Route::get('/jabatan', [DashboardAdminController::class, 'showJabatan']);
    Route::resource('/holidays', HolidayController::class);
    Route::get('/permission', [DashboardAdminController::class, 'showPermission']);
    Route::get('/Presence', [DashboardAdminController::class, 'showPresence']);
});
Route::middleware('user')->group(function(){
    Route::get('/user', function(){
        return view('users.index', [
            'title' => 'user'
        ]);
    });
});



