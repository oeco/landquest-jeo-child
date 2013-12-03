<?php if(have_posts()) : ?>
	<section class="posts-section">
		<div class="container">
			<ul class="posts-list small">
				<?php while(have_posts()) : the_post(); ?>
					<li id="post-<?php the_ID(); ?>" <?php post_class('three columns'); ?>>
						<article id="post-<?php the_ID(); ?>">
							<?php if ( has_post_thumbnail()) : ?>
								<section class="post-thumbnail">
								   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								   <?php the_post_thumbnail('front-loop', array('class' => 'scale-with-grid')); ?>
								   </a>
								</section>
							<?php endif; ?>
							<header class="post-header">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
							</header>
							<aside class="actions clearfix">
								<a href="<?php the_permalink(); ?>"><?php _e('Read more', 'jeo'); ?></a>
							</aside>
						</article>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>