<?php
global $library_obj;
$form_detail = maybe_unserialize( $form_row['form_detail'] );
$form_default_settings = $library_obj->get_default_detail();
$form_design = isset( $form_detail['form_design'] ) ? $form_detail['form_design'] : $form_default_settings['form_design'];
//$library_obj->print_array($form_default_settings);
?>
<div class="ufb-tab-content" id="ufb-display-tab" style="display:none">
    <div class="ufb-display-sub-section">
        <div class="ufb-field-wrap">
            <label><?php _e( 'Disable Plugin Styles', UFB_TD ); ?></label>
            <div class="ufb-field">
                <input type="checkbox" name="form_design[disable_plugin_style]" value='1' <?php echo (isset( $form_design['disable_plugin_style'] ) && $form_design['disable_plugin_style'] == 1) ? 'checked="checked"' : ''; ?>/>
                <div class="ufb-side-note"><?php _e( 'Check if you want to disable all the plugin styles in the frontend.', UFB_TD ); ?></div>
            </div>
        </div>
        <div class="ufb-field-wrap">
            <label><?php _e( 'Hide Form Title', UFB_TD ); ?></label>
            <div class="ufb-field">
                <input type="checkbox" name="form_design[hide_form_title]" value='1' <?php echo (isset( $form_design['hide_form_title'] ) && $form_design['hide_form_title'] == 1) ? 'checked="checked"' : ''; ?>/>
                <div class="ufb-side-note"><?php _e( 'Check to hide the form title in frontend form.', UFB_TD ); ?></div>
            </div>
        </div>
        <?php if ( $form_row['form_type'] == 'single' ) { ?>
        <div class="ufb-field-wrap">
            <label><?php _e( 'Hide Form on Successful Submission', UFB_TD ); ?></label>
            <div class="ufb-field">
                <input type="checkbox" name="form_design[hide_form_submission]" value='1' <?php echo (isset( $form_design['hide_form_submission'] ) && $form_design['hide_form_submission'] == 1) ? 'checked="checked"' : ''; ?>/>
                <div class="ufb-side-note"><?php _e( 'Check if you hide the form after successful submission.', UFB_TD ); ?></div>
            </div>
        </div>
        <?php }?>
        <?php if ( $form_row['form_type'] == 'multi' ) {
            ?>
            <div class="ufb-field-wrap">
                <label><?php _e( 'Hide Multi Steps Heading', UFB_TD ); ?></label>
                <div class="ufb-field">
                    <input type="checkbox" name="form_design[hide_multi_heading]" value='1' <?php echo (isset( $form_design['hide_multi_heading'] ) && $form_design['hide_multi_heading'] == 1) ? 'checked="checked"' : ''; ?>/>
                    <div class="ufb-side-note"><?php _e( 'Check to hide the tabs heading in frontend form.', UFB_TD ); ?></div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="ufb-field-wrap">
            <label><?php _e( 'Form Width', UFB_TD ); ?></label>
            <div class="ufb-field">
                <input type="text" name="form_design[form_width]" placeholder="500px or 100%" value="<?php echo esc_attr( $form_design['form_width'] ); ?>"/>
                <div class="ufb-field-note"><?php _e( 'Please provide the width of form either in px or %.Default width is 100%.', UFB_TD ); ?></div>
            </div>
        </div>
        <div class="ufb-field-wrap">
            <label><?php _e( 'Form Submission Message', UFB_TD ); ?></label>
            <div class="ufb-field">
                <textarea name="form_design[form_submission_message]" placeholder="<?php _e( 'Form submitted successfully.', UFB_TD ); ?>"><?php echo isset( $form_design['form_submission_message'] ) ? esc_attr( $form_design['form_submission_message'] ) : ''; ?></textarea>
            </div>
        </div>
        <div class="ufb-field-wrap">
            <label><?php _e( 'Form Error Message', UFB_TD ); ?></label>
            <div class="ufb-field">
                <textarea name="form_design[form_error_message]" placeholder="<?php _e( 'Validation errors occurred in the form.', UFB_TD ); ?>" ><?php echo isset( $form_design['form_error_message'] ) ? esc_attr( $form_design['form_error_message'] ) : ''; ?></textarea>
            </div>
        </div>
        <div class="ufb-field-wrap">
            <label><?php _e( 'Form Template', UFB_TD ); ?></label>
            <div class="ufb-field">

                <select name="form_design[form_template]" class="ufb-form-template-dropdown">
                    <option value="ufb-default-template" <?php selected( $form_design['form_template'], 'ufb-default-template' ); ?>>Default Template</option>
                    <?php for ( $i = 1; $i <= 10; $i++ ) {
                        ?>
                        <option value="ufb-template-<?php echo $i; ?>" <?php selected( $form_design['form_template'], 'ufb-template-' . $i ); ?>>Template <?php echo $i; ?></option>
                        <?php
                    }
                    ?>


                </select>
            </div>
        </div>
        <div class="ufb-form-controls">
            <input type="button" class="button-primary ufb-save-form" value="<?php _e( 'Save Form', UFB_TD ); ?>"/>
            <a href="<?php echo site_url( '?ufb_form_preview=true&ufb_form_id=' . $form_row['form_id'] ); ?>" target="_blank"><input type="button" class="button-primary" value="<?php _e( 'Preview', UFB_TD ); ?>"/></a>
            <div class="ufb-field-note"><?php _e( 'Note: Please save form before preview.', UFB_TD ); ?></div>
        </div>
    </div>	
    <div class="ufb-template-preview">
        <h3><?php _e( 'Template Preview', UFB_TD ); ?></h3>
        <?php         $form_design['form_template'] = str_replace('ufbl','ufb',$form_design['form_template']);       ?>
        <img src="<?php echo UFB_IMG_DIR . '/previews/default-template.jpg' ?>" alt="Default Template" id="preview-ufb-default-template" <?php if ( !($form_design['form_template'] == 'ufb-default-template' || $form_design['form_template'] == 'ufbl-default-template')) { ?>style="display:none"<?php } ?>/>
        <?php
        for ( $i = 1; $i <= 10; $i++ ) {
            ?>
            <img src="<?php echo UFB_IMG_DIR . '/previews/template-'.$i.'.jpg'; ?>" alt="Template <?php echo $i;?>" id="preview-ufb-template-<?php echo $i;?>" <?php if ( $form_design['form_template'] != 'ufb-template-'.$i ) { ?>style="display:none"<?php } ?>/>
            <?php
        }
        ?> 
        

    </div>
    <div class="ufb-clear"></div>
</div>

