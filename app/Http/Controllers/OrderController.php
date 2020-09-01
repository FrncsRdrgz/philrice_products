<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeedStock;
use DB;
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
            $test = DB::connection('warehouse')
            ->table($stocks['table'].' as sm')
            ->leftJoin('rsisdev_seed_seed.seed_characteristics as ss','sm.seedVarietyId','=','ss.id')
            ->select('ss.variety','sm.*')
            ->groupBy('seedVarietyId')
            ->paginate(2);
        }
        
        return $test;
    }
}
