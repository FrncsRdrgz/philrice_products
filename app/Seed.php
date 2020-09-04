<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    protected $connection = 'seed';

    protected $table = 'seed_characteristics';

    protected $primaryKey = 'id';
}
