<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

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