<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * UFBL Model Class
 * All the database related tasks 
 */
if ( !class_exists( 'UFB_Model' ) ) {

    class UFB_Model {

        /**
         * Model to add form into DB
         * @global UFB_Lib object $library_obj
         * 
         */
        public static function add_form() {
            global $library_obj;
            //$library_obj->print_array( $_POST );
            $form_title = sanitize_text_field( $_POST['form_title'] );
            $form_type = sanitize_text_field( $_POST['form_type'] );
            $form_title = ($form_title == '') ? __( 'Contact Form', UFB_TD ) : $form_title;
            $form_status = 1;
            $form_detail = serialize( $library_obj->get_default_detail() );
            $created_date = date( 'Y-m-d H:i:s:u' );
            global $wpdb;
            $check = $wpdb->insert(
                    UFB_FORM_TABLE, array(
                'form_title' => $form_title,
                'form_detail' => $form_detail,
                'form_status' => $form_status,
                'form_created' => $created_date,
                'form_modified' => $created_date,
                'form_type' => $form_type
                    ), array(
                '%s', '%s', '%s', '%s', '%s', '%s'
                    )
            );
            if ( $check == 1 ) {
                $form_id = $wpdb->insert_id;
                $redirect_url = admin_url( 'admin.php?page=ufb&action=edit-form&form_id=' . $form_id );
                $response_array = array( 'success' => 1, 'form_id' => $form_id, 'redirect_url' => $redirect_url );
            } else {
                $response_array = array( 'success' => 0, 'error_msg' => __( 'Something went wrong.Please try again later', UFB_TD ) );
            }
            die( json_encode( $response_array ) );
        }

        /**
         * Returns all the forms from the database
         * @return array
         */
        public static function get_all_forms() {
            global $wpdb;
            $table_name = UFB_FORM_TABLE;
            $forms = $wpdb->get_results( "SELECT * FROM $table_name" );
            return $forms;
        }

        /**
         * Model to change status of the form
         * 
         */
        public static function change_form_status() {
            $form_id = sanitize_text_field( $_POST['form_id'] );
            $form_status = sanitize_text_field( $_POST['status'] );
            global $wpdb;
            $check = $wpdb->update(
                    UFB_FORM_TABLE, array(
                'form_status' => $form_status
                    ), array( 'form_id' => $form_id ), array(
                '%d'
                    ), array( '%d' )
            );
            $msg = ($check) ? __( 'Status updated.', UFB_TD ) : __( 'Something went wrong.', UFB_TD );
            die( $msg );
        }

        /**
         * Model to return form settings by form id
         * @param int $form_id
         * @return array
         */
        public static function get_form_detail($form_id) {
            global $wpdb;
            $form_table = UFB_FORM_TABLE;
            $form_row = $wpdb->get_row( "SELECT * FROM $form_table WHERE form_id = $form_id", ARRAY_A );
            return $form_row;
        }

        /**
         * Model to save form
         * @return string 
         */
        public static function save_form() {
            global $library_obj;
            $library_obj->load_core( 'save-form' );
        }

        /**
         * Model to delete form
         * @return string;
         */
        public static function delete_form() {
            //global $library_obj;
            //$library_obj->print_array($_POST);
            $form_id = sanitize_text_field( $_POST['form_id'] );
            global $wpdb;
            $wpdb->delete( UFB_FORM_TABLE, array( 'form_id' => $form_id ), array( '%d' ) );
            die( 'success' );
        }

        /**
         * Model to get the form row by form_id
         * @return array
         */
        public static function get_form_row($form_id) {
            global $wpdb;
            $table_name = UFB_FORM_TABLE;
            $form_row = $wpdb->get_row( "SELECT * FROM $table_name WHERE form_id = $form_id", ARRAY_A );
            return $form_row;
        }

        /**
         * 
         * @param array $form_data
         * @return void
         */
        public static function save_to_db($form_data = array(), $email_reference_array = array()) {

            if ( isset( $form_data['form_id'] ) ) {
                $form_id = sanitize_text_field( $form_data['form_id'] );
                $form_data['email_reference_array'] = $email_reference_array;
                unset( $form_data['form_id'] );
                foreach ( $form_data as $key => $val ) {
                    if ( $key != 'email_reference_array' ) {
                        if ( !is_array( $val ) ) {
                            $form_data[$key] = sanitize_text_field( $val );
                        } else {
                            $form_data[$key] = array_map( 'sanitize_text_field', $val );
                        }
                    }
                }
                global $wpdb;
                $created_date = date( 'Y-m-d H:i:s:u' );
                $wpdb->insert(
                        UFB_ENTRY_TABLE, array(
                    'form_id' => $form_id,
                    'entry_detail' => maybe_serialize( $form_data ),
                    'entry_created' => $created_date
                        ), array(
                    '%d',
                    '%s',
                    '%s'
                        )
                );
            }
        }

        /**
         * Model to return form with id and form title
         * @return array
         */
        public static function get_forms() {
            global $wpdb;
            $form_table = UFB_FORM_TABLE;
            $form_rows = $wpdb->get_results( "select `form_id`,`form_title` from $form_table", 'ARRAY_A' );
            return $form_rows;
        }

        /**
         * Model to return form entries
         * @param int $form_id
         * @return array
         */
        public static function get_forms_entries($form_id = NULL, $limit = UFB_ENTRY_LIMIT, $offset = 0) {
            global $wpdb;
            $form_table = UFB_FORM_TABLE;
            $form_entry_table = UFB_ENTRY_TABLE;
            if ( $form_id == NULL ) {
                $query = "select $form_entry_table.entry_id, $form_entry_table.entry_detail, $form_entry_table.entry_created,$form_entry_table.status, $form_table.form_title, $form_table.form_id  from $form_entry_table inner join $form_table on $form_entry_table.form_id = $form_table.form_id order by $form_entry_table.entry_id desc limit $offset, $limit";
            } else {
                $query = "select $form_entry_table.entry_id, $form_entry_table.entry_detail, $form_entry_table.entry_created,$form_entry_table.status, $form_table.form_title, $form_table.form_id  from $form_entry_table inner join $form_table on $form_entry_table.form_id = $form_table.form_id where $form_entry_table.form_id = $form_id  order by $form_entry_table.entry_id desc limit $offset, $limit";
            }
            $form_entry_rows = $wpdb->get_results( $query, 'ARRAY_A' );
            return $form_entry_rows;
        }

        /**
         * Model to return all form entries
         * @param int $form_id
         * @return array
         */
        public static function get_all_forms_entries($form_id = NULL) {
            global $wpdb;
            $form_table = UFB_FORM_TABLE;
            $form_entry_table = UFB_ENTRY_TABLE;
            if ( $form_id == NULL ) {
                $query = "select $form_entry_table.entry_id, $form_entry_table.entry_detail, $form_entry_table.entry_created, $form_table.form_title, $form_table.form_id  from $form_entry_table inner join $form_table on $form_entry_table.form_id = $form_table.form_id order by $form_entry_table.entry_id desc ";
            } else {
                $query = "select $form_entry_table.entry_id, $form_entry_table.entry_detail, $form_entry_table.entry_created, $form_table.form_title, $form_table.form_id  from $form_entry_table inner join $form_table on $form_entry_table.form_id = $form_table.form_id where $form_entry_table.form_id = $form_id  order by $form_entry_table.entry_id desc ";
            }
            $form_entry_rows = $wpdb->get_results( $query, 'ARRAY_A' );
            return $form_entry_rows;
        }

        /**
         * Model to return form entries
         * @param int $form_id
         * @return array
         */
        public static function get_total_form_entries($form_id = NULL) {
            global $wpdb;
            $form_table = UFB_FORM_TABLE;
            $form_entry_table = UFB_ENTRY_TABLE;
            if ( $form_id == NULL ) {
                $query = "select $form_entry_table.entry_id, $form_entry_table.entry_detail, $form_entry_table.entry_created,$form_entry_table.status, $form_table.form_title, $form_table.form_id  from $form_entry_table inner join $form_table on $form_entry_table.form_id = $form_table.form_id order by $form_entry_table.entry_id desc";
            } else {
                $query = "select $form_entry_table.entry_id, $form_entry_table.entry_detail, $form_entry_table.entry_created,$form_entry_table.status, $form_table.form_title, $form_table.form_id  from $form_entry_table inner join $form_table on $form_entry_table.form_id = $form_table.form_id where $form_entry_table.form_id = $form_id  order by $form_entry_table.entry_id desc";
            }
            $form_entry_rows = $wpdb->get_results( $query, 'ARRAY_A' );
            $total_form_entry_rows = count( $form_entry_rows );
            return $total_form_entry_rows;
        }

        /**
         * Model to delete entry
         * @param type $entry_id
         * @return int
         */
        public static function delete_entry($entry_id) {
            global $wpdb;
            if ( $entry_id != '' ) {
                $wpdb->delete( UFB_ENTRY_TABLE, array( 'entry_id' => $entry_id ), array( '%d' ) );
                die( 'success' );
            }
        }

        /**
         * Model to return entry detail by entry id
         * @param int $entry_id
         * @return array
         */
        public static function get_entry_detail($entry_id) {
            global $wpdb;
            if ( $entry_id != '' ) {
                $form_table = UFB_FORM_TABLE;
                $entry_table = UFB_ENTRY_TABLE;
                $entry_row = $wpdb->get_row( "SELECT * FROM $entry_table INNER JOIN $form_table ON $entry_table.form_id = $form_table.form_id WHERE $entry_table.entry_id = $entry_id", 'ARRAY_A' );
                return $entry_row;
            } else {
                return NULL;
            }
        }

        /**
         * Model to return all the form labels in array
         * @param int $form_id
         * @return array 
         */
        public static function get_form_data($form_id) {
            global $wpdb;
            $form_table = UFB_FORM_TABLE;
            $form_row = $wpdb->get_row( "SELECT form_detail FROM $form_table WHERE form_id = $form_id ", 'ARRAY_A' );
            if ( !empty( $form_row ) ) {
                $form_detail = maybe_unserialize( $form_row['form_detail'] );
                $form_labels = array();
                $form_keys = array();
                $except_field_types = array( 'submit', 'captcha', 'custom-texts', 'agreement-block' );
                foreach ( $form_detail['field_data'] as $field_key => $field_settings ) {
                    if ( !in_array( $field_settings['field_type'], $except_field_types ) ) {
                        $form_labels[] = (isset( $field_settings['field_label'] ) && $field_settings['field_label'] != '') ? esc_attr( $field_settings['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . $field_settings['field_type'];
                        $form_keys[] = $field_key;
                    }
                }
                $form_data = array( 'form_labels' => $form_labels, 'form_keys' => $form_keys );
            } else {
                $form_data = array( 'form_labels' => array(), 'form_keys' => array() );
            }
            return $form_data;
        }

        /**
         * Model to copy form
         * @return void
         */
        public static function copy_form() {
            $form_id = sanitize_text_field( $_POST['form_id'] );
            $form_title = sanitize_text_field( $_POST['form_title'] );
            $form_row = self::get_form_row( $form_id );
            $form_title = ($form_title == '') ? esc_attr( $form_row['form_title'] ) . '- Copy' : $form_title;
            $form_detail = $form_row['form_detail'];
            $form_status = $form_row['form_status'];
            $created_date = date( 'Y-m-d H:i:s:u' );
            $form_type = isset( $form_row['form_type'] ) ? $form_row['form_type'] : 'single';
            global $wpdb;
            $check = $wpdb->insert(
                    UFB_FORM_TABLE, array(
                'form_title' => $form_title,
                'form_detail' => $form_detail,
                'form_status' => $form_status,
                'form_created' => $created_date,
                'form_modified' => $created_date,
                'form_type' => $form_type
                    ), array(
                '%s', '%s', '%s', '%s', '%s', '%s'
                    )
            );
            if ( $check == 1 ) {
                $form_id = $wpdb->insert_id;
                $redirect_url = admin_url( 'admin.php?page=ufb&action=edit-form&form_id=' . $form_id );
                $response_array = array( 'success' => 1, 'form_id' => $form_id, 'redirect_url' => $redirect_url );
            } else {
                $response_array = array( 'success' => 0, 'error_msg' => __( 'Something went wrong.Please try again later', UFB_TD ) );
            }
            die( json_encode( $response_array ) );
        }

        /*
         * Model to change the status of the entry
         * @param int entry_id 
         * @return void
         */

        public static function change_entry_status($entry_id, $status) {
            global $wpdb;
            $check = $wpdb->update(
                    UFB_ENTRY_TABLE, array(
                'status' => $status
                    ), array( 'entry_id' => $entry_id ), array(
                '%d'
                    ), array( '%d' )
            );
        }

        /**
         * @return boolen
         * @param string $action
         * @param array $entry_id
         */
        public static function perform_entry_bulk_action($action = '', $entry_id = array()) {
            global $wpdb;
            $entry_table = UFB_ENTRY_TABLE;
            $temp_array = array();
            foreach ( $entry_id as $e_id ) {
                $temp_array[] = "entry_id = $e_id";
            }
            $where_condition = implode( ' or ', $temp_array );
            switch ( $action ) {
                case 'read':
                    $query = "update $entry_table set status = 1 where $where_condition";
                    break;
                case 'unread':
                    $query = "update $entry_table set status = 0 where $where_condition";
                    break;
                case 'delete':
                    $query = "delete from $entry_table where $where_condition";
                    break;
            }
            $check = $wpdb->query( $query );
            return $check;
        }

        /**
         * Form Import
         * @param type array $form_row
         * @return boolean
         */
        public static function import_form($form_row) {
            $form_row = ( array ) $form_row;
            global $wpdb;
            $form_title = $form_row['form_title'];
            $form_detail = $form_row['form_detail'];
            $form_status = $form_row['form_status'];
            $created_date = date( 'Y-m-d H:i:s:u' );
            $form_type = isset( $form_row['form_type'] ) ? $form_row['form_type'] : 'single';
            $check = $wpdb->insert(
                    UFB_FORM_TABLE, array(
                'form_title' => $form_title,
                'form_detail' => $form_detail,
                'form_status' => $form_status,
                'form_created' => $created_date,
                'form_modified' => $created_date,
                'form_type' => $form_type
                    ), array(
                '%s', '%s', '%s', '%s', '%s', '%s'
                    )
            );

            return $check;
        }

        function get_free_version_forms() {
            global $wpdb;
            $free_version_table_name = $wpdb->prefix . 'ufbl_forms';
            if ( $wpdb->get_var( "SHOW TABLES LIKE '$free_version_table_name'" ) == $free_version_table_name ) {
                $free_forms = $wpdb->get_results( "select * from $free_version_table_name" );
                if ( $wpdb->num_rows > 0 ) {
                    return $free_forms;
                } else {
                    return NULL;
                }
            } else {
                return NULL;
            }
        }

        function copy_free_version_form($form_id) {
            global $wpdb;
            $free_version_table_name = $wpdb->prefix . 'ufbl_forms';
            $form_row = $wpdb->get_row( "select * from $free_version_table_name where form_id = $form_id", ARRAY_A );

            if ( null !== $form_row ) {

                $form_title = $form_row['form_title'];
                $form_detail = $form_row['form_detail'];
                $form_status = $form_row['form_status'];
                $created_date = $form_row['form_created'];
                $modified_date = $form_row['form_modified'];
                $form_type = 'single';
                $field_array = array(
                    'form_title' => $form_title,
                    'form_detail' => $form_detail,
                    'form_status' => $form_status,
                    'form_created' => $created_date,
                    'form_modified' => $modified_date,
                    'form_type' => $form_type
                );
                $field_data_array = array( '%s', '%s', '%s', '%s', '%s', '%s' );
                $check = $wpdb->insert( UFB_FORM_TABLE, $field_array, $field_data_array );
                return $check;
            }
        }

        function check_table_exists($table_name) {
            global $wpdb;
            if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
                //table not in database. 
                return false;
            } else {
                return true;
            }
        }

        function import_table($table_name, $import_type) {
            $import_file_path = UFB_PATH . '/tables/' . $import_type . '.json';
            $import_file_url = UFB_URL . '/tables/' . $import_type . '.json';
            if ( file_exists( $import_file_path ) ) {
                global $wpdb;
                $charset_collate = $wpdb->get_charset_collate();
                switch ( $import_type ) {
                    case 'country':
                        $table_sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL AUTO_INCREMENT,
				sortname varchar(255),
				name varchar(255),
				UNIQUE KEY id (id)
			  ) $charset_collate;";


                        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                        dbDelta( $table_sql );
                        $connection = wp_remote_get( $import_file_url );
                        if ( !is_wp_error( $connection ) ) {
                            $countries = json_decode( $connection['body'] );
                            foreach ( $countries as $country ) {
                                $id = $country->ID;
                                $sortname = $country->sortname;
                                $name = $country->name;
                                $wpdb->insert(
                                        $table_name, array(
                                    'id' => $id,
                                    'sortname' => $sortname,
                                    'name' => $name
                                        ), array(
                                    '%d', '%s', '%s'
                                        )
                                );
                            }
                            return '1';
                        } else {
                            return '0';
                        }
                        break;
                    case 'city':
                        $table_sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL AUTO_INCREMENT,
				name varchar(255),
                                state_id int(11),
				UNIQUE KEY id (id)
			  ) $charset_collate;";


                        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                        dbDelta( $table_sql );
                        $connection = wp_remote_get( $import_file_url );
                        if ( !is_wp_error( $connection ) ) {
                            $cities = json_decode( $connection['body'] );
                            foreach ( $cities as $city ) {
                                $id = $city->ID;
                                $state_id = $city->state_id;
                                $name = $city->name;
                                $wpdb->insert(
                                        $table_name, array(
                                    'id' => $id,
                                    'name' => $name,
                                    'state_id' => $state_id,
                                        ), array(
                                    '%d', '%s', '%d'
                                        )
                                );
                            }
                            return '1';
                        } else {
                            return '0';
                        }
                        break;
                    case 'state':
                        $table_sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL AUTO_INCREMENT,
				name varchar(255),
                                country_id int(11),
				UNIQUE KEY id (id)
			  ) $charset_collate;";


                        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                        dbDelta( $table_sql );
                        $connection = wp_remote_get( $import_file_url );
                        if ( !is_wp_error( $connection ) ) {
                            $states = json_decode( $connection['body'] );
                            foreach ( $states as $state ) {
                                $id = $state->ID;
                                $country_id = $state->country_id;
                                $name = $state->name;
                                $wpdb->insert(
                                        $table_name, array(
                                    'id' => $id,
                                    'name' => $name,
                                    'country_id' => $country_id,
                                        ), array(
                                    '%d', '%s', '%d'
                                        )
                                );
                            }
                            return '1';
                        } else {
                            return '0';
                        }
                        break;
                }
            } else {
                
            }
        }

        function drop_table($table_name) {
            global $wpdb;
            $drop_check = $wpdb->query( "drop table $table_name" );
            return $drop_check;
        }

        function get_all_rows($table_name){
            global $wpdb;
            $query = "select * from $table_name";
            $results = $wpdb->get_results($query,ARRAY_A);
            return $results;

        }
        
        /**
         * Country Wise States
         * @param type int $country_id
         * @return array
         */
        public static function get_states_from_country($country_id) {
            
            global $wpdb;
            $states_table = UFB_STATE_TABLE;
            $states = $wpdb->get_results( "select * from $states_table where country_id = $country_id" );
            return $states;
        }
        /**
         * Country Wise States
         * @param type int $country_id
         * @return array
         */
        public static function get_cities_from_state($state_id) {
            
            global $wpdb;
            $cities_table = UFB_CITY_TABLE;
            $cities = $wpdb->get_results( "select * from $cities_table where state_id = $state_id" );
            return $cities;
        }

    }

}
