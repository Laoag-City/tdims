$('.remove-user').click(function(){
	var id = $(this).attr('data-user');

	$('#remove-modal').addClass('is-active');
	$('#remove-form').attr('action', window.location.origin + '/users/' + id);
});

$('#close-remove-modal').click(function(){
	$('#remove-modal').removeClass('is-active');
});