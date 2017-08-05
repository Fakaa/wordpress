<?php

$form_data = array();
foreach ( $_POST[ 'form_data' ] as $val ) {
    if ( strpos( $val[ 'name' ], '[]' ) !== false ) {
        $form_data_name = str_replace( '[]', '', $val[ 'name' ] );
        if ( !isset( $form_data[ $form_data_name ] ) ) {
            $form_data[ $form_data_name ] = array();
        }
        $form_data[ $form_data_name ][] = $val[ 'value' ];
    } else {

        $form_data[ $val[ 'name' ] ] = $val[ 'value' ];
    }
}
$form_id = sanitize_text_field( $form_data[ 'form_id' ] );
$form_temp_data = $form_data;
$form_row = UFB_Model::get_form_detail( $form_id );
$form_detail = maybe_unserialize( $form_row[ 'form_detail' ] );
$field_data = $form_detail[ 'field_data' ];
$conditional_logic = isset($form_detail['conditional_logic'])? $form_detail['conditional_logic']:array('email_logic'=>array(),'redirect_logic'=>array());
$conditional_emails = array();
//self::print_array( $form_data );
$error_flag = 0;
$form_response = array();
$form_response[ 'error_keys' ] = array();
$default_redirect_url = isset($conditional_logic['default_url'])?$conditional_logic['default_url']:'';
if($default_redirect_url!=''){
    $form_response['redirect_url'] = $default_redirect_url;
}
$email_reference_array = array();

if ( !isset( $_POST[ 'current_step' ] ) ) {
    foreach ( $field_data as $key => $value ) {
        $field_type = $field_data[ $key ][ 'field_type' ];
        include(UFB_PATH . '/inc/cores/field-type-process.php');
    }//foreach form data close
    $form_response[ 'error_flag' ] = $error_flag;
    $form_submission_message = (isset( $form_detail[ 'form_design' ][ 'form_submission_message' ] ) && $form_detail[ 'form_design' ][ 'form_submission_message' ] != '') ? esc_attr( $form_detail[ 'form_design' ][ 'form_submission_message' ] ) : __( 'Form submitted successfully.', UFB_TD );
    $form_error_message = ( isset( $form_detail[ 'form_design' ][ 'form_error_message' ] ) && $form_detail[ 'form_design' ][ 'form_error_message' ] != '') ? esc_attr( $form_detail[ 'form_design' ][ 'form_error_message' ] ) : __( 'Validation Errors Occured.Please check and submit the form again.', UFB_TD );
    $form_response[ 'response_message' ] = ($error_flag == 1) ? $form_error_message : $form_submission_message;
     if(isset($form_detail['form_design']['hide_form_submission']) && $form_detail['form_design']['hide_form_submission'] == 1){
        $form_response['form_hide'] = 1;
    }else{
        $form_response['form_hide'] = 0;
    }
    if ( $error_flag == 0 ) {
        self::do_email_process( $email_reference_array, $form_row, $conditional_emails );
        UFB_Model::save_to_db( $form_data,$email_reference_array );
    }
} else {
    $current_step = sanitize_text_field( $_POST[ 'current_step' ] );
    $step_fields = $form_detail[ 'field_steps' ][ 'step' . $current_step . '_fields' ];
    $step_fields_array = explode( ',', $step_fields );
    
    foreach($step_fields_array as $key){
        $value = $field_data[$key];
        
        $field_type = $field_data[ $key ][ 'field_type' ];
        include(UFB_PATH . '/inc/cores/field-type-process.php');
    }
    $form_response[ 'error_flag' ] = $error_flag;
    if(isset($form_detail['form_design']['hide_form_submission']) && $form_detail['form_design']['hide_form_submission'] == 1){
        $form_response['form_hide'] = 1;
    }else{
        $form_response['form_hide'] = 0;
    }
    /**
     * Redirect Conditions Starts from here
     *   
     *            
    if($form_data['ufb_field_20'] > 1000 && $form_data['ufb_field_20']<2000){
        $form_response['redirect_url'] = 'http://www.super88.pw/installer-nick-cage/';
     
      
              
    }
    if($form_data['ufb_field_20'] > 2000 && $form_data['ufb_field_20']<3000){
        $form_response['redirect_url'] = 'http://www.super88.pw/installer-john-wayne/';
    }  
    */   
  //  UFB_Lib::print_array($field_data);    
    $form_submission_message = (isset( $form_detail[ 'form_design' ][ 'form_submission_message' ] ) && $form_detail[ 'form_design' ][ 'form_submission_message' ] != '') ? esc_attr( $form_detail[ 'form_design' ][ 'form_submission_message' ] ) : __( 'Form submitted successfully.', UFB_TD );
    $form_error_message = ( isset( $form_detail[ 'form_design' ][ 'form_error_message' ] ) && $form_detail[ 'form_design' ][ 'form_error_message' ] != '') ? esc_attr( $form_detail[ 'form_design' ][ 'form_error_message' ] ) : __( 'Validation Errors Occured.Please check and submit the form again.', UFB_TD );
    $form_response[ 'response_message' ] = ($error_flag == 1) ? $form_error_message : $form_submission_message;
}
//UFB_Lib::print_array($conditional_emails);
echo json_encode( $form_response );


