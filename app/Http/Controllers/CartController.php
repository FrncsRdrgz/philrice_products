<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\SeedStock;
use App\ShippingAddress;
use DB,Auth;
class CartController extends Controller
{
    /* order status
        0 = add to cart
        1 = ready for checkout
        2 = placed order

    */
	public function __construct()
    {
        $this->middleware('auth');
    }

 	public function index(){
 		$cart_data = Cart::where('user_id',Auth::id())->where('status',0)->get();
        $active_address = ShippingAddress::where('user_id',Auth::id())->where('is_default',1)->get()->first();
        //dd(Auth::user()->fullname);
        $activeStockTable = $this->activeStockTable();
        //dd($cart_data);
        if($activeStockTable != null){
            $stocks = new SeedStock(['table' => $activeStockTable['tblName']]);
            $stocks_tbl = $stocks['table'];

            $data = array();
            foreach($cart_data as $cd){
                $query = DB::connection('warehouse')
                ->table($stocks['table'].' as sm')
                ->leftJoin('rsisdev_seed_seed.seed_characteristics as ss','sm.seedVarietyId','=','ss.id')
                ->select('ss.maturity','ss.variety','sm.*')
                ->where('sm.palletCode',$cd->pallet_code)
                ->orderBy('sm.stockId','ASC')
                ->get();

                foreach($query as $q){
                    $data[] = array(
                        'variety' => $q->variety,
                        'seed_class' => $q->taggedSeedClass,
                        'quantity' => $cd->quantity

                    );
                }
            }
        }
        $item_count = $this->item_count();
        $provinces = $this->provinces();
        return view('cart.index',compact('data','item_count','provinces','active_address'));
 	}

    public function view_cart_data(){
        $cart_data = Cart::where('user_id',Auth::id())->where('status',0)->orderBy('cart_id','ASC')->get();

        $activeStockTable = $this->activeStockTable();
        //dd($cart_data);
        if($activeStockTable != null){
            $stocks = new SeedStock(['table' => $activeStockTable['tblName']]);
            $stocks_tbl = $stocks['table'];

            $data = array();
            foreach($cart_data as $cd){
                $query = DB::connection('warehouse')
                ->table($stocks['table'].' as sm')
                ->leftJoin('rsisdev_seed_seed.seed_characteristics as ss','sm.seedVarietyId','=','ss.id')
                ->select('ss.maturity','ss.variety','sm.*')
                ->where('sm.palletCode',$cd->pallet_code)
                //->orderBy('sm.stockId','ASC')
                ->get();

                foreach($query as $q){
                    $data[] = array(
                        'cart_id' => $cd->cart_id,
                        'variety' => $q->variety,
                        'seed_class' => $q->taggedSeedClass,
                        'quantity' => $cd->quantity,
                        'price' => '760',
                        'status' => $cd->status
                    );
                }
            }
        }
        return $data;
    }

    public function change_quantity(Request $request){
        $quantity = $request->quantity;
        $cart_id = $request->cart_id;

        DB::beginTransaction();
        try{
            $cart = Cart::where('cart_id',$cart_id)
                    ->where('user_id',Auth::id())
                    ->update(['quantity' => $quantity]);
            DB::commit();
            $res2 = "success";

        } catch(Exception $e){
            DB::rollback();
            $res2 = $e->getMessage();
        }

        return $res2;
    }

    public function delete_cart_item(Request $request){
        $cart_id = $request->cart_id;

        DB::beginTransaction();
        try{
            $cart = Cart::where('cart_id',$cart_id)
                        ->where('user_id',Auth::id())
                        ->delete();
            DB::commit();
            $res2 = "success";
        } catch(Exception $e){
            DB::rollback();
            $res2 = $e->getMessage();
        }

        return $res2;
    }

    public function proceed_checkout(Request $request){
        $cart_id_array = $request->cart_id_array;

        foreach($cart_id_array as $array){
            DB::beginTransaction();
            try{
                $cart = Cart::where('cart_id',$array['cart_id'])
                            ->where('user_id', Auth::id())
                            ->update(['status' => 1]);
                DB::commit();
                $res2 = "success";
            } catch(Exeption $e){
                DB::rollback();
                $res2 = $e->getMessage();
            }
        }
        return $res2;
    }

    public function municipalities(Request $request){
        $province_id = $request->province_id;
        $shipping_address = new ShippingAddress();

        $municipalities = $shipping_address->get_municipalities($province_id);

        return $municipalities;
    }

    public function save_address(Request $request){
        //dd($request->all());
        $province_id = $request->province_id;
        $region_id = $request->region_id;
        $municipality_id = $request->municipality_id;
        $barangay = $request->barangay;
        $other_details = $request->other_details;
        $set_default = $request->set_default;

        $province = DB::connection('seed_grow')->table('provinces')->where('province_id',$province_id)->first();
        $region = DB::connection('seed_grow')->table('regions')->where('region_id',$region_id)->first();
        $municipality = DB::connection('seed_grow')->table('municipalities')->where('municipality_id',$municipality_id)->first();

        DB::beginTransaction();
        try{
            $address = new ShippingAddress;
            $address->user_id = Auth::id();
            $address->region = $region->name;
            $address->province = $province->name;
            $address->city = $municipality->name;
            $address->barangay = $barangay;
            $address->other_details = $other_details;
            $address->is_default = $set_default;

            $address->save();

            DB::commit();
            $res = "success";
        } catch(Exeption $e){
            DB::rollback();
            $res = $e->getMessage();
        }

        return $res;
    }

    public function get_shipping_addresses(){
        $address = ShippingAddress::where('user_id',Auth::id())->get();

        return $address;
    }

    public function get_active_address(){
        $active_address = ShippingAddress::where('user_id',Auth::id())->where('is_default',1)->get()->first();
        return $active_address;
    }

    public function set_active_address($id){

        DB::beginTransaction();
        try{
            ShippingAddress::where('user_id',Auth::id())->where('is_default',1)->update(['is_default'=> 0]);
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
    }
}
