<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Table_group_1;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;

class CustomerController extends Controller
{
 
    public function customerinfo()
    {
        $data['users'] = User::orderBy('id','asc')->get();
        $data['table_group_1'] = Table_group_1::orderBy('table_group_1_id','asc')->get();
        return view('customer.customerinfo',$data);
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
    function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->action == 'edit')
    		{
    			$data = array(
    				'fname'	=>	$request->fname,
    				'lname'		=>	$request->lname,
    				'tel'		=>	$request->tel
    			);
    			DB::table('users')
    				->where('id', $request->id)
    				->update($data);
    		}
    		if($request->action == 'delete')
    		{
    			DB::table('users')
    				->where('id', $request->id)
    				->delete();
    		}
    		return response()->json($request);
    	}
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
    public function cus_updatetable(Request $request,$id)
    {  
        DB::table('table_group_1')
        ->where('table_group_1_id', $id)
        ->update(['table_group_1_active' => 'TRUE']);

        return response()->json([
            'status'     => '200',
        ]);
    }
    public function cus_canceltable(Request $request,$id)
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
}
