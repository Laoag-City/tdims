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
	<form method="POST" action="{{ url()->current() }}">
		@csrf

		@include('layouts.error_or_success_message')

		@if(session('success') != NULL)
			<a id="print_id_link" href="{{ url('drivers/' . session('success')['driver_id'] . '/id-printout') }}" class="button is-success is-outlined is-large is-fullwidth">
				PRINT TRICYCLE DRIVER ID
			</a>
			<br>
		@endif

		<div class="columns" style="margin-bottom: 0">
			<div class="column is-6">
				<div class="field is-horizontal">
					<div class="field-label is-normal">
						<label class="label">Valid Year</label>
					</div>

					<div class="field-body">
						<div class="field">
							<div class="control">
								<input type="text" class="input" name="" value="{{ $valid_years }}" readonly="" style="width: 40%;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<h5 class="title is-5">Tricycle Driver's Name</h5>

		<div class="columns">
			<div class="column is-4">
				<div class="field">
					<label class="label">First Name</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('driver_first_name') ?: 'is-danger' }}" name="driver_first_name" value="{{ old('driver_first_name') }}" maxlength="40">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Middle Initial</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('driver_middle_initial') ?: 'is-danger' }}" name="driver_middle_initial" value="{{ old('driver_middle_initial') }}" maxlength="1">
					</div>
				</div>
			</div>

			<div class="column is-4">
				<div class="field">
					<label class="label">Last Name</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('driver_last_name') ?: 'is-danger' }}" name="driver_last_name" value="{{ old('driver_last_name') }}" maxlength="30">
					</div>
				</div>
			</div>

			@php
				$old_driver_suffix = old('driver_suffix_name');
			@endphp

			<div class="column is-2">
				<div class="field">
					<label class="label">Suffix</label>
					<div class="control is-expanded">
						<div class="select is-fullwidth {{ !$errors->has('driver_suffix_name') ?: 'is-danger' }}">
							<select name="driver_suffix_name">
								<option></option>
								<option value="Jr." {{ $old_driver_suffix != 'Jr.' ?: 'selected' }}>Jr.</option>
								<option value="Sr." {{ $old_driver_suffix != 'Sr.' ?: 'selected' }}>Sr.</option>
								<option value="I" {{ $old_driver_suffix != 'I' ?: 'selected' }}>I</option>
								<option value="II" {{ $old_driver_suffix != 'II' ?: 'selected' }}>II</option>
								<option value="III" {{ $old_driver_suffix != 'III' ?: 'selected' }}>III</option>
								<option value="IV" {{ $old_driver_suffix != 'IV' ?: 'selected' }}>IV</option>
								<option value="V" {{ $old_driver_suffix != 'V' ?: 'selected' }}>V</option>
								<option value="VI" {{ $old_driver_suffix != 'VI' ?: 'selected' }}>VI</option>
								<option value="VII" {{ $old_driver_suffix != 'VII' ?: 'selected' }}>VII</option>
								<option value="VIII" {{ $old_driver_suffix != 'VIII' ?: 'selected' }}>VIII</option>
								<option value="IX" {{ $old_driver_suffix != 'IX' ?: 'selected' }}>IX</option>
								<option value="X" {{ $old_driver_suffix != 'X' ?: 'selected' }}>X</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>

		<div class="columns">
			<div class="column is-2">
				<div class="field">
					<label class="label">Driver Type</label>
					<div class="control">
						<label class="radio">
							<input type="radio" name="driver_type" value="0" {{ old('driver_type') != '0' ?: 'checked' }}>
							Barangay
						</label>

						<label class="radio">
							<input type="radio" name="driver_type" value="1" {{ old('driver_type') != '1' ?: 'checked' }}>
							City
						</label>
					</div>
				</div>
			</div>

			<div class="column is-3">
				<div class="field">
					<label class="label">ID No.</label>

					<div class="field has-addons">
						<div class="control">
							<button type="button" id="get_id_button" class="button is-info">Get ID</button>
						</div>

						<div class="control">
							<input type="text" class="input {{ !$errors->has('id_no') ?: 'is-danger' }}" name="id_no" value="{{ old('id_no') }}" readonly="">
						</div>
					</div>
				</div>
			</div>

			<!--<div class="column is-2">
				<div class="field">
					<label class="label">Sidecar No.</label>
					<div class="control">
						<input type="text" class="input {{-- !$errors->has('sidecar_no') ?: 'is-danger' --}}" name="sidecar_no" value="{{-- old('sidecar_no') --}}" maxlength="8">
					</div>
				</div>
			</div>-->

			<div class="column is-7">
				<div class="field">
					<label class="label">Address</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('address') ?: 'is-danger' }}" name="address" value="{{ old('address') }}" maxlength="80">
					</div>
				</div>
			</div>
		</div>
		
		<br>

		<div class="columns">
			<div class="column is-2">
				<div class="field">
					<label class="label">Sex</label>
					<div class="control is-expanded">
						<div class="select is-fullwidth {{ !$errors->has('sex') ?: 'is-danger' }}">
							<select name="sex">
								<option value="1" {{ old('sex') != '1' ?: 'selected'}}>Male</option>
								<option value="0" {{ old('sex') != '0' ?: 'selected'}}>Female</option>
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
								<option value="A" {{ $old_blood_type != 'A' ?: 'selected' }}>A</option>
								<option value="B" {{ $old_blood_type != 'B' ?: 'selected' }}>B</option>
								<option value="AB" {{ $old_blood_type != 'AB' ?: 'selected' }}>AB</option>
								<option value="O" {{ $old_blood_type != 'O' ?: 'selected' }}>O</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Height</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('height_feet') ?: 'is-danger' }}" name="height_feet" value="{{ old('height_feet') }}" placeholder="ft." min="3" max="7">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label" style="visibility: hidden;">a</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('height_inch') ?: 'is-danger' }}" name="height_inch" value="{{ old('height_inch') }}" placeholder="in." min="0" max="11">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Weight</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('weight') ?: 'is-danger' }}" name="weight" value="{{ old('weight') }}" min="1" max="150" placeholder="kgs">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Birthday</label>
					<div class="control">
						<input type="date" class="input {{ !$errors->has('birthday') ?: 'is-danger' }}" name="birthday" value="{{ old('birthday') }}">
					</div>
				</div>
			</div>
		</div>
		
		<br>

		<div class="columns">
			<div class="column is-5">
				<div class="field">
					<label class="label">Birthplace</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('birthplace') ?: 'is-danger' }}" name="birthplace" value="{{ old('birthplace') }}" maxlength="40">
					</div>
				</div>
			</div>

			@php
				$old_civil_status = old('civil_status');
			@endphp

			<div class="column is-2">
				<div class="field">
					<label class="label">Civil Status</label>
					<div class="control is-expanded">
						<div class="select is-fullwidth {{ !$errors->has('civil_status') ?: 'is-danger' }}">
							<select name="civil_status">
								<option value="Single" {{ $old_civil_status != 'Single' ?: 'selected' }}>Single</option>
								<option value="Married" {{ $old_civil_status != 'Married' ?: 'selected' }}>Married</option>
								<option value="Divorced" {{ $old_civil_status != 'Divorced' ?: 'selected' }}>Divorced</option>
								<option value="Separated" {{ $old_civil_status != 'Separated' ?: 'selected' }}>Separated</option>
								<option value="Widowed" {{ $old_civil_status != 'Widowed' ?: 'selected' }}>Widowed</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="column is-3">
				<!--<div class="field">
					<label class="label">OR No.</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('or_no') ?: 'is-danger' }}" name="or_no" value="{{ old('or_no') }}" maxlength="9">
					</div>
				</div>-->
			</div>

			<div class="column is-2">
				<!--<div class="field">
					<label class="label">Date Issued</label>
					<div class="control">
						<input type="date" class="input {{ !$errors->has('date_issued') ?: 'is-danger' }}" name="date_issued" value="{{ old('date_issued') }}">
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
						<input type="text" class="input {{ !$errors->has('emergency_contact_name') ?: 'is-danger' }}" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" maxlength="80">
					</div>
				</div>
			</div>

			<div class="column is-5">
				<div class="field">
					<label class="label">Address</label>
					<div class="control">
						<input type="text" class="input {{ !$errors->has('emergency_address') ?: 'is-danger' }}" name="emergency_address" value="{{ old('emergency_address') }}" maxlength="80">
					</div>
				</div>
			</div>

			<div class="column is-2">
				<div class="field">
					<label class="label">Contact No.</label>
					<div class="control">
						<input type="number" class="input {{ !$errors->has('emergency_contact_no') ?: 'is-danger' }}" name="emergency_contact_no" value="{{ old('emergency_contact_no') }}" maxlength="13">
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
					<input type="submit" class="input button is-primary" value="Add Tricycle Driver">
				</div>
			</div>
		</div>
	</form>
@endsection

@section('custom_js')
	<script src="{{ url('webcamjs/webcam.min.js') }}"></script>
	<script src="{{ mix('js/add_tricycle_driver.js') }}"></script>
@endsection