<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Models\User;
use App\Models\Buy;
use App\Models\Sell;
use App\Models\Driver;
use App\Models\Ebill;
use App\Models\EbillTransaction;
use App\Models\Post;

class HomeController extends AdminController
{
	/**
     * Only Authenticated users for "admin" guard are allowed.
     * 
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:admin');
    }
    /**
     * Show Admin Dashboard
     *
     * @return \Illuminate\Http\Request
     */

    public function index(){
        $data['total_user']     = User::count();
        $data['total_buylead']  = Buy::count();
        $data['total_selllead'] = Sell::count();
        $data['total_driver']   = Driver::count();
        $data['total_ebill']    = Ebill::count();
        $data['total_transaction'] = EbillTransaction::count();
        $data['total_posts']    = Post::count();
        return view('admin.dashboard', compact('data'));
    }
}
