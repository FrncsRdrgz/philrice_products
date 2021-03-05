<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CountCartItemTrait;
use DB,Auth;
use App\SeedStock;
class CheckoutController extends Controller
{
    use CountCartItemTrait;
	public function __construct()
    {
        $this->middleware('auth');
    }
    
  	public function checkout(){
        $item_count = $this->item_count();
        $activeStockTable = $this->activeStockTable();
        if($activeStockTable != null){
            $stocks = new SeedStock(['table' => $activeStockTable['tblName']]);
            $stocks_tbl = $stocks['table'];
            $data = DB::connection('warehouse')
            ->table($stocks['table'].' as sm')
            ->leftJoin('rsisdev_seed_seed.seed_characteristics as ss','sm.seedVarietyId','=','ss.id')
            ->select('ss.variety','sm.*')
            ->groupBy('seedVarietyId')
            ->paginate(2);
        }

        return view('checkout.index',compact('data','item_count'));
    }
}
