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
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HolidayController;
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
    $date = now()->format('l');
    // $dateHoliday = "20-11-2022";
    $dateHoliday = Carbon::parse("20-11-2022")->format("d-m-y");
    $ceckDateHoliday = $dateHoliday ;
    $ceckDate = $date == 'Saturday' || $date == 'Sunday';
    if($ceckDate || $ceckDateHoliday){
        $view = "ini hari sabtu atau minggu ataupun hari libur";
    }else{
        $view = "ini bukan hari sabtu atau minggu ataupun hari libur";
    }
    return $view;
});
Route::get('coba1', function (){
     $holidays = Holiday::where('date_holidays', Carbon::parse("10-11-2022")->format('y-m-d'))->first();
     return $holidays->date_holidays;

});
Route::get('/', [LoginController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('/', function(){
    return redirect('/login');
});

// Route::group(["middleware" => ["auth"]], function(){
//     Route::get('/dashboard', function(){
//         return 'anjas';
//     });
// });

// Route::group(["middelware" => ["admin"]], function(){
//     // dashboard
//     Route::get('/dashboard', function(){
//                 $user = auth()->user();
//                 return view('admin.dashboard.index',[
//                     "title" => "Dashboard",
//                     "user" => $user,
//                     "UserCount" => User::count(),
//                     "PositionCount" => Position::count(),
//                     "position" => Position::get()
//                 ]); 
//     });
//     // profile
//     Route::patch('/myprofile/{user}', [MyprofileController::class,'update']);
    
//     // master data
//     Route::resource('/attendance', AttendanceController::class);
//     Route::resource('/pegawai', PegawaiController::class);
//     Route::resource('/dosen', DosenController::class);
//     Route::get('/jabatan', function(){
//         return view('admin.jabatan.index',
//         ['positions' => Position::get(),
//         "title" => "jabatan",
//         "user" => auth()->user(),
//         "usercount" => User::get(),
//         "position" => Position::get()
//      ]);
//     });

//     // data tambahan
//     Route::get('/permission', [DashboardAdminController::class, 'showPermission']);
//     Route::get('/Presence', [DashboardAdminController::class, 'showPresence']);

//     // cetakPdf
//     Route::get('/apa', [DashboardAdminController::class, 'laporanKehadiran']);
    
// });
// Route::group(["middelware" => ["user"]], function(){
//     Route::get('/user', function(){
//                 return view('users.index', [
//                     'title' => 'user'
//                 ]);
//             });
// });


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
    
    Route::get('/apa', [DashboardAdminController::class, 'laporanKehadiran']);
    Route::get('/cetakKehadiran/{tanggal_awal}/{tanggal_akhir}', [DashboardAdminController::class, 'LaporanKehadiranPerTanggal']);
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


