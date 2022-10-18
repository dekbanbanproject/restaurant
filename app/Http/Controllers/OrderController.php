<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Table_group_1;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;

class OrderController extends Controller
{
 
    public function order()
    {
        $data['users'] = User::orderBy('id','asc')->get();
        $data['table_group_1'] = Table_group_1::orderBy('table_group_1_id','asc')->get();
        return view('store_kitchen.order',$data);
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
