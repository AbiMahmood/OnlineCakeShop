$(document).ready(function() {

	$('#contact input:submit').click(function() {
		$('#contact form').attr('action', 'http://' + document.domain + '/php/feedback.php');
		$('#contact form').submit();
	});

	$('form #response').hide();
	$('form #nameResponse').hide();
	$('form #phoneResponse').hide();
	$('form #emailResponse').hide();
	$('form #messageResponse').hide();
	$('#submit').click(function(e) {

		// prevent forms default action until
		// error check has been performed
		e.preventDefault();

		// grab form field values
		var valid = '';
		var nameResponse = '';
		var phoneReponse = '';
		var emailResponse = '';
		var messageResponse = '';
		var required = ' is required.';
		var name = $('form #name').val();
		var phone = $('form #phone').val();
		var email = $('form #email').val();
		var message = $('form #message').val();
		var honeypot = $('form #honeypot').val();
		var humanCheck = $('form #humanCheck').val();

		// perform error checking
		if (name = '' || name.length <= 2) {

			nameResponse = '<p>Your name' + required +'</p>';

		}

		if (phone ) {

		}

		if (!email.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i)) {

			emailResponse += '<p>Your email' + required +'</p>';

		}

		if (message = '' || message.length <= 5) {

			messageResponse += '<p>A message' + required + '</p>';

		}

		if (honeypot != 'http://') {

			valid += '<p>Spambots are not allowed.</p>';

		}

		if (humanCheck != '') {

			valid += '<p>A human user' + required + '</p>';

		}

	// let the user know if there are erros with the form

		if (valid != '') {


			$('form #response').removeClass().addClass('error')
				.html('<div class="alert alert-danger">'+
					'<strong>Please correct the errors below.</strong>' + '</div>'
							).fadeIn('fast');

			if (nameResponse != '') {
					$('form #nameResponse').removeClass().addClass('error')
						.html('<div class="alert alert-danger">'+
							nameResponse + '</div>'
								).fadeIn('fast');
			}

			if (phoneResponse != '') {
					$('form #nameResponse').removeClass().addClass('error')
						.html('<div class="alert alert-danger">'+
							phoneResponse + '</div>'
								).fadeIn('fast');
			}

			if (emailResponse != '') {
					$('form #nameResponse').removeClass().addClass('error')
						.html('<div class="alert alert-danger">'+
							emailResponse + '</div>'
								).fadeIn('fast');
			}

			if (messageResponse != '') {
					$('form #nameResponse').removeClass().addClass('error')
						.html('<div class="alert alert-danger">'+
							messageResponse + '</div>'
								).fadeIn('fast');
			}

		}
		// let the user know something is happening behind the scenes
		// serialize the form data and send to our ajax function
		else {

			$('form #response').removeClass().addClass('processing').html('Processing...').fadeIn('fast');

			var formData = $('form').serialize();

			submitForm(formData);

		}

	});

});

function submitForm(formData) {
	$.ajax({

		type:			'POST',
		url:			'php/feedback.php',
		data:			formData,
		dataType:	'json',
		cache:		false,
		timeout:	7000,
		success:
		function(data) {
			//we are getting data.error (from ajax, which is formData) and data.msg from our feedback.php
			$('form #response').removeClass().addClass((data.error === true) ? 'error':'success')
										.html(data.msg).fadeIn('fast');
			if ($('form #response').hasClass('success')) {
				setTimeout ("$('form #response').fadeOut('fast')",5000);
			}
		},
		error:
		function (XMLHttpRequest, textStatus, errorThrown) {
			$('form #response').removeClass().addClass('error')
						.html('<div class="alert alert-danger">' +
							'<p>There was an <strong>' + errorThrown +
									'</strong> error due to a <strong>' + textStatus +
										'</strong> condition.</p>' +
											'</div>').fadeIn('fast');
		},
		complete: function(XMLHttpRequest, status) {
			$('form') [0].reset();
		}



	});
};
