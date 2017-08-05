<div class="ufb-each-form-field ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <label class="ufb-field-label-ref"><?php echo ($val[ 'field_label' ] == '') ? __( 'Untitled Datepicker Range', UFB_TD ) : esc_attr( $val[ 'field_label' ] ); ?></label>
        <div class="ufb-form-field">
            <?php /*<div class="ufb-daterange-wrap"><span class="ufb-date-from-label"><?php _e( 'From', UFB_TD ); ?></span> <input type="text" disabled="disabled" placeholder="2015-12-12"/></div>
            <div class="ufb-daterange-wrap"><span class="ufb-date-from-label"><?php _e( 'To', UFB_TD ); ?></span> <input type="text" disabled="disabled"  placeholder="2015-12-30"/></div> */?>
            <img src="<?php echo UFB_IMG_DIR.'/datepicker-daterange-preview.jpg'?>"/>
        </div>
    </div><!--ufb-form-field-wrap-->
    <!--ufb-form-field-wrap-->
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
            <label><?php _e( 'From Label', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][from_label]" placeholder="<?php _e( 'From', UFB_TD ); ?>" value="<?php echo esc_attr($val['from_label']);?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'To Label', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][to_label]" placeholder="<?php _e( 'To', UFB_TD ); ?>" value="<?php echo esc_attr($val['to_label']);?>"/>
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
                <input type="text" name="field_data[<?php echo $key; ?>][error_message]" placeholder="<?php _e( 'Please fill your name', UFB_TD ); ?>" value="<?php echo esc_attr( $val[ 'error_message' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Placeholder', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][placeholder]" placeholder='<?php _e( 'Enter your booking date.', UFB_TD ); ?>' value="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Date Format Type', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <label><input type="radio" name="field_data[<?php echo $key; ?>][date_format_type]" value="pre_available" checked="checked" class="ufb-date-format" <?php checked( $val[ 'date_format_type' ], 'pre_available' ); ?>/><span class="ufb-radio-label"><?php _e( 'Pre Available Format', UFB_TD ); ?></span></label>
                <label><input type="radio" name="field_data[<?php echo $key; ?>][date_format_type]" value="custom"  class="ufb-date-format" <?php checked( $val[ 'date_format_type' ], 'custom' ); ?>/><span class="ufb-radio-label"><?php _e( 'Custom Format', UFB_TD ); ?></span></label>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-date-ref ufb-available-format"<?php if ( $val[ 'date_format_type' ] != 'pre_available' ) { ?> style="display: none;"<?php } ?>>
            <label><?php _e( 'Available Format', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <select name="field_data[<?php echo $key; ?>][date_format]">
                    <option value="mm/dd/yy"  <?php selected( $val[ 'date_format' ], 'mm/dd/yy' ); ?>>mm/dd/yy (09/17/2015)</option>
                    <option value="yy-mm-dd" <?php selected( $val[ 'date_format' ], 'yy-mm-dd' ); ?>>yy-mm-dd (2015-09-17)</option>
                    <option value="d M, y" <?php selected( $val[ 'date_format' ], 'd M, y' ); ?>>d M, y (17 Sep, 15)</option>
                    <option value="d MM, y" <?php selected( $val[ 'date_format' ], 'd MM, y' ); ?>>d MM, y (17 September, 15)</option>
                    <option value="DD, d MM, yy" <?php selected( $val[ 'date_format' ], 'DD, d MM, yy' ); ?>>DD, d MM, yy (Thursday, 17 September, 2015)</option>
                </select>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-date-ref ufb-custom-format" <?php if ( $val[ 'date_format_type' ] != 'custom_format' ) { ?> style="display: none;"<?php } ?>>
            <label class="ufb-relative">
                <?php _e( 'Custom Format', UFB_TD ); ?>
                <?php
                $help_text = '<ul>
                                <li>d - day of month (no leading zero)</li>
                                <li>dd - day of month (two digit)</li>
                                <li>o - day of the year (no leading zeros)</li>
                                <li>oo - day of the year (three digit)</li>
                                <li>D - day name short</li>
                                <li>DD - day name long</li>
                                <li>m - month of year (no leading zero)</li>
                                <li>mm - month of year (two digit)</li>
                                <li>M - month name short</li>
                                <li>MM - month name long</li>
                                <li>y - year (two digit)</li>
                                <li>yy - year (four digit)</li>
                            </ul>';
                echo UFB_Lib::generate_help_text( $help_text );
                ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][custom]" placeholder="<?php _e( '\'day\' d \'of\' MM \'in the year\' yy', UFB_TD ); ?>" value="<?php echo esc_attr( $val[ 'custom' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Pre filled value', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][pre_filled_value]"  value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]"   value="<?php echo esc_attr( $val[ 'field_id' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]"   value="<?php echo esc_attr( $val[ 'field_class' ] ); ?>"/>
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
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="datepicker-daterange"/>
    </div>
</div><!--ufb-each-form-field-->
