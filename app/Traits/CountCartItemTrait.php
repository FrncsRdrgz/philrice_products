<?php 

namespace App\Traits;

use App\Traits\GetSeedGrowerDetailTrait;
use App\Cart;
use DB,Auth;
trait CountCartItemTrait {

	use GetSeedGrowerDetailTrait;

	public function item_count(){
		$serial_num = $this->serial_number();
        return Cart::select(DB::raw('SUM(quantity) as quantity'))->where('serial_num',$serial_num)->where('status',0)->get()->first();
    }
}