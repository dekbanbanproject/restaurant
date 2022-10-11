<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/', function () {
    if (Auth::check()) {
        return view('auth.login');
    }else{
      
        return view('welcome');
    }
})->name('index');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('type');
Route::get('staff/home', [App\Http\Controllers\HomeController::class, 'staffHome'])->name('staff.home')->middleware('type');
Route::get('user/home', [App\Http\Controllers\UserController::class, 'user_index'])->name('user.home')->middleware('type');

Route::get('manage/home', [App\Http\Controllers\HomeController::class, 'manageHome'])->name('manage.home')->middleware('type');

Route::middleware(['type'])->group(function(){ 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});