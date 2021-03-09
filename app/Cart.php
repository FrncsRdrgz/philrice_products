<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cart extends Model
{
    protected $connection = "bdd_online";
    protected $table ="tbl_cart";
    protected $primaryKey = "cart_id";

    protected $fillable = [
    	'user_id',
    	'pallet_code',
    	'status',
    	'quantity'
    	];

    public $timestamps = false;

    public function findByUserId($user_id){
    	return DB::connection('bdd_online')
    			->table('tbl_cart')
    			->select('*')
    			->where('user_id',$user_id)
    			->where('status',0)
    			->get();
    }
    /* order status
        0 = add to cart
        1 = ready for checkout
        2 = placed order
    */

    public function count($id){
        return Cart::select(DB::raw('SUM(quantity) as quantity'))->where('user_id',$id)->where('status',0)->get()->first();
    }
}
