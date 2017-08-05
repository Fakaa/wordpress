<?php
//
// Room Post Type related functions.
//
add_action('init', 'ci_create_cpt_room');
add_action('admin_init', 'ci_add_cpt_room_meta');
add_action('save_post', 'ci_update_cpt_room_meta');

if( !function_exists('ci_create_cpt_room') ):
function ci_create_cpt_room()
{
	$labels = array(
		'name' => _x('Rooms', 'post type general name', 'ci_theme'),
		'singular_name' => _x('Room', 'post type singular name', 'ci_theme'),
		'add_new' => __('New Room', 'ci_theme'),
		'add_new_item' => __('Add New Room', 'ci_theme'),
		'edit_item' => __('Edit Room', 'ci_theme'),
		'new_item' => __('New Room', 'ci_theme'),
		'view_item' => __('View Room', 'ci_theme'),
		'search_items' => __('Search Rooms', 'ci_theme'),
		'not_found' =>  __('No Rooms found', 'ci_theme'),
		'not_found_in_trash' => __('No Rooms found in the trash', 'ci_theme'), 
		'parent_item_colon' => __('Parent Room:', 'ci_theme')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Room', 'ci_theme'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => true,
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
		//'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats') 
	);

	register_post_type( 'room' , $args );
}
endif;

if( !function_exists('ci_add_cpt_room_meta') ):
function ci_add_cpt_room_meta()
{
	add_meta_box("ci_cpt_room_meta", __('Room Details', 'ci_theme'), "ci_add_cpt_room_meta_box", "room", "normal", "high");
}
endif;

if( !function_exists('ci_update_cpt_room_meta') ):
function ci_update_cpt_room_meta($post_id) {

	if ( !ci_can_save_meta('room') ) return;

	$amenities = count($_POST["ci_cpt_room_amenities"]) > 0 ? $_POST["ci_cpt_room_amenities"] : array();
	$amenities = array_map('sanitize_text_field', $amenities);
	update_post_meta($post_id, "ci_cpt_room_amenities", $amenities);

	update_post_meta($post_id, "ci_cpt_room_from", sanitize_text_field($_POST["ci_cpt_room_from"]) );
	update_post_meta($post_id, "ci_cpt_room_offer", ci_sanitize_checkbox($_POST["ci_cpt_room_offer"], 'enabled') );
	update_post_meta($post_id, "ci_cpt_room_amenities_title", sanitize_text_field($_POST["ci_cpt_room_amenities_title"]) );

	ci_metabox_gallery_save($_POST);

}
endif;

if( !function_exists('ci_add_cpt_room_meta_box') ):
function ci_add_cpt_room_meta_box($post)
{
	ci_prepare_metabox('room');

	?>
	<h2><?php _e('Room Gallery', 'ci_theme'); ?></h2>

	<div class="inside">
		<p><?php _e('You can create a featured gallery by pressing the "Add Images" button below. You should also set a featured image that will be used as this Gallery\'s cover.', 'ci_theme'); ?></p>
		<?php ci_metabox_gallery(); ?>
	</div>

	<h2><?php _e('Amenities', 'ci_theme'); ?></h2>
	<p><?php _e('Provide the amenities of the room. Select <b>Add Field</b> as many times as you want to create a list of amenities. You can delete one by clicking on its <b>Remove me</b> link next to it. You may also click and drag the fields to re-arrange them.' , 'ci_theme'); ?></p>
	<p>
		<?php 
			$amenities_title = get_post_meta($post->ID, 'ci_cpt_room_amenities_title', true);
			$amenities_title = !empty($amenities_title) ? $amenities_title : __('Amenities', 'ci_theme');
		?>
		<label for="ci_cpt_room_amenities_title"><?php _e("Amenities' title:", 'ci_theme'); ?></label>
		<input type="text" id="ci_cpt_room_amenities_title" name="ci_cpt_room_amenities_title" value="<?php echo esc_attr($amenities_title); ?>" />
	</p>
	<fieldset class="amenities">
		<div class="inside">
			<?php
				$fields = get_post_meta($post->ID, 'ci_cpt_room_amenities', true);
				if (!empty($fields)) 
				{
					for( $i = 0; $i < count($fields); $i++ )
					{
						echo '<p class="amenities-field"><input type="text" name="ci_cpt_room_amenities[]" value="'. esc_attr($fields[$i]) .'" /> <a href="#" class="button amenities-remove">' . __('Remove me', 'ci_theme') . '</a></p>';
					}
				}
			?>
		</div>
		<a href="#" id="amenities-add-field" class="button"><?php _e('Add Field', 'ci_theme'); ?></a>
	</fieldset>

	<h2><?php _e('Room offers', 'ci_theme'); ?></h2>
	<?php
	ci_metabox_input('ci_cpt_room_from', __('Room starting price. Include currency symbol and any textual e.g. $99 / day.', 'ci_theme'));
	ci_metabox_checkbox('ci_cpt_room_offer', 'enabled', __('Room is on offer.', 'ci_theme'));

}
endif;

//
// Room post type custom admin list
//
add_filter("manage_edit-room_columns", "ci_cpt_room_edit_columns");  

if( !function_exists('ci_cpt_room_edit_columns') ):
function ci_cpt_room_edit_columns($columns){  
	$c = array(  
		"cb" => $columns['cb'],
		"title" => $columns['title'],
		"taxonomy-room_category" => __('Categories', 'ci_theme'),
		"date" => $columns['date']
	);
	
	return $c;
}
endif;

?>