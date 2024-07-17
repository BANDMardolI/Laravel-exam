<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
use App\Http\Controllers\PDFController;

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
Route::get('pdf/preview', [PDFController::class, 'preview'])->name('pdf.preview');
Route::get('/', [NewController::class, 'index']);
Route::get('addnew',[NewController::class, 'addNew'])->middleware('auth');
Route::post('addnew',[NewController::class, 'store'])->middleware('auth');
Route::get('view/{id}', [NewController::class, 'newView']);
Route::get('show/{id}', [PDFController::class, 'generatePDF']);
Route::get('report/{id}', [NewController::class,    ]);
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('auth', [LoginController::class, 'authorizate']);
Route::get('registration',[LoginController::class, 'registration']);
Route::post('register',[LoginController::class,'register']);
Route::get('logout',function(){
    session()->flush();
    return redirect('/');
});
