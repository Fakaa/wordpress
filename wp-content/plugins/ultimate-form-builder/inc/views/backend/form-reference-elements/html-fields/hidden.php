<div class="ufb-hidden-reference">
        <div class="ufb-each-form-field ufb-submit-button-wrap ufb-relative">
            <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
            <div class="ufb-form-field-wrap">
                <label class="ufb-field-label-ref"><?php _e( 'Untitled Hidden', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="hidden" disabled="disabled"/>
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
                        <input type="text" name="field_data[ufb_key][field_label]" data-field-name="ufb_key" data-field-type="field_label" class="ufb-field-label-field"/>
                    </div>
                </div>
                <div class="ufb-form-field-wrap">
                    <label><?php _e( 'Pre filled value', UFB_TD ); ?></label>
                    <div class="ufb-form-field">
                        <input type="text" name="field_data[ufb_key][pre_filled_value]" data-field-name="ufb_key" data-field-type="field_label"/>
                    </div>
                </div>
                <div class="ufb-form-field-wrap">
                    <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
                    <div class="ufb-form-field">
                        <input type="text" name="field_data[ufb_key][field_id]" data-field-name="ufb_key" data-field-type="field_label"/>
                    </div>
                </div>
                <div class="ufb-form-field-wrap">
                    <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
                    <div class="ufb-form-field">
                        <input type="text" name="field_data[ufb_key][field_class]" data-field-name="ufb_key" data-field-type="field_label"/>
                    </div>
                </div>
                <input type="hidden" name="field_data[ufb_key][field_type]" value="hidden" data-field-name="ufb_key" data-field-type="field_label"/>
            </div>
        </div><!--ufb-each-form-field-->
    </div>