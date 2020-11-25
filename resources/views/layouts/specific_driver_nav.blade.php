@php
	$current = request()->path();
@endphp

<nav id="driver_nav" class="breadcrumb has-dot-separator is-centered is-medium">
 	<ul>
 		<li class="{{ $current != 'drivers/' . $driver->driver_id ?: 'is-active' }}">
 			<a href="{{ url('drivers/' . $driver->driver_id) }}">
 				View Info
 			</a>
 		</li>

 		<li class="{{ $current != 'drivers/' . $driver->driver_id . '/edit' ?: 'is-active' }}">
 			<a href="{{ url('drivers/' . $driver->driver_id . '/edit') }}">
 				Edit Info
 			</a>
 		</li>

 		<li class="{{ $current != 'drivers/' . $driver->driver_id . '/id-control-no' ?: 'is-active' }}">
 			<a href="{{ url('drivers/' . $driver->driver_id . '/id-control-no') }}">
 			Manage ID Control No.
 			</a>
 		</li>

 		<li class="{{ $current != 'drivers/' . $driver->driver_id . '/lost-id' ?: 'is-active' }}">
 			<a href="{{ url('drivers/' . $driver->driver_id . '/lost-id') }}">
 			Change Lost ID
 			</a>
 		</li>

 		<li class="{{ $current != 'drivers/' . $driver->driver_id . '/id-printout' ?: 'is-active' }}">
 			<a href="{{ url('drivers/' . $driver->driver_id . '/id-printout') }}">
 				Print ID
 			</a>
 		</li>

 		<!--<li class="{{ $current != 'drivers/' . $driver->driver_id . '/id-printout-back' ?: 'is-active' }}">
 			<a href="{{ url('drivers/' . $driver->driver_id . '/id-printout-back') }}">
 				Print ID (Back)
 			</a>
 		</li>-->
 	</ul>
</nav>