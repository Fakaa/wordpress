<div class="ufb-file-uploader-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled File Uploader', UFB_TD ); ?></label>
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
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Your Image', UFB_TD ); ?>" class="ufb-field-label-field ufb-field"/>
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
                <label><?php _e( 'Required', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[ufb_key][required]" value="1" data-field-name="ufb_key" data-field-type="required"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Required Error Message', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][required_error_message]" placeholder="<?php _e( 'Please upload atleast a single file.', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Upload Button Label', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the label of the button.Default label is "Upload a file".', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][upload_button_label]" placeholder="<?php _e( 'Upload an image', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Max Upload Size in MB', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the maximum size limit of the file uploader.Default file size is 8 MB.Please add only numeric value.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][max_upload_size]" placeholder="8"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-full-width">
                <label>
                    <?php _e( 'Choose file extensions', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'Please choose the extension that you only want to allow from this file uploader.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <div class="ufb-sub-field-wrap">
                        <div class="ufb-sub-heading"><?php _e( 'Images', UFB_TD ); ?></div>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]"  value="jpg"/>jpg</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="jpeg"/>jpeg</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]"  value="png"/>png</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]"  value="gif"/>gif</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]"  value="bmp"/>bmp</label>
                    </div>
                    <div class="ufb-sub-field-wrap">
                        <div class="ufb-sub-heading"><?php _e( 'Documents', UFB_TD ); ?></div>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="pdf"/>pdf</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="doc"/>doc|docx</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="xls"/>xls|xlsx</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="odt"/>odt</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="ppt"/>ppt|pptx</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="pps"/>pps|ppsx</label>
                    </div>
                    <div class="ufb-sub-field-wrap">
                        <div class="ufb-sub-heading"><?php _e( 'Audio', UFB_TD ); ?></div>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="mp3"/>mp3</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="mp4"/>mp4</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="ogg"/>ogg</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="wav"/>wav</label>

                    </div>
                    <div class="ufb-sub-field-wrap">
                        <div class="ufb-sub-heading"><?php _e( 'Video', UFB_TD ); ?></div>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="mp4"/>mp3</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="m4v"/>m4v</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="mov"/>mov</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="wmv"/>wmv</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="avi"/>avi</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="mpg"/>mpg</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="ogv"/>ogv</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="3gp"/>3gp</label>
                        <label><input type="checkbox" name="field_data[ufb_key][extension][]" value="3g2"/>3g2</label>
                    </div>
                </div>
                <div class="ufb-sub-field-wrap">
                    <div class="ufb-sub-heading">
                        <?php _e( 'Custom Extension', UFB ) ?>
                        <?php echo UFB_Lib::generate_help_text( __( 'Please enter the extension that is not available in the above list but you want to allow the users to be able to upload.Use comma for multiple extensions.For example: zip,gzip', UFB_TD ) ); ?>
                    </div>
                    <input type="text" name="field_data[ufb_key][custom_extension]" placeholder="zip,gzip"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Extension error message', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the error message that will be shown to user when they try to upload the files with unallowed extension.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][extension_error_message]" placeholder="75"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Allow multiple uploads', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[ufb_key][multiple_uploads]" value="1" class="ufb-multiple-upload-trigger"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-allow-multiple-upload-ref" style="display:none;">
                <label>
                    <?php _e( 'Number of allowed uploads', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the number of files that user can upload through the file uploader.Default maximum number is infinite.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][allowed_number]" placeholder="5"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-allow-multiple-upload-ref" style="display:none;">
                <label>
                    <?php _e( 'Upload Limit Error Message', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the error message that will be shown to user when they try to upload more than the upload limit number.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][upload_limit_error_message]" placeholder="<?php _e( 'Maximum number of files allowed is 2.', UFB_TD ); ?>"/>
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
            <input type="hidden" name="field_data[ufb_key][field_type]" value="file-uploader"/>
        </div>
    </div><!--ufb-each-form-field-->
</div>



