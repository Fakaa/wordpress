<?php //  UFB_Lib::print_array( $val);?>
<div class="ufb-each-form-field ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <label class="ufb-field-label-ref"><?php echo ($val[ 'field_label' ] == '') ? __( 'Untitled Dropdown Date', UFB_TD ) : esc_attr( $val[ 'field_label' ] ); ?></label>
        <div class="ufb-form-field ufb-dropdown-date-demo">
            <select disabled="disabled"><option><?php _e( 'Year', UFB_TD ); ?></option></select>
            <select disabled="disabled"><option><?php _e( 'Month', UFB_TD ); ?></option></select>
            <select disabled="disabled"><option><?php _e( 'Day', UFB_TD ); ?></option></select> &nbsp;&nbsp;&nbsp;&nbsp;
            <select disabled="disabled"><option><?php _e( 'HH', UFB_TD ); ?></option></select> : 
            <select disabled="disabled"><option><?php _e( 'MM', UFB_TD ); ?></option></select>
            <select disabled="disabled"><option><?php _e( 'AM', UFB_TD ); ?></option></select>

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
                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e( 'Booking Date', UFB_TD ); ?>" class="ufb-field-label-field ufb-field" value="<?php echo esc_attr( $val[ 'field_label' ] ); ?>"/>
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
            <label><?php _e( 'Required', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <?php $required = isset( $val[ 'required' ] ) ? 1 : 0; ?>
                <input type="checkbox" name="field_data[<?php echo $key; ?>][required]" value="1" <?php checked( $required, true ); ?>/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Error Message', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][error_message]" placeholder="<?php _e( 'Please choose your date.', UFB_TD ); ?>" value="<?php echo esc_attr( $val[ 'error_message' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Display Blocks', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <label><input type="checkbox" name="field_data[<?php echo $key; ?>][show_date_block]" value="1" <?php echo (isset( $val[ 'show_date_block' ] )) ? 'checked="checked"' : ''; ?>/><?php _e( 'Show Date Block', UFB_TD ); ?></label>
                <label><input type="checkbox" name="field_data[<?php echo $key; ?>][show_time_block]" value="1" <?php echo (isset( $val[ 'show_time_block' ] )) ? 'checked="checked"' : ''; ?>/><?php _e( 'Show Time Block', UFB_TD ); ?></label>
            </div>

        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Display Fields', UFB_TD ); ?></label>
            <div class="ufb-form-field ufb-date-fields ufb-sortable">
                <?php foreach ( $val[ 'date_fields_order' ] as $date_field ) {
                    ?>
                    <label>
                        <span class="ufb-drag-icon"><i class="fa fa-arrows"></i></span>
                        <?php $date_field_array = isset($val['date_fields'])?$val['date_fields']:array();?>
                        <input type="checkbox" name="field_data[<?php echo $key; ?>][date_fields][]" value="<?php echo esc_attr($date_field);?>" <?php echo in_array($date_field,$date_field_array)?'checked="checked"':'';?>/><?php echo $date_field; ?>
                        <input type="hidden" name="field_data[<?php echo $key; ?>][date_fields_order][]" value="<?php echo esc_attr($date_field);?>"/>
                    </label>
                    <?php
                }
                ?>

            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Minimum Year', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the minimum year displayed in the dropdown.Please input in number.For eg. 1950. Default will be 1915.' ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][minimum_year]" placeholder="1950" value="<?php echo esc_attr($val['minimum_year']);?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Maximum Year', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the maximum year displayed in the dropdown.Please input in number.For eg. 2020. Default will be current year.' ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][maximum_year]" placeholder="2015" value="<?php echo esc_attr($val['maximum_year']);?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Time Format', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <select name="field_data[<?php echo $key; ?>][time_format]">
                    <option value="12" <?php selected($val['time_format'],'12');?>><?php _e( '12 Hour Format', UFB_TD ); ?></option>
                    <option value="24" <?php selected($val['time_format'],'24');?>><?php _e( '24 Hour Format', UFB_TD ); ?></option>
                </select>
            </div>
        </div>

        <div class="ufb-form-field-wrap">
            <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]" value="<?php echo esc_attr($val['field_id']);?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]" value="<?php echo esc_attr($val['field_class']);?>"/>
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
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="dropdown-date"/>
    </div>
</div><!--ufb-each-form-field-->
