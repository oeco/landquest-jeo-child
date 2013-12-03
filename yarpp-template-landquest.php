<?php if(have_posts()) : ?>
	<div class="container">
		<div class="twelve columns">
			<h3><?php _e('Related Investigations', 'landquest'); ?></h3>
		</div>
	</div>
	<?php get_template_part('loop', 'small'); ?>
<?php endif; ?>