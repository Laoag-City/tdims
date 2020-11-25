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
				@foreach($id_control_no as $key => $id)
					<div class="field">
						<label class="label">ID Control No {{ $loop->iteration }}{{ $loop->first ? ' (Original)' : '' }}</label>

						@php
							/*if(!$loop->first)
								if(old('id_control_no')[$key - 1])	
									$value = old('id_control_no')[$key - 1];
								else
									$value = $id;
							else
								$value = $id;*/
						@endphp

						<div class="control">
							<input type="text" class="input" name="{{ !$loop->first ? 'id_control_no[]' : '' }}" value="{{ $id }}" {{ !$loop->first ? : 'readonly' }}>
						</div>
					</div>
				@endforeach

				<div class="field">
					<div class="control">
						<input type="submit" class="input button is-primary" value="Edit ID Control No(s)" {!! count($id_control_no) != 1 ?: 'disabled' !!}>
					</div>
				</div>
			</div>
		</div>
	</form>

	<br>
@endsection