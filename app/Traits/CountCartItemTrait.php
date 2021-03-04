<?php 

namespace App\Traits;

use App\Cart;
use DB,Auth;
trait CountCartItemTrait {

	public function item_count(){
        return Cart::select(DB::raw('SUM(quantity) as quantity'))->where('user_id',Auth::id())->where('status',0)->get()->first();
    }
}