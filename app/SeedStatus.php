<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeedStatus extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "seed_status_id";
	protected $table = "seed_status";
	protected $fillable = ['name'];

	public $timestamps = false;
}
