<?php

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Presence;
use App\Models\User;
use App\Models\Position;
use App\Models\Permission;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CobaController;
use App\Http\Controllers\API\profileController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\PresencesController;
use PhpParser\Node\Expr\PostDec;

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
// Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/user', [AuthController::class, 'user']);

    // profile routes
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // permission routes
    Route::get('/permission', [PermissionController::class, 'show']);
    Route::post('/permission', [PermissionController::class, 'create']);

    // menampilkan jadwal masuk susai dengan posisinya nya
    Route::get('/attendance', function () {
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
    Route::post('/presensi', [PresencesController::class, 'showPresences']);
    // create presensi sesuai attendance
    Route::post('/presensi/create', [PresencesController::class, 'createPresence']);


    // Route::get('/presensi/form_masuk', function(Attendance $attendance){
    //     // return Presence::where('attendance_id', $attendance->id)->latest()->get();
    //     // return Carbon::parse()->format('h:i:s');
    //     return now()->format('H i s');

    // });

    Route::post('/presensi/form_masuk', [PresencesController::class, 'formMasuk']);
    // Route::get('coba-coba', [PresencesController::class, 'formKeluar']);
    Route::post('/presensi/form_keluar', [PresencesController::class, 'formKeluar']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/coba', function () {
        // $user = $request->user();
        $token = PersonalAccessToken::where('tokenable_id', auth()->user()->id)->get();
        // if ($token[0]->created_at <= ) {
        //     # code...
        // }
        PersonalAccessToken::destroy($token[0]->id);
        return 'anjas';
    });
    Route::get('coba-10', function()
    {
        # code...
        $token = PersonalAccessToken::where('tokenable_id', auth()->user()->id)->get();
        $anjas = "coba";
        if (
            Carbon::parse($token[0]->created_at)->addDay()->format('y-m-d') 
            < now()->format('y-m-d')
            ){
            $anjas = "anjas" ;
        }
        $data = [
            'token-parsing' => Carbon::parse($token[0]->created_at)->addDay(-1),
            'token' => $token[0]->created_at,
            'sekarang' => now(),
            'sekarang sesuai hari' => now()->format('y-m-d'),
            'token-parsing sesuai hari' => Carbon::parse($token[0]->created_at)->format('y-m-d'),
        ];
        // return response()->json([$anjas]);
        // return [$data, $anjas];
        $user = User::where('email', auth()->user()->email)->first();
        return $token->first()->created_at;

    });
});


// Route::post('/coba', [CobaController::class, 'coba']);