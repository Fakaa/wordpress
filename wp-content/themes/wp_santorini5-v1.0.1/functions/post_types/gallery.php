<?php
//
// Gallery Post Type related functions.
//
add_action( 'init', 'ci_create_cpt_galleries' );

if( !function_exists('ci_create_cpt_galleries') ):
function ci_create_cpt_galleries()
{
	$labels = array(
		'name' => _x('Galleries', 'post type general name', 'ci_theme'),
		'singular_name' => _x('Gallery', 'post type singular name', 'ci_theme'),
		'add_new' => __('Add New', 'ci_theme'),
		'add_new_item' => __('Add New Gallery', 'ci_theme'),
		'edit_item' => __('Edit Gallery', 'ci_theme'),
		'new_item' => __('New Gallery', 'ci_theme'),
		'view_item' => __('View Gallery', 'ci_theme'),
		'search_items' => __('Search Galleries', 'ci_theme'),
		'not_found' =>  __('No Galleries found', 'ci_theme'),
		'not_found_in_trash' => __('No Galleries found in the trash', 'ci_theme'),
		'parent_item_colon' => __('Parent Gallery:', 'ci_theme')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Gallery', 'ci_theme'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'gallery'),
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'gallery' , $args );

}
endif;

add_action( 'load-post.php', 'galleries_meta_boxes_setup' );
add_action( 'load-post-new.php', 'galleries_meta_boxes_setup' );

if( !function_exists('galleries_meta_boxes_setup') ):
function galleries_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'galleries_add_meta_boxes' );
	add_action( 'save_post', 'galleries_save_meta', 10, 2 );
}
endif;

if( !function_exists('galleries_add_meta_boxes') ):
function galleries_add_meta_boxes() {
	add_meta_box( 'galleries-box', __( 'Gallery Settings', 'ci_theme' ), 'galleries_score_meta_box', 'gallery', 'normal', 'high' );
}
endif;

if( !function_exists('galleries_score_meta_box') ):
function galleries_score_meta_box( $object, $box )
{
	ci_prepare_metabox('gallery');

	?><p><?php _e('You can create a gallery by pressing the "Add Images" button below. You should also set a featured image that will be used as this Gallery\'s cover.', 'ci_theme'); ?></p><?php

	ci_metabox_gallery();

	$opts = array(
		'col-md-4' => __('3 Columns', 'ci_theme'),
		'col-md-3 col-sm-6' => __('4 Columns', 'ci_theme')
	);
	ci_metabox_dropdown('ci_gallery_columns', $opts, __('Number of columns to display this gallery in:', 'ci_theme'));

}
endif;

if( !function_exists('galleries_save_meta') ):
function galleries_save_meta( $post_id, $post ) {

	if ( !ci_can_save_meta('gallery') ) return;

	// We apply sanitize_html_class() to each class token separately, since we need to preserve spaces.
	update_post_meta($post->ID, 'ci_gallery_columns', implode(' ', array_map('sanitize_html_class', explode(' ', $_POST['ci_gallery_columns']))) );
	ci_metabox_gallery_save($_POST);
}
endif;
?>