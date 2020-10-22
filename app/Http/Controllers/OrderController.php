<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeedStock;
use App\Seed;
use App\Cart;
use DB,Auth;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //dd($data);
        return view('order.index',compact('data'));
    }

    public function display_seeds(){

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
        
        return view('order.products',compact('data'))->render();
    }

    public function seed_details(Request $request){

       $seeds = Seed::findOrFail($request->seed_id);


       $activeStockTable = $this->activeStockTable();

        if($activeStockTable != null){
            $stocks = new SeedStock(['table' => $activeStockTable['tblName']]);
            $stocks_tbl = $stocks['table'];
            $data = DB::connection('warehouse')
                ->table($stocks['table'].' as sm')
                ->leftJoin('rsisdev_seed_seed.seed_characteristics as ss','sm.seedVarietyId','=','ss.id')
                ->select('ss.maturity','sm.*')
                ->where('ss.id',$request->seed_id)
                ->orderBy('sm.stockId','ASC')
                ->get();
        }

        $query = ['seeds'=> $seeds, 'data'=> $data];
       return $query;
    }

    public function add_to_cart(Request $request){
        $seed_id = $request->seed_id;
        $seed_class = $request->seed_class;
        $quantity = $request->quantity;
        $activeStockTable = $this->activeStockTable();

        if($activeStockTable != null){
            $stocks = new SeedStock(['table' => $activeStockTable['tblName']]);
            $stocks_tbl = $stocks['table'];
            $data = DB::connection('warehouse')
                ->table($stocks['table'].' as sm')
                ->leftJoin('rsisdev_seed_seed.seed_characteristics as ss','sm.seedVarietyId','=','ss.id')
                ->select('ss.maturity','sm.*')
                ->where('sm.seedVarietyId',$seed_id)
                ->where('sm.taggedSeedClass',$seed_class)
                ->orderBy('sm.stockId','ASC')
                ->first();
        }

        $params = array(
            'user_id' => Auth::user()->user_id,
            'pallet_code' => $data->palletCode,
            'status' => 1,
            'quantity' => $quantity*$data->packaging
        );

        $check_cart = Cart::where('pallet_code',$data->palletCode)->first();

        if($check_cart != null){
            $cart = Cart::findOrFail($check_cart->cart_id);

            $cart->quantity = $cart->quantity + $quantity;
            $cart->save();
        }
        else{
            $cart = new Cart;

            $cart->user_id = Auth::user()->user_id;
            $cart->pallet_code = $data->palletCode;
            $cart->status = 0;
            $cart->quantity = $quantity;

            $cart->save();  
        }

        
    }

    public function view_cart_data(){
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
        return $data;
    }
}
