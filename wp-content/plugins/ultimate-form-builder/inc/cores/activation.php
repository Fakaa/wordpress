<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Necessary Table Creation on activation
 */
if ( is_multisite() ) {
    global $wpdb;
    $current_blog = $wpdb->blogid;

// Get all blogs in the network and activate plugin on each one
    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
    foreach ( $blog_ids as $blog_id ) {
        switch_to_blog( $blog_id );
        $ufb_settings = get_option( 'ufb_settings' );
        if ( empty( $ufb_settings ) ) {
            $default_settings = array( 'disable_ui' => 0, 'disable_fa' => 0 );
            update_option( 'ufb_settings', $default_settings );
        }
        $charset_collate = $wpdb->get_charset_collate();
        $form_table = $wpdb->prefix . 'ufb_forms';
        $form_entry_table = $wpdb->prefix . 'ufb_entries';
        $form_sql = "CREATE TABLE $form_table (
						form_id mediumint(9) NOT NULL AUTO_INCREMENT,
						form_title varchar(255),
						form_detail longtext,
						form_status int,
						form_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
						form_modified datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                                                form_type varchar(10),
						UNIQUE KEY form_id (form_id)
					  ) $charset_collate;";

        $form_entry_sql = "CREATE TABLE $form_entry_table (
							entry_id mediumint(9) NOT NULL AUTO_INCREMENT,
						  form_id mediumint(9),
						  entry_detail longtext,
						  entry_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
						  status int DEFAULT '0',
						  UNIQUE KEY entry_id (entry_id)
						) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $form_sql );
        dbDelta( $form_entry_sql );


        restore_current_blog();
    }
} else {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $form_table = UFB_FORM_TABLE;
    $form_entry_table = UFB_ENTRY_TABLE;
    $form_sql = "CREATE TABLE $form_table (
				form_id mediumint(9) NOT NULL AUTO_INCREMENT,
				form_title varchar(255),
				form_detail longtext,
				form_status int,
				form_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				form_modified datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                                form_type varchar(10),
				UNIQUE KEY form_id (form_id)
			  ) $charset_collate;";

    $form_entry_sql = "CREATE TABLE $form_entry_table (
						entry_id mediumint(9) NOT NULL AUTO_INCREMENT,
					  form_id mediumint(9),
					  entry_detail longtext,
					  entry_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					  status int DEFAULT 0,
					  UNIQUE KEY entry_id (entry_id)
					) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $form_sql );
    dbDelta( $form_entry_sql );

    $ufb_settings = get_option( 'ufb_settings' );
    if ( empty( $ufb_settings ) ) {
        $default_settings = array( 'disable_ui' => 0, 'disable_fa' => 0 );
        update_option( 'ufb_settings', $default_settings );
    }
}	