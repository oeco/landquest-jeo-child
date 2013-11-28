(function($) {

	var form,
		inputs,
		message,
		r;

	$(document).ready(function() {

		form = $('.landquest-contact-form');
		inputs = form.find('.inputs');
		message = form.find('.message');

		if(form.length) {

			setupForm();

		}

	});

	function setupForm() {

		form.submit(function(e) {
			
			message.empty();

			e.preventDefault();

			r = form.serialize();
			
			var prefix = '?';
			if(landquest_contact.ajaxurl.indexOf('?') !== -1)
				prefix = '&';

			$.post(landquest_contact.ajaxurl + prefix + r, function(data) {

				respond(data.message, data.status);

			}, 'json');

		});

	}

	function respond(msg, status) {

		message.empty().html($('<p class="' + status + '">' + msg + '</p>'));

		if(status === 'success')
			inputs.hide();

	}

})(jQuery);