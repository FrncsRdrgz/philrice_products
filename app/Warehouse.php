<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "warehouse_id";
	protected $fillable = ['name', 'station_id', 'length', 'width', 'height'];

	public $timestamps = false;
}
