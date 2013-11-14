<?php

function landquest_setup() {
	
	add_theme_support('post-thumbnails');
	add_image_size( 'front-loop', 400, 200 );

}
add_action('after_setup_theme', 'landquest_setup');

function landquest_scripts() {
	
	// remove jeo site scripts
	wp_deregister_script('jeo-site');
	
}
add_action('wp_enqueue_scripts', 'landquest_scripts');

?>