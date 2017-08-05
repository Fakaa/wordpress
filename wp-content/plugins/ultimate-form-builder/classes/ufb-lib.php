<?php
defined('ABSPATH') or die('No script kiddies please!');
/**
 * UFBL Library Class
 * Class with all the necessary functions
 */
if ( !class_exists('UFB_Lib') ) {

    class UFB_Lib {

        /**
         *
         * @param string $view_file
         * @returns void
         */
        public static function load_view($view_file, $variable_array = array()) {
            if ( !empty($variable_array) && is_array($variable_array) ) {
                /**
                 * Creating a variable for each key
                 */
                foreach ( $variable_array as $key => $val ) {
                    $$key = $val;
                }
                $data = $variable_array;
            }
            $view_file = str_replace('.php', '', $view_file);
            if ( file_exists(UFB_PATH . 'inc/views/' . $view_file . '.php') ) {
                include UFB_PATH . 'inc/views/' . $view_file . '.php';
            } else {
                echo UFB_PATH . 'inc/views/' . $view_file . '.php File Not found';
            }
        }

        /**
         *
         * @param string $core_file
         * @return void
         */
        public static function load_core($core_file, $variable_array = array()) {
            if ( !empty($variable_array) && is_array($variable_array) ) {
                /**
                 * Creating a variable for each key
                 */
                foreach ( $variable_array as $key => $val ) {
                    $$key = $val;
                }
            }
            if ( file_exists(UFB_PATH . 'inc/cores/' . $core_file . '.php') ) {
                include UFB_PATH . 'inc/cores/' . $core_file . '.php';
            } else {
                echo UFB_PATH . 'inc/cores/' . $core_file . '.php File Not Found';
            }
        }

        /**
         *
         * @param array $array
         * @return void
         */
        public static function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        /**
         * Returns Form default values
         * @return array
         */
        public static function get_default_detail() {
            $default_detail = array();
            $default_detail[ 'field_data' ] = array();
            $default_detail[ 'form_design' ] = array( 'plugin_style' => 1, 'form_width' => '', 'form_template' => 'ufb-default-template' );
            $default_detail[ 'email_settings' ] = array( 'email_reciever' => array( get_option('admin_email') ), 'from_name' => '', 'from_email' => '', 'from_subject' => '' );
            return $default_detail;
        }

        public static function do_form_process() {
            include(UFB_PATH . '/inc/cores/form-process.php');
        }

        /**
         * Do the email sending process after form validation
         * return void
         * @param array $form_data
         */
        public static function do_email_process($email_reference_array = array(), $form_row = array(), $conditional_emails = array()) {
            if ( !empty($form_row) && !empty($email_reference_array) ) {
                $form_title = $form_row[ 'form_title' ];
                $form_detail = maybe_unserialize($form_row[ 'form_detail' ]);
                $field_data = $form_detail[ 'field_data' ];
                $fields_html = '';
                $count = 0;
                foreach ( $email_reference_array as $key => $val ) {
                    $field_label = ($field_data[ $key ][ 'field_label' ] != '') ? $field_data[ $key ][ 'field_label' ] : __('Untitled', UFB_TD) . ' ' . $field_data[ $key ][ 'field_type' ];
                    if ( isset($form_detail[ 'email_settings' ][ 'exclude_empty_field' ]) && $form_detail[ 'email_settings' ][ 'exclude_empty_field' ] == 1 ) {
                        if ( $val[ 'value' ] != '' ) {
                            $count++;
                            if ( $count % 2 == 0 ) {
                                $fields_html .= '<tr style="background-color:#eee;"><td style="width:150px;border:1px solid #D54E21;" ><strong>' . $field_label . ':</strong></td> <td style="border:1px solid #D54E21;">' . $val[ 'value' ] . '</td><tr>';
                            } else {
                                $fields_html .= '<tr><td style="width:150px;border:1px solid #D54E21;" ><strong>' . $field_label . ':</strong></td> <td style="border:1px solid #D54E21;">' . $val[ 'value' ] . '</td><tr>';
                            }
                        }
                    } else {
                        $count++;
                        if ( $count % 2 == 0 ) {
                            $fields_html .= '<tr style="background-color:#eee;"><td style="width:150px;border:1px solid #D54E21;" ><strong>' . $field_label . ':</strong></td> <td style="border:1px solid #D54E21;">' . $val[ 'value' ] . '</td><tr>';
                        } else {
                            $fields_html .= '<tr><td style="width:150px;border:1px solid #D54E21;" ><strong>' . $field_label . ':</strong></td> <td style="border:1px solid #D54E21;">' . $val[ 'value' ] . '</td><tr>';
                        }
                    }
                }
                $fields_table = '<table style="border:1px solid #D54E21" cellspacing="0" cellpadding="10">
							   <tr><td colspan="2" style="text-align:center;"><h2>' . $form_title . '</h2></td></tr>
							   ' .
                        $fields_html
                        . '</table>';
                $form_message = $form_detail[ 'email_settings' ][ 'message_format' ];
                $form_message = str_replace('#form_title', $form_title, $form_message);
                $form_message = str_replace('#form_details', $fields_table, $form_message);
                $form_html = '<html>
								<head><title></title></head>
						<body>' . $form_message . '
						      </body>
						</html>';
                $site_url = str_replace('http://', '', site_url());
                $site_url = str_replace('https://', '', $site_url);
                $email_subject = ($form_detail[ 'email_settings' ][ 'from_subject' ] != '') ? esc_attr($form_detail[ 'email_settings' ][ 'from_subject' ]) : __('New Form Submission', UFB_TD);
                if ( $form_detail[ 'email_settings' ][ 'from_name_type' ] == 'custom' ) {
                    $from_name = ($form_detail[ 'email_settings' ][ 'from_name' ] != '') ? esc_attr($form_detail[ 'email_settings' ][ 'from_name' ]) : __('No Name', UFB_TD);
                } else {
                    $from_name_field = isset($form_detail[ 'email_settings' ][ 'from_name_field' ]) ? esc_attr($form_detail[ 'email_settings' ][ 'from_name_field' ]) : '';
                    $from_name = ($from_name_field != '') ? esc_attr($email_reference_array[ $from_name_field ][ 'value' ]) : __('No Name', UFB_TD);
                }
                if ( $form_detail[ 'email_settings' ][ 'from_email_type' ] == 'custom' ) {
                    $from_email = ($form_detail[ 'email_settings' ][ 'from_email' ] != '') ? esc_attr($form_detail[ 'email_settings' ][ 'from_email' ]) : 'noreply@' . $site_url;
                } else {
                    $from_email_field = isset($form_detail[ 'email_settings' ][ 'from_email_field' ]) ? esc_attr($form_detail[ 'email_settings' ][ 'from_email_field' ]) : '';
                    $from_email = ($from_email_field != '') ? esc_attr($email_reference_array[ $from_email_field ][ 'value' ]) : 'noreply@' . $site_url;
                }
                $admin_email = get_option('admin_email');
                $email_recievers = $form_detail[ 'email_settings' ][ 'email_reciever' ];
                $headers = array();
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $headers[] = 'From: ' . $from_name . ' <' . $from_email . '>';
                //      echo $php_header = 'Content-Type: text/html; charset=UTF-8'. "\r\n" .
                //      'From: No Reply<'.$from_email . ">\r\n" .
                //         		'X-Mailer: PHP/' . phpversion();

                $email_recievers = array_merge($email_recievers, $conditional_emails);
                // self::print_array($email_recievers);
                //echo $php_header = implode('\r\n',$headers);
                foreach ( $email_recievers as $email_reciever ) {
                    $to_email = ($email_reciever == '') ? $admin_email : esc_attr($email_reciever);
                    $mail = wp_mail($to_email, $email_subject, $form_html, $headers);
                    //  $mail = mail( $to_email, $email_subject, $form_html, $php_header );
                }
                if ( isset($form_detail[ 'email_settings' ][ 'auto_respond' ]) && $form_detail[ 'email_settings' ][ 'auto_respond_email' ] != '' ) {
                    $auto_respond_email = isset($email_reference_array[ $form_detail[ 'email_settings' ][ 'auto_respond_email' ] ]) ? $email_reference_array[ $form_detail[ 'email_settings' ][ 'auto_respond_email' ] ][ 'value' ] : '';
                    if ( $auto_respond_email != '' ) {
                        $auto_respond_message = $form_detail[ 'email_settings' ][ 'auto_respond_message' ];
                        $auto_respond_message = str_replace('#form_details', $fields_table, $auto_respond_message);
                        $auto_respond_message = '<html>
								<head><title></title></head>
						<body>' . $auto_respond_message . '
						      </body>
						</html>';
                        $auto_respond_subject = ($form_detail[ 'email_settings' ][ 'auto_respond_subject' ] != '') ? esc_attr($form_detail[ 'email_settings' ][ 'auto_respond_subject' ]) : '';
                        $check = wp_mail($auto_respond_email, $auto_respond_subject, $auto_respond_message, $headers);
                    }
                }
            }
        }

        /**
         * Function to generate CSV for form entries
         * @param array $form_data
         * @param array $entry_rows
         */
        public static function generate_csv($form_data, $entry_rows) {
            //self::print_array( $form_data );
            // self::print_array( $entry_rows );die();
            $output = '';
            foreach ( $form_data[ 'form_labels' ] as $label ) {
                //$output .=$label . ',';
                $output .= '"' . $label . '",';
            }
            $output .= '"' . __('Entry Created On', UFB_TD) . '",';
            $output .= '"' . __('User IP', UFB_TD) . '",';
            $output .= '"' . __('Page URL', UFB_TD) . '",';
            $output .= '"' . __('User Logged In', UFB_TD) . '",';
            $output .= '"' . __('Logged In Username', UFB_TD) . '",';
            $output .= '"' . __('Logged In User Email', UFB_TD) . '",';
            $output .= "\n";
            foreach ( $entry_rows as $entry_row ) {
                $entry_detail = maybe_unserialize($entry_row[ 'entry_detail' ]);
                foreach ( $form_data[ 'form_keys' ] as $form_key ) {

                    if ( isset($entry_detail[ 'email_reference_array' ][ $form_key ][ 'value' ]) ) {
                        $entry_value = (isset($entry_detail[ 'email_reference_array' ][ $form_key ][ 'csv_value' ])) ? $entry_detail[ 'email_reference_array' ][ $form_key ][ 'csv_value' ] : $entry_detail[ 'email_reference_array' ][ $form_key ][ 'value' ];
                        $entry_value = str_replace('<br/>', ', ', $entry_value);
                        /* if ( is_array( $entry_detail[$form_key] ) ) {
                          //$entry_value = array_map( 'esc_attr', $entry_detail[$form_key] );

                          } else {
                          $entry_value = esc_attr( $entry_detail[$form_key] );
                          } */
                    } else {
                        $entry_value = '';
                    }
                    //$output .=$entry_value . ',';
                    $output .= '"' . $entry_value . '",';
                }
                $user_ip = isset($entry_detail[ 'user_ip' ]) ? esc_attr($entry_detail[ 'user_ip' ]) : '';
                $page_url = isset($entry_detail[ 'page_url' ]) ? esc_attr($entry_detail[ 'page_url' ]) : '';
                $user_logged_in = isset($entry_detail[ 'user_logged_in' ]) ? esc_attr($entry_detail[ 'user_logged_in' ]) : '';
                $logged_in_username = isset($entry_detail[ 'loggedin_username' ]) ? esc_attr($entry_detail[ 'loggedin_username' ]) : '';
                $logged_in_user_email = isset($entry_detail[ 'loggedin_user_email' ]) ? esc_attr($entry_detail[ 'loggedin_user_email' ]) : '';
                $output .= '"' . $entry_row[ 'entry_created' ] . '",';
                $output .= '"' . $user_ip . '",';
                $output .= '"' . $page_url . '",';
                $output .= '"' . $user_logged_in . '",';
                $output .= '"' . $logged_in_username . '",';
                $output .= '"' . $logged_in_user_email . '",';
                $output .= "\n";
            }
            $filename = "form-entries.csv";
            header('Content-Type: text/html; charset=UTF-8');
            //  header('Content-Encoding: UTF-8');
            //   header('Content-type: text/csv;  charset=UTF-8');
            header('Content-Disposition: attachment; filename=' . $filename);
            // mb_convert_encoding($output, 'UTF-16LE', 'UTF-8');
            echo $output;
            exit;
        }

        public static function generate_help_text($text = '') {
            $help_text = '<span class="ufb-relative">
                        <span class="dashicons dashicons-editor-help ufb-help-trigger"></span>
                        <div class="ufb-help-message">
                            <div class="ufbl-relative">
                                <div class="ufb-arrow-left"></div>
                                ' . $text . '
                            </div>
                        </div>
                    </span>';
            return $help_text;
        }

        /**
         * Form Export action
         */
        public static function ufb_export_form_action() {
            if ( !empty($_POST) && wp_verify_nonce($_POST[ 'ufb_export_nonce_field' ], 'ufb-export-nonce') ) {
                $form_id = sanitize_text_field($_POST[ 'form_id' ]);
                if ( $form_id != '' ) {
                    $form_row = UFB_Model::get_form_detail($form_id);
                    $filename = sanitize_title($form_row[ 'form_title' ]);
                    $json = json_encode($form_row);

                    header('Content-disposition: attachment; filename=' . $filename . '.json');
                    header('Content-type: application/json');

                    echo( $json);
                } else {
                    wp_redirect(admin_url('admin.php?page=ufb-form-export'));
                    exit;
                }
            } else {
                die('No script kiddies please!!');
            }
        }

        /**
         * Form Import action
         */
        public static function ufb_import_form_action() {
            if ( !empty($_POST) && wp_verify_nonce($_POST[ 'ufb_import_nonce_field' ], 'ufb-import-nonce') ) {
                if ( !empty($_FILES) && $_FILES[ 'import_file' ][ 'name' ] != '' ) {
                    $filename = $_FILES[ 'import_file' ][ 'name' ];
                    $filename_array = explode('.', $filename);
                    $filename_ext = end($filename_array);
                    if ( $filename_ext == 'json' ) {

                        $new_filename = 'import-' . rand(111111, 999999) . '.' . $filename_ext;
                        $upload_path = UFB_PATH . '/tmp/' . $new_filename;
                        $source_path = $_FILES[ 'import_file' ][ 'tmp_name' ];
                        $check = @move_uploaded_file($source_path, $upload_path);
                        if ( $check ) {

                            $url = UFB_URL . '/tmp/' . $new_filename;
                            $params = array(
                                'sslverify' => false,
                                'timeout' => 60
                            );
                            $connection = wp_remote_get($url, $params);
                            if ( !is_wp_error($connection) ) {
                                $body = $connection[ 'body' ];
                                $form_row = json_decode($body);
                                unlink($upload_path);
                                $check = UFB_Model::import_form($form_row);
                                // var_dump( $form_row );
                                if ( $check ) {
                                    // echo "test";
                                    $_SESSION[ 'ufb_message' ] = __('Form imported successfully.', UFB_TD);
                                    wp_redirect(admin_url('admin.php?page=ufb-form-import'));
                                    exit;
                                } else {
                                    $_SESSION[ 'ufb_message' ] = __('Something went wrong. Please try again later.', UFB_TD);
                                }
                            } else {

                                $_SESSION[ 'ufb_message' ] = __('Something went wrong. Please try again later.', UFB_TD);
                            }
                        } else {
                            $_SESSION[ 'ufb_message' ] = __('Something went wrong. Please check the write permission of tmp folder inside the plugin\'s folder', UFB_TD);
                        }
                    } else {
                        $_SESSION[ 'ufb_message' ] = __('Invalid File Extension', UFB_TD);
                    }
                }
                wp_redirect(admin_url('admin.php?page=ufb-form-import'));
                exit;
            } else {
                die('No script kiddies please!!');
            }
        }

        /**
         * Print Message
         */
        public static function print_message() {
            if ( isset($_SESSION[ 'ufb_message' ]) ) {
                ?>
                <div class="ufb-message">
                    <p>
                        <?php
                        echo $_SESSION[ 'ufb_message' ];
                        unset($_SESSION[ 'ufb_message' ]);
                        ?>
                    </p>
                    <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
                </div>

                <?php
            }
        }

        /**
         * Get client IP address
         */
        public static function get_client_ip() {
            $ipaddress = '';
            if ( isset($_SERVER[ 'HTTP_CLIENT_IP' ]) )
                $ipaddress = $_SERVER[ 'HTTP_CLIENT_IP' ];
            else if ( isset($_SERVER[ 'HTTP_X_FORWARDED_FOR' ]) )
                $ipaddress = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
            else if ( isset($_SERVER[ 'HTTP_X_FORWARDED' ]) )
                $ipaddress = $_SERVER[ 'HTTP_X_FORWARDED' ];
            else if ( isset($_SERVER[ 'HTTP_FORWARDED_FOR' ]) )
                $ipaddress = $_SERVER[ 'HTTP_FORWARDED_FOR' ];
            else if ( isset($_SERVER[ 'HTTP_FORWARDED' ]) )
                $ipaddress = $_SERVER[ 'HTTP_FORWARDED' ];
            else if ( isset($_SERVER[ 'REMOTE_ADDR' ]) )
                $ipaddress = $_SERVER[ 'REMOTE_ADDR' ];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }

        /**
         * Get current page URL
         */
        public static function currentPageURL() {
            $curpageURL = 'http';
            if ( isset($_SERVER[ "HTTPS" ]) && $_SERVER[ "HTTPS" ] == "on" ) {
                $curpageURL .= "s";
            }
            $curpageURL .= "://";
            if ( $_SERVER[ "SERVER_PORT" ] != "80" ) {
                $curpageURL .= $_SERVER[ "SERVER_NAME" ] . ":" . $_SERVER[ "SERVER_PORT" ] . $_SERVER[ "REQUEST_URI" ];
            } else {
                $curpageURL .= $_SERVER[ "SERVER_NAME" ] . $_SERVER[ "REQUEST_URI" ];
            }
            return $curpageURL;
        }

        /**
         * Returns loggedin username         *
         */
        public static function get_loggedin_username() {
            if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();

                $username = isset($current_user->user_login) ? $current_user->user_login : '';
            } else {
                $username = '';
            }
            return $username;
        }

        /**
         * Returns loggedin user email
         */
        public static function get_loggedin_user_email() {
            if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                $user_email = isset($current_user->user_email) ? $current_user->user_email : '';
            } else {
                $user_email = '';
            }
            return $user_email;
        }

        //Sanitizes field by converting line breaks to <br /> tags
        public static function sanitize_escaping_linebreaks($text) {
            $text = implode("<br \>", array_map('sanitize_text_field', explode("\n", $text)));
            return $text;
        }

        //outputs by converting <Br/> tags into line breaks
        public static function output_converting_br($text) {
            $text = implode("\n", array_map('sanitize_text_field', explode("<br \>", $text)));
            return $text;
        }

    }

    //class termination
}//class exists check