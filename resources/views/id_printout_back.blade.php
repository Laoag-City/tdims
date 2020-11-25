@extends('layouts.main')

@section('custom_css')
<style>
	@media print
	{    
	    nav.navbar, nav#driver_nav, #page_title, #print_button
	    {
	        display: none !important;
	    }

	    html.has-navbar-fixed-top, body
	    {
	    	padding: 0 !important;
	    }

	    #main_contents
	    {
	    	padding: 0 !important;
	    	margin: 0 !important;
	    	box-shadow: 0 0 0 !important;
	    }

	    #driver_id
	    {
	    	margin: 0 !important;
	    }
	}

	#driver_id
	{
		width: 19.7cm; 
		height: 12.5cm; 
		border: .1mm solid #bfbfbf;
		margin: auto;
		font-family: sans-serif;
		line-height: normal;
	}

	.inline-field
	{
		float: left;
		word-break: break-all;
	}

	.upper-fields
	{
		margin-left: 4.5cm;
	}

	div[class$="fields"]
	{
		overflow: auto;
	}

	.upper-fields>div:first-child
	{
		width: 7.5cm;
	}

	.upper-fields>div:last-child
	{
		margin-left: 4.8cm;
		width: 2cm;
	}
</style>
@endsection

@section('content')

@include('layouts.specific_driver_nav')

<div id="print_button">
	<a class="button is-fullwidth is-success" onclick="print()">Print ID</a>
	<br>
</div>

<div id="driver_id">
	<div class="upper-fields" style="margin-top: 1.9cm;">
		<div class="inline-field">
			{{ $driver->formattedIDNo(false) }}
		</div>

		<div class="inline-field">
			{{ $driver->getGender() }} / {{ $driver->blood_type }}
		</div>
	</div>

	<div class="upper-fields" style="margin-top: .2cm;">
		<div class="inline-field" {!! strlen($driver->address) > 35 ? 'style="font-size: 10pt;"' : '' !!}>
			{{ $driver->address }}
		</div>

		<div class="inline-field" style="margin-top: .32cm;">
			{{ $driver->height }}
		</div>
	</div>

	<div class="upper-fields" style="margin-top: .4cm;">
		<div class="inline-field">
			{{ friendlyDate($driver->date_of_birth) }}
		</div>

		<div class="inline-field">
			{{ $driver->weight }} kgs
		</div>
	</div>

	<div class="upper-fields" style="margin-top: .4cm;">
		<div class="inline-field">
			{{ $driver->place_of_birth }}
		</div>

		<div class="inline-field">
			{{ $driver->civil_status }}
		</div>
	</div>
<!----------------------------------------------------------------------->
	<div style="margin-left: 7.5cm; margin-top: .6cm;">
		{{ $driver->emergency_name }}
	</div>

	@if(!($driver->emergency_address == null && $driver->emergency_no == null))
		<div style="margin-left: 7.5cm; margin-top: .2cm;">
			{{ $driver->emergency_no }}{{ $driver->emergency_address && $driver->emergency_no ? ' / ' : '' }}{{ $driver->emergency_address }}
		</div>
	@else
		<div style="margin-left: 7.5cm; margin-top: .2cm; height: 18px;">
		</div>
	@endif

	<div class="fields" style="margin-left: 3.5cm; margin-top: 1cm;">
		<div class="inline-field" style="width: 3cm; visibility: hidden;">
			&nbsp;
		</div>

		<div class="inline-field" style="margin-left: 2.8cm; width: 3cm;">
			{{ $driver->or_no }}
		</div>

		<div class="inline-field" style="margin-left: 4cm; width: 3cm;">
			{{ friendlyDate($driver->date_issued) }}
		</div>
	</div>

	<div style="margin-top: 2.3cm; margin-left: .8cm;">
		<div style="width: 8.5cm; margin-right: 1cm; text-align: center; display: inline-block;">
			{{ $verified_name }}
			<br>
			{{ $verified_position }}
		</div>

		<div style="width: 8.5cm; text-align: center; display: inline-block;">
			{{ $attested_name }}
			<br>
			{{ $attested_position }}
		</div>
	</div>
</div>
@endsection

@section('custom_js')
	<script src="{{ mix('js/font_awesome_icons.js') }}"></script>
@endsection