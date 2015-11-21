$(function(){
	$('#modalLogin-button').click(function(){
		$('#modalLogin').modal('show')
			.find('#modalLogin-content')
			.load($(this).attr('value'));
	});
});