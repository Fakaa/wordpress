<div class="ufb-choice-matrix-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap ufb-without-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled Choice Matrix', UFB_TD ); ?></label>
            <div class="ufb-form-field">
            <img src="<?php echo UFB_IMG_DIR . '/choice-matrix-preview.jpg'; ?>"/>

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
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Ratings', UFB_TD ); ?>" class="ufb-field-label-field" />
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
                    <input type="checkbox" name="field_data[ufb_key][required]" value="1"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Error Message', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][error_message]" placeholder="<?php _e( 'Please give us a rating.', UFB_TD ); ?>" />
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Matrix Column', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][matrix_column]" class="ufb-matrix-column">
                        <?php
                        for ( $i = 2; $i <= 5; $i++ ) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> Column</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-full-width">
                <label><?php _e( 'Column Heading Labels' ); ?></label>
                <div class="ufb-form-field">
                    <div class="ufb-matrix-each-head ufb-matrix-heading-1">
                        <span class="ufb-matrix-head-title"><?php _e( 'Heading 1', UFB_TD ); ?></span>
                        <input type="text" name="field_data[ufb_key][matrix_column_label][heading1]" value="<?php _e( 'Terrible', UFB_TD ); ?>"/>
                    </div>
                    <div class="ufb-matrix-each-head ufb-matrix-heading-2">
                        <span class="ufb-matrix-head-title"><?php _e( 'Heading 2', UFB_TD ); ?></span>
                        <input type="text" name="field_data[ufb_key][matrix_column_label][heading2]" value="<?php _e( 'Fair', UFB_TD ); ?>"/>
                    </div>
                    <div class="ufb-matrix-each-head ufb-matrix-heading-3" style="display:none;">
                        <span class="ufb-matrix-head-title"><?php _e( 'Heading 3', UFB_TD ); ?></span>
                        <input type="text" name="field_data[ufb_key][matrix_column_label][heading3]" value="<?php _e( 'Satisfactory', UFB_TD ); ?>"/>
                    </div>
                    <div class="ufb-matrix-each-head ufb-matrix-heading-4" style="display:none;">
                        <span class="ufb-matrix-head-title"><?php _e( 'Heading 4', UFB_TD ); ?></span>
                        <input type="text" name="field_data[ufb_key][matrix_column_label][heading4]" value="<?php _e( 'Good', UFB_TD ); ?>"/>
                    </div>
                    <div class="ufb-matrix-each-head ufb-matrix-heading-5" style="display:none;">
                        <span class="ufb-matrix-head-title"><?php _e( 'Heading 5', UFB_TD ); ?></span>
                        <input type="text" name="field_data[ufb_key][matrix_column_label][heading5]" value="<?php _e( 'Excellent', UFB_TD ); ?>"/>
                    </div>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-full-width ufb-op-wrap">
                <label><?php _e( 'Column Heading Labels', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="button" value="<?php _e( 'Add Row', UFB_TD ); ?>" class="ufb-matrix-row-adder button-primary" name="ufb_key_matrix_row_ref"/>
                    <div class="ufb-matrix-row-wrap">
                        <div class="ufb-each-matrix-row">
                            <span class="ufb-matrix-row-label">Row 1 Heading</span>
                            <input type="text" name="field_data[ufb_key][matrix_row_value][]" value="<?php _e( 'Efficiency', UFB_TD ); ?>" placeholder="<?php _e( 'Service', UFB_TD ); ?>" />
                            <span class="ufb-matrix-row-remover ufb-remove-btn">X</span>
                        </div>
                        <div class="ufb-each-matrix-row">
                            <span class="ufb-matrix-row-label">Row 2 Heading</span>
                            <input type="text" name="field_data[ufb_key][matrix_row_value][]" value="<?php _e( 'Quality', UFB_TD ); ?>" placeholder="<?php _e( 'Service', UFB_TD ); ?>"/>
                            <span class="ufb-matrix-row-remover ufb-remove-btn">X</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_id]" />
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_class]" />
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
            <input type="hidden" name="field_data[ufb_key][field_type]" value="choice-matrix" />
        </div>
    </div><!--ufb-each-form-field-->
</div>