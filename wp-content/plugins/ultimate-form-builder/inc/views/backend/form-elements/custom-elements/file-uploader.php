<div class="ufb-each-form-field ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <label class="ufb-field-label-ref"><?php echo ($val[ 'field_label' ] != '') ? esc_attr( $val[ 'field_label' ] ) : __( 'Untitled File Uploader', UFB_TD ); ?></label>
        <div class="ufb-form-field">
            <img src="<?php echo UFB_IMG_DIR . '/upload-btn-preview.jpg'; ?>" class="ufb-upload-preview-btn"/>
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
                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e( 'Your Image', UFB_TD ); ?>" class="ufb-field-label-field ufb-field" value="<?php echo esc_attr( $val[ 'field_label' ] ); ?>"/>
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
            <label><?php _e( 'Required Error Message', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][required_error_message]" placeholder="<?php _e( 'Please upload atleast a single file.', UFB_TD ); ?>" value="<?php echo esc_attr( $val[ 'required_error_message' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Upload Button Label', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the label of the button.Default label is "Upload a file".', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][upload_button_label]" placeholder="<?php _e( 'Upload an image', UFB_TD ); ?>"  value="<?php echo esc_attr( $val[ 'upload_button_label' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Max Upload Size in MB', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the maximum size limit of the file uploader.Default file size is 8 MB.Please add only numeric value.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][max_upload_size]" placeholder="8" value="<?php echo esc_attr( $val[ 'max_upload_size' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-full-width">
            <label>
                <?php _e( 'Choose file extensions', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'Please choose the extension that you only want to allow from this file uploader.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <div class="ufb-sub-field-wrap">
                <?php $val[ 'extension' ] = isset($val[ 'extension' ])?$val[ 'extension' ]:array();?>
                    <div class="ufb-sub-heading"><?php _e( 'Images', UFB_TD ); ?></div>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="jpg" <?php echo (in_array( 'jpg', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>jpg</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="jpeg" <?php echo (in_array( 'jpeg', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>jpeg</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="png"  <?php echo (in_array( 'png', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>png</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="gif" <?php echo (in_array( 'gif', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>gif</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="bmp" <?php echo (in_array( 'bmp', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>bmp</label>
                </div>
                <div class="ufb-sub-field-wrap">
                    <div class="ufb-sub-heading"><?php _e( 'Documents', UFB_TD ); ?></div>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="pdf" <?php echo (in_array( 'pdf', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>pdf</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="doc" <?php echo (in_array( 'doc', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>doc|docx</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="xls" <?php echo (in_array( 'xls', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>xls|xlsx</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="odt" <?php echo (in_array( 'odt', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>odt</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="ppt" <?php echo (in_array( 'ppt', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>ppt|pptx</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="pps" <?php echo (in_array( 'pps', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>pps|ppsx</label>
                </div>
                <div class="ufb-sub-field-wrap">
                    <div class="ufb-sub-heading"><?php _e( 'Audio', UFB_TD ); ?></div>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="mp3" <?php echo (in_array( 'mp3', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>mp3</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="mp4" <?php echo (in_array( 'mp4', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>mp4</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="ogg" <?php echo (in_array( 'ogg', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>ogg</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="wav" <?php echo (in_array( 'wav', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>wav</label>

                </div>
                <div class="ufb-sub-field-wrap">
                    <div class="ufb-sub-heading"><?php _e( 'Video', UFB_TD ); ?></div>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="mp4" <?php echo (in_array( 'mp4', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>mp3</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="m4v" <?php echo (in_array( 'm4v', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>m4v</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="mov" <?php echo (in_array( 'mov', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>mov</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="wmv" <?php echo (in_array( 'wmv', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>wmv</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="avi" <?php echo (in_array( 'avi', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>avi</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="mpg" <?php echo (in_array( 'mpg', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>mpg</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="ogv" <?php echo (in_array( 'ogv', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>ogv</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="3gp" <?php echo (in_array( '3gp', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>3gp</label>
                    <label><input type="checkbox" name="field_data[<?php echo $key; ?>][extension][]" value="3g2" <?php echo (in_array( '3g2', $val[ 'extension' ] )) ? 'checked="checked"' : ''; ?>/>3g2</label>
                </div>
            </div>
            <div class="ufb-sub-field-wrap">
                <div class="ufb-sub-heading">
                    <?php _e( 'Custom Extension', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'Please enter the extension that is not available in the above list but you want to allow the users to be able to upload.Use comma for multiple extensions.For example: zip,gzip', UFB_TD ) ); ?>
                </div>
                <input type="text" name="field_data[<?php echo $key; ?>][custom_extension]" placeholder="zip,gzip"  value="<?php echo esc_attr( $val[ 'custom_extension' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Extension error message', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the error message that will be shown to user when they try to upload the files with unallowed extension.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][extension_error_message]" placeholder="Only image file types supported."  value="<?php echo esc_attr( $val[ 'extension_error_message' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Allow multiple uploads', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <?php $multiple_uploads = isset( $val[ 'multiple_uploads' ] ) ? 1 : 0; ?>
                <input type="checkbox" name="field_data[<?php echo $key; ?>][multiple_uploads]" value="1" class="ufb-multiple-upload-trigger" <?php checked( $multiple_uploads, true ); ?>/>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-allow-multiple-upload-ref" <?php if ( $multiple_uploads == 0 ) { ?>style="display:none;"<?php } ?>>
            <label>
                <?php _e( 'Number of allowed uploads', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the number of files that user can upload through the file uploader.Default maximum number is infinite.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][allowed_number]" placeholder="5"  value="<?php echo esc_attr( $val[ 'allowed_number' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap ufb-allow-multiple-upload-ref" <?php if ( $multiple_uploads == 0 ) { ?>style="display:none;"<?php } ?>>
            <label>
                <?php _e( 'Upload Limit Error Message', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the error message that will be shown to user when they try to upload more than the upload limit number.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][upload_limit_error_message]" placeholder="<?php _e( 'Maximum number of files allowed is 2.', UFB_TD ); ?>" value="<?php echo esc_attr( $val[ 'upload_limit_error_message' ] ); ?>"/>
            </div>
        </div>

        <div class="ufb-form-field-wrap">
            <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]"  value="<?php echo esc_attr( $val[ 'field_id' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]"  value="<?php echo esc_attr( $val[ 'field_class' ] ); ?>"/>
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
            <label>
                <?php _e( 'Hidden by Default', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'Check if you want to hide this element at the beginning of the form load. It is useful when you want show with some conditional logic.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="checkbox" name="field_data[<?php echo $key; ?>][hidden]" value="1" <?php echo (isset( $val[ 'hidden' ] ) && $val[ 'hidden' ] == 1) ? 'checked="checked"' : ''; ?>/>
            </div>
        </div>
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="file-uploader"/>
    </div>
</div><!--ufb-each-form-field-->




