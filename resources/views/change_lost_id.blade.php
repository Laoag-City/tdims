@extends('layouts.main')

@section('content')

	@include('layouts.specific_driver_nav')

	<br>

	<form method="POST" action="{{ url()->current() }}">
		@csrf
		@method('PATCH')

		@include('layouts.error_or_success_message')

		<div class="columns">
			<div class="column is-4 is-offset-4">
				<div class="field">
					<label class="label">Driver Name</label>

					<div class="control">
						<input type="text" class="input" value="{{ $driver->getWholeName() }}" readonly="">
					</div>
				</div>

				<div class="field">
					<label class="label">New ID Control No.</label>

					<div class="control">
						<input type="number" min="1" max="99999" class="input {{ !$errors->has('new_id_control_no') ?: 'is-danger' }}" name="new_id_control_no" value="{{ old('new_id_control_no') }}" required="">
					</div>
				</div>

				<div class="field">
					<div class="control">
						<input type="submit" class="input button is-primary" value="Add New Control No.">
					</div>
				</div>
			</div>
		</div>
	</form>

@endsection