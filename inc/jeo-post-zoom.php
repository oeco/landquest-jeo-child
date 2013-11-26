<?php

/* 
 * JEO Post Zoom
 */

class JEO_Post_Zoom {

	function __construct() {

		add_action('jeo_geocode_box', array($this, 'zoom_input'));
		add_action('jeo_geocode_box_save', array($this, 'save_post'));
		add_filter('jeo_marker_data', array($this, 'marker_data'));
		add_action('wp_footer', array($this, 'wp_footer'), 100);

	}

	function zoom_input($post) {
		$geocode_zoom = get_post_meta($post->ID, 'geocode_zoom', true);
		?>
		<p>
		<?php _e('Zoom', 'ekuatorial'); ?>:
		<input type="text" id="geocode_zoom" name="geocode_zoom" value="<?php if($geocode_zoom) echo $geocode_zoom; ?>" />
		</p>
		<?php
	}

	function save_post($post_id) {

		if(isset($_REQUEST['geocode_zoom'])) {
			update_post_meta($post_id, 'geocode_zoom', $_REQUEST['geocode_zoom']);
		} else {
			delete_post_meta($post_id, 'geocode_zoom');
		}

	}
	
	function marker_data($data) {

		global $post;

        if(get_post_meta($post->ID, 'geocode_zoom', true))
                $data['zoom'] = get_post_meta($post->ID, 'geocode_zoom', true);
		
		return $data;
		
	}
	
	function wp_footer() {
		?>
		<script type="text/javascript">
			jeo.markersReady(function(map) {
				if(map._markers.length == 1) {
					var marker = map._markers[0];
					if(typeof marker.feature.properties.zoom != 'undefined') {
						map.setZoom(marker.feature.properties.zoom);
					}
				}
			});
		</script>
		<?php
	}

}

$GLOBALS['jeo_post_zoom'] = new JEO_Post_Zoom();