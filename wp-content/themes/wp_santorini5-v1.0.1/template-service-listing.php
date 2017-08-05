<?php
/*
* Template Name: Services Listing
*/
?>
<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2 class="page-title"><?php the_title(); ?></h2>

				<div class="row">
					<div class="col-sm-8">
						<?php
							$args = array(
								'post_type' => 'service',
								'posts_per_page' => -1
							);

							$services = new WP_Query($args);
						?>
						<?php if ( $services->have_posts() ) : while ( $services->have_posts() ) : $services->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('entry row'); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="entry-thumb col-md-4">
										<a title="<?php echo esc_attr(sprintf( __('Permanent Link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('ci_thumb'); ?>
										</a>
									</figure>
								<?php endif; ?>

								<div class="col-md-8">
									<h1 class="entry-title"><a title="<?php echo esc_attr(sprintf( __('Permanent link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<div class="entry-excerpt">
										<?php the_excerpt(); ?>
									</div>
								</div>
							</article>
						<?php endwhile; endif; wp_reset_postdata(); ?>

					</div>
					<?php endwhile; endif; //main loop ?>

					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>