<?php get_header(); ?>
<?php
	global $wp_query;

	$found = $wp_query->post_count > $wp_query->found_posts ? $wp_query->post_count : $wp_query->found_posts;
	$none = __('No results found. Please broaden your terms and search again.', 'ci_theme');
	$one = __('Just one result found. We either nailed it, or you might want to broaden your terms and search again.', 'ci_theme');
	$many = sprintf(__("%d results found.", 'ci_theme'), $found);
?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<h2 class="page-title"><?php _e('Search Results', 'ci_theme'); ?></h2>

				<div class="row">
					<div class="col-sm-8">

						<div class="search-notice">
							<h3><?php ci_e_inflect($found, $none, $one, $many); ?></h3>
							<?php if($found==0): ?>
								<div class="widget_search">
									<?php get_search_form(); ?>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="entry-thumb">
										<a title="<?php echo esc_attr(sprintf( __('Permanent Link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('ci_featured_single'); ?>
										</a>
									</figure>
								<?php endif; ?>

								<h1 class="entry-title"><a title="<?php echo esc_attr(sprintf( __('Permanent link to: %s', 'ci_theme'), get_the_title() )); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

								<div class="entry-excerpt">
									<?php the_excerpt(); ?>
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