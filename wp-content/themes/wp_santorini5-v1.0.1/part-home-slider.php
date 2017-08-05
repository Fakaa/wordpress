<?php
	$slideshow = new WP_Query( array(
		'post_type'=>'slider',
		'posts_per_page' => -1
	));
?>

<?php if ( $slideshow->have_posts() ) : ?>
<div id="slider" class="flexslider">
	<ul class="slides">
		<?php while ( $slideshow->have_posts() ) : $slideshow->the_post(); ?>
			<?php
				if ( is_page_template('template-homepage-1.php') ) {
					$img = ci_get_featured_image_src('ci_slider_full');
				} else {
					$img = ci_get_featured_image_src('ci_slider_fixed');
				}

				$url = get_post_meta( $post->ID, 'ci_cpt_slider_url', true );
				$subtitle = get_post_meta( $post->ID, 'ci_cpt_slider_subtitle', true );
				$button_text = get_post_meta( $post->ID, 'ci_cpt_button_text', true );
				$url = !empty($url) ? $url : get_permalink();
			?>
			<li style="background: url('<?php echo $img; ?>') no-repeat center center">
				<div class="slide-info">
					<h2 class="slide-title"><?php the_title(); ?></h2>
					<?php if ( !empty($subtitle) ) : ?>
					<p class="slide-subtitle"><?php echo $subtitle; ?></p>
					<?php endif; ?>

					<?php if ( !empty($button_text) ) : ?>
					<a class="btn slide-more" href="<?php echo $url; ?>"><?php echo $button_text; ?></a>
					<?php endif; ?>
				</div>
			</li>
		<?php endwhile; ?>
	</ul>
</div> <!-- #slider -->
<?php endif; wp_reset_postdata(); ?>