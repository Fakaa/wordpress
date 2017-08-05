<?php
//
// Uncomment one of the following two. Their functions are in panel/generic.php
//
add_action('wp_enqueue_scripts', 'ci_enqueue_modernizr');
//add_action('wp_enqueue_scripts', 'ci_print_html5shim');

// This function lives in panel/generic.php
add_action('wp_footer', 'ci_print_selectivizr', 100);


add_action('init', 'ci_register_theme_scripts');
if ( !function_exists('ci_register_theme_scripts') ) :
function ci_register_theme_scripts() {
	//
	// Register all scripts here, both front-end and admin. 
	// There is no need to register them conditionally, as the enqueueing can be conditional.
	//

	$key = '';
	if(ci_setting('google_maps_api_key'))	{
		$key='key=' . ci_setting('google_maps_api_key') . '&';
	}
	$google_url = "http://maps.googleapis.com/maps/api/js?" . $key . "sensor=false";
	wp_register_script('ci-google-maps-api-3', $google_url, array(), null, false);

	wp_register_script('jquery-superfish', get_child_or_parent_file_uri('/js/superfish.min.js'), array('jquery'), false, true);
	wp_register_script('jquery-flexslider', get_child_or_parent_file_uri('/js/jquery.flexslider-min.js'), array('jquery'), false, true);
	wp_register_script('jquery-mmenu', get_child_or_parent_file_uri('/js/jquery.mmenu.min.js'), array('jquery'), false, true);
	wp_register_script('jquery-dropkick', get_child_or_parent_file_uri('/js/jquery.dropkick-min.js'), array('jquery'), false, true);
	wp_register_script('jquery-prettyPhoto', get_child_or_parent_file_uri('/js/jquery.prettyPhoto.js'), array('jquery'), false, true);
	wp_register_script('jquery-fitvids', get_child_or_parent_file_uri('/js/jquery.fitvids.js'), array('jquery'), false, true);

	wp_register_script('ci-post-edit-scripts', get_child_or_parent_file_uri('/js/admin/post-edit-screens.js'), array('jquery'), CI_THEME_VERSION, true);
	wp_register_script('ci-admin-widgets', get_child_or_parent_file_uri('/js/admin/admin-widgets.js'), 'jquery', false, true);

	wp_register_script('ci-front-scripts', get_child_or_parent_file_uri('/js/scripts.js'),
		array(
			'jquery',
			'jquery-ui-core',
			'jquery-ui-datepicker',
			'jquery-superfish',
			'jquery-flexslider',
			'jquery-mmenu',
			'jquery-fitvids',
			'jquery-dropkick',
			'jquery-prettyPhoto',
			'ci-google-maps-api-3'
		),
		CI_THEME_VERSION, true);
}
endif;



add_action('wp_enqueue_scripts', 'ci_enqueue_theme_scripts');
if( !function_exists('ci_enqueue_theme_scripts') ):
function ci_enqueue_theme_scripts() {
	//
	// Enqueue all (or most) front-end scripts here.
	// They can be also enqueued from within template files.
	//	
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script('ci-front-scripts');

	//
	// Map options export for ci-front-scripts
	//
	$coords = explode(',', ci_setting('map_coords'));
	$params['map_zoom_level'] = ci_setting('map_zoom_level');
	$params['map_coords_lat'] = $coords[0];
	$params['map_coords_long'] = $coords[1];
	$params['map_tooltip'] = ci_setting('map_tooltip');

	$params['weather_code'] = (string)ci_setting('weather_code');
	$params['weather_unit'] = (string)ci_setting('weather_unit');

	$params['slider_autoslide'] = ci_setting('slider_autoslide')=='enabled' ? true : false;
	$params['slider_effect'] = ci_setting('slider_effect');
	$params['slider_direction'] = ci_setting('slider_direction');
	$params['slider_duration'] = (string)ci_setting('slider_duration');
	$params['slider_speed'] = (string)ci_setting('slider_speed');

	wp_localize_script('ci-front-scripts', 'ThemeOption', $params);
	
}
endif;


if( !function_exists('ci_enqueue_admin_theme_scripts') ):
add_action('admin_enqueue_scripts','ci_enqueue_admin_theme_scripts');
function ci_enqueue_admin_theme_scripts() 
{
	global $pagenow;

	//
	// Enqueue here scripts that are to be loaded on all admin pages.
	//

	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here scripts that are to be loaded only on CSSIgniter Settings panel.
		//
		wp_enqueue_script('ci-panel-scripts');

	}

	if ( is_admin() and $pagenow == 'widgets.php' ) {
		wp_enqueue_script('ci-admin-widgets');

		$params['no_posts_found'] = __('No posts found.', 'ci_theme');
		$params['ajaxurl'] = admin_url( 'admin-ajax.php' );

		wp_localize_script('ci-admin-widgets', 'ThemeWidget', $params);
	}
}
endif;

?>