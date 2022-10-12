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
Route::get('kitchen', [App\Http\Controllers\HomeController::class, 'kitchen'])->name('kitchen');
Route::get('reserve_table', [App\Http\Controllers\HomeController::class, 'reserve_table'])->name('reserve_table');

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
Route::get('pr_plan', [App\Http\Controllers\HomeController::class, 'pr_plan'])->name('pr_plan');

Route::match(['get','post'],'table_group_1', [App\Http\Controllers\HomeController::class, 'table_group_1'])->name('zone.table_group_1');
Route::match(['get','post'],'table_group_1_save', [App\Http\Controllers\HomeController::class, 'table_group_1_save'])->name('zone.table_group_1_save');
Route::match(['get','post'],'reserve_table_edit', [App\Http\Controllers\HomeController::class, 'reserve_table_edit'])->name('zone.reserve_table_edit'); //ไปหน้าแก้ไขโต๊ะ
Route::match(['get','post'],'table_group_1_edit/{id}', [App\Http\Controllers\HomeController::class, 'table_group_1_edit'])->name('zone.table_group_1_edit');
Route::match(['get','post'],'table_group_1_update', [App\Http\Controllers\HomeController::class, 'table_group_1_update'])->name('zone.table_group_1_update');
Route::delete('table_group_1_destroy/{id}',[App\Http\Controllers\HomeController::class, 'table_group_1_destroy'])->name('zone.table_group_1_destroy');//

Route::match(['get','post'],'updatetable/{id}', [App\Http\Controllers\HomeController::class, 'updatetable'])->name('zone.updatetable');//จองโต๊ะ
Route::match(['get','post'],'canceltable/{id}', [App\Http\Controllers\HomeController::class, 'canceltable'])->name('zone.canceltable');//ยกเลิก

Route::match(['get','post'],'table_group_2', [App\Http\Controllers\HomeController::class, 'table_group_2'])->name('zone.table_group_2');
Route::match(['get','post'],'table_group_3', [App\Http\Controllers\HomeController::class, 'table_group_3'])->name('zone.table_group_3');
Route::match(['get','post'],'table_group_4', [App\Http\Controllers\HomeController::class, 'table_group_4'])->name('zone.table_group_4');

// Route::match(['get','post'],'person/person_index',[App\Http\Controllers\PersonController::class, 'person_index'])->name('person.person_index');//
// Route::match(['get','post'],'person/person_index_add',[App\Http\Controllers\PersonController::class, 'person_index_add'])->name('person.person_index_add');//
// Route::match(['get','post'],'person/person_index_addsub/{id}',[App\Http\Controllers\PersonController::class, 'person_index_addsub'])->name('person.person_index_addsub');//
// Route::match(['get','post'],'person/person_save',[App\Http\Controllers\PersonController::class, 'person_save'])->name('person.person_save');//
// Route::match(['get','post'],'person/person_index_edit/{id}',[App\Http\Controllers\PersonController::class, 'person_index_edit'])->name('person.person_index_edit');//
// Route::get('person/person_index_edittype/{id}',[App\Http\Controllers\PersonController::class, 'person_index_edittype'])->name('person.person_index_edittype');//
// Route::put('person/person_typeupdate',[App\Http\Controllers\PersonController::class, 'person_typeupdate'])->name('person.person_typeupdate');//
// Route::match(['get','post'],'person/person_update',[App\Http\Controllers\PersonController::class, 'person_update'])->name('person.person_update');//
// Route::delete('person/person_destroy/{id}',[App\Http\Controllers\PersonController::class, 'person_destroy'])->name('person.person_destroy');//
});