
<?php $setting = roark_blog::roark_blog_setting(); ?>

<article  id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
						
	<div class="post-media">

		<?php 

			if( !is_single() ) {

				if( has_post_thumbnail() ) : ?>
					<div class="image">
						<?php $size = $setting['blog'] == 'blog-standard' ? array(1200, 480) : array(500, 425); ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail($size); ?>
						</a>
					</div>
				<?php endif;

				roark_blog::roark_meta_date(); 

			} else {

				if(shortcode_exists('wiloke_post_format_shortcode')) {
					do_shortcode('[wiloke_post_format_shortcode]');
				} else { ?>
					<div class="image">
						<?php the_post_thumbnail('large'); ?>
					</div>
				<?php }
			}

		?>

	</div>

	<div class="post-entry">

		<?php if( is_single() ) : ?>
			<h1 class="h5 entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h2 class="h5 entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>

		<div class="entry-meta">
		
		 	<?php
				roark_blog::roark_meta_author();
				if( is_single() ) { roark_blog::roark_meta_date(); }
				roark_blog::roark_meta_cat();
				roark_blog::roark_meta_comment();
			?>

		</div>

		<div class="entry-content">
			<?php 
				if( is_single() ) {
					the_content();

					wp_link_pages( array(
					    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'roark' ) . '</span>',
					    'after'       => '</div>',
					    'link_before' => '<span>',
					    'link_after'  => '</span>',
					    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'roark' ) . ' </span>%',
					    'separator'   => '<span class="screen-reader-text">, </span>',
				   	) );
				} else {
					echo roark_blog::roark_excerpt_length();
				}
			?>
		</div>

	</div>

	<?php if( $setting['blog'] == 'blog-standard' && !is_single() ) :  ?>
		<div class="post-footer">
			<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__('Read more', 'roark'); ?></a>
		</div>
	<?php endif; ?>

	<?php if( is_single() ) { 
		do_action('roark_post_single_footer');
		roark_blog::roark_blog_related();
		comments_template(); 
	} ?>
	
</article>