<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CountCartItemTrait;
use App\Helpers\DatabaseConnection;
use App\Repositories\CartRepository;
use App\SeedStock;
use App\Seed;
use App\SeedType;
use App\InbredSeedClass;
use App\HybridSeedType;
use App\Cart;
use App\AffiliationUser;
use App\Warehouse;
use App\PalletPlan;
use App\Schema;
use App\Packaging;
use DB,Auth;
use Carbon\Carbon;
use Entrust;
class ShopController extends Controller
{
    use CountCartItemTrait;
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
        //get user with its affiliation
        $user_affiliation = AffiliationUser::where('user_id', Auth::user()->user_id)->with('station')->first();

        //get station id
        $station_id = $user_affiliation->station->philrice_station_id;
        //get active warehouse base on station id
        $warehouses = Warehouse::where('station_id',$station_id)->where('is_active',1)->get();

        $data = array();
        if(!empty($warehouses)){

            foreach($warehouses as $warehouse){
                //$warehouse_id = $warehouse->warehouse_id;
                //get pallet plan base on warehouse_id;
                $pallet_plan = PalletPlan::where('warehouse_id',$warehouse->warehouse_id)->where('status',1)->first();
                
                if(!empty($pallet_plan)){
                    //get schema base on station id;
                    $schema = Schema::where('station_id',$station_id)->first();
                    $schema_name = $schema->name;

                    //set the database connection using the schema name;
                    $connection = DatabaseConnection::setDBConnection($schema_name);

                    //Get year and semester from pallet plan table. 
                    $year = $pallet_plan->year;
                    $semester = $pallet_plan->semester;
                    $stocks_tbl_name = "tbl_sem".$semester."_".$year."_stocks";
                    $release_tbl_name = "tbl_sem".$semester."_".$year."_release_pur";

                    //Get stocks
                    $stocks = $connection->table($stocks_tbl_name)
                                        ->select(DB::raw('SUM(available_stocks) as available_stocks'),'variety','seed_type_id','inbred_seed_class_id','hybrid_seed_type_id','seed_status_id')
                                        ->where('available_stocks','>',0)
                                        ->where('status', '=', 0)
                                        ->where('seed_type_id',1)
                                        ->where('inbred_seed_class_id',4)
                                        ->where('seed_status_id',3)
                                        ->groupBy('variety','seed_type_id','inbred_seed_class_id','hybrid_seed_type_id','seed_status_id')
                                        ->get();
                    
                    // Get seeds
                    foreach($stocks as $stock){
                        // Get seeds
                        $seeds = Seed::where('variety_name', 'NOT LIKE', '%DWSR%')->where('variety',$stock->variety)->first();
                        // Get seed types
                        $seedType = SeedType::find($stock->seed_type_id);
                        // Get inbred seed classes
                        $inbred_seed_classes = InbredSeedClass::find($stock->inbred_seed_class_id);
                        // Get hybrid seed types
                        $hybrid_seed_types = HybridSeedType::find($stock->hybrid_seed_type_id);
                        // Get parentals

                        $data[] = array(
                            'variety' => $seeds->variety,
                            'inbred_class' => ($inbred_seed_classes == null)? null : $inbred_seed_classes->name,
                            'class_id' => $stock->inbred_seed_class_id,
                            'available_stocks' => $stock->available_stocks,
                            'hybrid_class' => ($hybrid_seed_types === null) ? null : $hybrid_seed_types->name,
                            'maturity' => $seeds->maturity,
                            'ave_yld' => $seeds->ave_yld,
                            'max_yld' => $seeds->max_yld
                        );
                    };     
                }
            }
        }
        $data = $this->paginate($data);

        $item_count = $this->item_count();
        
        return view('shop.index',compact('data','item_count'));
    }

    public function display_seeds(){

        //get user with its affiliation
        $user_affiliation = AffiliationUser::where('user_id', Auth::user()->user_id)->with('station')->first();

        //get station id
        $station_id = $user_affiliation->station->philrice_station_id;
        //get active warehouse base on station id
        $warehouses = Warehouse::where('station_id',$station_id)->where('is_active',1)->get();

        $data = array();
        if(!empty($warehouses)){

            foreach($warehouses as $warehouse){
                //$warehouse_id = $warehouse->warehouse_id;
                //get pallet plan base on warehouse_id;
                $pallet_plan = PalletPlan::where('warehouse_id',$warehouse->warehouse_id)->where('status',1)->first();
                
                if(!empty($pallet_plan)){
                    //get schema base on station id;
                    $schema = Schema::where('station_id',$station_id)->first();
                    $schema_name = $schema->name;

                    //set the database connection using the schema name;
                    $connection = DatabaseConnection::setDBConnection($schema_name);

                    //Get year and semester from pallet plan table. 
                    $year = $pallet_plan->year;
                    $semester = $pallet_plan->semester;
                    $stocks_tbl_name = "tbl_sem".$semester."_".$year."_stocks";
                    $release_tbl_name = "tbl_sem".$semester."_".$year."_release_pur";

                    //Get stocks
                    $stocks = $connection->table($stocks_tbl_name)
                                        ->select(DB::raw('SUM(available_stocks) as available_stocks'),'variety','seed_type_id','inbred_seed_class_id','hybrid_seed_type_id','seed_status_id')
                                        ->where('available_stocks','>',0)
                                        ->where('status', '=', 0)
                                        ->where('seed_type_id',1)
                                        ->where('inbred_seed_class_id',4)
                                        ->where('seed_status_id',3)
                                        ->groupBy('variety','seed_type_id','inbred_seed_class_id','hybrid_seed_type_id','seed_status_id')
                                        ->get();
                    
                    // Get seeds
                    foreach($stocks as $stock){
                        // Get seeds
                        $seeds = Seed::where('variety_name', 'NOT LIKE', '%DWSR%')->where('variety',$stock->variety)->first();
                        // Get seed types
                        $seedType = SeedType::find($stock->seed_type_id);
                        // Get inbred seed classes
                        $inbred_seed_classes = InbredSeedClass::find($stock->inbred_seed_class_id);
                        // Get hybrid seed types
                        $hybrid_seed_types = HybridSeedType::find($stock->hybrid_seed_type_id);
                        // Get parentals

                        $data[] = array(
                            'variety' => $seeds->variety,
                            'inbred_class' => ($inbred_seed_classes == null)? null : $inbred_seed_classes->name,
                            'class_id' => $stock->inbred_seed_class_id,
                            'available_stocks' => $stock->available_stocks,
                            'hybrid_class' => ($hybrid_seed_types === null) ? null : $hybrid_seed_types->name,
                            'maturity' => $seeds->maturity,
                            'ave_yld' => $seeds->ave_yld,
                            'max_yld' => $seeds->max_yld
                        );
                    };     
                }
            }
        }
        $data = $this->paginate($data);
        //$item_count = $this->item_count();
        return view('shop.products',compact('data'))->render();
    }

    public function seed_details(Request $request){
        $variety = $request->variety;
        $serial_num = $this->serial_number();
        //$seeds = Seed::findOrFail($request->seed_id);
        $user_affiliation = AffiliationUser::where('user_id', Auth::user()->user_id)->with('station')->first();
        //get station id
        $station_id = $user_affiliation->station->philrice_station_id;
        //get active warehouse base on station id
        $warehouses = Warehouse::where('station_id',$station_id)->where('is_active',1)->get();
        $data = array();
        if(!empty($warehouses))
        {
            foreach($warehouses as $warehouse){
                //get pallet plan base on warehouse_id;
                $pallet_plan = PalletPlan::where('warehouse_id',$warehouse->warehouse_id)->where('status',1)->first();

                if(!empty($pallet_plan)){
                    //get schema base on station id;
                    $schema = Schema::where('station_id',$station_id)->first();
                    $schema_name = $schema->name;

                    //set the database connection using the schema name;
                    $connection = DatabaseConnection::setDBConnection($schema_name);

                    //Get year and semester from pallet plan table. 
                    $year = $pallet_plan->year;
                    $semester = $pallet_plan->semester;
                    $stocks_tbl_name = "tbl_sem".$semester."_".$year."_stocks";
                    $release_tbl_name = "tbl_sem".$semester."_".$year."_release_pur";
                    $temp_tbl_name = "tbl_sem".$semester."_".$year."_temp_pur";

                    //Get stocks
                    $stocks = $connection->table($stocks_tbl_name)
                                        ->select(DB::raw('SUM(available_stocks) as available_stocks'),'variety','seed_type_id','inbred_seed_class_id','hybrid_seed_type_id','seed_status_id','packaging_id')
                                        ->where('variety',$variety)
                                        ->where('available_stocks','>',0)
                                        ->where('status', '=', 0)
                                        ->where('seed_type_id',1)
                                        ->where('seed_status_id',3)
                                        ->groupBy('variety','seed_type_id','inbred_seed_class_id','hybrid_seed_type_id','seed_status_id','packaging_id')
                                        ->get();
                    // Get seeds
                    foreach($stocks as $stock){
                        // Get seeds
                        $seeds = Seed::where('variety_name', 'NOT LIKE', '%DWSR%')->where('variety',$stock->variety)->first();
                        // Get seed types
                        $seedType = SeedType::find($stock->seed_type_id);
                        // Get inbred seed classes
                        $inbred_seed_classes = InbredSeedClass::find($stock->inbred_seed_class_id);
                        // Get hybrid seed types
                        $hybrid_seed_types = HybridSeedType::find($stock->hybrid_seed_type_id);
                        // Get parentals
                        // Get packagings
                        $packagings = Packaging::find($stock->packaging_id);

                        $data = array(
                            'variety' => $seeds->variety,
                            'inbred_class' => ($inbred_seed_classes == null)? null : $inbred_seed_classes->name,
                            'class_id' => $stock->inbred_seed_class_id,
                            'available_stocks' => $stock->available_stocks,
                            'hybrid_class' => ($hybrid_seed_types === null) ? null : $hybrid_seed_types->name,
                            'maturity' => $seeds->maturity,
                            'ave_yld' => $seeds->ave_yld,
                            'max_yld' => $seeds->max_yld,
                            'amylose' => $seeds->amylose,
                            'packaging' => $packagings->value,
                            'ecosystem' => $seeds->ecosystem
                        );
                    };
                    $temporary = $connection->table($temp_tbl_name.' as temp')
                        ->join($stocks_tbl_name.' as stocks','stocks.pallet_id','temp.pallet_id')
                        ->select('temp.quantity','temp.serialNum')
                        ->where('serialNum',$serial_num)
                        ->where('stocks.variety',$variety)
                        ->where('stocks.status',0)
                        ->where('temp.status','1')
                        //->groupBy('serialNum','temp.pallet_id','stocks.variety','stocks.inbred_seed_class_id')
                        ->first(); 
                }
                
            }
        }
       /*$activeStockTable = $this->activeStockTable();

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
        $data = collect($data)->first();*/
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
