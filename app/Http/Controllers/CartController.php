<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\SeedStock;
use DB,Auth;
class CartController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

 	public function index(){
 		$cart_data = Cart::where('user_id',Auth::id())->where('status',0)->get();

        
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
        return view('cart.index',compact('data','item_count'));
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
                        'price' => '760'
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
            $cart = Cart::findOrFail($cart_id);
            $cart->quantity = $quantity;
            $cart->save();
            DB::commit();
            $res2 = "success";

        } catch(Exception $e){
            DB::rollback();
            $res2 = $e->getMessage();
        }

        return $res2;
    }
}
