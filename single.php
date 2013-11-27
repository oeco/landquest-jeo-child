<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

	<?php jeo_map(); ?>

	<article id="content" class="single-post">
		<header id="post-header" class="page-header">
			<div class="container">
				<div class="ten columns offset-by-one">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</header>
		<section class="content">
			<div class="container">
				<div class="ten columns offset-by-one">
					<?php if($post->post_excerpt) : ?>
						<section id="post-excerpt">
							<?php the_excerpt(); ?>
						</section>
					<?php endif; ?>
					<?php if(get_post_type() != 'author') :
						$author = landquest_get_author();
						?>
						<aside id="post-meta">
							<?php if($author) : ?>
								<p class="post-author">
									<a href="<?php echo get_permalink($author->ID); ?>"><span><?php _e('by', 'landquest'); ?> <?php echo get_the_title($author->ID); ?></span></a>
								</p>
							<?php endif; ?>
							<p class="post-date">
								<span><?php the_date(); ?></span>
							</p>
						</aside>
					<?php endif; ?>
					<?php the_content(); ?>
				</div>
			</div>
		</section>
	</article>

<?php endif; ?>

<?php get_footer(); ?>