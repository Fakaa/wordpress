<?php
	get_template_part('panel/constants');

	load_theme_textdomain( 'ci_theme', get_template_directory() . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
	if ( ! isset( $content_width ) ) $content_width = 700;

	//
	// Let's bootstrap the theme.
	//
	get_template_part('panel/bootstrap');

	//
	// Define our various image sizes.
	// Notice: Changing the below values requires running a thumbnail regeneration
	// plugin such as "Regenerate Thumbnails" (http://wordpress.org/plugins/regenerate-thumbnails/)
	// in order for the new dimensions to take effect.
	//
	add_theme_support( 'post-thumbnails' );
	add_image_size('ci_blog_thumb', 700, 400, true);
	add_image_size('ci_slider_full', 1920, 850, true);
	add_image_size('ci_slider_fixed', 950, 640, true);
	add_image_size('ci_thumb', 700, 865, true);
	add_image_size('ci_fullwidth', 925, 465, true);

	// Enable prettyPhoto on embedded images
	add_filter('the_content', 'ci_prettyPhotoRel', 12);
	add_filter('get_comment_text', 'ci_prettyPhotoRel');
	add_filter('wp_get_attachment_link', 'ci_prettyPhotoRel');
	if( !function_exists('ci_prettyPhotoRel') ):
		function ci_prettyPhotoRel($content)
		{
			global $post;
			$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";

			$replacement = '<a$1href=$2$3.$4$5 data-rel="prettyPhoto['.$post->ID.']"$6>$7</a>';

			$content = preg_replace($pattern, $replacement, $content);
			return $content;
		}
	endif;

	//Responsivize embedded videos
	add_filter('embed_oembed_html', 'ci_embed_oembed_html', 99, 4);
	function ci_embed_oembed_html($html, $url, $attr, $post_id) {
		return '<div class="video-wrap">' . $html . '</div>';
	}

	// Let the user choose a color scheme on each post individually.
	add_ci_theme_support('post-color-scheme', array('page', 'post', 'room', 'gallery'));

	if( !function_exists('ci_footer_logo')):
	/**
	 * Returns the footer logo.
	 */
	function ci_footer_logo($before="", $after=""){
		$snippet = $before;

		$snippet .= '<a href="'.home_url().'">';

		if(ci_setting('footer_logo')){
			$snippet .= '<img src="'.ci_setting('footer_logo').'" alt="'.get_bloginfo('name').'" />';
		}
		else{
			$snippet .= get_bloginfo('name');
		}

		$snippet .= '</a>';

		$snippet .= $after;

		return $snippet;
	}
	endif;

	if( !function_exists('ci_theme_show_newsletter_widget') ):
	/**
	 * Outputs a newsletter form
	 *
	 * @access public
	 * @param array $atts
	 * @return string
	 */
	function ci_theme_show_newsletter_widget($atts)
	{
		extract(shortcode_atts( array(
			'title' => '',
			'description' => '',
			'button_text' => __('Subscribe', 'ci_theme')
		), $atts ));


		ob_start();

		if(ci_setting('newsletter_action')!=''):
			?>
			<div class="widget ci-newsletter bg bs">
				<?php if( !empty($title) ): ?>
					<h3><?php echo $title; ?></h3>
				<?php endif; ?>
				<?php if( !empty($description) ): ?>
					<?php echo wpautop($description); ?>
				<?php endif; ?>

				<form class="ci-newsletter" action="<?php ci_e_setting('newsletter_action'); ?>">
					<p>
						<input type="email" id="<?php ci_e_setting('newsletter_email_id'); ?>" name="<?php ci_e_setting('newsletter_email_name'); ?>" placeholder="<?php echo esc_attr(__('Your Email', 'ci_theme')); ?>">
						<button type="submit"><i class="fa fa-chevron-right"></i></button>
					</p>
					<?php
						$fields = ci_setting('newsletter_hidden_fields');
						if(is_array($fields) and count($fields) > 0)
						{
							for( $i = 0; $i < count($fields); $i+=2 )
							{
								if(empty($fields[$i]))
									continue;
								echo '<input type="hidden" name="'.esc_attr($fields[$i]).'" value="'.esc_attr($fields[$i+1]).'" />';
							}
						}
					?>
				</form>
			</div>
			<?php
		endif;

		$output = ob_get_clean();
		return $output;
	}
	endif;
