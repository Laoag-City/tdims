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
		width: 8.5in; 
		height: 11in; 
		border: .1mm solid #bfbfbf;
		padding-top: 0px;
		margin: auto;
		font-family: sans-serif;
		position: relative;
		color: black;
	}

	#background{
		position: absolute;
		width: 8.48in;
		height: 10.98in;
	}

	#picture
	{
		width: 5.08cm;
		height: 5.08cm;
	}

	#picture_container
	{
		left: 93.5px;
		top: 184.5px;
		position: absolute;
	}

	#main_info_container
	{
		position: absolute;
		left: 385px;
		top: 280px;
	}

	#back_first
	{
		position: absolute;
		right: 50px;
		top: 585px;
	}

	#back_second
	{
		position: absolute;
		right: 50px;
		top: 658px;
	}

	#back_third
	{
		position: absolute;
		right: 65px;
		top: 780px;
	}

	#back_fourth
	{
		position: absolute;
		right: 150px;
		top: 860px;
	}

	#back_five
	{
		position: absolute;
		right: 45px;
		top: 940px;
	}

	.main_info
	{
		width: 11cm;
		text-align: center;
	}

	.back_text
	{
		display: inline-block;
		font-size: 14pt;
		transform: scale(-1, -1);
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
	<img src="/img/id.png" id="background">

	<div id="picture_container">
		@if($driver->picture_path != null)
			<img id="picture" src="{{ url('pictures/'. $driver->driver_id) }}">

		@else
			<div id="picture" style="margin-bottom: 28px;"></div>
		@endif

		<div style="margin-left: 1.75cm; margin-top: 0.55cm;">
			<b style="font-size: 15pt;">{{ $driver->formattedIDNo() }}</b>
		</div>
	</div>

	<div id="main_info_container">
		<div class="main_info">
			<span style="font-size: {{ strlen($driver->getWholeName()) > 30 ? '11pt' : '16pt' }}">{{ $driver->getWholeName() }}</span>
		</div>

		<div class="main_info" style="margin-top: 1.5cm;">
			<span style="font-size: {{ strlen($driver->address) > 30 ? '11pt' : '16pt' }}">{{ $driver->address }}</span>
		</div>
	</div>

	<div id="back_first">
		<b class="back_text has-text-centered">
			{{ $driver->emergency_no }}
		</b>
	</div>

	<div id="back_second">
		<b class="back_text has-text-centered">
			{{ $driver->emergency_name }}
		</b>
	</div>

	<div id="back_third">
		<b class="back_text">
			{{ $driver->weight }} kgs
		</b>

		<b class="back_text" style="width: 40px; margin-left: 125px;">
			{{ $driver->height }}
		</b>

		<b class="back_text has-text-centered" style="width: 100px; margin-left: 90px;">
			{{ $driver->civil_status }}
		</b>

		<b class="back_text" style="width: 28px; margin-left: 60px;">
			{{ $driver->blood_type }}
		</b>	

		<b class="back_text has-text-centered" style="margin-left: 100px;">
			{{ $driver->getGender() }}
		</b>
	</div>

	<div id="back_fourth">
		<b class="back_text has-text-centered" style="width: 220px;">
			{{ friendlyDate($driver->date_of_birth, false) }}
		</b>

		<b class="back_text has-text-centered" style="width: 120px; margin-left: 215px;">
			{{ $driver->formattedIDNo(false) }}
		</b>
	</div>

	<div id="back_five">
		<b class="back_text has-text-centered" style="width: 720px;">
			{{ $driver->address }}
		</b>
	</div>
</div>
@endsection

@section('custom_js')
	<script src="{{ mix('js/font_awesome_icons.js') }}"></script>
@endsection