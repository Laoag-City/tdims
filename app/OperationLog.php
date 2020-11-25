<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $primaryKey = 'operation_log_id';

    public function driver()
    {
    	return $this->belongsTo('App\Driver', 'driver_id', 'driver_id');
    }
}
