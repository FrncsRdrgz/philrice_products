<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HybridSeedType extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "hybrid_seed_type_id";
	protected $table = "hybrid_seed_types";
	protected $fillable = ['name'];

	public $timestamps = false;
}
