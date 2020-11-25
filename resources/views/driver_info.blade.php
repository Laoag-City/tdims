@extends('layouts.main')

@section('custom_css')
<style>
	hr
	{
		border-top: 1px solid grey;
	}
</style>
@endsection

@section('content')
<br>

@include('layouts.specific_driver_nav')

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>Driver:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->getWholeName() }}</h5>
	</div>
</div>

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>ID No:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->formattedIDNo() }}</h5>
	</div>

	<div class="column is-1 has-text-right">
		<i>Type:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->getDriverType() }}</h5>
	</div>
</div>

<hr>

<div class="columns">
	<!--<div class="column is-1 has-text-right">
		<i>Sidecar:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{-- $driver->sidecar_no --}}</h5>
	</div>-->

	<div class="column is-1 has-text-right">
		<i>Address:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->address }}</h5>
	</div>

	<div class="column is-1 has-text-right">
		<i>Sex:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->getGender() }}</h5>
	</div>
</div>

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>Blood Type:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->blood_type }}</h5>
	</div>

	<div class="column is-1 has-text-right">
		<i>Height:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->height }}</h5>
	</div>
</div>

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>Weight:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->weight }} kgs.</h5>
	</div>

	<div class="column is-1 has-text-right">
		<i>Birthday:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ friendlyDate($driver->date_of_birth) }}</h5>
	</div>
</div>

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>Birthplace:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->place_of_birth }}</h5>
	</div>

	<div class="column is-1 has-text-right">
		<i>Civil Status:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->civil_status }}</h5>
	</div>
</div>

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>Control No:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->getIDControlNos() }}</h5>
	</div>

	<div class="column is-1 has-text-right">
		<!--<i>Date Issued:</i>-->
	</div>

	<div class="column is-5 has-text-centered">
		<!--<h5 class="title is-5">{{-- friendlyDate($driver->date_issued) --}}</h5>-->
	</div>
</div>

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>Emergency Name:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->emergency_name }}</h5>
	</div>

	<div class="column is-1 has-text-right">
		<i>Emergency Address:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->emergency_address }}</h5>
	</div>
</div>

<hr>

<div class="columns">
	<div class="column is-1 has-text-right">
		<i>Emergency No:</i>
	</div>

	<div class="column is-5 has-text-centered">
		<h5 class="title is-5">{{ $driver->emergency_no }}</h5>
	</div>

	<div class="column is-1 has-text-right">
		<!--<i>OR No:</i>-->
	</div>

	<div class="column is-5 has-text-centered">
		<!--<h5 class="title is-5">{{-- $driver->or_no --}}</h5>-->
	</div>
</div>

<hr>

@endsection