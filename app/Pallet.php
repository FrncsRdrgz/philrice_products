<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "pallet_id";
	protected $fillable = [
		'pallet_plan_id',
		'pallet_code',
		'name',
		'column_no',
		'row_no',
		'stack_no',
		'is_active'
	];

	public $timestamps = false;

	// Get the activities for the pallet
	/*public function activities() {
		return $this->hasMany('App\PalletActivities', 'pallet_id', 'pallet_id');
	}*/

	// Get the pallet plan that owns the pallet
	public function pallet_plan() {
		return $this->belongsTo('App\PalletPlan', 'pallet_plan_id', 'pallet_plan_id');
	}
}
