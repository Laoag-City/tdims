$('#get_id_button').click(function(){
	var driver_type = $('input[name="driver_type"]:checked').val();

	if(driver_type == undefined)
	{
		window.alert('Please select a Driver Type before generating an ID.');
	}

	else
	{
		$.ajax({
			url: 'drivers/latest-id-no',
			method: 'GET',
			data: {'driver_type': driver_type},
			success: function(response){
				$('input[name="id_no"]').val(response);
			},
			error: function(xhr){
				console.log('error', xhr);
			}
		});
	}
});

$('input[name="driver_type"]').change(function(){
	$('input[name="id_no"]').val('');
});

Webcam.set({
	width: 330,
	height: 250,
	crop_width: 250,
	crop_height: 250,
	jpeg_quality: 100,
	upload_name: 'id_photo'
});

Webcam.attach('#camera');

Webcam.on('live', function(){
	$('#take_photo').show();
});

$('#take_photo').click(function(){
	Webcam.snap(function(picture){
		$('input[name="id_photo"]').val(picture.replace(/^data\:image\/\w+\;base64\,/, ''));
	});

	Webcam.freeze();

	$('#change_photo').show();
	$(this).hide();
});

$('#change_photo').click(function(){
	Webcam.unfreeze();
	$('input[name="id_photo"]').val('');
	$('#take_photo').show();
	$(this).hide();
});

$('#remove_submission_notif').click(function(){
	$('#print_id_link').remove();
});