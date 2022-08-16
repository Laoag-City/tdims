<?php

namespace App\Custom;

use Carbon\Carbon;

class ValidYearParser
{
	protected const START_YEAR = 2016;
    protected const START_MONTH = 7;
    protected const YEAR_INTERVAL = 3;

    public function getYearNumberInValidYear($check_year_no_if_advanced_to_next_year = false)
    {
        $year_no_is_advanced = false;
        $year_now = Carbon::now()->year;
        $month_now = Carbon::now()->month;

        if($year_now - $this::START_YEAR < 0)
            abort(500, 'Error: Your time is behind ' . $this::START_YEAR . '. Please adjust your time to the time <u>now</u>.');

        if($year_now > $this::START_YEAR)
            $valid_year_order_number = $year_now - $this::START_YEAR;
        else
            $valid_year_order_number = $this::YEAR_INTERVAL; //used if year now is the same as start year

        //valid year order number must be the same or lower than year interval to know the real order number so subtract it through a loop
        while($valid_year_order_number > $this::YEAR_INTERVAL)
            $valid_year_order_number -= $this::YEAR_INTERVAL;

        //used if year now is the same as the last year of the previous ID series and if month now is the same or exceeds start month
        if($valid_year_order_number == $this::YEAR_INTERVAL && $month_now >= $this::START_MONTH)
        {
            $valid_year_order_number = 1;
            $year_no_is_advanced = true;
        }

        //same as with the one above except it is for years that are not the same with the last year of the previous ID series
        elseif($month_now >= $this::START_MONTH)
        {
            $valid_year_order_number += 1;
            $year_no_is_advanced = true;
        }

        return $check_year_no_if_advanced_to_next_year ? [$valid_year_order_number, $year_no_is_advanced] : $valid_year_order_number;
    }

    //this function returns a different set of months that is adjusted based on the start month in .env file
    /*public function getAdjustedMonth($specific_month = null)
    {
        $start_number = 1;
        $adjusted_months = [];

        if($this::START_MONTH != 1)
            $start_number = 12 - ($this::START_MONTH - 2);

        for($i = 1; $i <= 12; $i++)
        {
            $adjusted_months[$i] = $start_number;

            $start_number += 1;

            if($start_number == 13)
                $start_number = 1;
        }

        return $specific_month ? $adjusted_months[$specific_month] : $adjusted_months;
    }*/

    //if series now only is: null = return previous and current series, false = previous only, true = current only
    public function getPreviousOrPresentValidYears($series_now_only = null)
    {
        $year_now = Carbon::now()->year;
        $year_number = $this->getYearNumberInValidYear(true);

        $start_year_series_now = $year_now - ($year_number[1] ? $year_number[0] - 1 : $year_number[0]);
        $end_year_series_now = $start_year_series_now + $this::YEAR_INTERVAL;

        $start_year_series_previous = $start_year_series_now - $this::YEAR_INTERVAL;
        $end_year_series_previous = $start_year_series_now;

        if($series_now_only == true)
            return $start_year_series_now . '-' . $end_year_series_now;

        elseif($series_now_only === false)
            return $start_year_series_previous . '-' . $end_year_series_previous;

        return ['now' => $start_year_series_now . '-' . $end_year_series_now, 'previous' => $start_year_series_previous . '-' . $end_year_series_previous];
    }

    public function startMonthToName()
    {
    	switch ($this::START_MONTH) 
    	{
    		case 1:
    			return 'January';
    		case 2:
    			return 'February';
    		case 3:
    			return 'March';
    		case 4:
    			return 'April';
    		case 5:
    			return 'May';
    		case 6:
    			return 'June';
    		case 7:
    			return 'July';
    		case 8:
    			return 'August';
    		case 9:
    			return 'September';
    		case 10:
    			return 'October';
    		case 11:
    			return 'November';
    		case 12:
    			return 'December';
    	}
    }
}

?>