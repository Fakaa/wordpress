<?php
/*
* Template Name: Room Listing 3 Cols
*/
?>

<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 full">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<?php dynamic_sidebar('room-inset-sidebar'); ?>

					<?php
						$args = array(
							'post_type' => 'room',
							'posts_per_page' => -1
						);

						$rooms = new WP_Query($args);
					?>

					<div class="row">
						<?php if ( $rooms->have_posts() ) : while ( $rooms->have_posts() ) : $rooms->the_post(); ?>
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