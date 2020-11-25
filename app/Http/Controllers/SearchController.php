<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->driver_type != "0" && $request->driver_type != "1")
            return back();

        if(preg_match("/\d/", $request->keyword))
        	$cols = [
        		'id_no' => 1,
        		//'sidecar_no' => 1,
        	];

        else
            $cols = [
                'driver_first_name' => 2,
                'driver_middle_initial' => 1,
                'driver_last_name' => 2,
                'driver_suffix_name' => 1,
            ];

        $driver_type = $request->driver_type ? 'City Driver' : 'Brgy Driver';

    	$results = Driver::search($request->keyword, $cols)
                            ->where('is_city_driver', $request->driver_type)
                            ->orderBy('created_at', 'desc')
                            ->paginate(100);

    	return view('search', [
            'title' => 'Search Results',
            'subtitle' => "Results for \"{$request->keyword}\" as $driver_type.",
            'drivers' => $results
        ]);
    }
}
