<?php if(have_posts()) : ?>
	<section class="posts-section">
		<div class="container">
			<ul class="posts-list dataset">
				<?php while(have_posts()) : the_post(); ?>
					<li id="post-<?php the_ID(); ?>" <?php post_class('three columns'); ?>>
						<article id="post-<?php the_ID(); ?>">
							<?php if (has_post_thumbnail()) : ?>
								<section class="post-thumbnail">
								   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								   <?php the_post_thumbnail('front-loop', array('class' => 'scale-with-grid')); ?>
								   </a>
								</section>
							<?php endif; ?>
							<header class="post-header">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
							</header>
                            <?php
                            $url = get_field('full_download') ? get_field('full_download') : get_field('source_url');
                            if($url) :
                                ?>
                                <p class="download-button">
                                    <a href="<?php echo $url; ?>" title="<?php _e('Download data', 'landquest'); ?>" rel="external" target="_blank"><?php _e('Download data', 'landquest'); ?></a>
                                </p>
                            <?php endif; ?>
							<section class="post-content">
                                <?php
                                $source = get_the_terms($post->ID, 'source');
                                if($source) :
                                    $source = array_shift($source);
                                    $source_url = get_field('url', 'source_' . $source->term_id);
                                    ?>
                                    <p class="source">Source: <a href="<?php echo $source_url; ?>" target="_blank" rel="external"><?php echo $source->name; ?></a></p>
                                <?php endif; ?>
                                <?php
                                $license = get_the_terms($post->ID, 'license');
                                if($license) :
                                    $license = array_shift($license);
                                    $license_url = get_field('url', 'license_' . $license->term_id);
                                    ?>
                                    <p class="license">License: <a href="<?php echo $license_url; ?>" target="_blank" rel="external"><?php echo $license->name; ?></a></p>
                                <?php endif; ?>
							</section>
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