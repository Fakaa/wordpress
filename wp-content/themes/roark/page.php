<?php get_header(); ?>

	<?php roark_blog::roark_hero(); ?>

	<?php if( have_posts() ) : ?>
		
		<div class="container">

			<?php  

				while (have_posts() ) : the_post() ?>

					<div class="content-page">
						<?php echo the_content(); ?>
					</div>

					<?php comments_template(); ?>

				<?php endwhile; 
			?>

		</div>
		
	<?php endif; ?>

<?php get_footer(); ?>