<div class="ufb-each-form-field ufb-submit-button-wrap ufb-relative">
                                    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
                                    <div class="ufb-form-field-wrap">
                                        <label class="ufb-field-label-ref"><?php echo (isset($val['field_label']) && $val['field_label'] != '') ? esc_attr($val['field_label']) : __('Untitled Hidden', UFB_TD); ?></label>
                                        <div class="ufb-form-field">
                                            <input type="hidden" disabled="disabled"/>
                                        </div>
                                    </div><!--ufb-form-field-wrap-->
                                    <div class="ufb-field-controls">
                                        <a href="javascript:void(0)" class="ufb-field-settings-trigger button-primary"><?php _e('Settings', UFB_TD); ?></a><span>+</span>
                                        <a href="javascript:void(0)" class="ufb-field-delete-trigger">Delete</a>
                                    </div>
                                    <div class="ufb-field-settings-wrap" style="display:none;">
                                        <span class="ufb-up-arrow"></span>
                                        <div class="ufb-form-field-wrap">
                                            <label><?php _e('Field Label', UFB_TD); ?></label>
                                            <div class="ufb-form-field">
                                                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" class="ufb-field-label-field" data-field-name="<?php echo $key; ?>" data-field-type="field_label" value="<?php echo isset($val['field_label']) ? esc_attr($val['field_label']) : '' ?>"/>
                                            </div>
                                        </div>
                                        <div class="ufb-form-field-wrap">
                                            <label><?php _e('Pre filled value', UFB_TD); ?></label>
                                            <div class="ufb-form-field">
                                                <input type="text" name="field_data[<?php echo $key; ?>][pre_filled_value]" data-field-name="<?php echo $key; ?>" data-field-type="pre_filled_value" value="<?php echo isset($val['pre_filled_value']) ? esc_attr($val['pre_filled_value']) : '' ?>"/>
                                            </div>
                                        </div>
                                        <div class="ufb-form-field-wrap">
                                            <label><?php _e('ID of the field', UFB_TD); ?></label>
                                            <div class="ufb-form-field">
                                                <input type="text" name="field_data[<?php echo $key; ?>][field_id]" data-field-name="<?php echo $key; ?>" data-field-type="field_id"  value="<?php echo isset($val['field_id']) ? esc_attr($val['field_id']) : '' ?>"/>
                                            </div>
                                        </div>
                                        <div class="ufb-form-field-wrap">
                                            <label><?php _e('Class of the field', UFB_TD); ?></label>
                                            <div class="ufb-form-field">
                                                <input type="text" name="field_data[<?php echo $key; ?>][field_class]" data-field-name="<?php echo $key; ?>" data-field-type="field_class" value="<?php echo isset($val['field_class']) ? esc_attr($val['field_class']) : '' ?>"/>
                                            </div>
                                        </div>
                                        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="hidden" data-field-name="<?php echo $key; ?>" data-field-type="field_label"/>
                                    </div>
                                </div><!--ufb-each-form-field-->