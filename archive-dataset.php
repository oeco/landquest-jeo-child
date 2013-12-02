<?php get_header(); ?>

<div class="section-title">
	<div class="container">
		<div class="twelve columns">
			<h1 class="archive-title"><?php _e('Data and Resources', 'landquest'); ?></h1>
		</div>
	</div>
</div>
<?php get_template_part('loop', 'dataset'); ?>

<?php get_footer(); ?>