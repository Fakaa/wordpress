<?php

require_once(PI_FILE_CORE .'/TGM_Activation_Plugin/class-tgm-plugin-activation.php');

if (!function_exists('roark_tgm_activation')) {

    function roark_tgm_activation() {
        
      $dir = get_template_directory();
      $plugins = array(
        array(
            'name'      => 'WPBakery Visual Composer',
            'slug'      => 'js_composer',
            'source'    =>  $dir . '/core/plugins/js_composer.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'              => 'Roark Widgets',
            'slug'              => 'roark-widgets',
            'source'            =>  $dir . '/core/plugins/roark-widgets.zip',
            'required'          => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Wiloke Post Format UI',
            'slug'      => 'wiloke-post-format-ui',
            'source'    =>  $dir . '/core/plugins/wiloke-post-format-ui.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Roark Shortcodes',
            'slug'      => 'roark-shortcodes',
            'source'    =>  $dir . '/core/plugins/roark-shortcodes.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Envato Market Master',
            'slug'      => 'wp-envato-market-master',
            'source'    =>  $dir . '/core/plugins/wp-envato-market-master.zip',
            'required'  => false
        ),
        array(
            'name'      => 'Revolution Slider',
            'slug'      => 'revslider',
            'source'    =>  $dir . '/core/plugins/revslider.zip',
            'required'  => false
        ),

        array(
            'name'      => 'Wiloke Sharing Post',
            'slug'      => 'wiloke-sharing-post',
            'source'    =>  $dir . '/core/plugins/wiloke-sharing-post.zip',
            'required'  => false
        ),

        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        )
      );

      $config = array(
            'default_path' => '',
            'menu' => 'tgmpa-install-plugins',
            'has_notices' => true,
            'dismissable' => false,
            'dismiss_msg' => false,
            'is_automatic' => true,
            'message' => '',
            'strings' => array(
                'page_title' => esc_html__( 'Install Required Plugins', 'roark' ),
                'menu_title' => esc_html__( 'Install Plugins', 'roark' ),
                'installing' => esc_html__( 'Installing Plugin: %s', 'roark' ),
                'oops' => esc_html__( 'Something went wrong with the plugin API.', 'roark' ),
                'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'roark'), // %1$s = plugin name(s).
                'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'roark'), // %1$s = plugin name(s).
                'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'roark'), // %1$s = plugin name(s).
                'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'roark'), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'roark'), // %1$s = plugin name(s).
                'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'roark'), // %1$s = plugin name(s).
                'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'roark'), // %1$s = plugin name(s).
                'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'roark'), // %1$s = plugin name(s).
                'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'roark'),
                'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'roark'),
                'return' => esc_html__( 'Return to Required Plugins Installer', 'roark' ),
                'plugin_activated' => esc_html__( 'Plugin activated successfully.', 'roark' ),
                'complete' => esc_html__( 'All plugins installed and activated successfully. %s', 'roark' ), // %s = dashboard link.
                'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa( $plugins, $config );

    }

  add_action( 'tgmpa_register', 'roark_tgm_activation' );

}
