<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_display_options', 30);
	if( !function_exists('ci_add_tab_display_options') ):
		function ci_add_tab_display_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Display Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	load_panel_snippet('pagination');
	load_panel_snippet('excerpt');
	load_panel_snippet('seo');
	load_panel_snippet('comments');
	load_panel_snippet('featured_image_single');

	// Set our full width template width and options.
	add_filter('ci_full_template_width', 'ci_fullwidth_width');
	if( !function_exists('ci_fullwidth_width') ):
	function ci_fullwidth_width()	{
		return 950;
	}
	endif;
	load_panel_snippet('featured_image_fullwidth');
?>
<?php else: ?>
	
	<?php load_panel_snippet('pagination'); ?>	

	<?php load_panel_snippet('excerpt'); ?>	

	<?php load_panel_snippet('seo'); ?>	

	<?php load_panel_snippet('comments'); ?>

	<fieldset id="ci-panel-featured-image-single" class="set">
		<legend><?php _e('Featured Image', 'ci_theme'); ?></legend>
		<p class="guide">
			<?php
				echo sprintf(__('Control whether you want the featured image of each post to be displayed when viewing that post\'s page. The featured image can be shown/hidden on each individual post type, with common dimensions. You can define its height <em>(defaults to: %d pixels)</em>.', 'ci_theme'), intval($content_width/2));
				echo " "; _e('Note that if you change the the height of the featured images, you will need to regenerate all your thumbnails using an appropriate plugin, such as the <a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> plugin, otherwise your images may appear distorted.', 'ci_theme');
			?>
		</p>
		<?php
			$thumb_types = ci_cpt_with_featured_image();
			foreach($thumb_types as $post_type)
			{
				$obj = get_post_type_object($post_type);
				ci_panel_checkbox('featured_single_'.$post_type.'_show', 'enabled', sprintf(__('Show featured images on <em>%s</em>', 'ci_theme'), $obj->labels->name));
			}
		?>
		<fieldset class="mt10">
			<?php ci_panel_input('featured_single_height', __('Featured image Height', 'ci_theme')); ?>
			<?php
				// We hide the following fields, instead of removing them, as we need their input fields
				// so that the featured image dimensions will be saved along with the rest of the settings.
			?>
			<div style="display: none;">
				<?php ci_panel_input('featured_single_width', __('Featured image Width', 'ci_theme')); ?>
				<?php
					$align_options = array(
						'alignnone' => __('None', 'ci_theme'),
						'alignleft' => __('Left', 'ci_theme'),
						'aligncenter' => __('Center', 'ci_theme'),
						'alignright' => __('Right', 'ci_theme')
					);
					ci_panel_dropdown('featured_single_align', $align_options, __('Featured image alignment', 'ci_theme'));
				?>
			</div>
		</fieldset>
	</fieldset>

	<?php load_panel_snippet('featured_image_fullwidth'); ?>
		
<?php endif; ?>