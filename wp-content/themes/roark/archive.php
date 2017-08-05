<?php get_header(); ?>

	<?php $setting = roark_blog::roark_blog_setting(); ?>

	<section id="main" class="mb-100">
		<div class="container">
			<div class="row">

				<div class="<?php echo esc_attr($setting['class_content']) ?>">
					<?php roark_blog::roark_hero(); ?>
					<?php get_template_part( 'inc/blog/'. $setting['blog'] ); ?>
					<?php roark_blog::roark_paginate(); ?>
				</div>

				<?php if( $setting['class_sidebar'] != 'hidden' ) : ?>
					<div class="<?php echo esc_attr($setting['class_sidebar']) ?>">
						<?php get_template_part('sidebar'); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</section>

<?php get_footer(); ?>