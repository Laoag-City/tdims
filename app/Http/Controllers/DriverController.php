<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Driver;
use App\ValidYear;
use App\OperationLog;
use Carbon\Carbon;

class DriverController extends Controller
{
	protected $request;
    protected const NAME_SUFFIXES = [
            ['value' => 'Jr.'],
            ['value' => 'Sr.'],
            ['value' => 'I'],
            ['value' => 'II'],
            ['value' => 'III'],
            ['value' => 'IV'],
            ['value' => 'V'],
            ['value' => 'VI'],
            ['value' => 'VII'],
            ['value' => 'VIII'],
            ['value' => 'IX'],
            ['value' => 'X'],
        ];

    public function __construct(Request $request)
    {
    	$this->request = $request;
    }

    public function showAddDriverForm()
    {
    	if($this->request->isMethod('get'))
        {
            return view('add', [
                'title' => 'Add Tricycle Driver',
                'valid_years' => resolve('ValidYearParser')->getPreviousOrPresentValidYears(true),
                'verified_name' => $this->getVerifiedAttestedNames(0),
                'verified_position' => $this->getVerifiedAttestedNames(1),
                'attested_name' => $this->getVerifiedAttestedNames(3),
                'attested_position' => $this->getVerifiedAttestedNames(4)
            ]);
        }

        elseif($this->request->isMethod('post'))
        {
            /*
                $Validator = Validator::make($this->request->all(), [
                    'driver_first_name' => 'bail|required|name_alpha_hyphen_space|max:40',
                    'driver_middle_initial' => 'nullable|bail|alpha|max:1',
                    'driver_last_name' => 'bail|required|name_alpha_hyphen_space|max:30',
                    'driver_suffix_name' => 'nullable|in:' . implode(',', collect($this::NAME_SUFFIXES)->flatten()->toArray()),

                    'operator_first_name' => 'bail|required|name_alpha_hyphen_space|max:40',
                    'operator_middle_initial' => 'nullable|bail|alpha|max:1',
                    'operator_last_name' => 'bail|required|name_alpha_hyphen_space|max:30',
                    'operator_suffix_name' => 'nullable|in:' . implode(',', collect($this::NAME_SUFFIXES)->flatten()->toArray()),

                    'driver_type' => 'bail|required|in:0,1',
                    'id_no' => 'bail|required|integer',
                    'sidecar_no' => 'bail|required|unique:drivers,sidecar_no|max:8',
                    'address' => 'bail|required|max:80',
                    'sex' => 'bail|required|in:0,1',
                    'blood_type' => 'bail|required|in:A,B,AB,O',
                    'height_feet' => 'bail|required|integer|min:3|max:7',
                    'height_inch' => 'bail|required|integer|min:0|max:11',
                    'weight' => 'bail|required|integer|min:1|max:150',
                    'birthday' => 'bail|required|date|before:today',
                    'birthplace' => 'bail|required|name_alpha_space|max:40',
                    'civil_status' => 'bail|required|in:Single,Married,Divorced,Separated,Widowed',
                    'or_no' => 'bail|required|integer|unique:drivers,or_no|max:9999999',
                    'date_issued' => 'bail|required|date|before_or_equal:today',
                    'emergency_contact_name' => 'bail|required|complete_name|max:80',
                    'emergency_address' => 'nullable|bail|max:80',
                    'emergency_contact_no' => 'nullable|bail||max:13'
                ])->validate();

                $valid_year = ValidYear::firstOrCreate(['years' => resolve('ValidYearParser')->getPreviousOrPresentValidYears(true)]);

                $driver = new Driver;

                $driver->valid_year_id = $valid_year->valid_year_id;
                $driver->driver_first_name = $this->request->driver_first_name;
                $driver->driver_middle_initial = title_case($this->request->driver_middle_initial);
                $driver->driver_last_name = $this->request->driver_last_name;
                $driver->driver_suffix_name = $this->request->driver_suffix_name;
                $driver->operator_first_name = $this->request->operator_first_name;
                $driver->operator_middle_initial = title_case($this->request->operator_middle_initial);
                $driver->operator_last_name = $this->request->operator_last_name;
                $driver->operator_suffix_name = $this->request->operator_suffix_name;
                $driver->id_no = $this->getLatestIdNo();
                $driver->is_city_driver = $this->request->driver_type;
                $driver->sidecar_no = $this->request->sidecar_no;
                $driver->address = $this->request->address;
                $driver->sex = $this->request->sex;
                $driver->blood_type = $this->request->blood_type;
                $driver->height = $this->request->height_feet . "'" . $this->request->height_inch . '"';
                $driver->weight = $this->request->weight;
                $driver->date_of_birth = $this->request->birthday;
                $driver->place_of_birth = $this->request->birthplace;
                $driver->civil_status = $this->request->civil_status;
                $driver->emergency_name = $this->request->emergency_contact_name;
                $driver->emergency_address = $this->request->emergency_address;
                $driver->emergency_no = $this->request->emergency_contact_no;
                $driver->id_control_no = $driver->id_no;
                $driver->date_issued = $this->request->date_issued;
                $driver->or_no = $this->request->or_no;

                $driver->save();

                return back()->with('success', ['header' => 'Tricycle Driver added successfully.']);
            */

            $driver = $this->addEditLogic(true);

            return back()->with('success', ['header' => 'Tricycle Driver added successfully.', 'driver_id' => $driver->driver_id]);
        }

        else
            return response(null, 405);
    }

    public function getLatestIdNo()
    {
        Validator::make($this->request->all(), [
            'driver_type' => 'bail|required|in:0,1'
        ])->validate();

        $valid_year_now = ValidYear::where('years', resolve('ValidYearParser')->getPreviousOrPresentValidYears(true))->first();

        if($valid_year_now)
        {
            $latest_id_no = Driver::select('id_no')
                    ->where([
                        ['is_city_driver', '=', $this->request->driver_type],
                        ['valid_year_id', '=', $valid_year_now->valid_year_id]
                    ])
                    ->orderBy('created_at', 'desc')
                    ->first();

            if($latest_id_no)
            {
                return $latest_id_no->id_no + 1;
            }

            else
                return 1;
        }

        else
            return 1;
    }

    public function getCityOrBrgyDrivers()
    {
        if($this->request->route()->uri == 'drivers/city')
        {
            $is_city_driver = true;
            $title = "City Driver's List";
        }

        else
        {
            $is_city_driver = false;
            $title = "Barangay Driver's List";
        }

        Validator::make($this->request->all(), [
            'valid_year' => 'nullable|bail|exists:valid_years,years',
        ])->validate();

        $years = ValidYear::where('years', $this->request->valid_year)->first();
        $drivers = Driver::where('is_city_driver', $is_city_driver);

        if($years)
        {
            $drivers = $drivers->where('valid_year_id', $years->valid_year_id);
            $title .= ": {$years->years}";
        }

        $drivers = $drivers->with('valid_year')->orderBy('created_at', 'desc')->paginate(150);

        return view('list_drivers', [
            'title' => $title,
            'drivers' => $drivers,
            'years' => ValidYear::select('years')->get()
        ]);
    }

    public function showDriverInformation(Driver $driver)
    {
        return view('driver_info', [
            'title' => "Tricycle Driver's Information",
            'driver' => $driver
        ]);
    }

    public function showEditDriverForm(Driver $driver)
    {
        return view('edit', [
            'title' => 'Change Tricycle Driver Info',
            'valid_years' => $driver->valid_year->years,
            'driver' => $driver,
            'verified_name' => $this->getVerifiedAttestedNames(0),
            'verified_position' => $this->getVerifiedAttestedNames(1),
            'attested_name' => $this->getVerifiedAttestedNames(3),
            'attested_position' => $this->getVerifiedAttestedNames(4)
        ]);
    }

    public function editDriverInformation(Driver $driver)
    {
        $this->addEditLogic($driver);

        return back()->with('success', ['header' => 'Tricycle Driver\'s info has been changed successfully.']);
    }

    public function manageIDControlNo(Driver $driver)
    {
        if($this->request->isMethod('get'))
        {
            return view('manage_id_control_no', [
                'title' => 'Manage ID Control No.',
                'driver' => $driver,
                'id_control_no' => $driver->getIDControlNos(true)
            ]);
        }

        elseif($this->request->isMethod('patch'))
        {
            $current_ids = $driver->getIDControlNos(true);

            $validator = Validator::make($this->request->all(), [
                'id_control_no' => 'size:' . (count($current_ids) - 1),
                'id_control_no.*' => 'bail|required|integer|min:1|max:99999'
            ], [
                'id_control_no.size' => 'The number of the current ID Control Number(s) does not match with the one given.'
            ]);

            $validator->validate();

            $validator->after(function($validator) use($driver, $current_ids) {
                //check if other drivers who belong to the current driver's driver type already owns the id control number(s) submitted and exclude the driver being changed
                $existing = Driver::search('|' . implode('| |', $this->request->id_control_no) . '|', ['id_control_no' => 1])
                                    ->where([
                                        ['is_city_driver', '=', $driver->is_city_driver],
                                        ['driver_id', '!=', $driver->driver_id]
                                    ])
                                    ->get();

                if($existing->isNotEmpty())
                {
                    $validator->errors()->add('id_control_no', 'One of the ID Control Number(s) you supplied has already been taken.');
                    return;
                }

                $complete_request_control_no = $this->request->id_control_no;
                array_unshift($complete_request_control_no, $current_ids[0]);

                //check if submitted id control numbers have duplicate values
                if(count($complete_request_control_no) !== count(array_flip($complete_request_control_no)))
                    $validator->errors()->add('id_control_no', 'The ID Control Number(s) must be unique.');
            });

            $validator->validate();

            $driver->id_control_no = '|' . implode('|', array_merge([$current_ids[0]], $this->request->id_control_no)) . '|';
            $driver->save();

            $log = new OperationLog;
            $log->driver_id = $driver->driver_id;
            $log->operation_description = 'Updated ID Control No(s)';
            $log->save();

            return back()->with('success', ['header' => 'ID control number(s) managed successfully.']);
        }

        else
            return response(null, 405);
    }

    public function changeLostID(Driver $driver)
    {
        if($this->request->isMethod('get'))
        {
            return view('change_lost_id', [
                'title' => 'Change Lost ID',
                'driver' => $driver,
            ]);
        }

        elseif($this->request->isMethod('patch'))
        {
            $validator = Validator::make($this->request->all(), [
                'new_id_control_no' => 'bail|required|min:1|max:99999'
            ]);

            $validator->after(function($validator) use($driver) {
                $existing = Driver::search("|{$this->request->new_id_control_no}|", ['id_control_no' => 1])->where('is_city_driver', $driver->is_city_driver)->get();

                if($existing->isNotEmpty())
                    $validator->errors()->add('new_id_control_no', 'The ID Control Number you supplied is already been taken.');
            });

            $validator->validate();

            $driver->id_control_no .= "{$this->request->new_id_control_no}|";
            $driver->save();

            $log = new OperationLog;
            $log->driver_id = $driver->driver_id;
            $log->operation_description = 'Changed lost ID with new ID Control No: ' . $this->request->new_id_control_no;
            $log->save();

            return back()->with('success', ['header' => 'New ID control number assigned successfully.']);
        }

        else
            return response(null, 405);
    }

    public function showIdPrintout(Driver $driver)
    {
        return view('id_printout_front', [
            'title' => 'ID Printout',
            'driver' => $driver,
            'verified_name' => $this->getVerifiedAttestedNames(0),
            'verified_position' => $this->getVerifiedAttestedNames(1),
            'attested_name' => $this->getVerifiedAttestedNames(3),
            'attested_position' => $this->getVerifiedAttestedNames(4)
        ]);
    }

    public function showIdPrintoutBack(Driver $driver)
    {
        return view('id_printout_back', [
            'title' => 'ID Printout (Back)',
            'driver' => $driver,
            'verified_name' => $this->getVerifiedAttestedNames(0),
            'verified_position' => $this->getVerifiedAttestedNames(1),
            'attested_name' => $this->getVerifiedAttestedNames(3),
            'attested_position' => $this->getVerifiedAttestedNames(4)
        ]);
    }

    public function getPicture(Driver $driver)
    {
        return response()->file(storage_path('app/') . $driver->picture_path);
    }

    public function removeDriver(Driver $driver)
    {
        if($driver->picture_path != null)
            Storage::delete($driver->picture_path);

        $driver->delete();
        return back();
    }

    //$type can be true (for add operation) or an instance of Driver being edited (for edit operation)
    private function addEditLogic($type)
    {
        $rules = [
                'driver_first_name' => 'bail|required|name_alpha_hyphen_space|max:40',
                'driver_middle_initial' => 'nullable|bail|alpha|max:1',
                'driver_last_name' => 'bail|required|name_alpha_hyphen_space|max:30',
                'driver_suffix_name' => 'nullable|in:' . implode(',', collect($this::NAME_SUFFIXES)->flatten()->toArray()),

                'address' => 'bail|required|max:80',
                'sex' => 'bail|required|in:0,1',
                'blood_type' => 'bail|required|in:A,B,AB,O',
                'height_feet' => 'bail|required|integer|min:3|max:7',
                'height_inch' => 'bail|required|integer|min:0|max:11',
                'weight' => 'bail|required|integer|min:1|max:150',
                'birthday' => 'bail|required|date|before:today',
                'birthplace' => 'bail|required|name_alpha_comma_space|max:40',
                'civil_status' => 'bail|required|in:Single,Married,Divorced,Separated,Widowed',
                //'date_issued' => 'bail|required|date|before_or_equal:today',
                
                'emergency_contact_name' => 'bail|required|complete_name|max:80',
                'emergency_address' => 'nullable|bail|max:80',
                'emergency_contact_no' => 'nullable|bail||max:13',

                'id_photo' => 'nullable|string'
            ];

        if($type === true)
        {
            $rules['driver_type'] = 'bail|required|in:0,1';
            $rules['id_no'] = 'bail|required|integer';
            //$rules['sidecar_no'] = 'bail|required|unique:drivers,sidecar_no|max:8';
            //$rules['or_no'] = 'bail|required|integer|unique:drivers,or_no|max:9999999';
        }

        else
        {
            //$rules['sidecar_no'] = "bail|required|unique:drivers,sidecar_no,{$type->driver_id},driver_id|max:8";
            //$rules['or_no'] = "bail|required|integer|unique:drivers,or_no,{$type->driver_id},driver_id|max:9999999";
        }

        Validator::make($this->request->all(), $rules)->validate();

        if($this->request->id_photo != null)
        {
            $picture = base64_decode($this->request->id_photo);

            //https://stackoverflow.com/questions/6061505/detecting-image-type-from-base64-string-in-php
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $picture, FILEINFO_MIME_TYPE);

            if($mime_type == "image/jpeg")
                $extension = 'jpeg';
            else
                $extension = 'png';

            $random_name = '';

            for($i = 0; $i < 4; $i++)
                $random_name .= str_random(4);

            $picture_size = Storage::put(config('app.id_folder') . "/$random_name.$extension", $picture);
        }

        $log = new OperationLog;

        if($type === true)
        {
            $valid_year = ValidYear::firstOrCreate(['years' => resolve('ValidYearParser')->getPreviousOrPresentValidYears(true)]);
            $driver = new Driver;

            $driver->valid_year_id = $valid_year->valid_year_id;
            $driver->id_no = $this->getLatestIdNo();
            $driver->is_city_driver = $this->request->driver_type;
            $driver->id_control_no = "|{$driver->id_no}|";

            $log->operation_description = 'Added driver with ID series of ' . $valid_year->years;
        }

        else
        {
            $driver = $type;

            $log->operation_description = 'Edited driver';

            if($driver->picture_path != null && $this->request->id_photo != null)
                Storage::delete($driver->picture_path);
        }
        
        $driver->driver_first_name = $this->request->driver_first_name;
        $driver->driver_middle_initial = title_case($this->request->driver_middle_initial);
        $driver->driver_last_name = $this->request->driver_last_name;
        $driver->driver_suffix_name = $this->request->driver_suffix_name;
        $driver->address = $this->request->address;
        $driver->sex = $this->request->sex;
        $driver->blood_type = $this->request->blood_type;
        $driver->height = $this->request->height_feet . "'" . $this->request->height_inch . '"';
        $driver->weight = $this->request->weight;
        $driver->date_of_birth = $this->request->birthday;
        $driver->place_of_birth = $this->request->birthplace;
        $driver->civil_status = $this->request->civil_status;
        $driver->emergency_name = $this->request->emergency_contact_name;
        $driver->emergency_address = $this->request->emergency_address;
        $driver->emergency_no = $this->request->emergency_contact_no;
        //$driver->date_issued = $this->request->date_issued;
        //$driver->or_no = $this->request->or_no;

        if($type === true)
            $driver->picture_path = isset($picture_size) ? config('app.id_folder') . "/$random_name.$extension" : null ;
        else
        {
            if(isset($picture_size))
                $driver->picture_path = config('app.id_folder') . "/$random_name.$extension";
        }

        $driver->save();

        $log->driver_id = $driver->driver_id;
        $log->save();

        return $driver;
    }

    private function getVerifiedAttestedNames($index)
    {
        return str_replace(array("\r", "\n"), '', file(base_path('verified_attested.txt'))[$index]);
    }
}