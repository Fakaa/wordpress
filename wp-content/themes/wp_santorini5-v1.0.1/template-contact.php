<?php
/*
 * Template Name: Contact Template
 */
?>

<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<?php if ( ci_setting('contact_show_map') == 'enabled' ) : ?>
					<div class="map-wrap">
						<div id="map"></div>
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