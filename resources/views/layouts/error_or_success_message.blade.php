@if(count($errors) > 0)
	<div id="submission_notif" class="notification is-danger">
		<button id="remove_submission_notif" class="delete"></button>

		<p class="has-text-centered"><b>There are errors in the information you supplied.</b></p>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@elseif(session('success') != NULL)
	<div id="submission_notif" class="notification is-success">
		<button id="remove_submission_notif" class="delete"></button>
		<p class="title is-4">{!! session('success')['header'] !!}</p>
		<p class="subtitle is-5">{!! isset(session('success')['message']) ? session('success')['message'] : '' !!}</p>
	</div>
@endif