<?php 
if( !class_exists('CI_Book_Room') ):
class CI_Book_Room extends WP_Widget {

	function CI_Book_Room(){
		$widget_ops = array('description' => __('Book currently viewed room (for the Rooms Sidebar)', 'ci_theme'));
		$control_ops = array(/*'width' => 300, 'height' => 400*/);
		parent::WP_Widget('ci_book_room_widget', $name='-= CI Book Room =-', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		global $post;

		$ci_price = get_post_meta($post->ID, 'ci_cpt_room_from', true);
		$button = $instance['button'];
		$button = ci_get_string_translation('Book Room - Button Text', $button, 'Widgets');

		extract($args);

		echo $before_widget;
		echo '<div class="book-widget-inner">';
		if( !empty($ci_price) )
		{
			echo '<p class="book-now-price">'. sprintf(__('From %s', 'ci_theme'), $ci_price) . '</p>';
		}
		echo '<p class="book-now-action"><a href="'. add_query_arg('room_select', $post->ID, get_permalink( ci_translate_post_id(ci_setting('booking_form_page'), true, 'page') )) . '" class="btn">'. $button .'</a></p>';
		echo '</div>';
		echo $after_widget;
		
	} // widget

	function update($new_instance, $old_instance){
		$instance = array();
		$instance['button'] = ci_register_string_translation('Book Room - Button Text', $new_instance['button'], 'Widgets');

		return $instance;
	} // save

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'button' => __('Book this room', 'ci_theme')
		));

		$button = $instance['button'];

		?><p><?php _e('The widget will display a booking button, using the price set in the Room Details of each room. If not price is set, only the button will be shown.', 'ci_theme'); ?></p><?php
		echo '<p><label for="' . $this->get_field_id('button') . '">' . __('Button text:', 'ci_theme') . '</label><input id="' . $this->get_field_id('button') . '" name="' . $this->get_field_name('button') . '" type="text" value="' . esc_attr($button) . '" class="widefat" /></p>';

	} // form

} // class


register_widget('CI_Book_Room');

endif; // class_exists
?>