<?php
/*
* Template Name: Homepage with Full Slider
*/
?>

<?php get_header(); ?>

<?php get_template_part('part', 'home-slider'); ?>

<?php if ( ci_setting('booking_form_page') ) : ?>
	<div class="booking-wrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<?php get_template_part('part', 'booking-form'); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="widget-area-1">
					<?php dynamic_sidebar('homepage-widgets-1'); ?>
				</div> <!-- .widget-area-1 -->

				<div class="widget-area-2">
					<div class="row">
						<?php dynamic_sidebar('homepage-widgets-2'); ?>
					</div>
				</div> <!-- .widget-area-2 -->

				<div class="widget-area-3">
					<div class="row">
						<div class="col-sm-8">
							<?php
								while ( have_posts() ) : the_post();
									the_content();
								endwhile;
							?>

							<?php if ( ci_setting('show_homepage_blogpost') == 'on' ) : ?>
								<?php $q = new WP_Query(array(
									'post_type' => 'post',
									'posts_per_page' => ci_setting('show_homepage_blogpost_count')
								)); ?>

								<?php if ( $q->have_posts() ) : ?>
									<h3 class="widget-title"><?php ci_e_setting('show_homepage_blogpost_title'); ?></h3>
									<?php while ( $q->have_posts() ) : $q->the_post(); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
											<?php if ( has_post_thumbnail() ) : ?>
												<figure class="entry-thumb">
													<a title="<?php echo esc_attr(sprintf( __('Permanent Link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail('ci_blog_thumb'); ?>
													</a>
												</figure>
											<?php endif; ?>

											<h1 class="entry-title"><a title="<?php echo esc_attr(sprintf( __('Permanent link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
											<div class="entry-meta">
												<time class="entry-time" datetime="<?php echo get_the_date(DATE_W3C); ?>"><?php echo get_the_date(); ?></time>
												<span class="entry-categories"><b><?php _e('Posted Under:', 'ci_theme'); ?></b> <?php the_category(', '); ?></span>
												<a class="entry-comments" href="<?php echo get_comments_link(); ?>"><?php comments_number(); ?></a>
											</div>

											<div class="entry-excerpt">
												<?php the_excerpt(); ?>
											</div>
										</article>
									<?php endwhile; ?>
								<?php endif; wp_reset_postdata(); ?>
							<?php endif; ?>
						</div>

						<div class="sidebar col-sm-4">
							<?php dynamic_sidebar('homepage-widgets-3'); ?>
						</div>
					</div>
				</div> <!-- .widget-area-3 -->
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>