<?php

switch ( $field_type ) {
    case 'textfield':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        } else {
            if ( $field_data[$key]['max_chars'] != '' && strlen( $val ) > $field_data[$key]['max_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Characters exceeded.Max characters allowed is :', UFB_TD ) . $field_data[$key]['max_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( $field_data[$key]['min_chars'] != '' && strlen( $val ) < $field_data[$key]['min_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Mininum characters required is :', UFB_TD ) . $field_data[$key]['min_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {

                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'textarea':
        $val = isset( $form_data[$key] ) ? UFB_Lib::sanitize_escaping_linebreaks( $form_data[$key] ) : '';
       // $val = UFB_Lib::sanitize_escaping_linebreaks($val);
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        } else {
            if ( $field_data[$key]['max_chars'] != '' && strlen( $val ) > $field_data[$key]['max_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Characters exceeded.Max characters allowed is :', UFB_TD ) . $field_data[$key]['max_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( $field_data[$key]['min_chars'] != '' && strlen( $val ) < $field_data[$key]['min_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Mininum characters required is :', UFB_TD ) . $field_data[$key]['min_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'email':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        } else {
            if ( !is_email( $val ) && $val != '' ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Please enter the valid email address.', UFB_TD );
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'checkbox':
        if ( isset( $form_data[$key] ) ) {
            $val = array_map( 'sanitize_text_field', $form_data[$key] );
            $val = implode( ',', $val );
        } else {
            $val = '';
        }

        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'radio':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }

        break;
    case 'dropdown':
        if ( isset( $form_data[$key] ) ) {

            if ( is_array( $form_data[$key] ) ) {
                $val = array_map( 'sanitize_text_field', $form_data[$key] );
                $val = implode( ',', $val );
            } else {
                $val = sanitize_text_field( $form_data[$key] );
            }
        } else {
            $val = '';
        }

        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'password':
        $val = isset( $form_data[$key] ) ? $form_data[$key] : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        } else {
            if ( $field_data[$key]['max_chars'] != '' && strlen( $val ) > $field_data[$key]['max_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Characters exceeded.Max characters allowed is :', UFB_TD ) . $field_data[$key]['max_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( $field_data[$key]['min_chars'] != '' && strlen( $val ) < $field_data[$key]['min_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Mininum characters required is :', UFB_TD ) . $field_data[$key]['min_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'number':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        } else {
            if ( $val != '' && !is_numeric( $val ) ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Only numbers allowed.', UFB_TD );
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            } else {
                if ( $field_data[$key]['max_value'] != '' && intval( $val ) > $field_data[$key]['max_value'] ) {
                    $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Characters exceeded.Max characters allowed is :', UFB_TD ) . $field_data[$key]['max_value'];
                    $error_flag = 1;
                    $form_response['error_keys'][$key] = $error_message;
                }
                if ( $field_data[$key]['min_value'] != '' && intval( $val ) < $field_data[$key]['min_value'] ) {
                    $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Mininum characters required is :', UFB_TD ) . $field_data[$key]['min_value'];
                    $error_flag = 1;
                    $form_response['error_keys'][$key] = $error_message;
                }
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'hidden':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
        }
        break;
    case 'captcha':
        if ( $value['captcha_type'] == 'mathematical' ) {
            $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : 0;
            if ( $val != 0 ) {
                $num1_key = $key . '_num_1';
                $num2_key = $key . '_num_2';
                $num1 = $form_data[$num1_key];
                $num2 = $form_data[$num2_key];
                $result = $num1 + $num2;
                if ( $result != $val ) {
                    $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Please enter the correct sum.', UFB_TD );
                    $error_flag = 1;
                    $form_response['error_keys'][$key] = $error_message;
                }
            } else {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Please enter the correct sum.', UFB_TD );
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        } else {
            $captcha = sanitize_text_field( $_POST['captchaResponse'] ); // get the captchaResponse parameter sent from our ajax
            if ( !$captcha ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Please check the captcha.', UFB_TD );
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            } else {
                $secret_key = $value['secret_key'];
                $response_html = wp_remote_get( "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response=" . $captcha );
                //self::print_array($response_html);
                $response = json_decode( $response_html['body'] );
                if ( $response->success == false ) {
                    $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Please check the captcha.', UFB_TD );
                    $error_flag = 1;
                    $form_response['error_keys'][$key] = $error_message;
                }
            }
        }
        break;
    case 'datepicker-daterange':
        $from_key = $key . '_from';
        $to_key = $key . '_to';
        $from_date = isset( $form_data[$from_key] ) ? sanitize_text_field( $form_data[$from_key] ) : '';
        $to_date = isset( $form_data[$to_key] ) ? sanitize_text_field( $form_data[$to_key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && ($from_date == '' || $to_date == '') ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $from_date . ' - ' . $to_date );
        }
        break;
    case 'datepicker':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
            if ( isset( $conditional_logic['redirect_logic'] ) && count( $conditional_logic['redirect_logic'] ) > 0 ) {
                $change_fields = $conditional_logic['redirect_logic']['change_field'];
                //  UFB_Lib::print_array( $conditional_logic[ 'redirect_logic' ] );

                foreach ( $change_fields as $logic_key => $field_key ) {

                    if ( $field_key == $key ) {

                        $logic = $conditional_logic['redirect_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['redirect_logic']['logic_check_field'][$logic_key];
                        $redirect_to = $conditional_logic['redirect_logic']['redirect_to'][$logic_key];
                        //  var_dump( $logic_check_value );
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            $form_response['redirect_url'] =  $redirect_to;
                        }
                    }
                }
            }
        }
        break;
    case 'dropdown-date':
        $year_key = $key . '_year';
        $month_key = $key . '_month';
        $day_key = $key . '_day';
        $hour_key = $key . '_hour';
        $minute_key = $key . '_minute';

        $date_value = '';
        if ( $field_data[$key]['required'] == 1 ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            if ( isset( $form_data[$year_key] ) && $form_data[$year_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$month_key] ) && $form_data[$month_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$day_key] ) && $form_data[$day_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$hour_key] ) && $form_data[$hour_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$minute_key] ) && $form_data[$minute_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $date_value = array();
            $date_ref_array = array();
            //UFB_Lib::print_array($field_data);
            if ( $field_data[$key]['show_date_block'] == 1 ) {

                foreach ( $field_data[$key]['date_fields_order'] as $date_field ) {
                    if ( in_array( $date_field, $field_data[$key]['date_fields'] ) ) {
                        // $date_value[] = $date_field . ': ' . $form_data[ $key . '_' . $date_field ];
                        $date_ref_array[] = $form_data[$key . '_' . $date_field];
                    } else {
                        switch($date_field){
                            case 'year':
                            $date_ref_array[] = 'yyyy';
                            break;
                            case 'month':
                            $date_ref_array[] = 'mm';
                            break;
                            case 'day':
                            $date_ref_array[] = 'dd';
                            break;
                        }
                       // $date_ref_array[$date_field] = '';
                    }
                }
                $date_value[] = implode('-',$date_ref_array);
                /*
                $year = ($date_ref_array['year'] != '') ? $date_ref_array['year'] : 'yyyy';
                $month = ($date_ref_array['month'] != '') ? $date_ref_array['month'] : 'mm';
                $day = ($date_ref_array['day'] != '') ? $date_ref_array['day'] : 'dd';
                $dropdown_date = $year . '-' . $month . '-' . $day;
                $date_value[] = $dropdown_date;
                */
            }
            if ( $field_data[$key]['show_time_block'] == 1 ) {
                $hour = ($form_data[$key . '_hour'] != '') ? $form_data[$key . '_hour'] : 'HH';
                $minute = ($form_data[$key . '_minute'] != '') ? $form_data[$key . '_minute'] : 'MM';
                $dropdown_time = $hour . ':' . $minute;
                if ( $field_data[$key]['time_format'] == 12 ) {
                    $dropdown_time .= ' ' . $form_data[$key . '_time_format'];
                }
                $date_value[] = $dropdown_time;
            }
            $date_value = implode( ' ', $date_value );
            //UFB_Lib::print_array($date_value);
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $date_value );
        }
        break;
    case 'dropdown-daterange':
        $from_year_key = $key . '_from_year';
        $from_month_key = $key . '_from_month';
        $from_day_key = $key . '_from_day';
        $from_hour_key = $key . '_from_hour';
        $from_minute_key = $key . '_from_minute';

        $to_year_key = $key . '_to_year';
        $to_month_key = $key . '_to_month';
        $to_day_key = $key . '_to_day';
        $to_hour_key = $key . '_to_hour';
        $to_minute_key = $key . '_to_minute';


        if ( $field_data[$key]['required'] == 1 ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            if ( isset( $form_data[$from_year_key] ) && $form_data[$from_year_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$from_month_key] ) && $form_data[$from_month_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$from_day_key] ) && $form_data[$from_day_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$from_hour_key] ) && $form_data[$from_hour_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$from_minute_key] ) && $form_data[$from_minute_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }

            if ( isset( $form_data[$to_year_key] ) && $form_data[$to_year_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$to_month_key] ) && $form_data[$to_month_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$to_day_key] ) && $form_data[$to_day_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$to_hour_key] ) && $form_data[$to_hour_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( isset( $form_data[$to_minute_key] ) && $form_data[$to_minute_key] == '' ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $from_date_value = array();
            $to_date_value = array();
            $from_date_ref_array = array();
            $to_date_ref_array = array();
            if ( $field_data[$key]['show_date_block'] == 1 ) {
                foreach ( $field_data[$key]['date_fields_order'] as $date_field ) {
                    if ( in_array( $date_field, $field_data[$key]['date_fields'] ) ) {
                        //  $from_date_value[] = $date_field . ': ' . $form_data[$key . '_from_' . $date_field];
                        //  $to_date_value[] = $date_field . ': ' . $form_data[$key . '_to_' . $date_field];
                        $from_date_ref_array[] = $form_data[$key . '_from_' . $date_field];
                        $to_date_ref_array[] = $form_data[$key . '_to_' . $date_field];
                    } else {
                        switch($date_field){
                            case 'year':
                            $from_date_ref_array[] = 'yyyy';
                            $to_date_ref_array[] = 'yyyy';
                            break;
                            
                            case 'month':
                            $from_date_ref_array[] = 'mm';
                            $to_date_ref_array[] = 'mm';
                            break;
                            
                            case 'day':
                            $from_date_ref_array[] = 'dd';
                            $to_date_ref_array[] = 'dd';
                            break;
                        }
                        
                    }
                }
                $from_date_value[] = __('From: ',UFB_TD).implode('-',$from_date_ref_array);
                $to_date_value[] = __('To: ',UFB_TD).implode('-',$to_date_ref_array);
                /*
                $from_year = ($from_date_ref_array['year'] != '') ? $from_date_ref_array['year'] : 'yyyy';
                $from_month = ($from_date_ref_array['month'] != '') ? $from_date_ref_array['month'] : 'mm';
                $from_day = ($from_date_ref_array['day'] != '') ? $from_date_ref_array['day'] : 'dd';
                $from_dropdown_date = $from_year . '-' . $from_month . '-' . $from_day;
                
                $from_date_value[] = __('From: ',UFB_TD).$from_dropdown_date;

                $to_year = ($to_date_ref_array['year'] != '') ? $to_date_ref_array['year'] : 'yyyy';
                $to_month = ($to_date_ref_array['month'] != '') ? $to_date_ref_array['month'] : 'mm';
                $to_day = ($to_date_ref_array['day'] != '') ? $to_date_ref_array['day'] : 'dd';
                $to_dropdown_date = $to_year . '-' . $to_month . '-' . $to_day;
                $to_date_value[] = __('To: ',UFB_TD).$to_dropdown_date;
                */
            }

            if ( $field_data[$key]['show_time_block'] == 1 ) {
                $from_hour = ($form_data[$key . '_from_hour'] != '') ? $form_data[$key . '_from_hour'] : 'HH';
                $from_minute = ($form_data[$key . '_from_minute'] != '') ? $form_data[$key . '_from_minute'] : 'MM';
                $from_time = $from_hour . ':' . $from_minute;

                $to_hour = ($form_data[$key . '_to_hour'] != '') ? $form_data[$key . '_to_hour'] : 'HH';
                $to_minute = ($form_data[$key . '_to_minute'] != '') ? $form_data[$key . '_to_minute'] : 'MM';
                $to_time = $to_hour . ':' . $to_minute;
                if ( $field_data[$key]['time_format'] == 12 ) {
                    $from_time .= ' ' . $form_data[$key . '_from_time_format'];
                    $to_time .= ' ' . $form_data[$key . '_to_time_format'];
                }
                $from_date_value[] = $to_time;
                $to_date_value[] = $from_time;
            }
            $from_date_value = implode( ' ', $from_date_value );
            $to_date_value = implode( ' ', $to_date_value );
            $email_value = $from_date_value.' - '.$to_date_value;
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $email_value );
        }
        break;
    case 'ui-slider':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Criteria not fulfilled', UFB_TD );

        if ( $field_data[$key]['slider_type'] == 'default' ) {  // For default slider
            $val = (trim( $val ) == '') ? 0 : $val;
            if ( ($field_data[$key]['min_required_value'] != '' && $val < $field_data[$key]['min_required_value']) || ($field_data[$key]['max_required_value'] != '' && $val > $field_data[$key]['max_required_value']) ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        } else { // For Range Slider
            $val = (trim( $val ) == '') ? '0-0' : $val;
            $val_array = explode( '-', $val );
            $max_value = trim( $val_array[1] );
            $min_value = trim( $val_array[0] );
            if ( ($field_data[$key]['min_required_value'] != '' && $min_value < $field_data[$key]['min_required_value']) || ($field_data[$key]['max_required_value'] != '' && $max_value > $field_data[$key]['max_required_value']) ) {
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
        }
        break;
    case 'file-uploader':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['required_error_message'] ) && $field_data[$key]['required_error_message'] != '') ? $field_data[$key]['required_error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $val_array = explode( ',', $val );
            $links = '';
            foreach ( $val_array as $val_element ) {
                if($val_element!=''){
                    $links .= '<a href="' . $val_element . '">' . $val_element . '</a><br/>';
                
                }
            }
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $links,'csv_value'=>$val );
        }
        break;
    case 'agreement-block':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Please accept terms and condition', UFB_TD );
        if ( $val == '' ) {
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        break;

    case 'url':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        } else {
            if($val!=''){
                if ( filter_var( $val, FILTER_VALIDATE_URL ) === FALSE ) {
                     $error_flag = 1;
                    $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Please fill a valid URL', UFB_TD );
                    $form_response['error_keys'][$key] = $error_message;
                }
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            if ( isset( $conditional_logic['email_logic'] ) && count( $conditional_logic['email_logic'] ) > 0 ) {
                $logic_count = 0;
                foreach ( $conditional_logic['email_logic']['change_field'] as $logic_key => $field_key ) {
                    if ( $field_key == $key ) {
                        $logic = $conditional_logic['email_logic']['logic'][$logic_key];
                        $logic_check_value = $conditional_logic['email_logic']['logic_check_field'][$logic_key];
                        $email_to = $conditional_logic['email_logic']['email_to'][$logic_key];
                        if ( $logic == 'equal' && $val == $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'greater' && $val > $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                        if ( $logic == 'less' && $val < $logic_check_value ) {
                            if ( is_email( $email_to ) ) {
                                $conditional_emails[] = $email_to;
                            }
                        }
                    }

                    $logic_count++;
                }
            }
        }
        break;
    case 'wysiwyg':
        $val = isset( $form_data[$key] ) ? wp_kses_post( $form_data[$key] ) : '';
        $val = wpautop($val);
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        } else {
            if ( $field_data[$key]['max_chars'] != '' && strlen( $val ) > $field_data[$key]['max_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Characters exceeded.Max characters allowed is :', UFB_TD ) . $field_data[$key]['max_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
            if ( $field_data[$key]['min_chars'] != '' && strlen( $val ) < $field_data[$key]['min_chars'] ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'Mininum characters required is :', UFB_TD ) . $field_data[$key]['min_chars'];
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            }
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
        }
        break;
        case 'country-dropdown':
        if ( isset( $form_data[$key] ) ) {

            if ( is_array( $form_data[$key] ) ) {
                $val = array_map( 'sanitize_text_field', $form_data[$key] );
                $val = implode( ',', $val );
            } else {
                $val = sanitize_text_field( $form_data[$key] );
            }
        } else {
            $val = '';
        }

        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            
            
        }
        break;
        case 'states-dropdown':
        if ( isset( $form_data[$key] ) ) {

            if ( is_array( $form_data[$key] ) ) {
                $val = array_map( 'sanitize_text_field', $form_data[$key] );
                $val = implode( ',', $val );
            } else {
                $val = sanitize_text_field( $form_data[$key] );
            }
        } else {
            $val = '';
        }

        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            
            
        }
        case 'city-dropdown':
        if ( isset( $form_data[$key] ) ) {

            if ( is_array( $form_data[$key] ) ) {
                $val = array_map( 'sanitize_text_field', $form_data[$key] );
                $val = implode( ',', $val );
            } else {
                $val = sanitize_text_field( $form_data[$key] );
            }
        } else {
            $val = '';
        }

        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
            
            
        }
        break;
    case 'star-rating':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
        }
        break;
    case 'like-dislike':
        $val = isset( $form_data[$key] ) ? sanitize_text_field( $form_data[$key] ) : '';
        if ( isset( $field_data[$key]['required'] ) && $field_data[$key]['required'] == 1 && $val == '' ) {
            $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
            $error_flag = 1;
            $form_response['error_keys'][$key] = $error_message;
        }
        if ( $error_flag == 0 ) {
            $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => $val );
        }
        break;
    case 'choice-matrix':
        $required_flag = 0;
        if ( isset( $value['matrix_row_value'] ) ) {
            $row_count = 0;
            $matrix_row_values = array();
            foreach ( $value['matrix_row_value'] as $matrix_row_label ) {
                $row_count++;
                $row_key = $key . '_matrix_row_' . $row_count;
                if ( !isset( $form_data[$row_key] ) && isset( $value['required'] ) && $value['required'] == 1 ) {
                    $required_flag = 1;
                } else {
                    $matrix_row_value = $matrix_row_label . ' : ' . $form_data[$row_key];
                    $matrix_row_values[] = $matrix_row_value;
                }
            }
            if ( $required_flag == 1 ) {
                $error_message = (isset( $field_data[$key]['error_message'] ) && $field_data[$key]['error_message'] != '') ? $field_data[$key]['error_message'] : __( 'This field is required', UFB_TD );
                $error_flag = 1;
                $form_response['error_keys'][$key] = $error_message;
            } else {
                $email_reference_array[$key] = array( 'label' => $field_data[$key]['field_label'], 'value' => implode( '<br/>', $matrix_row_values ) );
            }
        }
        break;
    default:
        break;
}//switch close

