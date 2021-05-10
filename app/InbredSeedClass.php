<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InbredSeedClass extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "inbred_seed_class_id";
	protected $table = "inbred_seed_classes";
	protected $fillable = ['name'];

	public $timestamps = false;
}
