@extends('layouts.main')

@section('content')
<div class="column is-4 is-offset-4">
	<form method="POST" action="{{ url()->current() }}">
		@csrf
		@method('PATCH')

		@include('layouts.error_or_success_message')

		<div class="field">
			<label class="label">Username</label>
			<div class="control">
				<input class="input" type="text" name="username" value="{{ old('username') ? old('username') : $user->username }}" required>
			</div>
		</div>

		<div class="field">
			<label class="label">Password</label>
			<div class="control">
				<input class="input" type="password" name="password" value="{{ old('password') }}">
			</div>
		</div>

		<div class="field">
			<label class="label">Confirm Password</label>
			<div class="control">
				<input class="input" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
			</div>
		</div>

		<div class="field">
			<div class="control">
				<button type="submit" class="button is-fullwidth is-primary">Add User</button>
			</div>
		</div>
	</form>
</div>
@endsection