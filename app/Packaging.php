<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "packaging_id";
	protected $fillable = ['value'];

	public $timestamps = false;
}
