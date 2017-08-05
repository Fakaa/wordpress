<?php
/*
* Template Name: Fullwidth Page
*/
?>
<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 full">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<div class="row">
						<div class="col-xs-12">
							<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
								<?php if ( ci_has_image_to_show() ) : ?>
									<figure class="entry-thumb">
										<a data-rel="prettyPhoto" href="<?php echo ci_get_featured_image_src($post->ID); ?>">
											<?php ci_the_post_thumbnail_full(); ?>
										</a>
									</figure>
								<?php endif; ?>

								<div class="entry-content">
									<?php the_content(); ?>
								</div>

								<div id="comments">
									<?php comments_template(); ?>
								</div>
							</article>
						</div>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>