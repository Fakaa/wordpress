<?php get_header(); ?>

	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 full">
						<h2 class="page-title"><?php single_term_title(); ?></h2>

						<?php dynamic_sidebar('room-inset-sidebar'); ?>

						<div class="row">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<div class="col-sm-4">
									<?php get_template_part('loop','item'); ?>
								</div>
							<?php endwhile; endif; ?>
						</div>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>