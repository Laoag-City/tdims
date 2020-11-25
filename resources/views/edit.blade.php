@extends('layouts.main')

@section('custom_css')
<style>
	#camera
	{
		margin: auto; 
		border: 1px solid grey;
	}

	#take_photo, #change_photo
	{
		display: none;
	}
</style>
@endsection

@section('content')

	@include('layouts.specific_driver_nav')

	<br>

	<form method="POST" action="{{ url('drivers/' . $driver->driver_id) }}">
		@csrf
		@method('PUT')

		@include('layouts.error_or_success_message')

		<?php
			$driver_first_name = old('driver_first_name') != null ? old('driver_first_name') : $driver->driver_first_name;
			$driver_middle_initial = old('driver_middle_initial') != null ? old('driver_middle_initial') : $driver->driver_middle_initial;
			$driver_last_name = old('driver_last_name') != null ? old('driver_last_name') : $driver->driver_last_name;
			$driver_suffix_name = old('driver_suffix_name') != null ? old('driver_suffix_name') : $driver->driver_suffix_name;
			//$sidecar_no = old('sidecar_no') != null ? old('sidecar_no') : $driver->sidecar_no;
			$address = old('address') != null ? old('address') : $driver->address;
			$sex = old('sex') != null ? old('sex') : $driver->sex;
			$blood_type = old('blood_type') != null ? old('blood_type') : $driver->blood_type;
			$height_feet = old('height_feet') != null ? old('height_feet') : $driver->getHeightUnit(true);
			$height_inch = old('height_inch') != null ? old('height_inch') : $driver->getHeightUnit(false);
			$weight = old('weight') != null ? old('weight') : $driver->weight;
			$birthday = old('birthday') != null ? old('birthday') : $driver->date_of_birth;
			$birthplace = old('birthplace') != null ? old('birthplace') : $driver->place_of_birth;
			$civil_status = old('civil_status') != null ? old('civil_status') : $driver->civil_status;
			//$or_no = old('or_no') != null ? old('or_no') : $driver->or_no;
			//$date_issued = old('date_issued') != null ? old('date_issued') : $driver->date_issued;
			$emergency_contact_name = old('emergency_contact_name') != null ? old('emergency_contact_name') : $driver->emergency_name;
			$emergency_address = old('emergency_address') != null ? old('emergency_address') : $driver->emergency_address;
			$emergency_contact_no = old('emergency_contact_no') != null ? old('emergency_contact_no') : $driver->emergency_no;
		?>

		<div class="columns" style="margin-bottom: 0">
			<div class="column is-2 is-offset-3">
				<div class="field">
					<label class="label">Valid Year</label>
					<div class="control">
						<input type="text" class="input" name="" value="{{ $valid_years }}" readonly="">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">ID No</label>
					<div class="control">
						<input type="text" class="input" name="" value="{{ $driver->id_no }}" readonly="">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Type</label>
					<div class="control">
						<input type="text" class="input" name="" value="{{ $driver->getDriverType() }}" readonly="">
					</div>
				</div>
			</div>
		</div>

		<br>

		<h5 class="title is-5">Tricycle Driver's Name</h5>

		<div class="columns">
			<div class="column is-4">
				<div class="field">
					<label class="label">First Name</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('driver_first_name') ?: 'is-danger' }}" name="driver_first_name" value="{{ $driver_first_name }}" maxlength="40">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Middle Initial</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('driver_middle_initial') ?: 'is-danger' }}" name="driver_middle_initial" value="{{ $driver_middle_initial }}" maxlength="1">
					</div>
				</div>
			</div>

			<div class="column is-4">
				<div class="field">
					<label class="label">Last Name</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('driver_last_name') ?: 'is-danger' }}" name="driver_last_name" value="{{ $driver_last_name }}" maxlength="30">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Suffix</label>
					<div class="control is-expanded">
						<div class="select is-fullwidth {{ !$errors->has('driver_suffix_name') ?: 'is-danger' }}">
							<select name="driver_suffix_name">
								<option></option>
								<option value="Jr." {{ $driver_suffix_name != 'Jr.' ?: 'selected' }}>Jr.</option>
								<option value="Sr." {{ $driver_suffix_name != 'Sr.' ?: 'selected' }}>Sr.</option>
								<option value="I" {{ $driver_suffix_name != 'I' ?: 'selected' }}>I</option>
								<option value="II" {{ $driver_suffix_name != 'II' ?: 'selected' }}>II</option>
								<option value="III" {{ $driver_suffix_name != 'III' ?: 'selected' }}>III</option>
								<option value="IV" {{ $driver_suffix_name != 'IV' ?: 'selected' }}>IV</option>
								<option value="V" {{ $driver_suffix_name != 'V' ?: 'selected' }}>V</option>
								<option value="VI" {{ $driver_suffix_name != 'VI' ?: 'selected' }}>VI</option>
								<option value="VII" {{ $driver_suffix_name != 'VII' ?: 'selected' }}>VII</option>
								<option value="VIII" {{ $driver_suffix_name != 'VIII' ?: 'selected' }}>VIII</option>
								<option value="IX" {{ $driver_suffix_name != 'IX' ?: 'selected' }}>IX</option>
								<option value="X" {{ $driver_suffix_name != 'X' ?: 'selected' }}>X</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<br>

		<div class="columns">
			<!--<div class="column is-2">
				<div class="field">
					<label class="label">Sidecar No.</label>
					<div class="control">
						<input type="text" class="input {{-- !$errors->has('sidecar_no') ?: 'is-danger' --}}" name="sidecar_no" value="{{-- $sidecar_no --}}" maxlength="8">
					</div>
				</div>
			</div>-->

			<div class="column is-6 is-offset-1">
				<div class="field">
					<label class="label">Address</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('address') ?: 'is-danger' }}" name="address" value="{{ $address }}" maxlength="80">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Sex</label>
					<div class="control is-expanded">
						<div class="select is-fullwidth {{ !$errors->has('sex') ?: 'is-danger' }}">
							<select name="sex">
								<option value="1" {{ $sex != '1' ?: 'selected'}}>Male</option>
								<option value="0" {{ $sex != '0' ?: 'selected'}}>Female</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			@php
				$old_blood_type = old('blood_type');
			@endphp

			<div class="column is-2">
				<div class="field">
					<label class="label">Blood Type</label>
					<div class="control is-expanded">
						<div class="select is-fullwidth {{ !$errors->has('blood_type') ?: 'is-danger' }}">
							<select name="blood_type">
								<option value="A" {{ $blood_type != 'A' ?: 'selected' }}>A</option>
								<option value="B" {{ $blood_type != 'B' ?: 'selected' }}>B</option>
								<option value="AB" {{ $blood_type != 'AB' ?: 'selected' }}>AB</option>
								<option value="O" {{ $blood_type != 'O' ?: 'selected' }}>O</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<br>

		<div class="columns">
			<div class="column is-1">
				<div class="field">
					<label class="label">Height</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('height_feet') ?: 'is-danger' }}" name="height_feet" value="{{ $height_feet }}" placeholder="ft." min="3" max="7">
					</div>
				</div>
			</div>

			<div class="column is-1">
				<div class="field">
					<label class="label" style="visibility: hidden;">a</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('height_inch') ?: 'is-danger' }}" name="height_inch" value="{{ $height_inch }}" placeholder="in." min="0" max="11">
					</div>
				</div>
			</div>

			<div class="column is-1">
				<div class="field">
					<label class="label">Weight</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('weight') ?: 'is-danger' }}" name="weight" value="{{ $weight }}" min="1" max="150" placeholder="kgs">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Birthday</label>
					<div class="control">
						<input type="date" class="input {{ !$errors->has('birthday') ?: 'is-danger' }}" name="birthday" value="{{ $birthday }}">
					</div>
				</div>
			</div>

			<div class="column is-5">
				<div class="field">
					<label class="label">Birthplace</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('birthplace') ?: 'is-danger' }}" name="birthplace" value="{{ $birthplace }}" maxlength="40">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Civil Status</label>
					<div class="control is-expanded">
						<div class="select is-fullwidth {{ !$errors->has('civil_status') ?: 'is-danger' }}">
							<select name="civil_status">
								<option value="Single" {{ $civil_status != 'Single' ?: 'selected' }}>Single</option>
								<option value="Married" {{ $civil_status != 'Married' ?: 'selected' }}>Married</option>
								<option value="Divorced" {{ $civil_status != 'Divorced' ?: 'selected' }}>Divorced</option>
								<option value="Separated" {{ $civil_status != 'Separated' ?: 'selected' }}>Separated</option>
								<option value="Widowed" {{ $civil_status != 'Widowed' ?: 'selected' }}>Widowed</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<br>

		<div class="columns">
			<div class="column is-2 is-offset-4">
				<!--<div class="field">
					<label class="label">OR No.</label>
					<div class="control">
						<input type="text" class="input {{-- !$errors->has('or_no') ?: 'is-danger' --}}" name="or_no" value="{{-- $or_no }}" maxlength="9">
					</div>
				</div>-->
			</div>

			<div class="column is-2">
				<!--<div class="field">
					<label class="label">Date Issued</label>
					<div class="control">
						<input type="date" class="input {{-- !$errors->has('date_issued') ?: 'is-danger' --}}" name="date_issued" value="{{-- $date_issued --}}">
					</div>
				</div>-->
			</div>
		</div>
		
		<br>

		<h5 class="title is-5">Emergency Info</h5>

		<div class="columns">
			<div class="column is-5">
				<div class="field">
					<label class="label">Contact Name</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('emergency_contact_name') ?: 'is-danger' }}" name="emergency_contact_name" value="{{ $emergency_contact_name }}" maxlength="80">
					</div>
				</div>
			</div>

			<div class="column is-5">
				<div class="field">
					<label class="label">Address</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('emergency_address') ?: 'is-danger' }}" name="emergency_address" value="{{ $emergency_address }}" maxlength="80">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Contact No.</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('emergency_contact_no') ?: 'is-danger' }}" name="emergency_contact_no" value="{{ $emergency_contact_no }}" maxlength="13">
					</div>
				</div>
			</div>			
		</div>
		
		<br>

		<div class="columns">
			<div class="column is-6">
				<div class="field">
					<label class="label">Verified By</label>
					<div class="control">
						<input type="text" class="input" readonly="" value="{{ $verified_name }}">
					</div>
				</div>
			</div>

			<div class="column is-6">
				<div class="field">
					<label class="label">Attested By</label>
					<div class="control">
						<input type="text" class="input" readonly="" value="{{ $attested_name }}">
					</div>
				</div>
			</div>
		</div>

		<div class="columns">
			<div class="column is-6">
				<div class="field">
					<label class="label">Position</label>
					<div class="control">
						<input type="text" class="input" readonly="" value="{{ $verified_position }}">
					</div>
				</div>
			</div>

			<div class="column is-6">
				<div class="field">
					<label class="label">Position</label>
					<div class="control">
						<input type="text" class="input" readonly="" value="{{ $attested_position }}">
					</div>
				</div>
			</div>
		</div>

		<div class="columns">
			<div class="column is-one-third is-offset-one-third">
				<label class="label">ID Photo</label>
				<input type="hidden" name="id_photo">
				<div id="camera"></div>

				<br>
				<button id="take_photo" type="button" class="button is-success is-fullwidth is-outlined">Take Photo</button>
				<button id="change_photo" type="button" class="button is-error is-fullwidth is-outlined">Change Photo</button>
			</div>
		</div>

		<div class="column">
			<div class="field">
				<div class="control">
					<input type="submit" class="input button is-primary" value="Edit Tricycle Driver">
				</div>
			</div>
		</div>
	</form>
@endsection

@section('custom_js')
	<script src="{{ url('webcamjs/webcam.min.js') }}"></script>
	<script src="{{ mix('js/add_tricycle_driver.js') }}"></script>
@endsection