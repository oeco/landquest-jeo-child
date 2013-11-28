<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

	<?php jeo_map(); ?>

	<article id="content" class="single-post">
		<header id="page-header" class="page-header">
			<div class="container">
				<div class="twelve columns">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</header>
		<section class="content">
			<div class="container">
				<div class="row">
					<div class="twelve columns">
						<?php if($post->post_excerpt) : ?>
							<section id="post-excerpt">
								<?php the_excerpt(); ?>
							</section>
						<?php endif; ?>
						<?php the_content(); ?>
					</div>
				</div>
				<?php
				$hide_partners = true;
				if(is_page('about') && !$hide_partners) :
					$partners = get_posts(array('post_type' => 'partner', 'posts_per_page' => -1));
					if($partners) :
						global $post;
						?>
							<div id="lq-partners" class="row">
								<div class="twelve columns">
									<h3><?php _e('Partners', 'landquest'); ?></h3>
								</div>
								<?php foreach($partners as $partner) :
									$post = $partner;
									setup_postdata($post);
									?>
									<div class="three columns">
										<article id="partner-<?php the_ID(); ?>">
											<a href="<?php the_permalink(); ?>" target="_blank" rel="external"><?php the_post_thumbnail('small-thumbnail', array('class' => 'scale-with-grid', 'alt' => get_the_title())); ?></a>
											<h4><a href="<?php the_permalink(); ?>" target="_blank" rel="external"><?php the_title(); ?></a></h4>
											<p class="website"><a href="<?php the_permalink(); ?>" target="_blank" rel="external"><?php the_field('partner_url'); ?></a></p>
										</article>
									</div>
									<?php
									wp_reset_postdata();
								endforeach;
								?>
							</div>
						<?php
					endif;
				endif;
				?>
			</div>
		</section>
	</article>

<?php endif; ?>

<?php get_footer(); ?>