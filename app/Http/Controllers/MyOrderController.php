<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Order;
use App\OrderItem;
use DB, Auth;
class MyOrderController extends Controller
{

	public function __construct(CartRepository $cartRepository, OrderRepository $orderRepository){
		$this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
	}
    public function index(){
        //$orderItems =$this->orderRepository->getOrderItems(Auth::id());
    	$item_count = $this->cartRepository->count(Auth::id());
    	return view('myOrder.index',compact('item_count'));
    }

    public function getOrders(Request $request){;
        $status = $request->status;
        return $this->orderRepository->getOrderItems(Auth::id(),$status);
    }

    public function getPendingOrder(){

    }
}
