<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeedStock extends Model
{
    protected $connection = "warehouse";
    public function __construct($params = array())
    {
        
        if (isset($params['table'])) {
            $this->table = $params['table'];

        }
    }

    protected $primaryKey = 'stockId';

    protected $fillable = [
        'palletId', 'seedClass', 'seedVariety', 'packaging','availableStock','buffer', 'stock', 'stockRemaining', 'price'
    ];

    public $timestamps = false;
}
