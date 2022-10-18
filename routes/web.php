<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('coba', function (){
    return now()->format('h:i:s');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/dashboard', function(){
    $user = auth()->user();
    return view('admin.dashboard.index',[
        "title" => "Dashboard",
        "user" => $user,
    ]);
})->middleware('auth');
Route::get('/coba', function(){
    $user = auth()->user();
    return $user->image;
    // return view('admin.dashboard.index',[
    //     "title" => "Dashboard",
    //     'user' => 
    // ]);
})->middleware('auth');