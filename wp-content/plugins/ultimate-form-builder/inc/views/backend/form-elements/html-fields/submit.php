<div class="ufb-each-form-field ufb-submit-button-wrap ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <div class="ufb-form-field">
            <input type="submit" disabled="disabled" class="button-primary ufb-submit-reference" value="<?php echo ($val['button_label'] == '') ? __('Submit', UFB_TD) : esc_attr($val['button_label']); ?>"/>
        </div>
    </div><!--ufb-form-field-wrap-->
    <div class="ufb-field-controls">
        <a href="javascript:void(0)" class="ufb-field-settings-trigger button-primary"><?php _e('Settings', UFB_TD); ?></a><span>+</span>
        <a href="javascript:void(0)" class="ufb-field-delete-trigger" data-confirm-message="<?php _e('If you delete this element then data related with this element will also be deleted. Are you sure you want to delete this element?', UFB_TD); ?>">Delete</a>
    </div>
    <div class="ufb-field-settings-wrap" style="display:none;">
        <span class="ufb-up-arrow"></span>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Submit Button label', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][button_label]" class="ufb-submit-button ufb-field-label-field ufb-no-label" value="<?php echo esc_attr($val['button_label']); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Show Reset Button', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <?php $show_reset_button = isset($val['show_reset_button']) ? 1 : 0; ?>
                <input type="checkbox" name="field_data[<?php echo $key; ?>][show_reset_button]" value="1" <?php checked($show_reset_button, true); ?>/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Reset Button label', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][reset_label]" value="<?php echo isset($val['reset_label']) ? esc_attr($val['reset_label']) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('ID of the field', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]" data-field-name="<?php echo $key; ?>" data-field-type="field_id" value="<?php echo esc_attr($val['field_id']); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Class of the field', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]" data-field-name="<?php echo $key; ?>" data-field-type="field_class"  value="<?php echo esc_attr($val['field_class']); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Column', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the column wise display of your field.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <?php $column = isset( $val[ 'column' ] ) ? $val[ 'column' ] : '1' ?>
                <select name="field_data[<?php echo $key; ?>][column]">
                    <option value="1" <?php selected( $column, '1' ); ?>>1</option>
                    <option value="2" <?php selected( $column, '2' ); ?>>2</option>
                    <option value="3" <?php selected( $column, '3' ); ?>>3</option>
                    <option value="4" <?php selected( $column, '4' ); ?>>4</option>
                </select>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>                     <?php _e( 'Hidden by Default', UFB_TD ); ?>                     <?php echo UFB_Lib::generate_help_text( __( 'Check if you want to hide this element at the beginning of the form load. It is useful when you want show with some conditional logic.', UFB_TD ) ); ?>                 </label>
            <div class="ufb-form-field">
                <input type="checkbox" name="field_data[<?php echo $key; ?>][hidden]" value="1" <?php echo (isset( $val[ 'hidden' ] ) && $val[ 'hidden' ] == 1) ? 'checked="checked"' : ''; ?>/>
            </div>
        </div>
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="submit" data-field-name="<?php echo $key; ?>" data-field-type="field_type"/>
    </div>
</div><!--ufb-each-form-field-->