<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockStatus extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "stocks_status_id";
	protected $table = "stocks_status";
	protected $fillable = ['name'];

	public $timestamps = false;
}
