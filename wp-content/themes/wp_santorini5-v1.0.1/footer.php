	<?php $exclude_booking = array('template-booking.php', 'template-homepage-1.php', 'template-homepage-2.php'); ?>
	<?php if ( ci_setting('booking_form_page') and ( !in_array(get_page_template_slug(), $exclude_booking) ) ) : ?>
		<div class="booking-inpage">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 col-lg-offset-1">
						<?php get_template_part('part', 'booking-form'); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<hr>
					<nav class="nav row">
						<div class="col-sm-5">
							<?php
								if ( has_nav_menu('ci_footer_menu_left') ) {
									wp_nav_menu( array(
										'theme_location' 	=> 'ci_footer_menu_left',
										'fallback_cb' 		=> '',
										'container' 		=> '',
										'menu_id' 			=> '',
										'menu_class' 		=> 'navigation left-nav',
										'depth' => 1
									));
								} else {
									wp_nav_menu( array(
										'theme_location' 	=> 'ci_main_menu_left',
										'fallback_cb' 		=> '',
										'container' 		=> '',
										'menu_id' 			=> '',
										'menu_class' 		=> 'navigation left-nav',
										'depth' => 1
									));
								}
							?>
						</div>

						<div class="col-sm-2">
							<?php echo ci_footer_logo('<div class="logo">', '</div>'); ?>
						</div>

						<div class="col-sm-5">
							<?php
								if ( has_nav_menu('ci_footer_menu_right') ) {
									wp_nav_menu( array(
										'theme_location' 	=> 'ci_footer_menu_right',
										'fallback_cb' 		=> '',
										'container' 		=> '',
										'menu_id' 			=> '',
										'menu_class' 		=> 'navigation right-nav',
										'depth' => 1
									));
								} else {
									wp_nav_menu( array(
										'theme_location' 	=> 'ci_main_menu_right',
										'fallback_cb' 		=> '',
										'container' 		=> '',
										'menu_id' 			=> '',
										'menu_class' 		=> 'navigation right-nav',
										'depth' => 1
									));
								}
							?>
						</div>
					</nav>
					<p class="credits"><?php echo ci_footer(); ?></p>
				</div>
			</div>
		</div>
	</footer>
</div> <!-- #page -->

<?php wp_footer(); ?>
</body>
</html>