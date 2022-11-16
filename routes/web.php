<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use App\Models\Presence;
use App\Models\Attendance;
// use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
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


Route::get('coba', function (){
    return now()->format('h:i:s');
});
// Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('/', function(){
    return redirect('/login');
});
Route::middleware('admin')->group(function(){
    Route::get('/dashboard', function(){
        $user = auth()->user();
        return view('admin.dashboard.index',[
            "title" => "Dashboard",
            "user" => $user,
            "UserCount" => User::count(),
            "PositionCount" => Position::count(),
            "position" => Position::get()
        ]); 
    });
    // Route::get('/myprofile', [MyprofileController::class,'edit']);
    Route::patch('/myprofile/{user}', [MyprofileController::class,'update']);
    Route::resource('/attendance', AttendanceController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/dosen', DosenController::class);
    Route::get('/jabatan', function(){
        return view('admin.jabatan.index',
        ['positions' => Position::get(),
        "title" => "jabatan",
        "user" => auth()->user(),
        "usercount" => User::get(),
        "position" => Position::get()
     ]);
    });
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

Route::get('/apa', [DashboardAdminController::class, 'laporanKehadiran']);
Route::get('/apahayo', function () {
    Toastr::error('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
    return view('welcome');
});