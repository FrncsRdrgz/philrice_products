<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $connection = "bdd_online";
    protected $table = "tbl_order_items";
    protected $primaryKey = "order_item_id";
    protected $fillable = [
    	'order_id',
    	'pallet_code',
    	'quantity',
    	'status',
    	'table_name'
    ];
    public $timestamps = false;

    public function order(){
        return $this->belongsTo('App\Order');
    }

    
}
