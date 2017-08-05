<div class="ufb-each-form-field ufb-submit-button-wrap ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <label class="ufb-field-label-ref"><?php echo (isset( $val['field_label'] ) && $val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled Captcha', UFB_TD ); ?></label>
        <div class="ufb-form-field">
            <img src="<?php echo UFB_IMG_DIR . '/recaptcha-preview.jpg'; ?>"/>
        </div>
    </div><!--ufb-form-field-wrap-->
    <div class="ufb-field-controls">
        <a href="javascript:void(0)" class="ufb-field-settings-trigger button-primary"><?php _e( 'Settings', UFB_TD ); ?></a><span>+</span>
        <a href="javascript:void(0)" class="ufb-field-delete-trigger">Delete</a>
    </div>
    <div class="ufb-field-settings-wrap" style="display:none;">
        <span class="ufb-up-arrow"></span>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Field Label', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e( 'Human Check', UFB_TD ); ?>" class="ufb-field-label-field" data-field-name="<?php echo $key;?>" data-field-type="field_label" value="<?php echo esc_attr( $val['field_label'] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Field Notes', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This field is to enable or disable the field notes or information for the field.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <?php $field_notes = isset( $val['field_notes'] ) ? $val['field_notes'] : '0'; ?>
                <select name="field_data[<?php echo $key; ?>][field_notes]" class="ufb-field-notes-trigger">
                    <option value="0" <?php selected( $val['field_notes'], '0' ); ?>><?php _e( 'Don\'t Show', UFB_TD ); ?></option>
                    <option value="sub-label" <?php selected( $val['field_notes'], 'sub-label' ); ?>><?php _e( 'Show as sub label', UFB_TD ); ?></option>
                    <option value="info-icon" <?php selected( $val['field_notes'], 'info-icon' ); ?>><?php _e( 'Show as info icon', UFB_TD ); ?></option>
                </select>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-field-note-text" <?php if ( $val['field_notes'] == '0' ) { ?> style="display: none"<?php } ?>>
            <label>
                <?php _e( 'Note Text', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This field is for field note or field information text.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][note_text]" placeholder="<?php _e( 'Your Name', UFB_TD ); ?>" value="<?php echo isset( $val['note_text'] ) ? esc_attr( $val['note_text'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Captcha Type', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <select name="field_data[<?php echo $key; ?>][captcha_type]" class="ufb-captcha-type-dropdown">
                    <option value="mathematical" <?php selected( $val['captcha_type'], 'mathematical' ); ?>><?php _e( 'Mathematical Captcha', UFB_TD ); ?></option>
                    <option value="google" <?php selected( $val['captcha_type'], 'google' ); ?>><?php _e( 'Google reCaptcha', UFB_TD ); ?></option>
                </select>
            </div>
        </div>
        <div class="ufb-captcha-field-ref" <?php if ( $val['captcha_type'] == 'mathematical' ) { ?>style="display:none;"<?php } ?>>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Site Key', UFB_TD ) ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[<?php echo $key; ?>][site_key]" value="<?php echo isset( $val['site_key'] ) ? esc_attr( $val['site_key'] ) : ''; ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Secret Key', UFB_TD ) ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[<?php echo $key; ?>][secret_key]" value="<?php echo isset( $val['secret_key'] ) ? esc_attr( $val['secret_key'] ) : ''; ?>"/>
                </div>
            </div>
            <div class="ufb-field-extra-note">
                <?php
                _e( 'Google Captcha will only show up in form filled the valid google captcha keys.Please visit <a href="https://www.google.com/recaptcha/admin" target="_blank">here</a> to get your site and secret key.', UFB_TD );
                ?>

            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Error Message', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][error_message]" placeholder="<?php _e( 'Please verify you are human.', UFB_TD ); ?>" value="<?php echo isset( $val['error_message'] ) ? esc_attr( $val['error_message'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Placeholder', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][placeholder]" placeholder='<?php _e( 'Enter Sum', UFB_TD ); ?>' value="<?php echo isset( $val['placeholder'] ) ? esc_attr( $val['placeholder'] ) : ''; ?>"/>
                <div class="ufb-field-note"><?php _e( 'Note: Placeholder is only for the mathematical type captcha.' ); ?></div>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]" data-field-name="ufb_key" data-field-type="field_label"  value="<?php echo isset( $val['field_id'] ) ? esc_attr( $val['field_id'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]" data-field-name="ufb_key" data-field-type="field_class"  value="<?php echo isset( $val['field_class'] ) ? esc_attr( $val['field_class'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Column', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the column wise display of your field.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <?php $column = isset( $val['column'] ) ? $val['column'] : '1' ?>
                <select name="field_data[<?php echo $key; ?>][column]">
                    <option value="1" <?php selected( $column, '1' ); ?>>1</option>
                    <option value="2" <?php selected( $column, '2' ); ?>>2</option>
                    <option value="3" <?php selected( $column, '3' ); ?>>3</option>
                    <option value="4" <?php selected( $column, '4' ); ?>>4</option>
                </select>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Hidden by Default', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'Check if you want to hide this element at the beginning of the form load. It is useful when you want show with some conditional logic.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="checkbox" name="field_data[<?php echo $key; ?>][hidden]" value="1" <?php echo (isset( $val['hidden'] ) && $val['hidden'] == 1) ? 'checked="checked"' : ''; ?>/>
            </div>
        </div>
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="captcha" data-field-name="ufb_key" data-field-type="field_label"/>
    </div>
</div><!--ufb-each-form-field-->