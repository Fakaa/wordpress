<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<?php get_template_part('part', 'titles'); ?>

				<div class="row">
					<div class="col-sm-8">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="entry-thumb">
										<a title="<?php echo esc_attr(sprintf( __('Permanent Link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('ci_blog_thumb'); ?>
										</a>
									</figure>
								<?php endif; ?>

								<h1 class="entry-title"><a title="<?php echo esc_attr(sprintf( __('Permanent link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

								<div class="entry-excerpt">
									<?php ci_e_content(); ?>
								</div>
							</article>
						<?php endwhile; endif; ?>

						<?php ci_pagination(); ?>
					</div>

					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>