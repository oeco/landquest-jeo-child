<?php

/* 
 * LandQuest
 * Contact form
 */

class LandQuest_Contact {

	function __construct() {

		add_shortcode('landquest-contact', array($this, 'get_content'));
		$this->ajax();

	}

	function get_email() {

		return apply_filters('landquest_contact_email', 'john@example.com');

	}

	function get_phone() {

		return get_field('phone_number', 'option');

	}

	function get_content() {
		ob_start();
		$this->content();
		return ob_get_clean();
	}

	function content() {
		$email = $this->get_email();
		$phone = $this->get_phone();
		?>
		<div class="landquest-contact">
			<?php $this->form(); ?>
		</div>
		<?php
	}

	function form() {
		if(!$this->get_email())
			return false;

		wp_enqueue_script('landquest-contact', get_stylesheet_directory_uri() . '/inc/contact/contact.js', array('jquery'));
		wp_localize_script('landquest-contact', 'landquest_contact', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
		?>
		<form class="landquest-contact-form">
			<div class="inputs">
				<input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('landquest-contact'); ?>" />
				<input type="hidden" name="action" value="landquest_contact" />
				<p class="input-container"><input type="text" class="name" name="name" placeholder="<?php _e('Name', 'landquest'); ?>" /></p>
				<p class="input-container"><input type="text" class="email" name="email" placeholder="<?php _e('Email', 'landquest'); ?>" /></p>
				<p class="input-container"><input type="text" class="subject" name="subject" placeholder="<?php _e('Subject', 'landquest'); ?>" /></p>
				<p class="input-container"><textarea class="msg" name="message" placeholder="<?php _e('Your message here', 'landquest'); ?>"></textarea></p>
				<p class="submit-container"><input type="submit" class="button" value="<?php _e('Send', 'landquest'); ?>" /></p>
			</div>
			<div class="message">
			</div>
		</form>
		<?php
	}

	function ajax() {

		add_action('wp_ajax_nopriv_landquest_contact', array($this, 'send'));
		add_action('wp_ajax_landquest_contact', array($this, 'send'));

	}

	function send() {

		$email = $this->get_email();

		if(!$email)
			$this->ajax_response(__('Our system is not accepting email forms for now.', 'landquest'));

		if(!wp_verify_nonce($_REQUEST['_nonce'], 'landquest-contact'))
			$this->ajax_response(__('Security check.', 'landquest'));

		if(!$_REQUEST['email'] || !$_REQUEST['name'] || !$_REQUEST['message'])
			$this->ajax_response(__('Please fill out all the form fields.', 'landquest'));

		if(!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))
			$this->ajax_response(__('Invalid email.', 'landquest'));

		$headers = 'From: ' . $_REQUEST['name'] . ' <' . $_REQUEST['email'] . '>' . "\r\n";
		$subject = '[' . get_bloginfo('name') . ' contact] ' . $_REQUEST['subject'];

		wp_mail($email, $subject, $_REQUEST['message'], $headers);

		$this->ajax_response(__('Thank you! Your message has been sent, we\'ll get back to you as soon as possible.', 'landquest'), 'success');

	}

	function ajax_response($message = 'Error', $status = 'error') {

		$response = array(
			'status' => $status,
			'message' => $message
		);

		header('Content-Type: application/json;charset=UTF-8');
		echo json_encode($response);
		exit;
	}

}

new LandQuest_Contact();