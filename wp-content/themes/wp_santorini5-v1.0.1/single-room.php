<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<?php
						if ( is_active_sidebar('room-inset-sidebar') ) {
							dynamic_sidebar('room-inset-sidebar');
						}
					?>
					<?php $set = ci_featgal_get_attachments(); ?>
					<?php if ( $set->have_posts() ) : ?>
					<div class="room-slider flexslider">
						<ul class="slides">

							<?php while ( $set->have_posts() ) : $set->the_post(); ?>
							<li>
								<a data-rel="prettyPhoto[gal]" href="<?php echo ci_get_image_src($post->ID, 'large'); ?>">
									<img src="<?php echo ci_get_image_src($post->ID, 'ci_fullwidth'); ?>" alt="<?php echo get_the_excerpt(); ?>">
								</a>
							</li>
							<?php endwhile; wp_reset_postdata(); ?>
						</ul>
					</div>
					<?php endif; ?>

					<div class="row">
						<div class="col-sm-8">
							<article class="entry">
								<div class="entry-content">
									<?php
										$amenities = get_post_meta($post->ID, 'ci_cpt_room_amenities', true);
										$amenities_title = get_post_meta($post->ID, 'ci_cpt_room_amenities_title', true);
									?>
									<?php if(!empty($amenities) and count($amenities) > 0): ?>
										<?php if(!empty($amenities)): ?><h3><?php echo $amenities_title; ?></h3><?php endif; ?>
										<ul class="list-amenities">
											<?php
												foreach($amenities as $am)
												{
													echo '<li><i class="fa fa-star"></i>'.$am.'</li>';
												}
											?>
										</ul>
									<?php endif; ?>

									<?php the_content(); ?>
								</div>
							</article>
						</div>

						<?php get_sidebar(); ?>
					</div>

				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>