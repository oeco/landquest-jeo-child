<?php
/*
 * Mousehover bubble content
 */

if(get_post_type() == 'author') :

	?>
	
	<div class="author-bubble">
        <?php the_post_thumbnail('bubble-thumbnail'); ?>
        <h4><?php the_title(); ?></h4>
        <div class="meta">
            <?php if(get_field('author_activity')) : ?>
                <p class="activity meta-item"><?php the_field('author_activity'); ?></p>
            <?php endif; ?>
            <?php if(get_field('author_url')) : ?>
                <p class="website meta-item"><a href="<?php the_field('author_url'); ?>" rel="external" target="_blank"><?php the_field('author_url'); ?></a></p>
            <?php endif; ?>
        </div>
	</div>
	<?php

else :

	?>

	<small><?php echo get_the_date(_x('m/d/Y', 'map bubble date format', 'jeo')); ?></small>
	<h4><?php the_title(); ?></h4>

	<?php
endif;
?>