<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepository;
use App\SeedStock;
use App\Seed;
use App\Cart;
use DB,Auth;
use Carbon\Carbon;
class ShopController extends Controller
{
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
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
        $item_count = $this->cartRepository->count(Auth::id());
        return view('shop.index',compact('data','item_count'));
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
        //$item_count = $this->item_count();
        return view('shop.products',compact('data'))->render();
    }

    public function seed_details(Request $request){

       $seeds = Seed::findOrFail($request->seed_id);

       $activeStockTable = $this->activeStockTable();

        if($activeStockTable != null){
            $stocks = new SeedStock(['table' => $activeStockTable['tblName']]);
            //$stocks_tbl = $stocks['table'];
            $data = DB::connection('warehouse')
                ->table($stocks['table'].' as sm')
                ->join('rsisdev_seed_seed.seed_characteristics as ss','sm.seedVarietyId','=','ss.id')
                ->select(DB::raw('SUM(sm.availableStock) as availableStock'),'ss.maturity','ss.variety','ss.ave_yld','ss.ecosystem','ss.max_yld','sm.seedVarietyId','sm.packaging','sm.taggedSeedClass')
                ->where('ss.id',$request->seed_id)
                ->where('sm.taggedSeedClass','RS')
                ->orderBy('sm.stockId','ASC')
                ->groupBy('sm.seedVarietyId')
                ->get();
        }
        $data = collect($data)->first();
        
       return response()->json($data);
    }

    public function add_to_cart(Request $request){
        $seed_id = $request->seed_id;
        $seed_class = $request->seed_class;
        $quantity = $request->quantity;
        $activeStockTable = $this->activeStockTable();
        $res2 = "";
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
        $check_cart = Cart::where('pallet_code',$data->palletCode)->where('status', 0)->first();

        if($check_cart != null){
            DB::beginTransaction();
            try{
                $cart = Cart::findOrFail($check_cart->cart_id);
                $cart->quantity = $cart->quantity + $quantity;
                $cart->save();
                DB::commit();
                $res2 = "success";
            }catch(Exception $e){
                DB::rollback();
                $res2 = "error";
            }
            
        }
        else{
            DB::beginTransaction();
            try {
                $cart = new Cart;

            $cart->user_id = Auth::user()->user_id;
            $cart->pallet_code = $data->palletCode;
            $cart->status = 0;
            $cart->quantity = $quantity;
            $cart->table_name = $stocks['table'];
            $cart->save();
            DB::commit();
            $res2 = "success";
            }catch(Exception $e){
                DB::rollback();
                $res2 = "error";
            }
             
        }

        return $res2;
    }


    public function checkout(){
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
        return view('shop.checkout',compact('data'));
    }
}
