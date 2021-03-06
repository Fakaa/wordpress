<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_newsletter_options', 60);
	if( !function_exists('ci_add_tab_newsletter_options') ):
		function ci_add_tab_newsletter_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Newsletter Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['newsletter_action'] = '#';
	$ci_defaults['newsletter_email_id'] = 'e_id';
	$ci_defaults['newsletter_email_name'] = 'e_name';
	$ci_defaults['newsletter_hidden_fields'] = array(
		'hidden1', 'value1',
		'hidden2', 'value2',
	);
	
?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('The newsletter form can be used in combination with plugins or online providers such as <a href="http://www.campaignmonitor.com">Campaign Monitor</a> and <a href="http://www.mailchimp.com">MailChimp</a>. Please refer to their respective documentation if you need to know what the values of <b>Action</b>, <b>field names</b> and <b>field IDs</b> should be. Please note that if the <b>Action URL</b> is blank, then the form will not be displayed.', 'ci_theme'); ?></p>
		<?php ci_panel_input('newsletter_action', __('Action URL', 'ci_theme')); ?>
		<?php ci_panel_input('newsletter_email_id', __('"Email" field ID', 'ci_theme')); ?>
		<?php ci_panel_input('newsletter_email_name', __('"Email" field name', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('You can pass additional data to your newsletter system, by means of hidden fields (e.g. Mailchimp requires them). For the hidden input <strong>name</strong>, fill the left input on a line. For the hidden input <strong>value</strong>, fill the right input on a line.' , 'ci_theme'); ?></p>
		<fieldset id="newsletter_hidden_fields">
			<label><?php _e('Hidden fields', 'ci_theme'); ?></label>
			<a href="#" id="newsletter-add-field"><?php _e('Add hidden field', 'ci_theme'); ?></a>
			<div class="inside">
				<?php
					$fields = $ci['newsletter_hidden_fields'];
					if (!empty($fields)) 
					{
						for( $i = 0; $i < count($fields); $i+=2 )
						{
							echo '<p class="newsletter-field"><label>'.__('Hidden field name', 'ci_theme').'<input type="text" name="'.THEME_OPTIONS.'[newsletter_hidden_fields][]" value="'. $fields[$i] .'" /></label><label>'.__('Hidden field value', 'ci_theme').'<input type="text" name="'.THEME_OPTIONS.'[newsletter_hidden_fields][]" value="'. $fields[$i+1] .'" /></label> <a href="#" class="newsletter-remove">' . __('Remove me', 'ci_theme') . '</a></p>';
						}
					}
				?>
			</div>
		</fieldset>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#newsletter-add-field').click( function() {
					$('#newsletter_hidden_fields .inside').append('<p class="newsletter-field"><label><?php _e('Hidden field name', 'ci_theme'); ?><input type="text" name="<?php echo THEME_OPTIONS; ?>[newsletter_hidden_fields][]" /></label><label><?php _e('Hidden field value', 'ci_theme'); ?><input type="text" name="<?php echo THEME_OPTIONS; ?>[newsletter_hidden_fields][]" /></label> <a href="#" class="newsletter-remove"><?php _e('Remove me', 'ci_theme'); ?></a></p>');
					return false;		
				});
				
				$('#newsletter_hidden_fields').on('click', '.newsletter-remove', function() {
					$(this).parent('p').remove();
					return false;
				});
			});
		</script>
	</fieldset>

<?php endif; ?>