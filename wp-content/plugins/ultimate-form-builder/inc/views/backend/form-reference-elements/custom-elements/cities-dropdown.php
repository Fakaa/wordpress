<div class="ufb-city-dropdown-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <label class="ufb-field-label-ref"><?php _e( 'Untitled City Field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" disabled="disabled"/>
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
                    <input type="text" name="field_data[ufb_key][field_label]" placeholder="<?php _e( 'Your City', UFB_TD ); ?>" class="ufb-field-label-field ufb-field" data-field-name="ufb_key" data-field-type="field_label"/>
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
                    <input type="text" name="field_data[ufb_key][note_text]" placeholder="<?php _e( 'Your City', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Required', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[ufb_key][required]" value="1" data-field-name="ufb_key" data-field-type="required"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Error Message', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][error_message]" placeholder="<?php _e( 'Please choose a city', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'First Option Label', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[ufb_key][first_option_label]" placeholder="<?php _e( 'Choose City', UFB_TD ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Pre Populated Cities of a Country', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'Please choose a country to prepopulate the cities of that specific country.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][pre_populated_country]" class="ufb-pre-country-city-trigger">
                        <option value=""><?php _e( 'Choose Country', UFB_TD ); ?></option>
                        <?php foreach ( $country_list as $country ) {
                            ?>
                            <option value="<?php echo $country['id'] ?>" ><?php echo $country['name']; ?></option>
                            <?php }
                        ?>
                    </select>       
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Pre Populated States of a Country', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'Please choose a country first to prepopulate the states of that specific country and then choose state to  prepopulate cities of that specific state.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][pre_populated_state]" class="ufb-pre-populated-states-ref">
                        <option value=""><?php _e( 'Choose State', UFB_TD ); ?></option>
                    </select>
                    <p class="description"><?php _e( 'Please choose the country to populate states of that specific country in this list', UFB_TD ); ?></p>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Pre Selected City', UFB_TD ); ?></label>
                <?php echo UFB_Lib::generate_help_text( __( 'Please choose a state to be selected by default.', UFB_TD ) ); ?>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][pre_selected_city]" class="ufb-pre-populated-city-ref">
                        <option value=""><?php _e( 'Choose City', UFB_TD ); ?></option>
                    </select>
                    <p class="description"><?php _e( 'Please select country from above Pre populated States of a Country field', UFB_TD ); ?></p>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Cities list trigger Field', UFB_TD ); ?></label>
                <?php echo UFB_Lib::generate_help_text( __( 'Please choose a state field on which change, the cities should list.For this you should already have added an state field in the form.', UFB_TD ) ); ?>
                <div class="ufb-form-field">
                    <select name="field_data[ufb_key][city_list_trigger_field]">
                        <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                        <?php
                        $form_detail = maybe_unserialize( $form_row['form_detail'] );
                        foreach ( $form_detail['field_data'] as $key1 => $val1 ) {
                            if ( $val1['field_type'] == 'states-dropdown' ) {
                                $field_label = ($val1['field_label'] != '') ? esc_attr( $val1['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val1['field_type'] );
                                ?>
                                <option value="<?php echo $key1; ?>" ><?php echo $key1 . ' ( ' . $field_label . ' )'; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <p class="description"><?php _e( 'If you have added states dropdown list and haven\'t saved the form then please save the form first to get that field in the above list', UFB_TD ); ?></p>
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
            <input type="hidden" name="field_data[ufb_key][field_type]" value="city-dropdown" data-field-name="ufb_key" data-field-type="field_type"/>
        </div>
    </div><!--ufb-each-form-field-->
</div>