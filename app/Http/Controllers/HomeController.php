<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CountCartItemTrait;
use App\SeedStock;
use App\Cart;
use DB, Auth;
use Entrust;
class HomeController extends Controller
{
    use CountCartItemTrait;
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
        $item_count = $this->item_count();
        return view('index',compact('item_count'));
    }

    public function view_cart_data(){
        $cart = new Cart;
        return $cart->findByUserId(Auth::id());
    }
}
