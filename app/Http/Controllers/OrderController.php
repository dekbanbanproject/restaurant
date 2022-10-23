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
use App\Models\Order_rep;

class OrderController extends Controller
{
 
    public function order(Request $request,$table)
    {
        $data['users'] = User::orderBy('id','asc')->get();
        $data['table_group_1'] = Table_group_1::orderBy('table_group_1_id','asc')->get();
        $data['order_rep'] = Order_rep::leftjoin('menukitchen','menukitchen.menukitchen_id','=','order_rep.order_rep_menukitchen_id')
        
        ->where('table_group_1_name', '=', $table)       
        ->get();
        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '!=', 'OFF')
        ->where('order_rep_active', '!=', 'CANCEL') 
        ->where('order_rep_active', '!=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '!=', 'OFF')
        ->where('order_rep_active', '!=', 'CANCEL') 
        ->where('order_rep_active', '!=', 'PREORDER')
        ->sum('order_rep_total');
        return view('store_kitchen.order',$data,[
            'table'        =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
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

        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)->where('order_rep_active', '=', 'PREORDER')->sum('order_rep_total');
        return view('store_kitchen.order_add',$data,[
            'table'        =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
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
        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)->where('order_rep_active', '=', 'PREORDER')->sum('order_rep_total');
        return view('store_kitchen.order_add_phad',$data,[
            'table'        =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
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
        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)->where('order_rep_active', '=', 'PREORDER')->sum('order_rep_total');

        return view('store_kitchen.order_add_tod',$data,[
            'table'        =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
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

        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)->where('order_rep_active', '=', 'PREORDER')->sum('order_rep_total');

        return view('store_kitchen.order_add_drink',$data,[
            'table'        =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
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

        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)->where('order_rep_active', '=', 'PREORDER')->sum('order_rep_total');
        return view('store_kitchen.order_add_nuang',$data,[
            'table'    =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
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
        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)->where('order_rep_active', '=', 'PREORDER')->sum('order_rep_total');

        return view('store_kitchen.order_add_sod',$data,[
            'table'    =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
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
        $countdata = Order_rep::where('table_group_1_name', '=', $table)
        ->where('order_rep_active', '=', 'PREORDER')
        ->count();
        $totaldata = Order_rep::where('table_group_1_name', '=', $table)->where('order_rep_active', '=', 'PREORDER')->sum('order_rep_total');
        return view('store_kitchen.order_add_pingyang',$data,[
            'table'    =>    $table,
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
        ]);
    }
    public function order_save(Request $request)
    {
        $date = date("Y-m-d");
        $q = $request->qty; ;
        $p = $request->price; 
        $add = new Order_rep();
        $add->order_rep_menukitchen_id = $request->menukitchen_id;

        $tab = $request->table;
        $nametable = Table_group_1::where('table_group_1_name','=',$tab)->first();

        $add->table_group_1_id = $nametable->table_group_1_id;
        $add->table_group_1_name = $nametable->table_group_1_name;

        $add->order_rep_date = $date;

        $add->order_rep_menukitchen_id = $request->menukitchen_id;
        $add->order_rep_qty =  $q; 
        $add->order_rep_price = $p; 
        // $add->order_rep_discount =" "; 
        $add->order_rep_total = $q * $p;   
        $add->order_rep_active = "PREORDER";
        $add->save();

        return redirect()->back();
        // return response()->json([
        //     'status'     => '200',
        // ]);
    }
    public function order_destroy(Request $request, $id)
    {
        $del = Order_rep::find($id);
        $del->delete();
        return response()->json(['status' => '200']);
    }
    public function order_update(Request $request, $id)
    {
        $update = Order_rep::find($id);
        $update->order_rep_active = "CANCEL";
        $update->save();
        return response()->json(['status' => '200']);
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
   
    public function order_back(Request $request)
    {
        $datenow = date('Y-m-d');
        $data['users'] = User::orderBy('id','asc')->get();
        $data['table_group_1'] = Table_group_1::orderBy('table_group_1_id','asc')->get();
        $data['order_rep'] = Order_rep::leftjoin('menukitchen','menukitchen.menukitchen_id','=','order_rep.order_rep_menukitchen_id')
       ->where('order_rep_date','=',$datenow)
        ->orderBy('order_rep_id','DESC')
        // ->where('table_group_1_name', '=', $table)       
        ->get();

        $countdata = Order_rep::where('order_rep_active', '!=', 'OFF')
        ->where('order_rep_active', '!=', 'CANCEL') 
        ->where('order_rep_active', '!=', 'PREORDER')
        ->where('order_rep_date','=',$datenow)
        ->count();

        $totaldata = Order_rep::where('order_rep_active', '!=', 'OFF')
        ->where('order_rep_active', '!=', 'CANCEL') 
        ->where('order_rep_active', '!=', 'PREORDER')
        ->where('order_rep_date','=',$datenow)
        ->sum('order_rep_total');
        return view('store_kitchen.order_back',$data,[
            'countdata'    =>    $countdata,
            'totaldata'    =>    $totaldata
        ] );
    }
    public function order_back_update(Request $request, $id)
    {
        $update = Order_rep::find($id);
        $update->order_rep_active = "ORDER";
        $update->save();
        return response()->json(['status' => '200']);
    }
    public function order_back_lastupdate(Request $request, $id)
    {
        $update = Order_rep::find($id);
        $update->order_rep_active = "WAITPAY";
        $update->save();
        return response()->json(['status' => '200']);
    }
}
