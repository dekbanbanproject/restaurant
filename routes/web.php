<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Table_group_1;
use Illuminate\Support\Facades\DB;
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

Route::get('reserve_table', [App\Http\Controllers\HomeController::class, 'reserve_table'])->name('reserve_table');
Route::match(['get', 'post'], 'cus_updatetable/{id}', [App\Http\Controllers\CustomerController::class, 'cus_updatetable']); //จองโต๊ะ
Route::match(['get', 'post'], 'cus_canceltable/{id}', [App\Http\Controllers\CustomerController::class, 'cus_canceltable']); //ยกเลิก

Route::get('manager_asset/assetinfomation/{id}','ManagerassetController@assetinfomation')->name('massete.assetinfomation')->withoutMiddleware('checklogin');;
Route::get('order/{table}', [App\Http\Controllers\OrderController::class, 'order'])->name('or.order'); 
Route::get('order_table/{table}', [App\Http\Controllers\OrderController::class, 'order_table'])->name('or.order_table'); 
Route::get('order_add/{table}', [App\Http\Controllers\OrderController::class, 'order_add'])->name('or.order_add'); 
Route::get('order_add_phad/{table}', [App\Http\Controllers\OrderController::class, 'order_add_phad'])->name('or.order_add_phad'); 
Route::get('order_add_tod/{table}', [App\Http\Controllers\OrderController::class, 'order_add_tod'])->name('or.order_add_tod'); 
Route::get('order_add_drink/{table}', [App\Http\Controllers\OrderController::class, 'order_add_drink'])->name('or.order_add_drink');
Route::get('order_add_nuang/{table}', [App\Http\Controllers\OrderController::class, 'order_add_nuang'])->name('or.order_add_nuang');
Route::get('order_add_sod/{table}', [App\Http\Controllers\OrderController::class, 'order_add_sod'])->name('or.order_add_sod');
Route::get('order_add_pingyang/{table}', [App\Http\Controllers\OrderController::class, 'order_add_pingyang'])->name('or.order_add_pingyang');

Route::match(['get', 'post'],'order_save', [App\Http\Controllers\OrderController::class, 'order_save'])->name('or.order_save');
Route::delete('order_destroy/{id}', [App\Http\Controllers\OrderController::class, 'order_destroy'])->name('or.order_destroy'); //
Route::match(['get', 'post'], 'order_update/{id}', [App\Http\Controllers\OrderController::class, 'order_update'])->name('or.order_update');

// Route::match(['get', 'post'], 'order_save', [App\Http\Controllers\OrderController::class, 'order_save'])->name('or.order_save');
// Route::get('order_edit/{id}', [App\Http\Controllers\OrderController::class, 'order_edit'])->name('or.order_edit');
// Route::match(['get', 'post'], 'order_update', [App\Http\Controllers\OrderController::class, 'order_update'])->name('or.order_update');

// Route::get('/', function () {

//     if (Auth::check()) {
//         return view('auth.login');
//     }else{
//         $data['users'] = User::get();
//         $data['table_group_1'] = Table_group_1::where('table_group_1_zone','=','A')->get();
//         $data['table_group_1B'] = Table_group_1::where('table_group_1_zone','=','B')->get();
//         return view('welcome',$data);
//     }
// })->name('index');

Auth::routes();
Route::get('/', function () {

    if (Auth::check()) {
        return view('auth.login');
    } else {
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_zone', '=', 'A')->get();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_zone', '=', 'B')->get();
        return view('welcome', $data);
    }
})->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('type');
Route::get('staff/home', [App\Http\Controllers\HomeController::class, 'staffHome'])->name('staff.home')->middleware('type');
Route::get('user/home', [App\Http\Controllers\UserController::class, 'user_index'])->name('user.home')->middleware('type');

Route::get('manage/home', [App\Http\Controllers\HomeController::class, 'manageHome'])->name('manage.home')->middleware('type');



Route::middleware(['type'])->group(function () {

    Route::get('kitchen', [App\Http\Controllers\HomeController::class, 'kitchen'])->name('menu.kitchen');
    Route::match(['get', 'post'], 'kitchen_save', [App\Http\Controllers\HomeController::class, 'kitchen_save'])->name('menu.kitchen_save');
    Route::get('kitchen_edit/{id}', [App\Http\Controllers\HomeController::class, 'kitchen_edit'])->name('menu.kitchen_edit');
    Route::match(['get', 'post'], 'kitchen_update', [App\Http\Controllers\HomeController::class, 'kitchen_update'])->name('menu.kitchen_update');
    Route::delete('kitchen_destroy/{id}', [App\Http\Controllers\HomeController::class, 'kitchen_destroy'])->name('menu.kitchen_destroy'); //

    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('pr_plan', [App\Http\Controllers\HomeController::class, 'pr_plan'])->name('pr_plan');

    Route::get('customerinfo', [App\Http\Controllers\CustomerController::class, 'customerinfo'])->name('cus.customerinfo');
    // Route::get('customer_edit', [App\Http\Controllers\CustomerController::class, 'customer_edit'])->name('cus.customer_edit');
    Route::match(['get', 'post'], 'customer_save', [App\Http\Controllers\CustomerController::class, 'customer_save'])->name('cus.customer_save');
    Route::get('customer_edit/{id}', [App\Http\Controllers\CustomerController::class, 'customer_edit'])->name('cus.customer_edit');
    Route::match(['get', 'post'], 'customer_update', [App\Http\Controllers\CustomerController::class, 'customer_update'])->name('cus.customer_update');
    Route::delete('customer_destroy/{id}', [App\Http\Controllers\CustomerController::class, 'customer_destroy'])->name('cus.customer_destroy'); //

    Route::get('tabledit', [App\Http\Controllers\CustomerController::class, 'index']);
    Route::post('tabledit/action', [App\Http\Controllers\CustomerController::class, 'action'])->name('tabledit.action');


    Route::match(['get', 'post'], 'table_group_1', [App\Http\Controllers\HomeController::class, 'table_group_1'])->name('zone.table_group_1');
    Route::match(['get', 'post'], 'table_group_1_save', [App\Http\Controllers\HomeController::class, 'table_group_1_save'])->name('zone.table_group_1_save');
    Route::match(['get', 'post'], 'reserve_table_edit', [App\Http\Controllers\HomeController::class, 'reserve_table_edit'])->name('zone.reserve_table_edit'); //ไปหน้าแก้ไขโต๊ะ
    // Route::match(['get', 'post'], 'reserve_table_edit', [App\Http\Controllers\HomeController::class, 'reserve_table_edit'])->name('zone.reserve_table_edit'); //ไปหน้าแก้ไขโต๊ะ
    Route::match(['get', 'post'], 'table_group_1_edit/{id}', [App\Http\Controllers\HomeController::class, 'table_group_1_edit'])->name('zone.table_group_1_edit');
    Route::match(['get', 'post'], 'table_group_1_update', [App\Http\Controllers\HomeController::class, 'table_group_1_update'])->name('zone.table_group_1_update');
    Route::delete('table_group_1_destroy/{id}', [App\Http\Controllers\HomeController::class, 'table_group_1_destroy'])->name('zone.table_group_1_destroy'); //

    Route::match(['get', 'post'], 'updatetable/{id}', [App\Http\Controllers\HomeController::class, 'updatetable'])->name('zone.updatetable'); //จองโต๊ะ
    Route::match(['get', 'post'], 'canceltable/{id}', [App\Http\Controllers\HomeController::class, 'canceltable'])->name('zone.canceltable'); //ยกเลิก

    Route::match(['get', 'post'], 'table_group_2', [App\Http\Controllers\HomeController::class, 'table_group_2'])->name('zone.table_group_2');
    Route::match(['get', 'post'], 'table_group_3', [App\Http\Controllers\HomeController::class, 'table_group_3'])->name('zone.table_group_3');
    Route::match(['get', 'post'], 'table_group_4', [App\Http\Controllers\HomeController::class, 'table_group_4'])->name('zone.table_group_4');

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
