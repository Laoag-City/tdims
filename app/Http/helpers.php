<?php
	function selected_option($old_data, $options, $existing_data = null)
	{
		
		if($old_data == null && $existing_data == null)
			return;

		$data_to_use = $old_data != null ? $old_data : $existing_data;

		foreach($options as $option)
		{
			if($option == $data_to_use)
				return $option;
		}
	}

	function friendlyDate($date, $short_month = true)
    {
    	if($short_month)
    		$format = 'm-d-Y';
    	else
    		$format = 'F d, Y';

        return date($format, strtotime($date));
    }
?>