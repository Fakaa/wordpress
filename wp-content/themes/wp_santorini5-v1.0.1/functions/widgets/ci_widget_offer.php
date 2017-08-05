<?php
if( !class_exists('CI_Offer_Widget') ):

class CI_Offer_Widget extends WP_Widget {

	function CI_Offer_Widget(){
		$widget_ops = array('description' => __('Displays a special offer.', 'ci_theme'));
		$control_ops = array(/*'width' => 300, 'height' => 400*/);
		parent::WP_Widget('ci_special_offer_widget', $name='-= CI Special Offer =-', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$button_text = ci_get_string_translation('Special Offer - Button text', $instance['button_text'], 'Widgets');
		$offer_text = ci_get_string_translation('Special Offer - Offer text', $instance['offer_text'], 'Widgets');
		$offer_url = $instance['offer_url'];
		$image_bg = $instance['image_bg'];


		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		?>
		<div class="item">
			<figure class="item-thumb">
				<a href="<?php echo esc_url($offer_url); ?>">
					<img src="<?php echo esc_url($image_bg); ?>" alt="">
				</a>
			</figure>

			<div class="item-content">
				<h4><?php echo $offer_text; ?></h4>
				<a class="item-title btn" href="<?php echo esc_url($offer_url); ?>"><?php echo $button_text; ?></a>
			</div>
		</div>
		<?php

		echo $after_widget;
	} // widget

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['button_text'] = sanitize_text_field($new_instance['button_text']);
		$instance['offer_text'] = sanitize_text_field($new_instance['offer_text']);
		$instance['offer_url'] = esc_url_raw($new_instance['offer_url']);
		$instance['image_bg'] = esc_url_raw($new_instance['image_bg']);

		ci_register_string_translation('Special Offer - Button text', $instance['button_text'], 'Widgets');
		ci_register_string_translation('Special Offer - Offer text', $instance['offer_text'], 'Widgets');

		return $instance;
	} // save

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'offer_text' => '',
			'offer_url' => '',
			'image_bg' => '',
			'button_text' => __('View Offer', 'ci_theme')
		));
		extract($instance);

		?>
		<p><?php _e("This widget will display a special offer box which can be linked to any URL you choose.", 'ci_theme'); ?></p>
		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'ci_theme'); ?></label><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('offer_text');?>"><?php _e('Offer Text:', 'ci_theme'); ?></label><input id="<?php echo $this->get_field_id('offer_text'); ?>" name="<?php echo $this->get_field_name('offer_text'); ?>" type="text" value="<?php echo esc_attr($offer_text); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('offer_url');?>"><?php _e('Offer URL:', 'ci_theme'); ?></label><input id="<?php echo $this->get_field_id('offer_url'); ?>" name="<?php echo $this->get_field_name('offer_url'); ?>" type="text" value="<?php echo esc_url($offer_url); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('image_bg');?>"><?php _e('Background Image URL (750x930px):', 'ci_theme'); ?></label><input id="<?php echo $this->get_field_id('image_bg'); ?>" name="<?php echo $this->get_field_name('image_bg'); ?>" type="text" value="<?php echo esc_url($image_bg); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('button_text');?>"><?php _e('Button Text:', 'ci_theme'); ?></label><input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" class="widefat" /></p>

	<?php
	} // form

} // class


register_widget('CI_Offer_Widget');

endif; // class_exists
?>