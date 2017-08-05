<?php
global $library_obj;
$form_detail = maybe_unserialize( $form_row['form_detail'] );
$form_default_settings = $library_obj->get_default_detail();
//$library_obj->print_array($form_default_settings);
?>
<div class="ufb-tab-content" id="ufb-conditional-logic-tab" style="display:none">
    <ul class="ufb-conditional-tabs">
        <li class="ufb-conditon-trigger ufb-active-condition-trigger" data-condition="display"><?php _e( 'Display Logic', UFB_TD ); ?></li>
        <li class="ufb-conditon-trigger" data-condition="email"><?php _e( 'Email Logic', UFB_TD ); ?></li>
        <li class="ufb-conditon-trigger" data-condition="redirect"><?php _e( 'Redirect Logic', UFB_TD ); ?></li>
    </ul>
    <div class="ufb-field-note">
        <p><?php _e( 'Note: Single Line Textfield, Multiple Line Textfield, Email, Dropdown, Radio Buttons, Checkbox, Number field, Datepicker, URL field  are only applicable for conditional Logic', UFB_TD ); ?></p>
        <p><?php _e( 'If you have added new fields but haven\'t saved the form, then please save the form first before adding the conditonal logic.', UFB_TD ); ?></p>
    </div>
    <div class="ufb-condition-section" data-condition="display">
        <input type="button" class="button button-primary ufb-display-condition-adder" value="<?php _e( 'Add New Condition', UFB_TD ); ?>"/>
        <div class="ufb-display-condition-wrap">
            <?php
            if ( isset( $form_detail['conditional_logic']['display_logic'] ) ) {
                $count = 0;
                foreach ( $form_detail['conditional_logic']['display_logic']['change_field'] as $change_field ) {
                    ?>
                    <div class="ufb-each-condition">
                        <span class="ufb-condition-text"> <?php _e( 'If', UFB_TD ); ?> </span>
                        <select name="conditional_logic[display_logic][change_field][]">
                            <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                            <?php
                            $valid_fields = array( 'textfield', 'textarea', 'email', 'dropdown', 'radio', 'checkbox', 'number', 'datepicker', 'url', 'like-dislike' );
                            foreach ( $form_detail['field_data'] as $key => $val ) {
                                $field_type = $val['field_type'];
                                if ( in_array( $field_type, $valid_fields ) ) {

                                    $field_label = ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val['field_type'] );
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php selected( $change_field, $key ); ?>><?php echo $key . ' ( ' . $field_label . ' )'; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="ufb-condition-text"> <?php _e( 'is' ); ?> </span> 
                        <select name="conditional_logic[display_logic][logic][]">
                            <option value="equal" <?php selected( $form_detail['conditional_logic']['display_logic']['logic'][$count], 'equal' ); ?>>Equals to</option>
                            <option value="less" <?php selected( $form_detail['conditional_logic']['display_logic']['logic'][$count], 'less' ); ?>>Less than</option>
                            <option value="greater" <?php selected( $form_detail['conditional_logic']['display_logic']['logic'][$count], 'greater' ); ?>>Greater than</option>
                        </select>
                        <input type="text" name="conditional_logic[display_logic][logic_check_field][]" value="<?php echo esc_attr( $form_detail['conditional_logic']['display_logic']['logic_check_field'][$count] ); ?>"/>
                        <span class="ufb-condition-text"> <?php _e( 'then', UFB_TD ); ?> </span>
                        <select name="conditional_logic[display_logic][logic_action][]">
                            <option value="show" <?php selected( $form_detail['conditional_logic']['display_logic']['logic_action'][$count], 'show' ); ?>>Show</option>
                            <option value="hide" <?php selected( $form_detail['conditional_logic']['display_logic']['logic_action'][$count], 'hide' ); ?>>Hide</option>
                        </select>
                        <select name="conditional_logic[display_logic][effect_field][]">
                            <?php
                            foreach ( $form_detail['field_data'] as $key => $val ) {
                                $field_label = ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val['field_type'] );
                                ?>
                                <option value="<?php echo $key; ?>" <?php selected( $form_detail['conditional_logic']['display_logic']['effect_field'][$count], $key ); ?>><?php echo $key . ' ( ' . $field_label . ' )'; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="ufb-condition-remove ufb-remove-btn">X</span></div>
                    <?php
                    $count++;
                }
            }
            ?>
        </div>
    </div>
    <div class="ufb-condition-section" data-condition="email" style="display: none;">
        <input type="button" class="button button-primary ufb-email-condition-adder" value="<?php _e( 'Add New Condition', UFB_TD ); ?>"/>
        <div class="ufb-email-condition-wrap">
            <?php
            if ( isset( $form_detail['conditional_logic']['email_logic'] ) ) {
                $count = 0;
                foreach ( $form_detail['conditional_logic']['email_logic']['change_field'] as $change_field ) {
                    ?>
                    <div class="ufb-each-condition">
                        <span class="ufb-condition-text"> <?php _e( 'If', UFB_TD ); ?> </span>
                        <select name="conditional_logic[email_logic][change_field][]">
                            <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                            <?php
                            $valid_fields = array( 'textfield', 'textarea', 'email', 'dropdown', 'radio', 'checkbox', 'number', 'datepicker', 'url', 'like-dislike' );
                            foreach ( $form_detail['field_data'] as $key => $val ) {
                                $field_type = $val['field_type'];
                                if ( in_array( $field_type, $valid_fields ) ) {

                                    $field_label = ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val['field_type'] );
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php selected( $change_field, $key ); ?>><?php echo $key . ' ( ' . $field_label . ' )'; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="ufb-condition-text"> <?php _e( 'is', UFB_TD ); ?> </span>
                        <select name="conditional_logic[email_logic][logic][]">
                            <option value="equal" <?php selected( $form_detail['conditional_logic']['email_logic']['logic'][$count], 'equal' ); ?>>Equals to</option>
                            <option value="less" <?php selected( $form_detail['conditional_logic']['email_logic']['logic'][$count], 'less' ); ?>>Less than</option>
                            <option value="greater" <?php selected( $form_detail['conditional_logic']['email_logic']['logic'][$count], 'greater' ); ?>>Greater than</option>
                        </select>
                        <input type="text" name="conditional_logic[email_logic][logic_check_field][]" value="<?php echo esc_attr( $form_detail['conditional_logic']['email_logic']['logic_check_field'][$count] ); ?>"/>
                        <span class="ufb-condition-text"> <?php _e( 'then email to', UFB_TD ); ?> </span>
                        <input type="text" name="conditional_logic[email_logic][email_to][]" placeholder="abc@something.com"  value="<?php echo esc_attr( $form_detail['conditional_logic']['email_logic']['email_to'][$count] ); ?>"/>
                        <span class="ufb-condition-remove ufb-remove-btn">X</span>
                    </div>
                    <?php
                    $count++;
                }
            }
            ?>
        </div>
    </div>
    <div class="ufb-condition-section" data-condition="redirect" style="display:none;">
        <div class="ufb-field-wrap">
            <label><?php _e( 'Default Redirect URL', UFB_TD ); ?></label>
            <div class="ufb-field">
                <input type="text" name="conditional_logic[default_url]" placeholder="http://something.com" value="<?php echo (isset($form_detail['conditional_logic']['default_url']))?esc_url($form_detail['conditional_logic']['default_url']):'';?>"/>
                <div class="ufb-field-note">
                    <?php _e( 'If you want to redirect the user to any other page after the successful form submission then please add the URL and leave blank if you don\'t want to redirect.<br/> Users will be redirected only when any of the redirect conditions will not match.', UFB_TD ); ?>
                </div>
            </div>
        </div>
        <input type="button" class="button button-primary ufb-redirect-condition-adder" value="<?php _e( 'Add New Condition', UFB_TD ); ?>"/>
        <div class="ufb-redirect-condition-wrap">
            <?php
            if ( isset( $form_detail['conditional_logic']['redirect_logic'] ) ) {
                $count = 0;
                foreach ( $form_detail['conditional_logic']['redirect_logic']['change_field'] as $change_field ) {
                    ?>
                    <div class="ufb-each-condition">
                        <span class="ufb-condition-text"> <?php _e( 'If', UFB_TD ); ?> </span>
                        <select name="conditional_logic[redirect_logic][change_field][]">
                            <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                            <?php
                            $valid_fields = array( 'textfield', 'textarea', 'email', 'dropdown', 'radio', 'checkbox', 'number', 'datepicker', 'url', 'like-dislike' );
                            foreach ( $form_detail['field_data'] as $key => $val ) {
                                $field_type = $val['field_type'];
                                if ( in_array( $field_type, $valid_fields ) ) {

                                    $field_label = ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val['field_type'] );
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php selected( $change_field, $key ); ?>><?php echo $key . ' ( ' . $field_label . ' )'; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="ufb-condition-text"> <?php _e( 'is', UFB_TD ); ?> </span>
                        <select name="conditional_logic[redirect_logic][logic][]">
                            <option value="equal" <?php selected( $form_detail['conditional_logic']['redirect_logic']['logic'][$count], 'equal' ); ?>>Equals to</option>
                            <option value="less" <?php selected( $form_detail['conditional_logic']['redirect_logic']['logic'][$count], 'less' ); ?>>Less than</option>
                            <option value="greater" <?php selected( $form_detail['conditional_logic']['redirect_logic']['logic'][$count], 'greater' ); ?>>Greater than</option>
                        </select>
                        <input type="text" name="conditional_logic[redirect_logic][logic_check_field][]" value="<?php echo esc_attr( $form_detail['conditional_logic']['redirect_logic']['logic_check_field'][$count] ); ?>"/>
                        <span class="ufb-condition-text"> <?php _e( 'then redirect to', UFB_TD ); ?> </span>
                        <input type="text" name="conditional_logic[redirect_logic][redirect_to][]" placeholder="abc@something.com"  value="<?php echo esc_attr( $form_detail['conditional_logic']['redirect_logic']['redirect_to'][$count] ); ?>"/>
                        <span class="ufb-condition-remove ufb-remove-btn">X</span>
                    </div>
                    <?php
                    $count++;
                }
            }
            ?>
        </div>
        
    </div>

    <select class="ufb-condition-valid-fields-ref" style="display:none;">
        <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
        <?php
        $valid_fields = array( 'textfield', 'textarea', 'email', 'dropdown', 'radio', 'checkbox', 'number', 'datepicker', 'url', 'like-dislike' );
        foreach ( $form_detail['field_data'] as $key => $val ) {
            $field_type = $val['field_type'];
            if ( in_array( $field_type, $valid_fields ) ) {

                $field_label = ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val['field_type'] );
                ?>
                <option value="<?php echo $key; ?>"><?php echo $key . ' ( ' . $field_label . ' )'; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <select class="ufb-condition-fields-ref" style="display:none;">
        <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
        <?php
        foreach ( $form_detail['field_data'] as $key => $val ) {
            $field_label = ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . ucfirst( $val['field_type'] );
            ?>
            <option value="<?php echo $key; ?>"><?php echo $key . ' ( ' . $field_label . ' )'; ?></option>
            <?php
        }
        ?>
    </select>
</div>