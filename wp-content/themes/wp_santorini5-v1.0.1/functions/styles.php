<?php
add_action('init', 'ci_register_theme_styles');
if( !function_exists('ci_register_theme_styles') ):
function ci_register_theme_styles() {
	//
	// Register all front-end and admin styles here. 
	// There is no need to register them conditionally, as the enqueueing can be conditional.
	//
	wp_register_style('google-font', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic|Montserrat:400,700');
	wp_register_style('ci-flexslider', get_child_or_parent_file_uri('/css/flexslider.css'));
	wp_register_style('font-awesome', get_child_or_parent_file_uri('/css/font-awesome.css'));
	wp_register_style('weather-icons', get_child_or_parent_file_uri('/css/weather-icons.css'));
	wp_register_style('ci-bootstrap', get_child_or_parent_file_uri('/css/bootstrap.css'));
	wp_register_style('jquery-ui', get_child_or_parent_file_uri('/css/jquery-ui-1.10.4.datepicker.min.css'));
	wp_register_style('prettyPhoto', get_child_or_parent_file_uri('/css/prettyPhoto.css'));
	wp_register_style('mmenu', get_child_or_parent_file_uri('/css/mmenu.css'));
	wp_register_style('ci-mediaqueries', get_child_or_parent_file_uri('/css/mediaqueries.css'));
	wp_register_style('ci-color-scheme', get_child_or_parent_file_uri('/colors/'.ci_setting('stylesheet')));
	wp_register_style('ci-post-edit-screens', get_child_or_parent_file_uri('/css/admin/post-edit-screens.css'), array(), CI_THEME_VERSION);

	wp_register_style('ci-style', get_stylesheet_uri(), 
		array(
			'google-font',
			'font-awesome',
			'weather-icons',
			'ci-flexslider',
			'ci-bootstrap',
			'prettyPhoto',
			'mmenu',
			'jquery-ui'
		), CI_THEME_VERSION, 'screen');

}
endif;


add_action('wp_enqueue_scripts', 'ci_enqueue_theme_styles');
if( !function_exists('ci_enqueue_theme_styles') ):
function ci_enqueue_theme_styles() {
	//
	// Enqueue all (or most) front-end styles here.
	//	
	wp_enqueue_style('ci-style');
	wp_enqueue_style('ci-mediaqueries');
	wp_enqueue_style('ci-color-scheme');	
}
endif;


if( !function_exists('ci_enqueue_admin_theme_styles') ):
add_action('admin_enqueue_scripts','ci_enqueue_admin_theme_styles');
function ci_enqueue_admin_theme_styles() {
	global $pagenow;

	//
	// Enqueue here styles that are to be loaded on all admin pages.
	//

	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here styles that are to be loaded only on CSSIgniter Settings panel.
		//

	}
}
endif;

?>