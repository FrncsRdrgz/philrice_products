<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentals extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = "parentals_id";
	protected $table = "parentals";
	protected $fillable = ['name'];

	public $timestamps = false;
}
