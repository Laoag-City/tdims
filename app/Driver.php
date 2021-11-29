<?php

namespace App;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use Eloquence;

    protected $primaryKey = 'driver_id';

    public function valid_year()
    {
    	return $this->belongsTo('App\ValidYear', 'valid_year_id', 'valid_year_id');
    }

    public function operation_logs()
    {
    	return $this->hasMany('App\OperationLog', 'driver_id', 'driver_id');
    }

    public function getWholeName()
    {
        //https://stackoverflow.com/questions/24570744/remove-extra-spaces-but-not-space-between-two-words?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
        return trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", "$this->driver_first_name $this->driver_middle_initial" . ($this->driver_middle_initial ? '.' : '') . " $this->driver_last_name $this->driver_suffix_name")));
    }

    public function getDriverType()
    {
        return $this->is_city_driver ? 'City Driver' : 'Brgy Driver';
    }

    public function getGender()
    {
        return $this->sex ? 'Male' : 'Female';
    }

    public function getHeightUnit($is_feet)
    {
        if($is_feet)
            return substr($this->height, 0, 1);

        return rtrim(substr($this->height, 2, 3), '"');
    }

    public function getIDControlNos($as_array = false)
    {
        $control_nos = explode('|', $this->id_control_no);
        array_shift($control_nos);
        array_pop($control_nos);
        return $as_array ? $control_nos : implode(', ', $control_nos);
    }

    //if $is_id_no is false, return id control no
    public function formattedIDNo($is_id_no = true)
    {
        $id = sprintf('%04d', $is_id_no ? $this->id_no : $this->getLatestIDControlNo());

        return $this->is_city_driver ? 'A ' . $id : 'AB ' . $id;
    }

    public function getLatestIDControlNo()
    {
        return array_values(array_slice($this->getIDControlNos(true), -1))[0];
    }
}
