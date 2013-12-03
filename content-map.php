<div class="map-container">
	<div id="map_<?php echo jeo_get_map_id(); ?>" class="map"></div>
	<?php do_action('jeo_map'); ?>
	<p class="share-map">
		<?php
		$share_args = array();
		if(is_single()) {
			global $post;
			$share_args = array('p' => $post->ID);
		}
		?>
		<a class="share-map-button" href="<?php echo jeo_get_share_url($share_args); ?>" title="<?php _e('Share this map', 'landquest'); ?>"><?php _e('Share this map', 'landquest'); ?></a>
	</p>
</div>
<script type="text/javascript">jeo(<?php echo jeo_map_conf(); ?>);</script>