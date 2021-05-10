<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeedType extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "seed_type_id";
	protected $table = "seed_types";
	protected $fillable = ['name'];

	public $timestamps = false;
}
