<?php
if( !class_exists('CI_Newsletter') ):

class CI_Newsletter extends WP_Widget {

	function CI_Newsletter(){
		$widget_ops = array('description' => __('Displays a Newsletter form for your users to register.', 'ci_theme'));
		$control_ops = array(/*'width' => 300, 'height' => 400*/);
		parent::WP_Widget('ci_newsletter_widget', $name='-= CI Newsletter =-', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$button = ci_get_string_translation('Newsletter - Button', $instance['button'], 'Widgets');
		$description = ci_get_string_translation('Newsletter - Description', $instance['description'], 'Widgets');

		echo ci_theme_show_newsletter_widget( array(
			'title' => $title,
			'description' => $description,
			'button_text' => $button
		));

	} // widget

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['button'] = sanitize_text_field($new_instance['button']);
		$instance['description'] = wp_kses($new_instance['description'], wp_kses_allowed_html('post'));

		ci_register_string_translation('Newsletter - Description', $instance['button'], 'Widgets');
		ci_register_string_translation('Newsletter - Button', $instance['description'], 'Widgets');
		return $instance;
	} // save

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'description' => '',
			'button' => __('Subscribe', 'ci_theme')
		));
		extract($instance);

		?>
		<p><?php _e("The widget will display a booking form which will redirect on either the theme's booking page or your custom URL supplied in the Theme Options.", 'ci_theme'); ?></p>
		<p><label><?php _e('Title:', 'ci_theme'); ?></label><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" class="widefat" /></p>
		<p><label><?php _e('Description:', 'ci_theme'); ?></label><textarea id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" class="widefat"><?php echo esc_textarea($description); ?></textarea></p>
		<p><label><?php _e('Button text:', 'ci_theme'); ?></label><input id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo esc_attr($button); ?>" class="widefat" /></p>
		<?php
	} // form

} // class


register_widget('CI_Newsletter');

endif; // class_exists
?>