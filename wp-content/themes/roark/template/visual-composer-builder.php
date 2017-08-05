<?php 

/**
 * Template Name: Visual Composer Builder
 */

get_header(); ?>

	<?php if( have_posts() ) : ?>

		<section class="section mb-50">

	        <div class="container">

				<div class="builder-content">

					<?php while ( have_posts() ) : the_post();
						the_content();
					endwhile; ?>

				</div>

			</div>

		</section>

	<?php endif;

get_footer();