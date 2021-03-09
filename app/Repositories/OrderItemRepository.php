<?php

namespace App\Repositories;

class OrderItemRepository {
	
	public function __construct($orderItem){
		$this->orderItem = $orderItem;
	}

	public function all(){
		$orderItems = $this->orderItem->all();

		return response()->json($orderItems,200);
	}
}