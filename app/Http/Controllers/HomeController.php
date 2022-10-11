<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        return view('home');
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
        return view('reserve_table');
    }
}
