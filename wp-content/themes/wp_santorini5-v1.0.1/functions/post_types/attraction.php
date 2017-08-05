<?php
//
// Attraction Post Type related functions.
//
add_action( 'init', 'ci_create_cpt_attractions' );

if( !function_exists('ci_create_cpt_attractions') ):
function ci_create_cpt_attractions()
{
	$labels = array(
		'name' => _x('Attractions', 'post type general name', 'ci_theme'),
		'singular_name' => _x('Attraction', 'post type singular name', 'ci_theme'),
		'add_new' => __('Add New', 'ci_theme'),
		'add_new_item' => __('Add New Attraction', 'ci_theme'),
		'edit_item' => __('Edit Attraction', 'ci_theme'),
		'new_item' => __('New Attraction', 'ci_theme'),
		'view_item' => __('View Attraction', 'ci_theme'),
		'search_items' => __('Search Attractions', 'ci_theme'),
		'not_found' =>  __('No Attractions found', 'ci_theme'),
		'not_found_in_trash' => __('No Attractions found in the trash', 'ci_theme'),
		'parent_item_colon' => __('Parent Attraction:', 'ci_theme')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Attraction', 'ci_theme'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'attraction'),
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'attraction' , $args );

}
endif;

add_action( 'load-post.php', 'attractions_meta_boxes_setup' );
add_action( 'load-post-new.php', 'attractions_meta_boxes_setup' );

if( !function_exists('attractions_meta_boxes_setup') ):
function attractions_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'attractions_add_meta_boxes' );
	add_action( 'save_post', 'attractions_save_meta', 10, 2 );
}
endif;

if( !function_exists('attractions_add_meta_boxes') ):
function attractions_add_meta_boxes() {
	add_meta_box( 'attractions-box', __( 'Attraction Details', 'ci_theme' ), 'attractions_score_meta_box', 'attraction', 'normal', 'high' );
}
endif;

if( !function_exists('attractions_score_meta_box') ):
function attractions_score_meta_box( $object, $box )
{
	ci_prepare_metabox('attraction');

	?><p><?php _e('You can create a gallery by pressing the "Add Images" button below. You should also set a featured image that will be used as this Attraction\'s cover.', 'ci_theme'); ?></p><?php
	ci_metabox_gallery();
}
endif;

if( !function_exists('attractions_save_meta') ):
function attractions_save_meta( $post_id, $post ) {

	if ( !ci_can_save_meta('attraction') ) return;

	ci_metabox_gallery_save($_POST);
}
endif;
?>