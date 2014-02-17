<?php

function landquest_setup() {
	
	add_theme_support('post-thumbnails');
	add_image_size('bubble-thumbnail', 100, 100, true);
	add_image_size('front-loop', 360, 240, true);
	add_image_size('small-thumbnail', 260, 173, true);
	add_image_size('footer-thumbnail', 100, 80);
	load_child_theme_textdomain('landquest', get_stylesheet_directory() . '/languages');

}
add_action('after_setup_theme', 'landquest_setup');

function landquest_scripts() {
	
	define('WP_DEBUG', true);
	
	// remove jeo site scripts
	//wp_deregister_script('jeo-site');
	wp_deregister_style('jeo-main');
	
	// fonts
	wp_register_style('font-ifdp', 'http://fonts.googleapis.com/css?family=IM+Fell+Double+Pica');
	wp_register_style('font-galdeano', 'http://fonts.googleapis.com/css?family=Galdeano');
	
	// register child theme css
	wp_enqueue_style('lanquest-main', get_stylesheet_directory_uri() . '/css/landquest-main.css', array('jeo-skeleton', 'jeo-lsf', 'font-opensans', 'font-ifdp', 'font-galdeano'), '0.0.1');
	
	wp_register_script('sly', get_stylesheet_directory_uri() . '/js/sly.min.js', array('jquery'), '1.2.0');
}
add_action('wp_enqueue_scripts', 'landquest_scripts');

function landquest_marker_scripts() {

	// landquest site script
	wp_enqueue_script('landquest', get_stylesheet_directory_uri() . '/js/landquest.js', array('jquery', 'jeo.markers', 'sly'), '0.1.0');
	wp_localize_script('landquest', 'landquest_site', array(
		'is_single' => is_single()
	));

}
add_action('jeo_markers_enqueue_scripts', 'landquest_marker_scripts');

/*
 * ACF
 */


function landquest_acf_dir() {
        return get_stylesheet_directory_uri() . '/inc/acf/';
}
add_filter('acf/helpers/get_dir', 'landquest_acf_dir');

define('ACF_LITE', false);
require_once(STYLESHEETPATH . '/inc/acf/acf.php');

include_once(STYLESHEETPATH . '/inc/author.php');
include_once(STYLESHEETPATH . '/inc/contact/contact.php');
include_once(STYLESHEETPATH . '/inc/partner.php');
include_once(STYLESHEETPATH . '/inc/dataset.php');
include_once(STYLESHEETPATH . '/inc/gdocs-to-map/gdocs-to-map.php');
include_once(STYLESHEETPATH . '/inc/jeo-post-zoom.php');

function landquest_contact_email() {
	return 'miguel@cardume.art.br';
}
add_filter('landquest_contact_email', 'landquest_contact_email');

/*
 * qTranslate
 */

require_once(STYLESHEETPATH . '/inc/qtranslate/qtranslate.php');

/*
 * About map
 */

function landquest_about_marker_query($query) {
	if(is_page('about'))
		return new WP_Query(array('post_type' => 'author', 'posts_per_page' => -1));
	
	return $query;
}
add_filter('jeo_marker_base_query', 'landquest_about_marker_query');

/*
 * Social APIs
 */

function landquest_social_apis() {

        // Facebook
        ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=1485880808304742";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <?php

        // Twitter
        ?>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        <?php

        // Google Plus
        ?>
        <script type="text/javascript">
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>
        <?php
}
add_action('wp_footer', 'landquest_social_apis');

function landquest_home_url($path = '/') {

    $url = home_url($path);
    
    if(function_exists('qtrans_convertURL')) {
        $url = qtrans_convertURL($url);
    }
    
    return $url;
}

function landquest_body_class($class) {
    if(is_page()) {
        global $post;
        $class[] = 'page-' . $post->post_name;
    }
    return $class;
}
add_filter('body_class', 'landquest_body_class');

function landquest_disable_cache() {
	return false;
}
add_filter('jeo_markers_enable_transient', 'landquest_disable_cache');
add_filter('jeo_markers_enable_browser_caching', 'landquest_disable_cache');

?>