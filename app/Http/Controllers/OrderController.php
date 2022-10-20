<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Table_group_1;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;
use App\Models\Menukitchen;
use App\Models\Order_food;
use App\Models\Order_food_sub;

class OrderController extends Controller
{
 
    public function order(Request $request,$table)
    {
        $data['users'] = User::orderBy('id','asc')->get();
        $data['table_group_1'] = Table_group_1::orderBy('table_group_1_id','asc')->get();
        $data['order_food'] = Order_food::leftjoin('order_food_sub','order_food_sub.order_food_id','=','order_food.order_food_id')
        ->where('order_food_active', '=', 'ORDER')
        ->where('table_group_1_name', '=', $table)
        ->get();

        return view('store_kitchen.order',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_table(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_zone', '=', 'A')->get();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_zone', '=', 'B')->get();
        return view('store_kitchen.order_table',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_add(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_name', '=',$table)->first();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_name', '=', $table)->first();
        $data['menukitchen'] = Menukitchen::leftjoin('menukitchen_category','menukitchen_category.menukitchen_category_id','=','menukitchen.menukitchen_category')
        ->where('menukitchen_category', '=', '1')
        ->get();
        return view('store_kitchen.order_add',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_add_phad(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_name', '=',$table)->first();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_name', '=', $table)->first();
        $data['menukitchen'] = Menukitchen::leftjoin('menukitchen_category','menukitchen_category.menukitchen_category_id','=','menukitchen.menukitchen_category')
        ->where('menukitchen_category', '=', '2')
        ->get();
        return view('store_kitchen.order_add_phad',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_add_tod(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_name', '=',$table)->first();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_name', '=', $table)->first();
        $data['menukitchen'] = Menukitchen::leftjoin('menukitchen_category','menukitchen_category.menukitchen_category_id','=','menukitchen.menukitchen_category')
        ->where('menukitchen_category', '=', '3')
        ->get();
        return view('store_kitchen.order_add_tod',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_add_drink(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_name', '=',$table)->first();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_name', '=', $table)->first();
        $data['menukitchen'] = Menukitchen::leftjoin('menukitchen_category','menukitchen_category.menukitchen_category_id','=','menukitchen.menukitchen_category')
        ->where('menukitchen_category', '=', '4')
        ->get();
        return view('store_kitchen.order_add_drink',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_add_nuang(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_name', '=',$table)->first();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_name', '=', $table)->first();
        $data['menukitchen'] = Menukitchen::leftjoin('menukitchen_category','menukitchen_category.menukitchen_category_id','=','menukitchen.menukitchen_category')
        ->where('menukitchen_category', '=', '5')
        ->get();
        return view('store_kitchen.order_add_nuang',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_add_sod(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_name', '=',$table)->first();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_name', '=', $table)->first();
        $data['menukitchen'] = Menukitchen::leftjoin('menukitchen_category','menukitchen_category.menukitchen_category_id','=','menukitchen.menukitchen_category')
        ->where('menukitchen_category', '=', '6')
        ->get();
        return view('store_kitchen.order_add_sod',$data,[
            'table'    =>    $table
        ]);
    }
    public function order_add_pingyang(Request $request,$table)
    { 
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_name', '=',$table)->first();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_name', '=', $table)->first();
        $data['menukitchen'] = Menukitchen::leftjoin('menukitchen_category','menukitchen_category.menukitchen_category_id','=','menukitchen.menukitchen_category')
        ->where('menukitchen_category', '=', '7')
        ->get();
        return view('store_kitchen.order_add_pingyang',$data,[
            'table'    =>    $table
        ]);
    }
    public function customer_save(Request $request)
    {
        $name = $request->fname ;
        $add = new User();
        $add->fname = $name; 
        $add->lname = $request->lname;
        $add->tel = $request->tel;   
        $add->username = $name; 
        $add->password = '$2y$10$PMCpXxmjGScT3.vMZGfcpeNDUWPH3gVC8Y.i.B9uYK.Po2aqYuX0q' ;        
        $add->save();

        return response()->json([
            'status'     => '200',
        ]);
    }
    public function customer_edit(Request $request, $id)
    {
        $datauser = User::find($id);

        return response()->json([
            'status'     => '200',
            'datauser'      =>  $datauser,
        ]);
    }
    public function customer_update(Request $request)
    {
        $name = $request->fname ;
        $id = $request->id ;
        $add = User::find($id);
        $add->fname = $name; 
        $add->lname = $request->lname;
        $add->tel = $request->tel;   
        $add->username = $request->username;
        $add->password = '$2y$10$PMCpXxmjGScT3.vMZGfcpeNDUWPH3gVC8Y.i.B9uYK.Po2aqYuX0q' ;        
        $add->save();

        return response()->json([
            'status'     => '200',
        ]);
    }
    public function customer_destroy(Request $request, $id)
    {
        $del = User::find($id);
        $del->delete();
        return response()->json(['status' => '200']);
    }
   
}
