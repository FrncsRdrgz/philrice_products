<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "schema_id";
	protected $fillable = [
		'schema_id', 
		'name', 
		'station_id',
	];

	public $timestamps = false;
}
