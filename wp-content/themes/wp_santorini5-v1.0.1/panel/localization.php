<?php
//
// Translation support for the CSSIgniter Panel options
//
// Currently supported (in order of preference):
//   * WPML
//   * Polylang
//   * qTranslate (no custom fields)
//

if( ! function_exists('ci_handle_register_panel_translations') ):
add_action( 'wp_loaded', 'ci_handle_register_panel_translations' );
function ci_handle_register_panel_translations()
{
	global $ci;
	ci_register_panel_translation($ci);
}
endif;

if( ! function_exists('ci_register_panel_translation') ):
function ci_register_panel_translation($options)
{
	foreach($options as $key => $value)
	{
		if( is_array($value) ) {
			ci_register_panel_translation($value);
		}
		else {
			ci_register_string_translation($key, $value, 'Panel');
		}
	}

}
endif;


if( ! function_exists('ci_register_string_translation') ):
function ci_register_string_translation($name, $value, $context)
{
	// WPML support
	if(function_exists('icl_register_string'))
	{
		icl_register_string($context, $name.' - '.md5($value) , $value);
	}
	// Polylang support
	elseif(function_exists('pll_register_string'))
	{
		// Must be run in every pageload.
		pll_register_string($context.' - '.$name, $value);
	}
	// qTranslate seems to be working out of the box.

	// Return the $value so that the function can be used in nested calls.
	// E.g.: $value = ci_register_string_translation( $name, sanitize_text_field($value), $context );
	return $value;
}
endif;


if( ! function_exists('ci_get_string_translation') ):
function ci_get_string_translation($name, $value, $context)
{
	$translation = $value;

	// WPML support
	if(function_exists('icl_t'))
	{
		$translation = icl_t($context, $name.' - '.md5($value), $value);
	}
	// Polylang support
	elseif(function_exists('pll__'))
	{
		// Doesn't work before the 'wp' action.
		$translation = pll__($value);
	}
	// qTranslate seems to be working out of the box.

	return $translation;
}
endif;


if( ! function_exists('ci_handle_panel_translation') ):
add_action( 'wp', 'ci_handle_panel_translation' );
function ci_handle_panel_translation()
{
	global $ci;
	ci_load_panel_translation($ci);
}
endif;

if( ! function_exists('ci_load_panel_translation') ):
function ci_load_panel_translation(&$options)
{
	foreach($options as $key => $value)
	{
		if( is_array($value) ) {
			$options[$key] = ci_load_panel_translation($value);
		}
		else {
			$options[$key] = ci_get_string_translation($key, $value, 'Panel');
		}
	}
	return $options;
}
endif;


//
// Helper functions
//

if( ! function_exists('ci_translate_post_id') ):
function ci_translate_post_id($post_id, $return_default=false, $post_type='post', $lang=false)
{
	// WPML support
	if(function_exists('icl_object_id'))
	{
		if( empty($lang) ) $lang = null;

		// Returns null if a translation is not found.
		$trans = icl_object_id($post_id, $post_type, false, $lang);
		if(!empty($trans))
			return $trans;
		elseif($return_default)
			return $post_id;
		else
			return false;
	}
	// Polylang support
	elseif(function_exists('pll_get_post'))
	{
		if( empty($lang) ) $lang = '';

		// Returns false if a translation is not found.
		$trans = pll_get_post($post_id, $lang);
		if(!empty($trans))
			return $trans;
		elseif($return_default)
			return $post_id;
		else
			return false;
	}
	// qTranslate doesn't need this as translations are stored in a single post.

	// No plugin detected.
	return $post_id;
}
endif;
?>