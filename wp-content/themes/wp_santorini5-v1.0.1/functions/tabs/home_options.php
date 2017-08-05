<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_homepage_options', 20);
	if( !function_exists('ci_add_tab_homepage_options') ):
		function ci_add_tab_homepage_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Homepage Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	load_panel_snippet('slider_flexslider');
	$ci_defaults['show_homepage_blogpost'] = 'on';
	$ci_defaults['show_homepage_blogpost_title'] = __('Our News', 'ci_theme');
	$ci_defaults['show_homepage_blogpost_count'] = 1;

?>
<?php else: ?>

	<?php load_panel_snippet('slider_flexslider'); ?>

	<fieldset class="set">
		<legend><?php _e('News section', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('You can configure if and how the News sections appears in the bottom area of your homepage.', 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('show_homepage_blogpost', 'on', __('Show the News section.', 'ci_theme')); ?>
		<?php ci_panel_input('show_homepage_blogpost_title', __('Title:', 'ci_theme')); ?>
		<?php ci_panel_input('show_homepage_blogpost_count', __('Number of blog posts:', 'ci_theme')); ?>
	</fieldset>

<?php endif; ?>