<div class="ufb-submit-reference">
    <div class="ufb-each-form-field ufb-submit-button-wrap ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <div class="ufb-form-field">
                <input type="submit" disabled="disabled" class="button-primary ufb-submit-reference" value="<?php _e( 'Submit', UFB_TD ); ?>"/>
            </div>
        </div><!--ufb-form-field-wrap-->
        <div class="ufb-field-controls">
            <a href="javascript:void(0)" class="ufb-field-settings-trigger button-primary"><?php _e( 'Settings', UFB_TD ); ?></a><span>+</span>
            <a href="javascript:void(0)" class="ufb-field-delete-trigger" data-confirm-message="<?php _e( 'If you delete this element then data related with this element will also be deleted. Are you sure you want to delete this element?', UFB_TD ); ?>">Delete</a>
        </div>
        <div class="ufb-field-settings-wrap" style="display:none;">
            <span class="ufb-up-arrow"></span>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Submit Button label', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][button_label]" class="ufb-submit-button ufb-field-label-field ufb-no-label" data-field-name="ufb_key" data-field-type="button_label"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Show Reset Button', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[ufb_key][show_reset_button]" value="1" data-field-name="ufb_key" data-field-type="field_label"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Reset Button label', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][reset_label]"  data-field-name="ufb_key" data-field-type="button_label"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_id]" data-field-name="ufb_key" data-field-type="field_id"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_class]" data-field-name="ufb_key" data-field-type="field_class"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Column', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the column wise display of your field.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][column]">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Hidden by Default', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'Check if you want to hide this element at the beginning of the form load. It is useful when you want show with some conditional logic.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[ufb_key][hidden]" value="1"/>
                </div>
            </div>
            <input type="hidden" name="field_data[ufb_key][field_type]" value="submit" data-field-name="ufb_key" data-field-type="field_type"/>
        </div>
    </div><!--ufb-each-form-field-->
</div>