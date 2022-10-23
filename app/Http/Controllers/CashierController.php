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

class CashierController extends Controller
{  
    public function cashier(Request $request)
    {
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_zone','=','A')->orderBy('table_group_1_id','asc')->get();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_zone','=','B')->orderBy('table_group_1_id','asc')->get();
        return view('cashier',$data);
    }
    public function cashier_pay(Request $request,$id)
    {  
        $datenow = date('Y-m-d');
        $data['table_group_1'] = Table_group_1::where('table_group_1_zone','=','A')->orderBy('table_group_1_id','asc')->get();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_zone','=','B')->orderBy('table_group_1_id','asc')->get();
        $data['order_rep'] = Order_rep::leftjoin('menukitchen','menukitchen.menukitchen_id','=','order_rep.order_rep_menukitchen_id')
        ->where('table_group_1_id','=',$id)
        ->where('order_rep_active','=','WAITPAY')
        //  ->orderBy('order_rep_id','DESC')
         // ->where('table_group_1_name', '=', $table)       
         ->get();
 
         $countqty = Order_rep::where('table_group_1_id','=',$id)
         ->where('order_rep_active','=','WAITPAY')
         ->sum('order_rep_qty');
        //  ->count();
 
         $sumdata = Order_rep::where('table_group_1_id','=',$id)
         ->where('order_rep_active','=','WAITPAY')
         ->sum('order_rep_price');

         $totaldata = Order_rep::where('table_group_1_id','=',$id)
         ->where('order_rep_active','=','WAITPAY')
         ->sum('order_rep_total');

        return view('cashier_pay',$data,[
            'totaldata'       =>      $totaldata,
            'countqty'        =>      $countqty,
            'sumdata'         =>      $sumdata
        ]);
    }
    public function table_group_1_save(Request $request)
    {
        $add = new Table_group_1();
        $add->table_group_1_name = $request->input('table_group_1_name'); 
        $add->table_group_1_zone = $request->input('table_group_1_zone');
        $add->user_id = $request->input('user_id');          
        $add->save();

        return response()->json([
            'status'     => '200',
        ]);
    }
     
    public function reserve_table_edit(Request $request)
    {
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::get();
        return view('reserve_table_edit',$data);
    }
    public function table_group_1_destroy(Request $request, $id)
    {
        $del = Table_group_1::find($id);
        $del->delete();
        return response()->json(['status' => '200']);
    }
}
