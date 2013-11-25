<?php if(is_single()) : ?>
	
	<h1><?php the_title(); ?></h1>

<?php else : ?>

	<small><?php echo get_the_date(_x('m/d/Y', 'map bubble date format', 'jeo')); ?></small>
	<h4><?php the_title(); ?></h4>

<?php endif; ?>