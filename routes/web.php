<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [NewController::class, 'index']);
Route::post('/', [NewController::class, 'indexSearch']);
Route::get('addinstr',[NewController::class, 'addInstr'])->middleware('auth');
Route::post('addinstr',[NewController::class, 'store'])->middleware('auth');
Route::get('show/{id}', [NewController::class, 'showInstr']);
Route::get('report/{id}', [NewController::class, 'report']);
Route::get('download/{id}', [NewController::class, 'downloadInstr']);
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('auth', [LoginController::class, 'authorizate']);
Route::get('registration',[LoginController::class, 'registration']);
Route::post('register',[LoginController::class,'register']);
Route::get('logout',function(){
    session()->flush();
    return redirect('/');
});
