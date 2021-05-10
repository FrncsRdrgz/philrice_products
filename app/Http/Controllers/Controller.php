<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Browser;
use DB, Auth;
use Storage;
use App\Monitoring;
use App\Affiliation;
use App\Permission;
use App\PhilRiceStation;
use App\Role;
use App\System;
use App\Activity;
use App\User;
use App\TableLog;
use Entrust;
use App\Cart;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Get all stations
    public function stations()
    {
        $stations = DB::table('philrice_station')->select('*')->orderBy('name', 'asc')->get();
        return $stations;
    }
    // get
    public function getUserStation($user_id){
        return DB::table('affiliation_user')->select('affiliated_to')->where('user_id',$user_id)->first();
    }

    // Browser name for logs
    public function browser() {
    	return Browser::browserName();
    }

    // Device for logs
    public function device() {
    	if (Browser::isMobile()) {
    		if (Browser::deviceModel() != "Unknown") {
    			return Browser::deviceModel();
    		} else {
    			return "Mobile";
    		}
    	} else if (Browser::isTablet()) {
    		if (Browser::deviceModel() != "Unknown") {
    			return Browser::deviceModel();
    		} else {
    			return "Tablet";
    		}
    	} else if (Browser::isDesktop()) {
    		return "Desktop";
    	}
    }

    // Countries
    public function countries() {
        // json file is in storage folder
        $json = Storage::disk('local')->get('countries.json');
        $countries = json_decode($json, true);
        asort($countries);
        return $countries;
    }

    // Provinces
    public function provinces() {
        $provinces = DB::connection('seed_grow')->table('provinces')->orderBy('name', 'asc')->get();
        return $provinces;
    }

    // Affiliations
    public function affiliations() {
        $affiliations = DB::table('affiliations')->orderBy('name', 'asc')->get();
        return $affiliations;
    }

    // OS name for logs
    public function operating_system() {
        return Browser::platformName();
    }

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
