<?php
//
// Experimental code: Theme Customizer
//

add_action( 'customize_preview_init', 'ci_theme_customize_preview_init' );
function ci_theme_customize_preview_init()
{
	global $ci;
	$ci = get_option(THEME_OPTIONS);
}

add_action( 'customize_register', 'ci_theme_customize_register' );
if( !function_exists('ci_theme_customize_register') ):
function ci_theme_customize_register( $wpc )
{
	global $_ci_panel_options;

	$paneltabs = apply_filters( 'ci_panel_tabs', array() );

	// Setup customizer sections
	foreach($paneltabs as $tab => $title)
	{
		$section = 'ci_'.$tab;
		$wpc->add_section( $section, array(
			'title' => $title,
			'priority' => 200,
			//'description' => __('Description text', 'ci_theme')
		));

		$options = !empty($_ci_panel_options[$section]) ? $_ci_panel_options[$section] : array();
		//TODO: Sort options by their priority. Need to think more about that, as we need to take grouping into account.
		// Note that the priority of the controls is our own feature, in contrast with the section's priority, which is WP's.

		foreach($options as $key => $option)
		{
			$option_name = THEME_OPTIONS.'['.$key.']';
			$control_name = 'ci_'.$key;

			$setting_args = array(
				'default' => $option['default'],
				'type' => 'option',
				//'capability' => 'edit_theme_options',
				//'transport' => 'refresh'
			);
			if( !empty($option['capability']) )
				$setting_args['capability'] = $option['capability'];
			if( !empty($option['transport']) )
				$setting_args['transport'] = $option['transport'];

			$wpc->add_setting( $option_name, $setting_args );

			switch( $option['type'] )
			{
				case 'help':
					$wpc->add_control( new CI_Customize_Help_Control( $wpc, $control_name, array(
						'label' => $option['label'],
						'section' => $section,
						'settings' => $option_name,
						'type' => $option['type']
					)));
					break;

				case 'color':
					$wpc->add_control( new WP_Customize_Image_Control( $wpc, $control_name, array(
						'label' => $option['label'],
						'section' => $section,
						'settings' => $option_name,
						'type' => $option['type']
					)));
					break;

				default:
					$wpc->add_control( $control_name, array(
						'label' => $option['label'],
						'section' => $section,
						'settings' => $option_name,
						'type' => $option['type']
					));
			}
		}
	}

}
endif;


function ci_panel_add_control($option, $type, $default, $label, $args = array())
{
	global $load_defaults, $ci_defaults, $_ci_panel_options;

	if ($load_defaults===TRUE)
	{
		if( empty( $args['section'] ) )
		{
			// Get the caller function's filename.
			$bt = debug_backtrace();
			$section = 'ci_' . sanitize_key(basename($bt[0]['file'], '.php'));
			unset($bt);
		}
		else
		{
			$section = $args['section'];
		}
	
		$option_rec = array(
			'section' => $section,
			'option' => $option,
			'type' => $type,
			'label' => $label,
			'default' => $default,
			'priority' => 10
		);
		$option_rec = wp_parse_args($args, $option_rec);
		$_ci_panel_options[ $section ][ $option ] = $option_rec;

		$ci_defaults[ $option ] = $default;
	}
	else
	{
		switch($type)
		{
			case "text":
				ci_panel_input($option, $label, $args);
				break;
		}
	}
}

if( class_exists('WP_Customize_Control') ):
class CI_Customize_Help_Control extends WP_Customize_Control
{
	public $type = 'help';
	
	public function render_content()
	{
		?>
			<p class="description"><?php echo $this->label; ?></p>
		<?php
	}
}
endif;

?>