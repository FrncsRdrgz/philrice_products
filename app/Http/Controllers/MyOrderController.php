<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CountCartItemTrait;
use DB, Auth;
class MyOrderController extends Controller
{
	use CountCartItemTrait;
    public function index(){
    	$item_count = $this->item_count();
    	return view('myOrder.index',compact('item_count'));
    }

    public function getAllOrder(){

    }

    public function getPendingOrder(){

    }
}
