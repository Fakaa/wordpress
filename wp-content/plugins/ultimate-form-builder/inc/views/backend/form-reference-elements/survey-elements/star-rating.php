<div class="ufb-star-rating-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap ufb-without-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled Star Rating', UFB_TD ); ?></label>
            <div class="ufb-form-field">
            <img src="<?php echo UFB_IMG_DIR . '/star-rating-preview.jpg'; ?>"/>

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
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Our Service', UFB_TD ); ?>" class="ufb-field-label-field" />
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
            <div class="ufb-form-field-wrap ufb-full-width ufb-op-wrap">
                <label><?php _e( 'Stars', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="button" value="<?php _e( 'Add Star', UFB_TD ); ?>" class="ufb-star-value-adder button-primary" name="ufb_key_ref_key"/>
                    <div class="ufb-star-value-wrap">
                        <div class="ufb-each-star">
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label">Value 1</span>
                                <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( '1/5', UFB_TD ); ?>" placeholder="1/5" />
                            </div>
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label1">Label 1</span>
                                <input type="text" name="field_data[ufb_key][label][]" value="<?php _e( 'Terrible', UFB_TD ); ?>" placeholder="Terrible" />
                            </div>
                            <span class="ufb-star-remover">X</span>
                        </div>
                        <div class="ufb-each-star">
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label">Value 2</span>
                                <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( '2/5', UFB_TD ); ?>" placeholder="1/5" />
                            </div>
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label1">Label 2</span>
                                <input type="text" name="field_data[ufb_key][label][]" value="<?php _e( 'Bad', UFB_TD ); ?>" placeholder="Terrible" />
                            </div>
                            <span class="ufb-star-remover">X</span>
                        </div>
                        <div class="ufb-each-star">
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label">Value 3</span>
                                <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( '3/5', UFB_TD ); ?>" placeholder="1/5" />
                            </div>
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label1">Label 3</span>
                                <input type="text" name="field_data[ufb_key][label][]" value="<?php _e( 'Good', UFB_TD ); ?>" placeholder="Terrible" />
                            </div>
                            <span class="ufb-star-remover">X</span>
                        </div>
                        <div class="ufb-each-star">
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label">Value 4</span>
                                <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( '4/5', UFB_TD ); ?>" placeholder="1/5" />
                            </div>
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label1">Label 4</span>
                                <input type="text" name="field_data[ufb_key][label][]" value="<?php _e( 'Better', UFB_TD ); ?>" placeholder="Terrible" />
                            </div>
                            <span class="ufb-star-remover">X</span>
                        </div>
                        <div class="ufb-each-star">
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label">Value 5</span>
                                <input type="text" name="field_data[ufb_key][value][]" value="<?php _e( '5/5', UFB_TD ); ?>" placeholder="1/5" />
                            </div>
                            <div class="ufb-star-label-wrap">
                                <span class="ufb-star-label1">Label 5</span>
                                <input type="text" name="field_data[ufb_key][label][]" value="<?php _e( 'Best', UFB_TD ); ?>" placeholder="Terrible" />
                            </div>
                            <span class="ufb-star-remover">X</span>
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
                        <option value="2">2/</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="field_data[ufb_key][field_type]" value="star-rating" />
        </div>
    </div><!--ufb-each-form-field-->
</div>