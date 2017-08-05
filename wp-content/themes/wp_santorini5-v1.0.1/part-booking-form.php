<form class="b-form group"  action="<?php echo get_permalink( ci_translate_post_id(ci_setting('booking_form_page'), true, 'page') ); ?>" method="post">
	<div class="arrival group">
		<input type="text" name="arrive" id="arrive" class="datepicker" placeholder="<?php _e('arrive', 'ci_theme'); ?>">
	</div>

	<div class="departure group">
		<input type="text" name="depart" id="depart" class="datepicker" placeholder="<?php _e('depart', 'ci_theme'); ?>">
	</div>

	<div class="adults group">
		<select name="adults" id="adults" class="dk">
			<option selected disabled><?php _e('adults', 'ci_theme'); ?></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>

	<div class="room group">
		<?php
			$selected = '';
			if(is_singular() and get_post_type()=='room')
				$selected = get_the_ID();

			wp_dropdown_posts(array(
				'show_option_none' => __('room', 'ci_theme'),
				'id' => 'room_select',
				'class' => 'dk',
				'post_type' => 'room',
				'selected' => $selected
			), 'room_select');
		?>

	</div>

	<div class="bookbtn group">
		<button type="submit"><?php _e('book now', 'ci_theme'); ?></button>
	</div>
</form>