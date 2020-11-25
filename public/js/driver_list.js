$('.remove-driver').click(function(){
	var id = $(this).attr('data-driver');

	$('#remove-modal').addClass('is-active');
	$('#remove-form').attr('action', window.location.origin + '/drivers/' + id);
});

$('#close-remove-modal').click(function(){
	$('#remove-modal').removeClass('is-active');
});