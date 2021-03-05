<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $connection = 'bdd_online';
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_orders';

    protected $fillable = [
    	'user_id',
    	'order_date',
    	'status',
    	'order_type',
    	'reservation_expiration_date',
    ];
    public $timestamps = false;
}
