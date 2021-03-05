<?php 

namespace App\Traits;

use App\ShippingAddress;
use DB,Auth;
trait GetActiveShippingAddressTrait {

	/*public function get_shipping_addresses($user_id){
        $address = ShippingAddress::where('user_id',$user_id)->get();

        return $address;
    }*/

    public function get_active_address($user_id){
        $active_address = ShippingAddress::where('user_id',$user_id)->where('is_default',1)->get()->first();
        return $active_address;
    }

    /*public function set_active_address($user_id){

        DB::beginTransaction();
        try{
            ShippingAddress::where('user_id',$user_id)->where('is_default',1)->update(['is_default'=> 0]);
            $address = ShippingAddress::findOrFail($id);
            $address->is_default = 1;
            $address->save();
            DB::commit();
            $res = "success";
        } catch(Exeption $e){
            DB::rollback();
            $res = $e->getMessage();
        }
        return $res;
    }*/
}