<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<div class="row">
						<div class="col-sm-8">
							<article class="entry">

								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="entry-thumb">
										<a data-rel="prettyPhoto" href="<?php echo ci_get_featured_image_src($post->ID); ?>">
											<?php the_post_thumbnail('ci_blog_thumb'); ?>
										</a>
									</figure>
								<?php endif; ?>

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