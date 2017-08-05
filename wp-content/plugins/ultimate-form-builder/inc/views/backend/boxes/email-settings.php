<?php
global $library_obj;
$form_detail = maybe_unserialize( $form_row['form_detail'] );
$field_data = $form_detail['field_data'];
$form_detail = empty( $form_detail ) ? $library_obj->get_default_detail() : $form_detail;
$email_settings = $form_detail['email_settings'];
?>
<div class="ufb-tab-content" id="ufb-email-tab" style="display: none;">
    <div class="ufb-email-wrap">
        <label><?php _e( 'Email Reciever', UFB_TD ); ?></label>
        <div class="ufb-emails">
            <input type="button" value="<?php _e( 'Add email', UFB_TD ); ?>" class="button-primary ufb-email-adder"/>
            <?php
            $count = 0;
            foreach ( $email_settings['email_reciever'] as $email ) {
                $count++;
                ?>
                <div class="ufb-email-fields">
                    <input type="text" name="email_settings[email_reciever][]" placeholder="test@abc.com" value="<?php echo esc_attr( $email ); ?>"/>
                    <?php if ( $count != 1 ) {
                        ?>
                        <span class="ufb-email-remove">X</span>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'From Email', UFB_TD ); ?></label>
        <div class="ufb-field">
            <?php $from_email_type = isset( $email_settings['from_email_type'] ) ? esc_attr( $email_settings['from_email_type'] ) : 'custom'; ?>
            <label><input type="radio" name="email_settings[from_email_type]" value="custom" <?php checked( $from_email_type, 'custom' ); ?> class="ufb-from-type-trigger"/><?php _e( 'Custom', UFB_TD ); ?></label>
            <label><input type="radio" name="email_settings[from_email_type]" value="form-field" <?php checked( $from_email_type, 'form-field' ); ?> class="ufb-from-type-trigger"/><?php _e( 'Form Field', UFB_TD ); ?></label>
            <div class="ufb-from-name-type ufb-from-type">

                <input type="text" name="email_settings[from_email]" placeholder='test@xyz.com' value="<?php echo esc_attr( $email_settings['from_email'] ); ?>" <?php if($from_email_type != 'custom'){?> style="display:none;"<?php }?>/>
                <select name="email_settings[from_email_field]" <?php if($from_email_type != 'form-field'){?> style="display:none;"<?php }?>>
                    <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                    <?php
                    foreach ( $field_data as $key => $val ) {

                        if ( $val['field_type'] == 'email' ) {
                            ?>
                            <option value="<?php echo $key ?>" <?php if(isset($email_settings['from_email_field'])){ selected( $email_settings['from_email_field'], $key );} ?>><?php echo ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . $val['field_type']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'From Name', UFB_TD ); ?></label>
        <div class="ufb-field">
            <?php $from_name_type = isset( $email_settings['from_name_type'] ) ? esc_attr( $email_settings['from_name_type'] ) : 'custom'; ?>

            <label><input type="radio" name="email_settings[from_name_type]" value="custom" <?php checked( $from_name_type, 'custom' ); ?> class="ufb-from-type-trigger"/><?php _e( 'Custom', UFB_TD ); ?></label>
            <label><input type="radio" name="email_settings[from_name_type]" value="form-field" <?php checked( $from_name_type, 'form-field' ); ?> class="ufb-from-type-trigger"/><?php _e( 'Form Field', UFB_TD ); ?></label>
            <div class="ufb-from-name-type ufb-from-type">
                <input type="text" name="email_settings[from_name]" placeholder='John Corner' value="<?php echo esc_attr( $email_settings['from_name'] ); ?>" <?php if($from_email_type != 'custom'){?> style="display:none;"<?php }?>/>
                <select name="email_settings[from_name_field]" <?php if($from_email_type != 'form-field'){?> style="display:none;"<?php }?>>
                    <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                    <?php
                    foreach ( $field_data as $key => $val ) {

                        if ( $val['field_type'] == 'textfield' ) {
                            ?>
                            <option value="<?php echo $key ?>" <?php if(isset($email_settings['from_name_field'])){ selected( $email_settings['from_name_field'], $key );} ?>><?php echo ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . $val['field_type']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'Email Subject', UFB_TD ); ?></label>
        <div class="ufb-field">
            <input type="text" name="email_settings[from_subject]" placeholder='<?php _e( 'New Form Submission', UFB_TD ); ?>' value="<?php echo esc_attr( $email_settings['from_subject'] ); ?>"/>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'Message Format', UFB_TD ); ?></label>
        <div class="ufb-field">
            <?php
            $default_message_format = __( 'Hello there,

You have got a new Form Submission from #form_title.Details below:

#form_details

Thank you', UFB_TD );
            $message_format = (isset( $email_settings['message_format'] ) && $email_settings['message_format'] != '') ? UFB_Lib::output_converting_br( $email_settings['message_format'] ) : $default_message_format;
            ?>
            <textarea name="email_settings[message_format]"><?php echo $message_format; ?></textarea>
            <div class="ufb-field-note"><?php _e( 'Please use #form_title and #form_details to replace Form Title and Form Recieved Data in the email respectively.', UFB_TD ); ?></div>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'Exclude Empty Field', UFB_TD ); ?></label>
        <div class="ufb-field">
            <input type="checkbox" name="email_settings[exclude_empty_field]" value="1" <?php
            if ( isset( $email_settings['exclude_empty_field'] ) ) {
                checked( $email_settings['exclude_empty_field'], true );
            }
            ?>/>
            <div class="ufb-field-note"><?php _e( 'Check this if you want to exclude the empty fields in the email.', UFB_TD ); ?></div>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'Email Auto Respond', UFB_TD ); ?></label>
        <div class="ufb-field">
            <input type="checkbox" name="email_settings[auto_respond]" value="1" <?php
            if ( isset( $email_settings['auto_respond'] ) ) {
                checked( $email_settings['auto_respond'], true );
            }
            ?>/>
            <div class="ufb-field-note"><?php _e( 'For auto respond to work, the form should have at least a single email field.', UFB_TD ); ?></div>
        </div>
    </div>

    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'Auto Respond Email', UFB_TD ); ?></label>
        <div class="ufb-field">
            <select name="email_settings[auto_respond_email]">
                <option value=""><?php _e( 'Choose Field', UFB_TD ); ?></option>
                <?php
                if ( count( $field_data ) > 0 ) {
                    $auto_respond_email = isset( $email_settings['auto_respond_email'] ) ? esc_attr( $email_settings['auto_respond_email'] ) : '';
                    foreach ( $field_data as $key => $val ) {
                        if ( $val['field_type'] == 'email' ) {
                            ?>
                            <option value="<?php echo $key ?>" <?php selected( $auto_respond_email, $key ) ?>><?php echo ($val['field_label'] != '') ? esc_attr( $val['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . $val['field_type']; ?></option>
                            <?php
                        }
                    }
                }
                ?>
            </select>
            <div class="ufb-field-note"><?php _e( 'If you have added a email field in the form and haven\'t saved the form yet, then please save the form first to get that email field in this list.', UFB_TD ); ?></div>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'Auto Respond Subject', UFB_TD ); ?></label>
        <div class="ufb-field">
            <input type="text" name="email_settings[auto_respond_subject]" value="<?php echo isset( $email_settings['auto_respond_subject'] ) ? esc_attr( $email_settings['auto_respond_subject'] ) : ''; ?>" placeholder="<?php _e( 'Entry Recieved', UFB_TD ); ?>"/>
        </div>
    </div>
    <div class="ufb-field-wrap">
        <label class="ufb-field"><?php _e( 'Auto Repond Message', UFB_TD ); ?></label>
        <div class="ufb-field">
            <?php
            $default_auto_repond_message = __( "Hi there, 
                    
We have recieved your enquiry. We will get back to you shortly.
                    
Thank you", UFB_TD );
            $auto_respond_message = (isset( $email_settings['auto_respond_message'] ) && $email_settings['auto_respond_message'] != '') ? $library_obj->output_converting_br( $email_settings['auto_respond_message'] ) : $default_auto_repond_message;
            ?>
            <textarea name="email_settings[auto_respond_message]"><?php echo $auto_respond_message; ?></textarea>
            <div class="ufb-field-note"><?php _e( 'Please use #form_details to send the form data in the auto respond email.', UFB_TD ); ?></div>
        </div>
    </div>
    <div class="ufb-form-controls">
        <input type="button" class="button-primary ufb-save-form" value="<?php _e( 'Save Form', UFB_TD ); ?>"/>
        <a href="<?php echo site_url( '?ufb_form_preview=true&ufb_form_id=' . $form_row['form_id'] ); ?>" target="_blank"><input type="button" class="button-primary" value="<?php _e( 'Preview', UFB_TD ); ?>"/></a>
        <div class="ufb-field-note"><?php _e( 'Note: Please save form before preview.', UFB_TD ); ?></div>
    </div>
</div>

