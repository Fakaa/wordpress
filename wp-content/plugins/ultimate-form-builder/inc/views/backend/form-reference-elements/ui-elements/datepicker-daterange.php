<div class="ufb-datepicker-daterange-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled Datepicker Range', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <img src="<?php echo UFB_IMG_DIR . '/datepicker-daterange-preview.jpg' ?>"/>

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
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Booking Date', UFB_TD ); ?>" class="ufb-field-label-field ufb-field"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Field Notes', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][field_notes]" class="ufb-field-notes-trigger">
                        <option value="0"><?php _e( 'Don\'t Show', UFB_TD ); ?></option>
                        <option value="sub-label"><?php _e( 'Show as sub label', UFB_TD ); ?></option>
                        <option value="info-icon"><?php _e( 'Show as info icon', UFB_TD ); ?></option>
                    </select>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-field-note-text" style="display: none">
                <label><?php _e( 'Note Text', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][note_text]" placeholder="<?php _e( 'Your Name', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'From Label', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][from_label]" placeholder="<?php _e( 'From', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'To Label', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][to_label]" placeholder="<?php _e( 'To', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Required', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[ufb_key][required]" value="1"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Error Message', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][error_message]" placeholder="<?php _e( 'Please fill your name', UFB_TD ); ?>" />
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Placeholder', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][placeholder]" placeholder='<?php _e( 'Enter your booking date.', UFB_TD ); ?>'>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Date Format Type', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <label><input type="radio" name="field_data[ufb_key][date_format_type]" value="pre_available" checked="checked" class="ufb-date-format" <?php checked( $val['date_format_type'], 'pre_available' ); ?>/><span class="ufb-radio-label"><?php _e( 'Pre Available Format', UFB_TD ); ?></span></label>
                    <label><input type="radio" name="field_data[ufb_key][date_format_type]" value="custom"  class="ufb-date-format" <?php checked( $val['date_format_type'], 'custom' ); ?>/><span class="ufb-radio-label"><?php _e( 'Custom Format', UFB_TD ); ?></span></label>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-date-ref ufb-available-format"<?php if ( $val['date_format_type'] != 'pre_available' ) { ?> style="display: none;"<?php } ?>>
                <label><?php _e( 'Available Format', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][date_format]">
                        <option value="mm/dd/yy">mm/dd/yy (09/17/2015)</option>
                        <option value="yy-mm-dd">yy-mm-dd (2015-09-17)</option>
                        <option value="d M, y">d M, y (17 Sep, 15)</option>
                        <option value="d MM, y">d MM, y (17 September, 15)</option>
                        <option value="DD, d MM, yy">DD, d MM, yy (Thursday, 17 September, 2015)</option>
                    </select>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-date-ref ufb-custom-format" style="display: none;">
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
                    <input type="text" name="field_data[ufb_key][custom]" placeholder="<?php _e( '\'day\' d \'of\' MM \'in the year\' yy', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Pre filled value', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][pre_filled_value]"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_id]"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_class]"/>
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
                        <option value="2">2/</option>
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
            <input type="hidden" name="field_data[ufb_key][field_type]" value="datepicker-daterange"/>
        </div>
    </div><!--ufb-each-form-field-->
</div>