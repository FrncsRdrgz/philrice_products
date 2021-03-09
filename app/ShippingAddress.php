<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class ShippingAddress extends Model
{
    protected $connection = "bdd_online";
    protected $table = "tbl_shipping_address";
    protected $primaryKey = "shipping_address_id";

    protected $fillable = [
    	'user_id',
    	'region',
    	'province',
    	'city',
    	'barangay',
    	'other_details',
    	'is_default'
    ];

    public function get_municipalities($province_id) {
        $municipalities = DB::connection('seed_grow')
        ->table('municipalities')
        ->select('name', 'municipality_id')
        ->where('province_id', $province_id)
        ->orderBy('name', 'asc')
        ->get();

        return $municipalities;
    }

    public function get_active_address($user_id){
        $active_address = ShippingAddress::where('user_id',$user_id)->where('is_default',1)->get()->first();
        return $active_address;
    }
}
