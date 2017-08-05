<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_color_options', 40);
	if( !function_exists('ci_add_tab_color_options') ):
		function ci_add_tab_color_options($tabs)
		{
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Appearance Options', 'ci_theme');
			return $tabs;
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	load_panel_snippet('custom_background');
	load_panel_snippet('color_scheme');
	$ci_defaults['default_header_bg'] = ''; // Holds the URL of the image file to use as header background
	$ci_defaults['booking_form_bg'] = ''; // Holds the URL of the image file to use as header background

	// If the user hasn't selected an image for the header background or is using the second frontpage template we need to add a class to the body element
	add_filter('body_class', 'ci_body_alt_class');
	if ( !function_exists('ci_body_alt_class') ) {
		function ci_body_alt_class($classes) {
			if ( ( !is_page_template('template-homepage-1.php') ) AND ( is_page_template('template-homepage-2.php') OR ci_setting('default_header_bg') == '' ) ) {
				$classes[] = 'alt';
			} else {
				$class[] = '';
			}
			return $classes;
		}
	}

	add_action('wp_head', 'ci_secondary_backgrounds', 101);
	if ( !function_exists('ci_secondary_backgrounds') ) {
		function ci_secondary_backgrounds() {
			$output = '';

			if ( ci_setting('default_header_bg') OR ci_setting('booking_form_bg') ) {
				$output = '<style type="text/css" media="screen">';
				if ( ci_setting('default_header_bg') AND !is_page_template('template-homepage-1.php') ) {
					$output .= '#header { background: url("' . esc_url(ci_setting('default_header_bg')) . '") no-repeat center top; }';
				}
				if ( ci_setting('default_header_bg') ) {
					$output .= '.booking-inpage { background: url("' . esc_url(ci_setting('booking_form_bg')) . '") no-repeat center center; }';
					$output .= '@media screen and ( max-width: 767px ) { .booking-wrap { background: url("' . esc_url(ci_setting('booking_form_bg')) . '") no-repeat center top; } }';
				}
				$output .= '</style>';
			}

			echo $output;
		}
	}
?>
<?php else: ?>

	<?php load_panel_snippet('color_scheme'); ?>

	<fieldset class="set">
		<legend><?php _e('Header Display', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('Upload or select an image to be used as the default header background on your header. This will be displayed in all your inner pages except for the frontpage template with the full width slider. This is entirely optional. For best results, use a high resolution image, at least 1920x230 pixels in size.', 'ci_theme'); ?></p>
		<?php ci_panel_upload_image('default_header_bg', __('Upload an image:', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<legend><?php _e('Booking Form', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('Upload or select an image to be used as the background of your booking form in the inner pages. This is entirely optional. If you leave this empty the default color will appear as a background. For best results, use a high resolution image, at least 1920x350 pixels in size.', 'ci_theme'); ?></p>
		<?php ci_panel_upload_image('booking_form_bg', __('Upload an image:', 'ci_theme')); ?>
	</fieldset>

	<?php load_panel_snippet('custom_background'); ?>

<?php endif; ?>