<div class="wrap">
	<?php
	/**
	 * Always use self::load_view to load view inside a view
	 * Header view loaded
	 */
	$data['form_row'] = $form_row;
//	self::print_array($data);
       self::load_view( 'backend/header' );
	?>
	<div class="ufb-shortcode-display-wrap">Shortcode: <input type="text" onfocus="this.select();" readonly="readonly" value="[ufb form_id=&quot;<?php echo $_GET['form_id']?>&quot;]" class="shortcode-in-list-table wp-ui-text-highlight code"></div>
	<h2 class="nav-tab-wrapper">
		<a href="javascript:void(0);" class="nav-tab nav-tab-active ufb-tab-trigger" data-id="form-builder"><?php _e( 'Form Builder', UFB_TD ); ?></a>
		<a href="javascript:void(0);" class="nav-tab ufb-tab-trigger" data-id="display"><?php _e( 'Display Settings', UFB_TD ); ?></a>
		<a href="javascript:void(0);" class="nav-tab ufb-tab-trigger" data-id='email'><?php _e( 'Email Settings', UFB_TD ); ?></a>
		<a href="javascript:void(0);" class="nav-tab ufb-tab-trigger" data-id='conditional-logic'><?php _e( 'Conditional Logic', UFB_TD ); ?></a>
	</h2>
	<?php self::print_message();?>
        
	<div class="ufb-form-controls ufb-text-align-right">
		<input type="button" class="button-primary ufb-save-form" value="<?php _e( 'Save Form', UFB_TD ); ?>"/>
		<a href="<?php echo site_url('?ufb_form_preview=true&ufb_form_id='.$form_row['form_id']);?>" target="_blank"><input type="button" class="button-primary" value="<?php _e( 'Preview', UFB_TD ); ?>"/></a>
		<div class="ufb-field-note"><?php _e( 'Note: Please save form before preview.', UFB_TD ); ?></div>
	</div>
	<div class="ufb-clear"></div>
	<div class="ufb-tab-content-wrapper">
		<!--form builder reference fields-->
		<?php self::load_view( 'backend/boxes/form-fields-html',$data ); ?>
		<!--form builder reference fields-->

		<form class="ufb-form" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" data-changed="false">
			<!--Form Builder Section -->
			<?php self::load_view( 'backend/boxes/form-builder-main', $data ); ?>
			<!--Form Builder Section -->

			<!--Display Settings Section -->
			<?php self::load_view( 'backend/boxes/display-settings', $data ); ?>
			<!--Display Settings Section -->

			<!--Email Settings Section -->
			<?php self::load_view( 'backend/boxes/email-settings', $data ); ?>
			<!--Email Settings Section -->
                        
			<!--Conditional Logic Section -->
			<?php self::load_view( 'backend/boxes/conditional-logic', $data ); ?>
			<!--Email Settings Section -->
                        
                        
		</form>	
	</div>
</div>

