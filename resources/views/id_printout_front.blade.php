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
		width: 8.48in; 
		height: 11.15625in; 
		border: .1mm solid #bfbfbf;
		padding-top: 15px;
		margin: auto;
		font-family: sans-serif;
		position: relative;
		color: black;
	}

	#background{
		position: absolute;
		width: 8.47in;
		height: 10.98in;
	}

	#picture
	{
		width: 4.75cm;
		height: 5.1cm;
	}

	#picture_container
	{
		left: 27px;
		top: 134px;
		position: absolute;
	}

	#main_info_container
	{
		position: absolute;
		left: 235px;
		top: 206px;
	}

	#back_first
	{
		position: absolute;
		left: 140px;
		top: 622px;
	}

	#back_second
	{
		position: absolute;
		left: 190px;
		top: 663px;
	}

	#back_third
	{
		position: absolute;
		left: 205px;
		top: 703px;
	}

	#back_fourth
	{
		position: absolute;
		left: 100px;
		top: 745px;
	}

	#back_five
	{
		position: absolute;
		left: 305px;
		top: 782px;
	}

	#back_six
	{
		position: absolute;
		left: 190px;
		top: 810px;
	}

	#back_seven
	{
		position: absolute;
		left: 120px;
		top: 870px;
	}

	#back_eight
	{
		position: absolute;
		left: 120px;
		top: 945px;
	}

	.main_info
	{
		width: 14.7cm;
		text-align: center;
	}

	.back_text
	{
		display: inline-block;
		font-size: 18px;
	}

	.main_info>span
	{
		text-transform: uppercase;
		font-weight: bold;
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
	<img src="/img/id.jpg" id="background">

	<div id="picture_container">
		@if($driver->picture_path != null)
			<img id="picture" src="{{ url('pictures/'. $driver->driver_id) }}">

		@else
			<div id="picture" style="margin-bottom: 8px;"></div>
		@endif

		<div style="margin-left: 2.6cm;">
			<b style="font-size: 15pt;">{{ $driver->formattedIDNo() }}</b>
		</div>
	</div>

	<div id="main_info_container">
		<div class="main_info">
			<span style="font-size: {{ strlen($driver->getWholeName()) > 30 ? '12pt' : '17pt' }}">{{ $driver->getWholeName() }}</span>
		</div>

		<div class="main_info" style="margin-top: 1.5cm;">
			<span style="font-size: {{ strlen($driver->address) > 30 ? '12pt' : '17pt' }}">{{ $driver->address }}</span>
		</div>
	</div>

	<div id="back_first">
		<b class="back_text has-text-centered" style="width: 345px;">
			{{ $driver->address }}
		</b>

		<b class="back_text" style="margin-left: 212px;">
			{{ $driver->blood_type }}
		</b>
	</div>

	<div id="back_second">
		<b class="back_text has-text-centered" style="width: 290px;">
			{{ friendlyDate($driver->date_of_birth, false) }}
		</b>

		<b class="back_text" style="margin-left: 180px;">
			{{ $driver->height }}
		</b>
	</div>

	<div id="back_third">
		<b class="back_text has-text-centered" style="width: 280px;">
			{{ $driver->place_of_birth }}
		</b>

		<b class="back_text" style="margin-left: 165px;">
			{{ $driver->weight }} kgs
		</b>
	</div>

	<div id="back_fourth">
		<b class="back_text has-text-centered" style="width: 100px;">
			{{ $driver->getGender() }}
		</b>

		<b class="back_text" style="margin-left: 465px;">
			{{ $driver->civil_status }}
		</b>
	</div>

	<div id="back_five">
		<b class="back_text has-text-centered">
			{{ $driver->emergency_name }}
		</b>
	</div>

	<div id="back_six">
		<b class="back_text has-text-centered">
			{{ $driver->emergency_no }}
		</b>
	</div>

	<div id="back_seven">
		<b class="back_text has-text-centered" style="width: 145px;">
			{{ $driver->formattedIDNo(false) }}
		</b>

		<b class="back_text has-text-centered" style="margin-left: 90px; width: 150px;">
			{{-- $driver->or_no --}}
		</b>
		<b class="back_text has-text-centered" style="margin-left: 120px; width: 150px;">
			{{-- friendlyDate($driver->date_issued) --}}
		</b>
	</div>

	<div id="back_eight">
		<b class="back_text has-text-centered" style="width: 265px; font-size: 12pt; display: none;">
			{{ $verified_name }}
			<br>
			{{ $verified_position }}
		</b>

		<b class="back_text has-text-centered" style="margin-left: 50px; width: 260px; font-size: 12pt;">
			{{ $attested_name }}
			<br>
			{{ $attested_position }}
		</b>
	</div>
</div>
@endsection

@section('custom_js')
	<script src="{{ mix('js/font_awesome_icons.js') }}"></script>
@endsection