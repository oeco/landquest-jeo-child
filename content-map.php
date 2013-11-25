<div class="map-container">
	<div id="map_<?php echo jeo_get_map_id(); ?>" class="map"></div>
	<?php do_action('jeo_map'); ?>
</div>
<script type="text/javascript">jeo(<?php echo jeo_map_conf(); ?>);</script>