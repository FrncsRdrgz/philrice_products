<?php

namespace App\Repositories;

class OrderRepository {

	public function __construct($order,$stock){
		$this->order = $order;
		$this->stock = $stock;
	}

	public function all() {
		$orders = $this->order->all();

		return response()->json($orders,200);
	}

	public function getOrderItems($id,$status){
		/*$orderItems = $this->order->with(['orderItems' => function($query) use ($status){
			$query->where('status',$status);
		}])
		->where('user_id',$id)
		->where('status',$status)
		->get();*/
		$query = $this->order->with('orderItems')
		->where('user_id',$id)
		->orderBy('order_id','DESC');

		if($status !== "0"){
			$query->where('status',$status);
		}
		$orderItems = $query->get();

		$data = array();
		
		foreach($orderItems as $order){
			$stocks = array();
			foreach($order->orderItems as $items){
				$tblStock = $this->stock->setTable($items->table_name);

				$query = $tblStock->join('rsisdev_seed_seed.seed_characteristics as ss','ss.id',$items->table_name.'.seedVarietyid')
				->select('ss.variety','ss.maturity','ss.ave_yld','ss.max_yld')
				->where('palletCode',$items->pallet_code)
				->get()->first();

					$stocks[] = array(
						'order_item_id' => $items->order_item_id,
						'pallet_code' => $items->pallet_code,
						'quantity' => $items->quantity,
						'variety' => $query->variety,
						'maturity' => $query->maturity,
						'ave_yld' => $query->ave_yld,
						'max_yld' => $query->max_yld,
					);
			}
			$data[] = array(
				'order_id' => $order->order_id,
				'status' => $order->status,
				'data' => $stocks
			);
		};
		return response()->json($data,200);
	}
}