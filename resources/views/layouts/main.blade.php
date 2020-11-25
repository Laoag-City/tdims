<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="has-navbar-fixed-top has-background-grey-lighter">
	<head>
		<meta name="author" content="Russell James F. Bello">
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(), ]) !!};</script>

        <title>{{ $title }} | Tricyle Driver ID Management System</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('custom_css')
	</head>

	<body style="padding-top: 8px; padding-bottom: 1px;">
		<nav class="navbar is-dark is-fixed-top">
			<div class="navbar-brand">
				<div class="navbar-item">
					<img src="/img/lc_logo.png">
					<h5 class="title is-5 has-text-light" style="margin-left: 5px; cursor: help;" title="Proudly developed by Russell James Funtila Bello.">
						<i>TDIMS</i>
					</h5>
				</div>

				<a role="button" class="navbar-burger has-text-white" aria-label="menu" aria-expanded="false">
					<span aria-hidden="true"></span>
					<span aria-hidden="true"></span>
					<span aria-hidden="true"></span>
				</a>
			</div>

			<div class="navbar-menu">
				@if(Auth::check())
					<div class="navbar-start">
						<a href="{{ url('drivers') }}" class="navbar-item">Add Driver</a>

						<div class="navbar-item has-dropdown is-hoverable">
							<div class="navbar-link">
								Driver List
							</div>
							<div class="navbar-dropdown is-boxed">
								<a class="navbar-item" href="{{ url('drivers/city') }}">
									City
								</a>
								<a class="navbar-item" href="{{ url('drivers/barangay') }}">
									Barangay
								</a>
							</div>
						</div>

						<form method="GET" action="{{ url('search-results') }}" class="navbar-item">
							<div class="field has-addons">
								<div class="control">
									<span class="select">
										<select name="driver_type" required="">
											<option></option>
											<option value="1">City</option>
											<option value="0">Brgy</option>
										</select>
									</span>
								</div>

								<div class="control">
									<input type="text" class="input" name="keyword" placeholder="Search..." required="">
								</div>

								<div class="control">
									<button type="submit" class="button is-info">Search</button>
								</div>
							</div>
						</form>
					</div>
				@endif

				<div class="navbar-end">
					@if(Auth::check())
						@if(Auth::user()->is_admin)
							<a class="navbar-item" href="{{ url('users') }}">
								User Administration
							</a>
						@endif

						<div class="navbar-item">
							<div class="field is-grouped">
								<p class="control">
									<a href="#" class="button is-danger is-outlined" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Log Out</a>
								</p>
							</div>
						</div>
					@endif
					
					<a href="#" class="navbar-item" style="cursor: context-menu;">Renewal Month: {{ $start_month }}</a>
					<a href="#" class="navbar-item" style="cursor: context-menu;">ID series: {{ $current_series }}</a>
				</div>

				<form id="logout_form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        			{{ csrf_field() }}
    			</form>
			</div>
		</nav>

		<div id="main_contents" class="container box has-background-white-ter">
			<h3 id="page_title" class="title is-3 has-text-centered"><u>{{ $title }}</u></h3>

			@yield('content')
		</div>

		<script src="{{ mix('js/app.js') }}"></script>
		@yield('custom_js')
	</body>
</html>