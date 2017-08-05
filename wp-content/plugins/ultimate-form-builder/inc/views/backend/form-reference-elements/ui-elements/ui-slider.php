<div class="ufb-ui-slider-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled UI Slider', UFB_TD ); ?></label>
            <div class="ufb-form-field">

                <div class="ufb-slider-ref-wrap">
                    <div class="ufb-ui-slider"></div>
                    <span class="ufb-slider-value">0</span>
                </div>
                <div class="ufb-range-slider-ref-wrap" style="display:none;">
                    <div class="ufb-range-slider"></div>
                    <span class="ufb-slider-value">0-0</span>
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
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Budget', UFB_TD ); ?>" class="ufb-field-label-field ufb-field"/>
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
                <label><?php _e( 'Slider Type', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <label><input type="radio" name="field_data[ufb_key][slider_type]" value="default" checked="checked" class="ufb-slider-type"/><span class="ufb-radio-label"><?php _e( 'Default', UFB_TD ); ?></span></label>
                    <label><input type="radio" name="field_data[ufb_key][slider_type]" value="range"  class="ufb-slider-type"/><span class="ufb-radio-label"><?php _e( 'Rangle Slider', UFB_TD ); ?></span></label>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Slider Min Value', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the minimum value which slider can select.Default value is 0.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][min_value]" placeholder="0"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Slider Max Value', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the maximum value which slider can select.Default Value is 100', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][max_value]" placeholder="100"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Slider Step', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the value which is changed in each slide.Default is 1.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][slider_step]" placeholder="100"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Minimum Required Value', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the minimum value that user can select from the slider.Default is your slider minimum value.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][min_required_value]" placeholder="10"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Maximum Required Value', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the maximum value that user can select from the slider.Default Value is slider\' maximum value.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][max_required_value]" placeholder="75"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Error Message', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][error_message]" placeholder="<?php _e( 'Please choose the budget greater than 0.', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Pre selected value', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'Please give single numeric number such as 2,3,20 for slider and 2-20, 3-20 for range slider or leave blank if you don\'t want any pre selected value to display.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][pre_selected_value]" placeholder="<?php _e( 'E.g: 5 or 7-70' ); ?>"/>
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
            <input type="hidden" name="field_data[ufb_key][field_type]" value="ui-slider"/>
        </div>
    </div><!--ufb-each-form-field-->
</div>

