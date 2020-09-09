<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SeedStock;
use App\Cart;
use DB, Auth;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('index');
    }

    public function view_cart_data(){
        $cart = new Cart;
        return $cart->findByUserId(Auth::id());
    }
}
