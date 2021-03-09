<?php

namespace App\Repositories;

class CartRepository {

	public function __construct($cart){
		$this->cart = $cart;
	}

	public function all(){
		$cartItems = $this->cart->all();

		return response()->json($cartItems,200);
	}

	public function count($id){
		$count = $this->cart->count($id);

		return $count;
	}
	
}