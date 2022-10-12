<?php

use App\Models\User;
use App\Models\Attendance;
use App\Models\Presence;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CobaController;
use App\Http\Controllers\API\profileController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\PresencesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [AuthController::class, 'login'])->name('login');

// harusnya bukan di api
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/user', [AuthController::class, 'user']);
    
    // profile routes
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);
       
    // permission routes
    Route::get('/permission', [PermissionController::class, 'show']);
    Route::post('/permission', [PermissionController::class, 'create']);

    // menampilkan jadwal masuk susai dengan posisinya nya
    Route::get('/attendance', function(){
        $userPosition = auth()->user()->position->id;
        $jadwals = Attendance::where('position_id', $userPosition)->get();
        // foreaach($jadwals  );
        
        foreach ($jadwals as $jadwal) {        
        return response()->json([
            'jadwal' => $jadwal
        ]);
    }
    });

    // menampilkan presensi sesuai dengan jadwalnya
    Route::get('/presensi/{attendance}' , [PresencesController::class, 'showPresences']);

    // tambah presensi sesuai attendance
    Route::post('/presensi/{attendance}/create', function (Attendance $attendance){

        $presensi = Presence::where('attendance_id', $attendance->id)->where('presence_date', now()->format('y-m-d'));
        // jika presensi dengan tanggal tidak ada, maka create data presensi
        if($presensi->count() == 0){    
            Presence::create([
                'user_id' => auth()->user()->id,
                'attendance_id' => $attendance->id,
                'longitude' => null,
                'latitude' => null,
                'presence_date' => now()->format('Y-m-d'),
                'presence_enter_time' => null,
                'presence_out_time' => null
            ]);

            return response()->json([
                'status' => 'success',
                'deskripsi' => 'oke'
            ],200);
        }else{
        return response()->json([
            'deskripsi' => 'lanjut ke form absen masuk dan keluar'
        ],200);
    }});

    Route::get('/presensi/{attendance}/form_masuk', function(Attendance $attendance){
        return Presence::where('attendance_id', $attendance->id)->latest()->get();
    });
    Route::post('/presensi/{attendance}/form_masuk', function(Request $request, Attendance $attendance){
        $presensi =  Presence::where('attendance_id', $attendance->id)->latest();
        $cekWaktu = now()->format('h:i:s') >= $attendance->start_time && now()->format('h:i:s') <= $attendance->limit_start_time; 
         if(!$cekWaktu){
            return response()->json([
                'description' => 'maaf anda tidak bisa absen'
            ],200);
        }
        else{
        $presensi->update([
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'presence_enter_time' => now()->format('h:i:s'),
        ]);
        return response()->json([
            'status' => 'oke',
            'description' => 'anda berhasil absen'
        ],200);
        }
    });
    Route::get('/coba2/{attendance}', function(Attendance $attendance){
        return response()->json([
            'data' => $attendance->position->posisi
        ]);
    });
    Route::post('/presensi/{attendance}/form_keluar',function(Request $request, Attendance $attendance){
        $presensi =  Presence::where('attendance_id', $attendance->id)->latest();
        $cekWaktu = now()->format('h:i:s') >= $attendance->end_time && now()->format('h:i:s') <= $attendance->limit_end_time; 
        // $cekUser  = $attendance->position->name = 'dosen' ;
        if(!$cekWaktu){
            return response()->json([
                'status' => 'oke',
                'description' => 'maaf anda sudah tidak bisa absen keluar'
            ],200);
        }
        else{
        $presensi->update([
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'presence_out_time' => now()->format('h:i:s'),
        ]);
        return response()->json([
            'status' => 'oke',
            'description' => 'anda berhasil absen'
        ],200);
        }
    });
    Route::post('/logout', [AuthController::class, 'logout']);

});


// Route::post('/coba', [CobaController::class, 'coba']);