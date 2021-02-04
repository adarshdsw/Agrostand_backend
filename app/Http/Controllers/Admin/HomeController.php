<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;


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
        return view('admin.dashboard');
    }
}
