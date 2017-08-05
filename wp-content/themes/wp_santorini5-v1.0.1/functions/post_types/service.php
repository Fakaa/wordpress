<?php
//
// Service Post Type related functions.
//
add_action('init', 'ci_create_cpt_service');

if( !function_exists('ci_create_cpt_service') ):
function ci_create_cpt_service()
{
	$labels = array(
		'name' => _x('Services', 'post type general name', 'ci_theme'),
		'singular_name' => _x('Service', 'post type singular name', 'ci_theme'),
		'add_new' => __('New Service', 'ci_theme'),
		'add_new_item' => __('Add New Service', 'ci_theme'),
		'edit_item' => __('Edit Service', 'ci_theme'),
		'new_item' => __('New Service', 'ci_theme'),
		'view_item' => __('View Service', 'ci_theme'),
		'search_items' => __('Search Services', 'ci_theme'),
		'not_found' =>  __('No Services found', 'ci_theme'),
		'not_found_in_trash' => __('No Services found in the trash', 'ci_theme'),
		'parent_item_colon' => __('Parent Service:', 'ci_theme')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Service', 'ci_theme'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => true,
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'service' , $args );
}
endif;