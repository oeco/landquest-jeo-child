<?php

function landquest_setup() {
	
	add_theme_support('post-thumbnails');
	add_image_size( 'front-loop', 400, 200 );

}
add_action('after_setup_theme', 'landquest_setup');

function landquest_scripts() {
	
	define('WP_DEBUG', true);
	
	// remove jeo site scripts
	wp_deregister_script('jeo-site');
	wp_deregister_style('jeo-main');
	
	// fonts
	wp_register_style('font-ifdp', 'http://fonts.googleapis.com/css?family=IM+Fell+Double+Pica');
	wp_register_style('font-galdeano', 'http://fonts.googleapis.com/css?family=Galdeano');
	
	// register child theme css
	wp_enqueue_style('lanquest-main', get_stylesheet_directory_uri() . '/css/landquest-main.css', array('jeo-skeleton', 'jeo-lsf', 'font-opensans', 'font-ifdp', 'font-galdeano'), '0.0.1');
	
}
add_action('wp_enqueue_scripts', 'landquest_scripts');

include_once(STYLESHEETPATH . '/inc/gdocs-to-map/gdocs-to-map.php');

?>