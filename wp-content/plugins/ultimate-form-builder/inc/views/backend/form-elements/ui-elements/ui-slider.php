<div class="ufb-each-form-field ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <label class="ufb-field-label-ref"><?php echo ($val[ 'field_label' ] == '') ? __( 'Untitled UI Slider', UFB_TD ) : esc_attr( $val[ 'field_label' ] ); ?></label>
        <div class="ufb-form-field">
            <div class="ufb-slider-ref-wrap" <?php if ( $val[ 'slider_type' ] == 'range' ) { ?>style="display:none;"<?php } ?>>
                <div class="ufb-ui-slider" data-min-value="<?php echo ($val[ 'min_value' ] != '') ? esc_attr( $val[ 'min_value' ] ) : 0; ?>" data-max-value="<?php echo ($val[ 'max_value' ] != '') ? esc_attr( $val[ 'max_value' ] ) : 100; ?>" data-step="<?php echo ($val[ 'slider_step' ] != '') ? esc_attr( $val[ 'slider_step' ] ) : 100; ?>" data-pre-value="<?php echo esc_attr( $val[ 'pre_selected_value' ] ); ?>"></div>
                <span class="ufb-slider-value"><?php echo ($val[ 'pre_selected_value' ] != '') ? esc_attr( $val[ 'pre_selected_value' ] ) : 0; ?></span>
            </div>
            <div class="ufb-range-slider-ref-wrap" <?php if ( $val[ 'slider_type' ] == 'default' ) { ?>style="display:none;"<?php } ?>>
                <div class="ufb-range-slider" data-min-value="<?php echo ($val[ 'min_value' ] != '') ? esc_attr( $val[ 'min_value' ] ) : 0; ?>" data-max-value="<?php echo ($val[ 'max_value' ] != '') ? esc_attr( $val[ 'max_value' ] ) : 100; ?>" data-step="<?php echo ($val[ 'slider_step' ] != '') ? esc_attr( $val[ 'slider_step' ] ) : 100; ?>" data-pre-value="<?php echo esc_attr( $val[ 'pre_selected_value' ] ); ?>"></div>
                <span class="ufb-slider-value"><?php echo ($val[ 'pre_selected_value' ] != '') ? esc_attr( $val[ 'pre_selected_value' ] ) : '0-0'; ?></span>
            </div>
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
                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e( 'Budget', UFB_TD ); ?>" class="ufb-field-label-field ufb-field" value="<?php echo esc_attr( $val[ 'field_label' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Field Notes', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This field is to enable or disable the field notes or information for the field.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <?php $field_notes = isset( $val[ 'field_notes' ] ) ? $val[ 'field_notes' ] : '0'; ?>
                <select name="field_data[<?php echo $key; ?>][field_notes]" class="ufb-field-notes-trigger">
                    <option value="0" <?php selected( $val[ 'field_notes' ], '0' ); ?>><?php _e( 'Don\'t Show', UFB_TD ); ?></option>
                    <option value="sub-label" <?php selected( $val[ 'field_notes' ], 'sub-label' ); ?>><?php _e( 'Show as sub label', UFB_TD ); ?></option>
                    <option value="info-icon" <?php selected( $val[ 'field_notes' ], 'info-icon' ); ?>><?php _e( 'Show as info icon', UFB_TD ); ?></option>
                </select>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-field-note-text" <?php if ( $val[ 'field_notes' ] == '0' ) { ?> style="display: none"<?php } ?>>
            <label>
                <?php _e( 'Note Text', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This field is for field note or field information text.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][note_text]" placeholder="<?php _e( 'Your Name', UFB_TD ); ?>" value="<?php echo isset( $val[ 'note_text' ] ) ? esc_attr( $val[ 'note_text' ] ) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Slider Type', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <label><input type="radio" name="field_data[<?php echo $key; ?>][slider_type]" value="default" checked="checked" class="ufb-slider-type" <?php checked( $val[ 'slider_type' ], 'default' ); ?>/><span class="ufb-radio-label"><?php _e( 'Default', UFB_TD ); ?></span></label>
                <label><input type="radio" name="field_data[<?php echo $key; ?>][slider_type]" value="range"  class="ufb-slider-type"  <?php checked( $val[ 'slider_type' ], 'range' ); ?>/><span class="ufb-radio-label"><?php _e( 'Rangle Slider', UFB_TD ); ?></span></label>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Slider Min Value', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the minimum value which slider can select.Default value is 0.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][min_value]" placeholder="0" value="<?php echo esc_attr( $val[ 'min_value' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Slider Max Value', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the maximum value which slider can select.Default Value is 100', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][max_value]" placeholder="100" value="<?php echo esc_attr( $val[ 'max_value' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Slider Step', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the value which is changed in each slide.Default is 1.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][slider_step]" placeholder="5" value="<?php echo esc_attr( $val[ 'slider_step' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Minimum Required Value', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the minimum value that user can select from the slider.Default is your slider minimum value.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][min_required_value]" placeholder="10" value="<?php echo esc_attr( $val[ 'min_required_value' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Maximum Required Value', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the maximum value that user can select from the slider.Default Value is slider\' maximum value.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][max_required_value]" placeholder="75" value="<?php echo esc_attr( $val[ 'max_required_value' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Error Message', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][error_message]" placeholder="<?php _e( 'Please choose the budget greater than 0.', UFB_TD ); ?>" value="<?php echo esc_attr( $val[ 'error_message' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Pre selected value', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'Please give single numeric number such as 2,3,20 for slider and 2-20, 3-20 for range slider or leave blank if you don\'t want any pre selected value to display.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][pre_selected_value]" placeholder="<?php _e( 'E.g: 5 or 7-70' ); ?>" value="<?php echo esc_attr( $val[ 'pre_selected_value' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]" value="<?php echo esc_attr( $val[ 'field_id' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]" value="<?php echo esc_attr( $val[ 'field_class' ] ); ?>"/>
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
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="ui-slider"/>

    </div>
</div><!--ufb-each-form-field-->


