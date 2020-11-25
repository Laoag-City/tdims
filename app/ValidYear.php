<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidYear extends Model
{
    protected $primaryKey = 'valid_year_id';

    protected $fillable = ['years'];

    public function drivers()
    {
    	return $this->hasMany('App\Driver', 'valid_year_id', 'valid_year_id');
    }
}
