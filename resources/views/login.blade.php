@extends('layouts.main')

@section('content')

	<form method="POST" action="{{ url()->current() }}">
		@csrf
		@include('layouts.error_or_success_message')
		
		<div class="columns is-centered">
			<div class="column is-4">
				<div class="field">
					<label class="label">Username</label>
					<div class="control">
						<input type="text" class="input" name="username" value="{{ old('username') }}">
					</div>
				</div>
			</div>
		</div>

		<div class="columns is-centered">
			<div class="column is-4">
				<div class="field">
					<label class="label">Password</label>
					<div class="control">
						<input type="password" class="input" name="password" value="{{ old('password') }}">
					</div>
				</div>
			</div>
		</div>

		<div class="columns is-centered">
			<div class="column is-4">
				<div class="field">
					<div class="control">
						<button type="submit" class="input button is-primary">
							Log In
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>

@endsection