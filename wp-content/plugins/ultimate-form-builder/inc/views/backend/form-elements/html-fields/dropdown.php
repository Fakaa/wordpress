<div class="ufb-each-form-field ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <label class="ufb-field-label-ref"><?php echo (isset($val['field_label']) && $val['field_label'] != '') ? esc_attr($val['field_label']) : __('Untitled Dropdown', UFB_TD); ?></label>
        <div class="ufb-form-field">
            <select disabled="disabled">
                <option><?php _e('Option 1', UFB_TD) ?></option>
            </select>
        </div>
    </div><!--ufb-form-field-wrap-->
    <div class="ufb-field-controls">
        <a href="javascript:void(0)" class="ufb-field-settings-trigger button-primary"><?php _e('Settings', UFB_TD); ?></a><span>+</span>
        <a href="javascript:void(0)" class="ufb-field-delete-trigger">Delete</a>
    </div>
    <div class="ufb-field-settings-wrap" style="display:none;">
        <span class="ufb-up-arrow"></span>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Field Label', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e('Your Country', UFB_TD); ?>" class="ufb-field-label-field" data-field-name="<?php echo $key; ?>" data-field-type="field_label" value="<?php echo (isset($val['field_label'])) ? esc_attr($val['field_label']) : ''; ?>"/>
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
            <label><?php _e('Required', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="checkbox" name="field_data[<?php echo $key; ?>][required]" value="1" data-field-name="<?php echo $key; ?>" data-field-type="field_type" <?php echo (isset($val['required']) && $val['required'] == 1) ? 'checked="checked"' : ''; ?>/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Error Message', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][error_message]" placeholder="<?php _e('Please fill your name', UFB_TD); ?>" data-field-name="<?php echo $key; ?>" data-field-type="error_message" value="<?php echo isset($val['error_message']) ? esc_attr($val['error_message']) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-full-width ufb-op-wrap">
            <label><?php _e('Options', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="button" value="<?php _e('Add Option', UFB_TD); ?>" class="ufb-option-value-adder button-primary" data-field-key="<?php echo $key; ?>"/>
                <div class="ufb-option-value-wrap">
                    <?php
                    if (isset($val['option'], $val['value'])) {
                        $value_index = 0;
                        foreach ($val['option'] as $option) {
                            ?>
                            <div class="ufb-each-option">
                                <span class="ufb-option-drag-arrow"><i class="fa fa-arrows"></i></span>
                                <input type="text" name="field_data[<?php echo $key; ?>][option][]"  placeholder="Option" data-field-name="<?php echo $key; ?>" value="<?php echo $option; ?>"/>
                                <input type="text" name="field_data[<?php echo $key; ?>][value][]"  placeholder="Value" data-field-name="<?php echo $key; ?>"  value="<?php echo $val['value'][$value_index]; ?>"/>
                                <span class="ufb-option-remover">X</span>
                            </div>
                            <?php
                            $value_index++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Multiple', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="checkbox" name="field_data[<?php echo $key; ?>][multiple]" value="1" data-field-name="<?php echo $key; ?>" data-field-type="multiple" <?php checked($val['multiple'], true); ?>/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('ID of the field', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]" data-field-name="<?php echo $key; ?>" data-field-type="field_id" value="<?php echo isset($val['field_id']) ? esc_attr($val['field_id']) : ''; ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e('Class of the field', UFB_TD); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]" data-field-name="<?php echo $key; ?>" data-field-type="field_class" value="<?php echo isset($val['field_id']) ? esc_attr($val['field_id']) : ''; ?>"/>
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
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="dropdown" data-field-name="<?php echo $key; ?>" data-field-type="field_type"/>
    </div>
</div><!--ufb-each-form-field-->