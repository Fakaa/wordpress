<?php
//
// Slider Post Type related functions.
//
add_action( 'init', 'ci_create_cpt_slider' );
add_action( 'admin_init', 'ci_add_cpt_slider_meta' );
add_action( 'save_post', 'ci_update_cpt_slider_meta' );

if( !function_exists('ci_create_cpt_slider') ):
function ci_create_cpt_slider()
{
	$labels = array(
		'name' => _x('Slides', 'post type general name', 'ci_theme'),
		'singular_name' => _x('Slide', 'post type singular name', 'ci_theme'),
		'add_new' => __('New Slide', 'ci_theme'),
		'add_new_item' => __('Add New Slide', 'ci_theme'),
		'edit_item' => __('Edit Slide', 'ci_theme'),
		'new_item' => __('New Slide', 'ci_theme'),
		'view_item' => __('View Slide', 'ci_theme'),
		'search_items' => __('Search Slides', 'ci_theme'),
		'not_found' =>  __('No Slides found', 'ci_theme'),
		'not_found_in_trash' => __('No Slides found in the trash', 'ci_theme'),
		'parent_item_colon' => __('Parent Slide:', 'ci_theme')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Slide', 'ci_theme'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => false,
		'rewrite' => true,
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
		//'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats') 
	);

	register_post_type( 'slider' , $args );
}
endif;

if( !function_exists('ci_add_cpt_slider_meta') ):
function ci_add_cpt_slider_meta()
{
	add_meta_box( "ci_cpt_slider_meta", __( 'Slider Details', 'ci_theme' ), "ci_add_cpt_slider_meta_box", "slider", "normal", "high" );
}
endif;

if( !function_exists('ci_update_cpt_slider_meta') ):
function ci_update_cpt_slider_meta( $post_id )
{
	if ( !ci_can_save_meta('slider') ) return;

	update_post_meta( $post_id, "ci_cpt_slider_url", esc_url_raw($_POST["ci_cpt_slider_url"]) );
	update_post_meta( $post_id, "ci_cpt_slider_subtitle", sanitize_text_field($_POST["ci_cpt_slider_subtitle"]) );
	update_post_meta( $post_id, "ci_cpt_button_text", sanitize_text_field($_POST["ci_cpt_button_text"]) );

}
endif;

if( !function_exists('ci_add_cpt_slider_meta_box') ):
function ci_add_cpt_slider_meta_box($post)
{
	ci_prepare_metabox('slider');

	ci_metabox_input('ci_cpt_slider_subtitle', __('Enter the subtitle of your slide, displayed under the title', 'ci_theme'));
	ci_metabox_input('ci_cpt_slider_url', __( 'Set a URL below to redirect the user, when the "Read More" button of this slide gets clicked. Leaving the URL blank, will redirect to the slider\'s own content.', 'ci_theme'), array('esc_func' => 'esc_url'));
	ci_metabox_input('ci_cpt_button_text', __('Enter the text of the "Read More" slide button', 'ci_theme'));

}
endif;

?>