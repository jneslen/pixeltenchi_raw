$(document).ready(function() {
	$(document).pngFix();

	$('a[data-toggle=modal]').click(function(event) {

		if($(this).attr('data-btn-func') == 'close') {
			$('.modal-footer .btn').removeClass('submit-button');
			$('.modal-footer .btn').addClass('close');
			$('.modal-footer .btn').attr('data-dismiss', 'modal');
		} else {
			if(!$('.modal-footer .btn').hasClass('submit-button')) {
				$('.modal-footer .btn').addClass('submit-button');
			}
			$('.modal-footer .btn').removeClass('close');
			$('.modal-footer .btn').removeAttr('data-dismiss');
		}

		if($(this).attr('data-btn-name')) {
			$('.modal-footer .btn').html($(this).attr('data-btn-name'));
		}

		$('#modal-title').html($(this).attr('data-title'));
		$('#modal-subtitle').html($(this).attr('data-subtitle'));
		$.ajax(
			{
				url: $(this).attr('href'),
				//cache: false,
				dataType: 'html',
				success: function(r) {
					$('#modal-body').html(r);
					$('#modal').modal({
						backdrop: true,
						show: true
					}).css({
							width: 'auto',
							'margin-left': function () {
								return -($(this).width() / 2);
							}
						});
				}
			});
		/*var url = $(this).attr('href');
		$('#modal-body').load(url, function() {
			$('#modal').modal({
				backdrop: true,
				show: true
			}).css({
					width: 'auto',
					'margin-left': function () {
						return -($(this).width() / 2);
					}
				});
		});*/
		event.preventDefault();
	});

	$('#modal .submit-button').click(function() {
		$('#modal form').submit();
	});

	$('#modal form').live('submit', function() {
		$(this).ajaxSubmit({
			target: '#modal-body',
			type: 'post',
			success: function(r){
				obj = $.parseJSON(r);
				if(obj.success == true)
				{
					$('#modal').modal('hide');
					window.location.href = '/thank_you';
				}
			}
		});
		return false;
	});
});