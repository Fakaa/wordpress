<div class="ufb-dropdown-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled Dropdown', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <select disabled="disabled">
                    <option><?php _e( 'Option 1', UFB_TD ) ?></option>
                </select>
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
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Your Country', UFB_TD ); ?>" class="ufb-field-label-field" data-field-name="ufb_key" data-field-type="field_type"/>
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
                    <input type="checkbox" name="field_data[ufb_key][required]" value="1" data-field-name="ufb_key" data-field-type="field_type"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Error Message', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][error_message]" placeholder="<?php _e( 'Please fill your name', UFB_TD ); ?>" data-field-name="ufb_key" data-field-type="field_type"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-full-width ufb-op-wrap">
                <label><?php _e( 'Options', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="button" value="<?php _e( 'Add Option', UFB_TD ); ?>" class="ufb-option-value-adder button-primary" data-field-key="ufb_key"/>
                    <div class="ufb-option-value-wrap">
                        <div class="ufb-each-option">
                            <span class="ufb-option-drag-arrow"><i class="fa fa-arrows"></i></span>
                            <input type="text" name="field_data[ufb_key][option][]" value="<?php _e( 'Option 1', UFB_TD ); ?>" placeholder="Option" data-field-name="ufb_key" data-field-type="option"/>
                            <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( 'Option 1', UFB_TD ); ?>" placeholder="Value" data-field-name="ufb_key" data-field-type="value"/>
                            <span class="ufb-option-remover">X</span>
                        </div>
                        <div class="ufb-each-option">
                            <span class="ufb-option-drag-arrow"><i class="fa fa-arrows"></i></span>
                            <input type="text" name="field_data[ufb_key][option][]" value="<?php _e( 'Option 2', UFB_TD ); ?>" placeholder="Option" data-field-name="ufb_key" data-field-type="option"/>
                            <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( 'Option 2', UFB_TD ); ?>" placeholder="Value" data-field-name="ufb_key" data-field-type="value"/>
                            <span class="ufb-option-remover">X</span>
                        </div>
                        <div class="ufb-each-option">
                            <span class="ufb-option-drag-arrow"><i class="fa fa-arrows"></i></span>
                            <input type="text" name="field_data[ufb_key][option][]" value="<?php _e( 'Option 3', UFB_TD ); ?>" placeholder="Option" data-field-name="ufb_key" data-field-type="option"/>
                            <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( 'Option 3', UFB_TD ); ?>" placeholder="Value" data-field-name="ufb_key" data-field-type="value"/>
                            <span class="ufb-option-remover">X</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Multiple', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[ufb_key][multiple]" value="1" data-field-name="ufb_key" data-field-type="multiple"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_id]" data-field-name="ufb_key" data-field-type="field_id"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_class]" data-field-name="ufb_key" data-field-type="field_class"/>
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
            <input type="hidden" name="field_data[ufb_key][field_type]" value="dropdown" data-field-name="ufb_key" data-field-type="field_type"/>
        </div>
    </div><!--ufb-each-form-field-->
</div>