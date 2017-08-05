<?php

/**
 * Posted Variables
 * Array
  (
  [action] => ufb_form_action
  [field_data] => Array
  (
  [ufb_field_1] => Array
  (
  [field_label] => Your Name
  [required] => 1
  [max_chars] =>
  [min_chars] =>
  [error_message] =>
  [placeholder] =>
  [pre_filled_value] =>
  [field_id] =>
  [field_class] =>
  [field_type] => textfield
  )

  [ufb_field_2] => Array
  (
  [field_label] => Your Message
  [error_message] =>
  [textarea_rows] =>
  [textarea_columns] =>
  [max_chars] =>
  [min_chars] =>
  [placeholder] =>
  [pre_field_value] =>
  [field_id] =>
  [field_class] =>
  [field_type] => textfield
  )

  [ufb_field_3] => Array
  (
  [field_label] => Your Email
  [error_message] =>
  [placeholder] =>
  [pre_field_value] =>
  [field_id] =>
  [field_class] =>
  [field_type] => email
  )

  [ufb_field_4] => Array
  (
  [button_label] => Submit
  [field_id] =>
  [field_class] =>
  [field_type] => submit
  )

  )

  [form_title] => Test Form
  [form_id] => Test Form
  [form_key_count] => 4
  [ufb_form_nonce_field] => 8aaf69bf4e
  [_wp_http_referer] => /ultimate-form-builder-lite/wp-admin/admin.php?page=ufbl&action=edit-form&form_id=1
  )
 * */
 $_POST = array_map( 'stripslashes_deep', $_POST );
global $wpdb;
foreach ( $_POST as $key => $val ) {
    if ( $key == 'field_data' || $key == 'form_design' || $key == 'email_settings' || 'field_steps' || 'conditional_logic' ) {
        $$key = $val;
    } else {
        $$key = sanitize_text_field( $val );
    }
}
//global $library_obj;
//$library_obj->print_array( $_POST );die();
//die();
//echo $form_id;


if ( isset( $field_data ) ) {
    /**
     * Sanitizing each form fields
     */
    $field_data_temp = array();
    $html_fields = array( 'field_label', 'custom_text', 'agreement_text' );
    $allowed_html = array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'ul' => array(),
        'li' => array(),
        'p' => array(),
        'span' => array(
            'class' => array(),
            'id' => array()
        ),
        'quote' => array(),
        'strike' => array(),
        'div' => array( 'class' => array(), 'id' => array() )
    );
    foreach ( $field_data as $key => $val ) {
        $field_data_temp[$key] = array();
        foreach ( $val as $k => $v ) {
            if ( !is_array( $v ) ) {
                if ( in_array( $k, $html_fields ) ) {
                    $field_data_temp[$key][$k] = wp_kses( $v, $allowed_html );
                } else {

                    $field_data_temp[$key][$k] = sanitize_text_field( $v );
                }
            } else {
                $field_data_temp[$key][$k] = array_map( 'sanitize_text_field', $v );
            }
        }
    }
    $field_data = $field_data_temp;
}

/**
 * Sanitizing each email field
 */
$email_settings_temp = array();
foreach ( $email_settings as $key => $val ) {
    if ( $key == 'email_reciever' ) {
        $email_settings_temp['email_reciever'] = array_map( 'sanitize_email', $val );
    } else if ( $key == 'from_email' ) {
        $email_settings_temp[$key] = sanitize_email( $val );
    } else if ( $key == 'message_format' || $key == 'auto_respond_message') {
        $email_settings_temp[$key] = UFB_Lib::sanitize_escaping_linebreaks( $val );
    } else {
        $email_settings_temp[$key] = sanitize_text_field( $val );
    }
}


$form_design = array_map( 'sanitize_text_field', $form_design );
$email_settings = $email_settings_temp;
$form_data = array();
$form_data['field_data'] = isset( $field_data ) ? $field_data : array();
$form_data['form_design'] = $form_design;
$form_data['email_settings'] = $email_settings;
$form_data['form_key_count'] = $form_key_count;
$form_data['field_steps'] = $field_steps;
$form_data['conditional_logic'] = $conditional_logic;
$form_data['form_type'] = $form_type;
$form_modified_date = date( 'Y-m-d H:i:s:u' );
//$library_obj->print_array( $form_data );

$wpdb->update(
        UFB_FORM_TABLE, array(
    'form_title' => $form_title, // string
    'form_detail' => maybe_serialize( $form_data ),
    'form_modified' => $form_modified_date
        ), array( 'form_id' => $form_id ), array(
    '%s', // form_title
    '%s', // form_data
    '%s'  //form_modified
        ), array( '%d' )
);
$_SESSION['ufb_message'] = __( 'Form Updated Successfully', UFB_TD );
$redirect_url = admin_url( 'admin.php?page=ufb&action=edit-form&form_id=' . $form_id );
wp_redirect( $redirect_url );
exit;

