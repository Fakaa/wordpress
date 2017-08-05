<div class="ufb-each-form-field ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap ufb-without-field-wrap">
        <label class="ufb-field-label-ref"><?php echo ($val[ 'field_label' ] != '') ? esc_attr( $val[ 'field_label' ] ) : __( 'Untitled Choice Matrix', UFB_TD ); ?></label>
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
                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e( 'Ratings', UFB_TD ); ?>" class="ufb-field-label-field"  value="<?php echo esc_attr( $val[ 'field_label' ] ); ?>"/>
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
                <input type="text" name="field_data[<?php echo $key; ?>][error_message]" placeholder="<?php _e( 'Please give us rating.', UFB_TD ); ?>" value="<?php echo esc_attr( $val[ 'error_message' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Matrix Column', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <select name="field_data[<?php echo $key; ?>][matrix_column]" class="ufb-matrix-column">
                    <?php
                    for ( $i = 2; $i <= 5; $i++ ) {
                        ?>
                        <option value="<?php echo $i; ?>" <?php selected( $val[ 'matrix_column' ], $i ) ?>><?php echo $i; ?> Column</option>
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
                    <input type="text" name="field_data[<?php echo $key; ?>][matrix_column_label][heading1]" value="<?php echo esc_attr( $val[ 'matrix_column_label' ][ 'heading1' ] ); ?>"/>
                </div>
                <div class="ufb-matrix-each-head ufb-matrix-heading-2">
                    <span class="ufb-matrix-head-title"><?php _e( 'Heading 2', UFB_TD ); ?></span>
                    <input type="text" name="field_data[<?php echo $key; ?>][matrix_column_label][heading2]" value="<?php echo esc_attr( $val[ 'matrix_column_label' ][ 'heading2' ] ); ?>"/>
                </div>
                <div class="ufb-matrix-each-head ufb-matrix-heading-3" <?php if ( $val[ 'matrix_column' ] < 3 ) { ?>style="display:none;"<?php } ?>>
                    <span class="ufb-matrix-head-title"><?php _e( 'Heading 3', UFB_TD ); ?></span>
                    <input type="text" name="field_data[<?php echo $key; ?>][matrix_column_label][heading3]" value="<?php echo esc_attr( $val[ 'matrix_column_label' ][ 'heading3' ] ); ?>"/>
                </div>
                <div class="ufb-matrix-each-head ufb-matrix-heading-4" <?php if ( $val[ 'matrix_column' ] < 4 ) { ?>style="display:none;"<?php } ?>>
                    <span class="ufb-matrix-head-title"><?php _e( 'Heading 4', UFB_TD ); ?></span>
                    <input type="text" name="field_data[<?php echo $key; ?>][matrix_column_label][heading4]" value="<?php echo esc_attr( $val[ 'matrix_column_label' ][ 'heading4' ] ); ?>"/>
                </div>
                <div class="ufb-matrix-each-head ufb-matrix-heading-5" <?php if ( $val[ 'matrix_column' ] < 5 ) { ?>style="display:none;"<?php } ?>>
                    <span class="ufb-matrix-head-title"><?php _e( 'Heading 5', UFB_TD ); ?></span>
                    <input type="text" name="field_data[<?php echo $key; ?>][matrix_column_label][heading5]" value="<?php echo esc_attr( $val[ 'matrix_column_label' ][ 'heading5' ] ); ?>"/>
                </div>
            </div>
        </div> 
        <div class="ufb-form-field-wrap ufb-full-width ufb-op-wrap">
            <label><?php _e( 'Row Heading Labels', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="button" value="<?php _e( 'Add Row', UFB_TD ); ?>" class="ufb-matrix-row-adder button-primary" name="<?php echo $key; ?>_matrix_row_ref"/>
                <div class="ufb-matrix-row-wrap">
                    <?php
                    if ( isset( $val[ 'matrix_row_value' ] ) && count( $val[ 'matrix_row_value' ] > 0 ) ) {
                        $row_heading_count = 1;
                        foreach ( $val[ 'matrix_row_value' ] as $row_heading ) {
                            ?>
                            <div class="ufb-each-matrix-row">
                                <span class="ufb-matrix-row-label">Row <?php echo $row_heading_count; ?> Heading</span>
                                <input type="text" name="field_data[<?php echo $key; ?>][matrix_row_value][]" value="<?php echo esc_attr( $row_heading ); ?>" placeholder="<?php _e( 'Service', UFB_TD ); ?>" />
                                <span class="ufb-matrix-row-remover ufb-remove-btn">X</span>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
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
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="choice-matrix" />
    </div>

</div><!--ufb-each-form-field-->
