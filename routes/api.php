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
use App\Http\Controllers\DashboardAdminController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/user', [AuthController::class, 'user']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::post('/permission-create', [PermissionController::class, 'create']);
    Route::post('/presensi', [PresencesController::class, 'showPresences']);
    Route::post('/presensi/create', [PresencesController::class, 'createPresence']);
    Route::post('/presensi/form_masuk', [PresencesController::class, 'formMasuk']);
    Route::post('/presensi/form_keluar', [PresencesController::class, 'formKeluar']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/SPK', [DashboardAdminController::class, 'apiSPK']);
});

