<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Table_group_1;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::orderBy('table_group_1_id','asc')->get();
        return view('home',$data);
    }
    public function customerHome(Request $request)
    {
        return view('customer.home');
    }
    public function adminHome(Request $request)
    {
        return view('admin');
    }
    public function staffHome(Request $request)
    {
        return view('staff/staff_index');
    }
    public function manageHome(Request $request)
    {
        return view('manageHome');
    }
    public function pr_plan(Request $request)
    {
        return view('pr_plan');
    }
    public function reserve_table(Request $request)
    {
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_zone','=','A')->orderBy('table_group_1_id','asc')->get();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_zone','=','B')->orderBy('table_group_1_id','asc')->get();
        return view('reserve_table',$data);
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
    public function table_group_1_update(Request $request)
    {
        $id = $request->table_group_1_id;
        $add = Table_group_1::find($id);
        $add->table_group_1_name = $request->input('table_group_1_name'); 
        $add->table_group_1_zone = $request->input('table_group_1_zone');
        $add->user_id = $request->input('user_id');          
        $add->save();

        return redirect()->route('zone.reserve_table_edit');
        // return response()->json([
        //     'status'     => '200',
        // ]);
    }
    public function updatetable(Request $request,$id)
    {  
        DB::table('table_group_1')
        ->where('table_group_1_id', $id)
        ->update(['table_group_1_active' => 'TRUE']);

        return response()->json([
            'status'     => '200',
        ]);
    }
    public function canceltable(Request $request,$id)
    { 
        DB::table('table_group_1')
        ->where('table_group_1_id', $id)
        ->update(['table_group_1_active' => 'FALSE']);

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
    public function kitchen(Request $request)
    {
        $data['users'] = User::get();
        $data['table_group_1'] = Table_group_1::where('table_group_1_zone','=','A')->orderBy('table_group_1_id','asc')->get();
        $data['table_group_1B'] = Table_group_1::where('table_group_1_zone','=','B')->orderBy('table_group_1_id','asc')->get();
        return view('store_kitchen.kitchen',$data);
    }
}
