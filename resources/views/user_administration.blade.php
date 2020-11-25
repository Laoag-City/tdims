@extends('layouts.main')

@section('custom_css')
<style>
	tr>th
	{
		text-align: center !important;
		font-size: 10.5pt;
	}

	td:last-child
	{
		width: 1px !important;
	}
</style>
@endsection

@section('content')

<div class="columns">
	<div class="column">
		<div class="columns">
			<div class="column is-10 is-offset-1">
				<form method="POST" action="{{ url()->current() }}">
					@csrf

					@include('layouts.error_or_success_message')

					<div class="field">
						<label class="label">Username</label>
						<div class="control">
							<input class="input" type="text" name="username" value="{{ old('username') }}" required>
						</div>
					</div>

					<div class="field">
						<label class="label">Password</label>
						<div class="control">
							<input class="input" type="password" name="password" value="{{ old('password') }}" required>
						</div>
					</div>

					<div class="field">
						<label class="label">Confirm Password</label>
						<div class="control">
							<input class="input" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
						</div>
					</div>

					<div class="field">
						<div class="control">
							<button type="submit" class="button is-fullwidth is-primary">Add User</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="column">
		<table class="table is-fullwidth is-bordered is-striped is-hoverable">
			<thead>
				<tr>
					<th>Username</th>
					<th>User Type</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{ $user->username }}</td>
						<td>{{ $user->is_admin ? 'Admin' : 'Regular' }}</td>
						<td>
							@if(!$user->is_admin)
								<div class="dropdown is-hoverable is-right">
									<div class="dropdown-trigger">
										<button class="button">Options</button>
									</div>

									<div class="dropdown-menu">
										<div class="dropdown-content">
											<a href="{{ url('users/' . $user->user_id) . '/edit' }}" class="dropdown-item">Edit</a>
											<a href="#" class="dropdown-item remove-user" data-user="{{ $user->user_id }}">Remove</a>
										</div>
									</div>
								</div>
							@else
								<div></div>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div id="remove-modal" class="modal">
		<div class="modal-background"></div>
		
		<div class="modal-card has-text-centered">
			<header class="modal-card-head">
				<b class="modal-card-title">Remove User</b>
				<button id="close-remove-modal" class="delete"></button>
			</header>

			<section class="modal-card-body">
				<p>Are you sure you want to remove the selected user?</p>
			</section>

			<footer class="modal-card-foot">
				<form id="remove-form" method="POST" style="width: 100%;">
					@csrf
					@method('DELETE')
					<button type="submit" class="button is-danger is-fullwidth is-outlined">Remove anyway</button>
				</form>
			</footer>
		</div>
</div>

@endsection

@section('custom_js')
	<script src="{{ mix('js/user_management.js') }}"></script>
@endsection