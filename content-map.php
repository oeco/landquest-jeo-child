<div class="map-container">
	<div id="map_<?php echo jeo_get_map_id(); ?>" class="map"></div>
	<?php do_action('jeo_map'); ?>
	<p class="share-map">
		<?php echo jeo_get_share_url(); ?>
	</p>
</div>
<script type="text/javascript">jeo(<?php echo jeo_map_conf(); ?>);</script>