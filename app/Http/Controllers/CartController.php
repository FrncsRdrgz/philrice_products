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
}
