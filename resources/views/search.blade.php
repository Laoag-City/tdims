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
	<h5 class="title is-5 has-text-centered">{{ $subtitle }}</h5>

	<table class="table is-fullwidth is-bordered is-striped is-hoverable">
		<thead>
			<tr>
				<th>Driver</th>
				<th>ID No</th>
				<th>ID Control No</th>
				<!--<th>Sidecar No</th>-->
				<th>Valid Year</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($drivers as $driver)
				<tr>
					<td>{{ $driver->getWholeName() }}</td>
					<td>{{ $driver->id_no }}</td>
					<td>{{ $driver->getIDControlNos() }}</td>
					<!--<td>{{ $driver->sidecar_no }}</td>-->
					<td>{{ $driver->valid_year->years }}</td>
					<td>
						<div class="dropdown is-hoverable is-right">
							<div class="dropdown-trigger">
								<button class="button">Options</button>
							</div>
							<div class="dropdown-menu">
								<div class="dropdown-content">
									<a href="{{ url('drivers/' . $driver->driver_id) }}" class="dropdown-item">View Info</a>

									<a href="{{ url('drivers/' . $driver->driver_id . '/edit') }}" class="dropdown-item">Edit Info</a>

									<a href="{{ url('drivers/' . $driver->driver_id . '/id-control-no') }}" class="dropdown-item">Manage ID Control No.</a>

									<a href="{{ url('drivers/' . $driver->driver_id) . '/lost-id' }}" class="dropdown-item">Change Lost ID</a>

									<a href="{{ url('drivers/' . $driver->driver_id) . '/id-printout'}}" class="dropdown-item">Print ID</a>

									<!--commented out unitl when it is needed<a href="#" class="dropdown-item remove-driver" data-driver="{{ $driver->driver_id }}">Remove</a>-->
								</div>
							</div>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>

		@if($drivers->hasPages())
			<tfoot>
				<tr>
					<th colspan="7">{{ $drivers->appends(['driver_type' => request()->input('driver_type'), 'keyword' => request()->input('keyword')])->links() }}</th>
				</tr>
			</tfoot>
		@endif
	</table>
<!--commented out unitl when it is needed
	<div id="remove-modal" class="modal">
		<div class="modal-background"></div>
		
		<div class="modal-card has-text-centered">
			<header class="modal-card-head">
				<b class="modal-card-title">Remove Tricyle Driver</b>
				<button id="close-remove-modal" class="delete"></button>
			</header>

			<section class="modal-card-body">
				<p>Are you sure you want to remove the selected tricycle driver?</p>
				<p>All information related to the tricycle driver will be removed.</p>
			</section>

			<footer class="modal-card-foot">
				<form id="remove-form" method="POST" style="width: 100%;">
					@csrf
					@method('DELETE')
					<button type="submit" class="button is-danger is-fullwidth is-outlined">Remove anyway</button>
				</form>
			</footer>
		</div>
	</div>-->

@endsection

@section('custom_js')
	<!--commented out unitl when it is needed<script src="{{ mix('js/driver_list.js') }}"></script>-->
@endsection