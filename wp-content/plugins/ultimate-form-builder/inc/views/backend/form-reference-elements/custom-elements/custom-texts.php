<div class="ufb-custom-texts-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled Custom Texts', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <?php _e( '<p><strong>Note:</strong>Please double check your <strong>email</strong> and <strong>username</strong> before submitting the form.</p>', UFB_TD ); ?>
            </div>
        </div><!--ufb-form-field-wrap-->
        <div class="ufb-field-controls">
            <a href="javascript:void(0)" class="ufb-field-settings-trigger button-primary"><?php _e( 'Settings', UFB_TD ); ?></a><span>+</span>
            <a href="javascript:void(0)" class="ufb-field-delete-trigger">Delete</a>
        </div>
        <div class="ufb-field-settings-wrap" style="display:none;">
            <span class="ufb-up-arrow"></span>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Field Label', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This label won\'t show up in the form.Its just the reference for you to recognize the field.', UFB_TD ) );
                    ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Extra Notes', UFB_TD ); ?>" class="ufb-field-label-field ufb-field"/>
                </div>
            </div>

            <div class="ufb-form-field-wrap ufb-full-width">
                <label><?php _e( 'Custom Text', UFB_TD ); ?><?php echo UFB_Lib::generate_help_text( __( 'You can use basic html tags such as &lt;p>, &lt;strong>,&lt;u>, &lt;em>, &lt;ul> &lt;li>, &lt;quote>, &lt;a> etc. ', UFB_TD ) ); ?></label>
                <div class="ufb-form-field">
                    <textarea name="field_data[ufb_key][custom_text]"></textarea>
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
            <input type="hidden" name="field_data[ufb_key][field_type]" value="custom-texts" />
        </div>
    </div><!--ufb-each-form-field-->
</div>

