<div class="col-sm-4">
	<div class="sidebar">

		<?php if ( get_post_type() == 'room' ) : ?>

			<?php
				$current_room = get_the_ID();
				$rooms = new WP_Query('post_type=room&posts_per_page=-1');
			?>
			<ul class="room-nav">

				<?php while ( $rooms->have_posts() ) : $rooms->the_post(); ?>
				<?php
					$class = (get_the_ID() == $current_room ? 'current-room' : '');
				?>
				<li><a class="<?php echo $class; ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; wp_reset_postdata(); ?>
			</ul>

		<?php endif; ?>
		<?php
			if ( is_home() or is_singular('post') ) {
				dynamic_sidebar('blog-sidebar');
			} else if ( is_singular('room') ) {
				dynamic_sidebar('room-sidebar');
			} else if ( is_singular('service') OR ( is_page_template('template-service-listing.php') ) ) {
				dynamic_sidebar('service-sidebar');
			} else if ( is_singular('attraction') OR is_page_template('template-attractions-listing-3col.php') OR is_page_template('template-attractions-listing-4col.php') ) {
				dynamic_sidebar('attraction-sidebar');
			} else if ( is_page_template('template-contact.php') ) {
				dynamic_sidebar('sidebar-contact');
			} else if ( is_page() ) {
				dynamic_sidebar('page-sidebar');
			} else {
				dynamic_sidebar('blog-sidebar');
			}
		?>
	</div>
</div>