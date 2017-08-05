<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 full">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php $columns = get_post_meta(get_the_ID(), 'ci_gallery_columns', true); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<div class="row">
					<?php $set = ci_featgal_get_attachments(); ?>
					<?php while ( $set->have_posts() ) : $set->the_post(); ?>

					<div class="<?php echo $columns; ?>">
						<?php get_template_part('loop','item'); ?>
					</div>

					<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>