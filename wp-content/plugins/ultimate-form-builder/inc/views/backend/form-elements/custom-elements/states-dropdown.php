<div class="ufb-states-dropdown-reference">
    <div class="ufb-each-form-field ufb-relative">
        <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
        <div class="ufb-form-field-wrap">
            <label class="ufb-field-label-ref"><?php echo ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled States', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <select disabled="disabled">
                    <option>Alaska</option>
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
                    <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e( 'Your State', UFB_TD ); ?>" class="ufb-field-label-field ufb-field" value="<?php echo esc_attr( $val['field_label'] ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Field Notes', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This field is to enable or disable the field notes or information for the field.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <?php $field_notes = isset( $val['field_notes'] ) ? $val['field_notes'] : '0'; ?>
                    <select name="field_data[<?php echo $key; ?>][field_notes]" class="ufb-field-notes-trigger">
                        <option value="0" <?php selected( $val['field_notes'], '0' ); ?>><?php _e( 'Don\'t Show', UFB_TD ); ?></option>
                        <option value="sub-label" <?php selected( $val['field_notes'], 'sub-label' ); ?>><?php _e( 'Show as sub label', UFB_TD ); ?></option>
                        <option value="info-icon" <?php selected( $val['field_notes'], 'info-icon' ); ?>><?php _e( 'Show as info icon', UFB_TD ); ?></option>
                    </select>
                </div>
            </div>
            <div class="ufb-form-field-wrap ufb-field-note-text" <?php if ( $val['field_notes'] == '0' ) { ?> style="display: none"<?php } ?>>
                <label>
                    <?php _e( 'Note Text', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This field is for field note or field information text.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[<?php echo $key; ?>][note_text]" placeholder="<?php _e( 'Your Website', UFB_TD ); ?>" value="<?php echo isset( $val['note_text'] ) ? esc_attr( $val['note_text'] ) : ''; ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'First Option Label', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[<?php echo $key; ?>][first_option_label]" placeholder="<?php _e( 'Choose State', UFB_TD ); ?>" value="<?php echo isset( $val['first_option_label'] ) ? esc_attr( $val['first_option_label'] ) : ''; ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Pre Populated States of a Country', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'Please choose a country to prepopulate the states of that specific country.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <select name="field_data[<?php echo $key; ?>][pre_populated_states]" class="ufb-pre-populate-states-trigger">
                        <option value=""><?php _e( 'Choose Country', UFB_TD ); ?></option>
                        <?php foreach ( $country_list as $country ) {
                            ?>
                            <option value="<?php echo $country['id'] ?>" <?php selected( $val['pre_populated_states'], $country['id'] ); ?> ><?php echo $country['name']; ?></option>
                        <?php }
                        ?>
                    </select>
                    <div class="ufb-ajax-loader" style="display:none;"></div>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'States list trigger Field', UFB_TD ); ?></label>
                <?php echo UFB_Lib::generate_help_text( __( 'Please choose a country field on which change, the states should list.For this you should already have added a country field in the form.', UFB_TD ) ); ?>
                <div class="ufb-form-field">
                    <select name="field_data[<?php echo $key; ?>][states_list_trigger_field]" class="ufb-states-trigger-field-ref">
                        <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                        <?php
                       // UFB_Lib::print_array( $val );
                        foreach ( $form_detail['field_data'] as $key1 => $val1 ) {
                            if ( $val1['field_type'] == 'country-dropdown' ) {
                                $field_label = ($val1['field_label'] != '') ? esc_attr( $val1['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val1['field_type'] );
                                ?>
                                <option value="<?php echo $key1; ?>" <?php selected( $val['states_list_trigger_field'], $key1 ); ?>><?php echo $key1 . ' ( ' . $field_label . ' )'; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <p class="description"><?php _e( 'If you have added country dropdown list and haven\'t saved the form then please save the form first to get that field in the above list', UFB_TD ); ?></p>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Pre Selected State', UFB_TD ); ?></label>
                <?php echo UFB_Lib::generate_help_text( __( 'Please choose a state to be selected by default.', UFB_TD ) ); ?>
                <div class="ufb-form-field">
                    <select name="field_data[<?php echo $key; ?>][pre_selected_state]" class="ufb-states-ref">
                        <option value=""><?php _e( 'Choose State', UFB_TD ); ?></option>
                        <?php
                        if ( $val['pre_populated_states'] != '' ) {
                            $country_id = esc_attr( $val['pre_populated_states'] );
                            $states_array = UFB_Model::get_states_from_country( $country_id );
                            
                            //$this->library->print_array($states_array);
                            if ( !empty( $states_array ) ) {

                                foreach ( $states_array as $state ) {
                                    ?>
                                    <option value="<?php echo $state->id; ?>" <?php selected($val['pre_selected_state'],$state->id);?>><?php echo $state->name; ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <p class="description"><?php _e( 'Please select country from above Pre populated States of a Country field', UFB_TD ); ?></p>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Required', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="checkbox" name="field_data[<?php echo $key; ?>][required]" value="1" <?php echo (isset( $val['required'] ) && $val['required'] == 1) ? 'checked="checked"' : ''; ?>/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Error Message', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[<?php echo $key; ?>][error_message]" placeholder="<?php _e( 'Please choose your state', UFB_TD ); ?>" value="<?php echo esc_attr( $val['error_message'] ); ?>"/>
                </div>
            </div>

            <div class="ufb-form-field-wrap">
                <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[<?php echo $key; ?>][field_id]" value="<?php echo esc_attr( $val['field_id'] ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
                <div class="ufb-form-field">
                    <input type="text" name="field_data[<?php echo $key; ?>][field_class]" value="<?php echo esc_attr( $val['field_class'] ); ?>"/>
                </div>
            </div>
            <div class="ufb-form-field-wrap">
                <label>
                    <?php _e( 'Column', UFB_TD ); ?>
                    <?php echo UFB_Lib::generate_help_text( __( 'This is the column wise display of your field.', UFB_TD ) ); ?>
                </label>
                <div class="ufb-form-field">
                    <?php $column = isset( $val['column'] ) ? $val['column'] : '1' ?>
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
                    <input type="checkbox" name="field_data[<?php echo $key; ?>][hidden]" value="1" <?php echo (isset( $val['hidden'] ) && $val['hidden'] == 1) ? 'checked="checked"' : ''; ?>/>
                </div>
            </div>
            <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="states-dropdown" data-field-name="<?php echo $key; ?>" data-field-type="field_type"/>
        </div>
    </div><!--ufb-each-form-field-->
</div>