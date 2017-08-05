<?php
defined('ABSPATH') or die('No script kiddies please!');

/*
  Plugin Name: Ultimate Form Builder
  Plugin URI:  https://accesspressthemes.com/wordpress-plugins/ultimate-form-builder/
  Description: A plugin to build any type of forms
  Version:     1.1.4
  Author:      AccessPress Themes
  Author URI:  http://accesspressthemes.com
  Domain Path: /languages
  Text Domain: ufb
 */

/**
 * Necessary Constants for plugin
 */
global $wpdb;
defined('UFB_VERSION') or define('UFB_VERSION', '1.1.4'); //plugin version
defined('UFB_SLUG') or define('UFB_SLUG', 'ufb'); //plugin admin slug
defined('UFB_TD') or define('UFB_TD', 'ufb'); //plugin's text domain
defined('UFB_IMG_DIR') or define('UFB_IMG_DIR', plugin_dir_url(__FILE__) . 'images'); //plugin image directory
defined('UFB_URL') or define('UFB_URL', plugin_dir_url(__FILE__)); //plugin directory url
defined('UFB_JS_DIR') or define('UFB_JS_DIR', plugin_dir_url(__FILE__) . 'js');  //plugin js directory
defined('UFB_CSS_DIR') or define('UFB_CSS_DIR', plugin_dir_url(__FILE__) . 'css'); // plugin css dir
defined('UFB_PATH') or define('UFB_PATH', plugin_dir_path(__FILE__));
defined('UFB_FORM_TABLE') or define('UFB_FORM_TABLE', $wpdb->prefix . 'ufb_forms');
defined('UFB_ENTRY_TABLE') or define('UFB_ENTRY_TABLE', $wpdb->prefix . 'ufb_entries');
defined('UFB_COUNTRY_TABLE') or define('UFB_COUNTRY_TABLE', $wpdb->prefix . 'ufb_countries');
defined('UFB_STATE_TABLE') or define('UFB_STATE_TABLE', $wpdb->prefix . 'ufb_states');
defined('UFB_CITY_TABLE') or define('UFB_CITY_TABLE', $wpdb->prefix . 'ufb_cities');
defined('UFB_ENTRY_LIMIT') or define('UFB_ENTRY_LIMIT', 10);

require_once UFB_PATH . 'classes/ufb-lib.php';
require_once UFB_PATH . 'classes/ufb-model.php';
require_once UFB_PATH . 'classes/file-uploader-class.php';

/**
 * Plugin's main class
 */
if ( !class_exists('UFB_Class') ) {

    class UFB_Class {

        var $library;
        var $model;

        /**
         * Plugin initialization hooks
         */
        function __construct() {
            $this->library = new UFB_Lib();
            $this->model = new UFB_Model();
            add_action('init', array( $this, 'ufb_init' )); //executes when init hook is fired
            add_action('admin_menu', array( $this, 'ufb_menu' )); //adds plugin menu in wordpress backend
            add_action('admin_enqueue_scripts', array( $this, 'register_admin_assets' )); //registers admin assets
            add_action('wp_enqueue_scripts', array( $this, 'register_frontend_assets' )); //registers admin assets

            /**
             * Form Add Action
             */
            add_action('wp_ajax_add_form_action', array( $this, 'add_form_ajax' )); //add form ajax action
            add_action('wp_ajax_nopriv_add_form_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call


            /**
             * Form Copy Action
             */
            add_action('wp_ajax_copy_form_action', array( $this, 'copy_form_ajax' )); //copy form ajax action
            add_action('wp_ajax_nopriv_copy_form_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call

            /**
             * Front Form Action
             */
            add_action('wp_ajax_ufb_front_form_action', array( $this, 'front_form_action' ));
            add_action('wp_ajax_nopriv_ufb_front_form_action', array( $this, 'front_form_action' ));

            /**
             * Front Stepwise  Form Action
             */
            add_action('wp_ajax_ufb_front_form_step_action', array( $this, 'front_form_step_action' ));
            add_action('wp_ajax_nopriv_ufb_front_form_step_action', array( $this, 'front_form_step_action' ));

            /**
             * Form Status Action
             */
            add_action('wp_ajax_ufb_form_status_action', array( $this, 'form_status_action' )); //add form ajax action
            add_action('wp_ajax_nopriv_ufb_form_status_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call

            /**
             * Form Delete Action
             */
            add_action('wp_ajax_ufb_form_delete_action', array( $this, 'form_delete_action' )); //form delete ajax action
            add_action('wp_ajax_nopriv_ufb_form_delete_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call

            /**
             * Entry Delete Action
             */
            add_action('wp_ajax_ufb_entry_delete_action', array( $this, 'entry_delete_action' )); //entry delete ajax action
            add_action('wp_ajax_nopriv_ufb_form_delete_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call

            /**
             * Entry Status Change Action
             */
            add_action('wp_ajax_ufb_entry_status_change_action', array( $this, 'entry_status_change_action' )); //entry status change action
            add_action('wp_ajax_nopriv_ufb_form_delete_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call

            /**
             * Entry Detail Action
             */
            add_action('wp_ajax_ufb_get_entry_detail_action', array( $this, 'get_entry_detail_action' )); //entry detail ajax action
            add_action('wp_ajax_nopriv_ufb_get_entry_detail_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call

            register_activation_hook(__FILE__, array( $this, 'activate_plugin' )); //executes when plugin is activated

            /*
             * Form Save Action
             */
            add_action('admin_post_ufb_form_action', array( $this, 'ufb_form_action' )); //form action


            /**
             * Form Shortcode
             */
            add_shortcode('ufb', array( $this, 'shortcode_manager' ));

            /**
             * CSV Export Action
             */
            add_action('admin_post_ufb_csv_export', array( $this, 'export_csv' ));

            /**
             * Form Preview
             */
            add_action('template_redirect', array( $this, 'preview_form' ));

            /**
             * File Uploader Action
             */
            add_action('wp_ajax_ufb_file_upload_action', array( $this, 'file_upload_action' ));
            add_action('wp_ajax_nopriv_ufb_file_upload_action', array( $this, 'file_upload_action' ));

            /**
             * Uploaded File Delete Action
             */
            add_action('wp_ajax_ufb_file_delete_action', array( $this, 'file_delete_action' ));
            add_action('wp_ajax_nopriv_ufb_file_delete_action', array( $this, 'file_delete_action' ));

            /**
             * Entry Bulk action
             */
            add_action('admin_post_ufb_entries_bulk_actions', array( $this, 'ufb_entries_bulk_actions' ));

            /**
             * Form Export Action
             */
            add_action('admin_post_ufb_export_form_action', array( 'UFB_Lib', 'ufb_export_form_action' ));

            /**
             * Form Import Action
             */
            add_action('admin_post_ufb_import_form_action', array( 'UFB_Lib', 'ufb_import_form_action' ));

            /**
             * Form Ajax Import Action
             */
            add_action('wp_ajax_ufb_new_form_import_action', array( $this, 'new_form_import_action' ));
            add_action('wp_ajax_nopriv_ufb_new_form_import_action', array( $this, 'no_permission' ));

            /**
             * Country State table
             * @since version 1.1.0
             */
            add_action('wp_ajax_import_table_action', array( $this, 'import_table_action' ));
            add_action('wp_ajax_nopriv_import_table_action', array( $this, 'no_permission' ));

            /**
             * Country wise states ajax action
             * @since version 1.1.0
             */
            add_action('wp_ajax_ufb_get_states_from_country_action', array( $this, 'get_states_from_country' ));
            add_action('wp_ajax_nopriv_ufb_get_states_from_country_action', array( $this, 'get_states_from_country' ));
            /**
             * State wise cities ajax action
             * @since version 1.1.0
             */
            add_action('wp_ajax_ufb_get_cities_from_state_action', array( $this, 'get_cities_from_state' ));
            add_action('wp_ajax_nopriv_ufb_get_cities_from_state_action', array( $this, 'get_cities_from_state' ));

            add_action('admin_post_ufb_import_form_action', array( 'UFB_Lib', 'ufb_import_form_action' ));

            /**
             * Settings Save Action
             */
            add_action('wp_ajax_save_settings_action', array( $this, 'save_settings_ajax' )); //save settings ajax
            add_action('wp_ajax_nopriv_save_settings_action', array( $this, 'no_permission' )); //preventing unauthorized ajax call
        }

        /**
         * Tasks to be done in init hook
         * Loads plugin for translation
         * Starts session
         */
        function ufb_init() {
            load_plugin_textdomain(UFB_TD, false, basename(dirname(__FILE__)) . '/languages'); //Loads plugin text domain for the translation
            if ( !session_id() && !headers_sent() ) {
                session_start(); //starts session if already not started
            }
            do_action('ufb_init');
        }

        /**
         * Adds Plugin menu in wordpress backend
         */
        function ufb_menu() {
            add_menu_page(__('Forms', UFB_TD), __('Forms', UFB_TD), 'manage_options', UFB_SLUG, array( $this, 'forms_list' ), 'dashicons-welcome-widgets-menus', 35.7);
            add_submenu_page(UFB_SLUG, isset($_GET[ 'form_id' ]) ? __('Edit Form', UFB_TD) : __('All Forms', UFB_TD), __('All Forms', UFB_TD), 'manage_options', UFB_SLUG, array( $this, 'forms_list' ));
            add_submenu_page(UFB_SLUG, __('New Form', UFB_TD), __('New Form', UFB_TD), 'manage_options', 'ufb-new-form', array( $this, 'add_new_form' ));
            add_submenu_page(UFB_SLUG, __('Form Entries', UFB_TD), __('Form Entries', UFB_TD), 'manage_options', 'ufb-form-entries', array( $this, 'forms_entries' ));
            add_submenu_page(UFB_SLUG, __('Settings', UFB_TD), __('Settings', UFB_TD), 'manage_options', 'ufb-settings', array( $this, 'forms_settings' ));
            add_submenu_page(UFB_SLUG, __('Export', UFB_TD), __('Export', UFB_TD), 'manage_options', 'ufb-form-export', array( $this, 'forms_export' ));
            add_submenu_page(UFB_SLUG, __('Import', UFB_TD), __('Import', UFB_TD), 'manage_options', 'ufb-form-import', array( $this, 'forms_import' ));
            add_submenu_page(UFB_SLUG, __('How to use', UFB_TD), __('How to use', UFB_TD), 'manage_options', 'ufb-how-to-use', array( $this, 'how_to_use' ));
            add_submenu_page(UFB_SLUG, __('About', UFB_TD), __('About', UFB_TD), 'manage_options', 'ufb-about', array( $this, 'about' ));
        }

        /**
         * Forms Listing
         */
        function forms_list() {
            if ( isset($_GET[ 'action' ], $_GET[ 'form_id' ]) && $_GET[ 'action' ] == 'edit-form' ) {
                $form_id = sanitize_text_field($_GET[ 'form_id' ]);
                $data[ 'form_row' ] = $this->model->get_form_detail($form_id);
                $data[ 'country_table_flag' ] = $this->model->check_table_exists(UFB_COUNTRY_TABLE);
                $data[ 'state_table_flag' ] = $this->model->check_table_exists(UFB_STATE_TABLE);
                $data[ 'city_table_flag' ] = $this->model->check_table_exists(UFB_CITY_TABLE);
                // $this->library->print_array($data);
                if ( $data[ 'country_table_flag' ] ) {
                    $data[ 'country_list' ] = $this->model->get_all_rows(UFB_COUNTRY_TABLE);
                } else {
                    $data[ 'country_list' ] = array();
                }

                if ( $data[ 'form_row' ] != null ) {
                    $this->library->load_view('backend/form-builder', $data);
                } else {
                    _e('No form found for this form id.Please go back and create a new form.', UFB_TD);
                }
            } else {
                $forms = $this->model->get_all_forms();
                $data[ 'forms' ] = $forms;
                $this->library->load_view('backend/form-list', $data);
            }
        }

        /**
         * Plugin on activation tasks
         */
        function activate_plugin() {
            $this->library->load_core('activation');
        }

        /**
         * Registers admin assets
         */
        function register_admin_assets() {
            $plugin_pages = array( UFB_SLUG, 'ufb-new-form', 'ufb-form-entries', 'ufb-how-to-use', 'ufb-about', 'ufb-form-export', 'ufb-form-import', 'ufb-settings' );
            $admin_ajax_nonce = wp_create_nonce('ufb-admin-ajax-nonce');
            $admin_ajax_object = array( 'ajax_url' => admin_url('admin-ajax.php'), 'ajax_nonce' => $admin_ajax_nonce );
            if ( isset($_GET[ 'page' ]) && in_array($_GET[ 'page' ], $plugin_pages) ) {
                wp_enqueue_style('ufb-admin', UFB_CSS_DIR . '/backend.css', array(), UFB_VERSION);
                //  wp_enqueue_style( 'ufb-jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css', array(), UFB_VERSION );
                wp_enqueue_style('ufb-font-awesome', UFB_CSS_DIR . '/font-awesome.min.css', array(), UFB_VERSION);
                wp_enqueue_script('ufb-admin-js', UFB_JS_DIR . '/backend.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-slider' ), UFB_VERSION);
                wp_localize_script('ufb-admin-js', 'ufb_ajax_obj', $admin_ajax_object);
            }
        }

        /**
         * Registers front assets
         */
        function register_frontend_assets() {
            $ufb_settings = get_option('ufb_settings');
            if ( empty($ufb_settings) ) {
                $ufb_settings = array( 'disable_ui' => 0, 'disable_fa' => 0 );
            }
            /**
             * Frontend styles
             */
            wp_enqueue_style('ufb-custom-select-css', UFB_CSS_DIR . '/jquery.selectbox.css', array(), UFB_VERSION);
            if ( $ufb_settings[ 'disable_fa' ] != 1 ) {
                wp_enqueue_style('ufb-font-css', UFB_CSS_DIR . '/font-awesome.min.css', array(), UFB_VERSION);
            }
            if ( $ufb_settings[ 'disable_ui' ] != 1 ) {
                wp_enqueue_style('ufb-jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css', array(), UFB_VERSION);
            }
            wp_enqueue_style('ufb-front-css', UFB_CSS_DIR . '/frontend.css', array(), UFB_VERSION);
            wp_enqueue_style('ufb-fileuploader-animation', UFB_CSS_DIR . '/loading-animation.css');
            wp_enqueue_style('ufb-fileuploader', UFB_CSS_DIR . '/fileuploader.css');

            /**
             * Frontend Scripts
             */
            wp_enqueue_script('ufb-fileuploader', UFB_JS_DIR . '/fileuploader.js', array(), UFB_VERSION);
            wp_enqueue_script('ufb-custom-select-js', UFB_JS_DIR . '/jquery.selectbox-0.2.min.js', array( 'jquery' ), UFB_VERSION);
            wp_enqueue_script('ufb-touch-ui', UFB_JS_DIR . '/jquery-ui-touchpad.js', array( 'jquery', 'jquery-ui-slider' ), UFB_VERSION);
            wp_enqueue_script('ufb-front-js', UFB_JS_DIR . '/frontend.js', array( 'jquery', 'ufb-custom-select-js', 'jquery-ui-datepicker', 'jquery-ui-slider', 'ufb-fileuploader' ), UFB_VERSION);
            $frontend_js_obj = array(
                'default_error_message' => __('This field is required', UFB_TD),
                'ajax_url' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('frontend-ajax-nonce'),
                'preview_img' => UFB_IMG_DIR . '/no-preview.png'
            );
            wp_localize_script('ufb-front-js', 'frontend_js_obj', $frontend_js_obj);
        }

        /**
         * Unauthorized ajax call
         */
        function no_permission() {
            die('No script kiddies please!');
        }

        /**
         * Add New Form
         */
        function add_new_form() {
            $this->library->load_view('backend/new-form');
        }

        /**
         * Add Form Ajax Action
         */
        function add_form_ajax() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $this->model->add_form();
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Form status change action
         */
        function form_status_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $this->model->change_form_status();
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Form Save Action
         */
        function form_save_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $this->model->save_form();
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Form Delete Action
         */
        function form_delete_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $this->model->delete_form();
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * UFBL Form Save Action
         */
        function ufb_form_action() {
            if ( isset($_POST[ 'ufb_form_nonce_field' ]) && wp_verify_nonce($_POST[ 'ufb_form_nonce_field' ], 'ufb-form-nonce') ) {
                $this->model->save_form();
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Form Entries Page
         */
        function forms_entries() {
            $form_rows = $this->model->get_forms();
            $data[ 'form_rows' ] = $form_rows;
            $page = isset($_GET[ 'page_num' ]) ? $_GET[ 'page_num' ] : 1;
            $limit = UFB_ENTRY_LIMIT;
            $offset = ($page - 1) * $limit;
            if ( isset($_GET[ 'form_id' ]) ) {
                $form_id = sanitize_text_field($_GET[ 'form_id' ]);
                $form_entries_row = $this->model->get_forms_entries($form_id, $limit, $offset);
                $total_form_entries = $this->model->get_total_form_entries($form_id);
            } else {
                $form_entries_row = $this->model->get_forms_entries(NULL, $limit, $offset);
                $total_form_entries = $this->model->get_total_form_entries();
            }
            $total_pages = $total_form_entries / $limit;
            if ( $total_form_entries % $limit != 0 ) {
                $total_pages = intval($total_pages) + 1;
            }
            $data[ 'form_entry_rows' ] = $form_entries_row;
            $data[ 'total_pages' ] = $total_pages;
            $this->library->load_view('backend/form-entries-list', $data);
        }

        /**
         * Form Shortcode
         */
        function shortcode_manager($atts = array()) {
            if ( isset($atts[ 'form_id' ]) ) {
                $form_id = $atts[ 'form_id' ];
                $form_row = $this->model->get_form_row($form_id);
                if ( $form_row != '' ) {
                    if ( $form_row[ 'form_status' ] == 1 ) {

                        $form_html = $this->generate_form($form_row);
                    } else {
                        $close_message = isset($atts[ 'close_message' ]) ? $atts[ 'close_message' ] : __('This form is closed', UFB_TD);
                        $form_html = '<p>' . $close_message . '</p>';
                    }
                } else {
                    $form_html = '<p>' . __('Form couldn\'t be found for id ', UFB_TD) . $form_id . '</p>';
                }


                return $form_html;
            } else {
                return __('Form ID missing', UFB_TD);
            }
        }

        /**
         * Form HTML
         *
         */
        function generate_form($form_row) {
            $data[ 'form_row' ] = $form_row;
            ob_start();
            $this->library->load_view('frontend/front-form', $data);
            $form_html = ob_get_contents();
            ob_clean();
            return $form_html;
        }

        /**
         * Front Form Action
         */
        function front_form_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'frontend-ajax-nonce') ) {
                //$this->library->print_array( $_POST );
                $this->library->do_form_process();
                do_action('ufb_front_form_action');
                die();
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Front Step Form Action
         */
        function front_form_step_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'frontend-ajax-nonce') ) {

                //$this->library->print_array( $_POST );
                $this->library->do_form_process();
                do_action('ufb_front_step_form_action');
                die();
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Entry Delete Action
         */
        function entry_delete_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                //$this->library->print_array($_POST);die();
                $entry_id = sanitize_text_field($_POST[ 'entry_id' ]);
                $delete = $this->model->delete_entry($entry_id);
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Get Entry Detail Action
         */
        function get_entry_detail_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                //$this->library->print_array($_POST);die();
                $entry_id = sanitize_text_field($_POST[ 'entry_id' ]);
                $entry_row = $this->model->get_entry_detail($entry_id);
                $status = 1;
                $this->model->change_entry_status($entry_id, $status);
                $data[ 'entry_row' ] = $entry_row;
                $this->library->load_view('backend/entry-detail', $data);
                die();
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Exports File to CSV
         */
        function export_csv() {
            if ( isset($_GET[ '_wpnonce' ]) && wp_verify_nonce($_GET[ '_wpnonce' ], 'ufb-csv-nonce') ) {
                if ( isset($_GET[ 'form_id' ]) ) {
                    $form_id = sanitize_text_field($_GET[ 'form_id' ]);
                    $form_data = $this->model->get_form_data($form_id);
                    $entry_rows = $this->model->get_all_forms_entries($form_id);
                    $this->library->generate_csv($form_data, $entry_rows);
                } else {
                    wp_redirect(admin_url('admin.php?page=ufb-form-entries'));
                    exit;
                }
            } else {
                die('No script kiddies please!!');
            }
        }

        /**
         * Form copy action
         */
        function copy_form_ajax() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $this->model->copy_form();
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Form Preview
         */
        function preview_form() {
            if ( isset($_GET[ 'ufb_form_preview' ], $_GET[ 'ufb_form_id' ]) && is_user_logged_in() ) {
                $this->library->load_view('frontend/preview-form');
                exit();
            }
        }

        /**
         * How to use page
         */
        function how_to_use() {
            $this->library->load_view('backend/how-to-use');
        }

        /**
         * About page
         */
        function about() {
            $this->library->load_view('backend/about');
        }

        /**
         * File Upload Action
         */
        function file_upload_action() {
            if ( !wp_verify_nonce($_GET[ 'file_uploader_nonce' ], 'frontend-ajax-nonce') )
                die('No script kiddies please!');
            $allowedExtensions = $_GET[ 'allowedExtensions' ]; //array('jpg', 'jpeg', 'png', 'gif');
            $sizeLimit = $_GET[ 'sizeLimit' ];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $upload_dir = wp_upload_dir();
            $result = $uploader->handleUpload($upload_dir[ 'path' ] . '/', $replaceOldFile = false, $upload_dir[ 'url' ]);

            echo json_encode($result);
            die();
        }

        /**
         * File Delete Action
         */
        function file_delete_action() {
            if ( !empty($_POST) && wp_verify_nonce($_POST[ '_wpnonce' ], 'frontend-ajax-nonce') ) {
                if ( isset($_POST[ 'attachment_id' ]) && $_POST[ 'attachment_id' ] != '' ) {
                    $check = wp_delete_attachment(sanitize_text_field($_POST[ 'attachment_id' ]), true);
                } else {
                    $check = unlink($_POST[ 'path' ]);
                }
                if ( $check ) {
                    die('success');
                } else {
                    die('error');
                }
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Entry change status action
         * */
        function entry_status_change_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $status = (sanitize_text_field($_POST[ 'status' ]) == 0) ? 1 : 0;
                $entry_id = sanitize_text_field($_POST[ 'entry_id' ]);
                $this->model->change_entry_status($entry_id, $status);
                die();
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Entry Bulk Action
         */
        function ufb_entries_bulk_actions() {
            if ( !empty($_POST) && wp_verify_nonce($_POST[ 'entries_nonce_field' ], 'entries-nonce') ) {
                $action = sanitize_text_field($_POST[ 'bulk_action' ]);
                if ( isset($_POST[ 'entry_id' ]) ) {
                    $entry_id = array_map('sanitize_text_field', $_POST[ 'entry_id' ]);
                    $check = $this->model->perform_entry_bulk_action($action, $entry_id);
                    if ( $check ) {
                        switch ( $action ) {
                            case 'read':
                                $_SESSION[ 'ufb_message' ] = __('Status changed successfully.', UFB_TD);
                                break;
                            case 'unread':
                                $_SESSION[ 'ufb_message' ] = __('Status changed successfully.', UFB_TD);
                                break;
                            case 'delete':
                                $_SESSION[ 'ufb_message' ] = __('Entries deleted successfully.', UFB_TD);
                                break;
                        }
                    } else {
                        $_SESSION[ 'ufb_message' ] = __('There was an error. Please try again later.', UFB_TD);
                    }
                } else {
                    $_SESSION[ 'ufb_message' ] = __('Please select at least one entry', UFB_TD);
                }
                wp_redirect(admin_url('admin.php?page=ufb-form-entries'));
                exit;
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Forms Export
         */
        function forms_export() {
            $data[ 'forms' ] = $this->model->get_forms();
            $this->library->load_view('backend/form-export', $data);
        }

        /**
         * Forms & Table Import
         */
        function forms_import() {
            $data[ 'free_version_forms' ] = $this->model->get_free_version_forms();
            $data[ 'country_table_flag' ] = $this->model->check_table_exists(UFB_COUNTRY_TABLE);
            $data[ 'state_table_flag' ] = $this->model->check_table_exists(UFB_STATE_TABLE);
            $data[ 'city_table_flag' ] = $this->model->check_table_exists(UFB_CITY_TABLE);
            $this->library->load_view('backend/form-import', $data);
        }

        /**
         * Form Settings
         */
        function forms_settings() {
            $ufb_settings = get_option('ufb_settings');
            if ( empty($ufb_settings) ) {
                $ufb_settings = array( 'disable_ui' => 0, 'disable_fa' => 0 );
            }
            $data[ 'ufb_settings' ] = $ufb_settings;
            $this->library->load_view('backend/form-settings', $data);
        }

        /**
         * Settings Save
         */
        function save_settings_ajax() {
            if ( !empty($_POST) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $disable_ui = sanitize_text_field($_POST[ 'disable_ui' ]);
                $disable_fa = sanitize_text_field($_POST[ 'disable_fa' ]);
                $ufb_settings = array( 'disable_ui' => $disable_ui, 'disable_fa' => $disable_fa );
                update_option('ufb_settings', $ufb_settings);
                die('success');
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Free Version Form entry action
         *
         * @since 1.0.2
         */
        function new_form_import_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $form_id = sanitize_text_field($_POST[ 'form_id' ]);
                $check = $this->model->copy_free_version_form($form_id);
                if ( $check ) {
                    _e('Form imported successfully', UFB_TD);
                } else {
                    _e('There was some error. Please try again later', UFB_TD);
                }
                die();
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Import country state city table
         *
         * @since 1.1.0
         */
        function import_table_action() {
            if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') ) {
                $import_type = sanitize_text_field($_POST[ 'import_type' ]);
                switch ( $import_type ) {
                    case 'country':
                        $table_name = UFB_COUNTRY_TABLE;
                        break;
                    case 'city':
                        $table_name = UFB_CITY_TABLE;
                        break;
                    case 'state':
                        $table_name = UFB_STATE_TABLE;
                        break;
                    case 'default':
                        break;
                }
                $table_check = $this->model->check_table_exists($table_name);
                if ( !$table_check ) {
                    $check = $this->model->import_table($table_name, $import_type);
                } else {
                    $drop_check = $this->model->drop_table($table_name);
                    if ( $drop_check ) {
                        $check = $this->model->import_table($table_name, $import_type);
                    }
                }
                if ( $check == '1' ) {
                    die(__('Table imported successfully', UFB_TD));
                } else {
                    die(__('There occurred some error. Please try again later.', UFB_TD));
                }
            } else {
                die('No script kiddies please!!');
            }
        }

        /**
         * Returns country wise states
         */
        function get_states_from_country() {
            if ( isset($_POST[ '_wpnonce' ]) && (wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') || wp_verify_nonce($_POST[ '_wpnonce' ], 'frontend-ajax-nonce')) ) {

                $country_id = sanitize_text_field($_POST[ 'country_id' ]);
                $states_array = $this->model->get_states_from_country($country_id);
                $first_label = isset($_POST[ 'first_label' ]) ? $_POST[ 'first_label' ] : __('Choose State', UFB_TD);
                ?>
                <option value=""><?php echo $first_label; ?></option>
                <?php
                //  $this->library->print_array($states_array);die();
                if ( !empty($states_array) ) {

                    foreach ( $states_array as $state ) {
                        if ( isset($_POST[ 'first_label' ]) ) {
                            ?>
                            <option value="<?php echo $state->name; ?>" data-state-id="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>

                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>

                            <?php
                        }
                    }
                }
                die();
            } else {
                die('No script kiddies please!!');
            }
        }

        /**
         * Returns states wise cities
         */
        function get_cities_from_state() {
            if ( isset($_POST[ '_wpnonce' ]) && (wp_verify_nonce($_POST[ '_wpnonce' ], 'ufb-admin-ajax-nonce') || wp_verify_nonce($_POST[ '_wpnonce' ], 'frontend-ajax-nonce')) ) {

                $state_id = sanitize_text_field($_POST[ 'state_id' ]);

                $cities_array = $this->model->get_cities_from_state($state_id);
                ?>
                <option value=""><?php _e('Choose City', UFB_TD); ?></option>
                <?php
                //$this->library->print_array($states_array);
                if ( !empty($cities_array) ) {

                    foreach ( $cities_array as $city ) {
                        if ( isset($_POST[ 'first_label' ]) ) {
                            ?>
                            <option value="<?php echo $city->name; ?>"><?php echo $city->name; ?></option>

                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option>

                            <?php
                        }
                    }
                }
                die();
            }
        }

    }

    /**
     * Plugin initialization with object creation
     */
    $ufb_obj = new UFB_Class();
    $library_obj = new UFB_Lib();

    //class termination
}
