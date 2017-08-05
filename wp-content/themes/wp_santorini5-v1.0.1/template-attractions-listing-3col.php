<?php
/*
* Template Name: Attractions Listing 3 Cols
*/
?>

<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 full">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<?php
					$args = array(
						'post_type' => 'attraction',
						'posts_per_page' => -1
					);

					$attractions = new WP_Query($args);
					?>

					<div class="row">
						<?php if ( $attractions->have_posts() ) : while ( $attractions->have_posts() ) : $attractions->the_post(); ?>
							<div class="col-sm-4">
								<?php get_template_part('loop','item'); ?>
							</div>
						<?php endwhile; endif; wp_reset_postdata(); ?>
					</div>

				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>