<?php 
    if(class_exists('Redux')) {
        $font_google = roark_framework::roark_googlefont_option();
        $option_name = 'roark_option';

        Redux::setArgs( 
           $option_name,
            array(
               'display_name' => esc_html__('Roark Options', 'roark'), 
               'display_version' => 'Part 2', 
               'menu_title' => esc_html__('Roark Options', 'roark'), 
               'admin_bar' => false, 
               'page_slug' => 'roark_option',
               'menu_type' => 'submenu',
               'dev_mode' => false,
               'allow_sub_menu' => true, 
           ) 
        );

        Redux::setSection($option_name, array(
            'title'      => esc_html__('General Settings', 'roark'),
            'id'         => 'general',
            'fields'     => array(
                array(
                    'id'       => 'favicon',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Favicon', 'roark' ),
                    'subtitle' => esc_html__( 'Upload a favicon for your website.', 'roark' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'preloader',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Preloader', 'roark' ),
                    'subtitle' => esc_html__( 'Set enable preloader.', 'roark' ),
                    'default'   => '1'
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Header Settings', 'roark'),
            'id'         => 'header',
            'icon'       => 'dashicons  dashicons-archive',
            'fields'     => array(
                array(
                    'id'       => 'logo',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Logo Image', 'roark' ),
                    'subtitle' => esc_html__( 'Upload a logo for your website.', 'roark' ),
                    'label'    => true,
                ),

                array(
                    'id'       => 'logo_retina',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Retina Logo Image', 'roark' ),
                    'description'=> esc_html__('Some newer devices come with "Retina Display" which , it will make content look sharper and more clear. A retina logo image is the same as the normal logo image, though twice the size and it must be named the exact same as the regular logo image, though with @2x added onto the end of the name.', 'roark'),
                    'label'    => true,
                ),

                array(
                    'id'      => 'header_option',
                    'type'    => 'checkbox',
                    'inline'   => 'true',
                    'title'   => esc_html__( 'Header Options', 'roark' ),
                    'subtitle'    => esc_html__( 'Would you like to add Social/Search box to Header?', 'roark' ),
                    'options' => array(
                        'social_icon'  => esc_html__('Hide Social', 'roark'),
                        'search_icon'    => esc_html__('Hide Search', 'roark'),
                    ),
                    'default'     => array(
                        'social_icon'   => '0',
                        'search_icon'   => '0',
                    )
                ),

                array(
                    'id'             => 'logo_spacing',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'all'            => false,
                    'right'          => false,     // Disable the top
                    'left'           => false,     // Disable the bottom
                    'title'          => esc_html__( 'Set Padding Top and Padding Bottom For Logo', 'roark' ),
                    'units_extended' => 'true', 
                    'subtitle'       => esc_html__( 'Allow your users to set the  top and bottom space for logo.', 'roark' ),
                    'default'        => array(
                        'margin-top'    => '45px',
                        'margin-bottom' => '45px',
                    )
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Social Settings', 'roark'),
            'id'         => 'social',
            'icon'       => 'dashicons-share dashicons-before',
            'fields'     => array(

                array(
                    'id'       => 'fa-facebook',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Facebook', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-twitter',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Twitter', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-google-plus',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Google Plus', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-pinterest',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Pinterest', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-linkedin',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Linkedin', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-rss',
                    'type'     => 'text',
                    'title'    => esc_html__( 'RSS', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-instagram',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Instagram', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-skype',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Skype', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-tumblr',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Tumblr', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-vimeo-square',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Vimeo', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),

                array(
                    'id'       => 'fa-yahoo',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Yahoo', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),
                array(
                    'id'       => 'fa-youtube',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Youtube', 'roark' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'roark')
                ),

            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Blog Settings', 'roark'),
            'id'         => 'blog',
            'icon'      => 'dashicons-before dashicons-admin-post',
            'fields'     => array(

                array(
                    'id'       => 'blog_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Blog Title', 'roark'),
                    'value'    => esc_html__('Our Blog', 'roark'),
                    'default'  => esc_html__('Our Blog', 'roark'),
                ),

                array(
                    'id'       => 'blog_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Blog Style', 'roark'),
                    'subtitle' => esc_html__( 'Set style for your blog page.', 'roark' ),
                    'options'  => array(
                        'blog-standard'      => esc_html__('Blog Standrad', 'roark'),
                        'blog-masonry'       => esc_html__('Blog Masonry', 'roark')
                    ),
                    'default'  => 'blog-standard'
                ),
                array(
                    'id'       => 'blog_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Blog Sidebar', 'roark'),
                    'subtitle' => esc_html__( 'Set sidebar for blog page. Default is right.', 'roark' ),
                    'options'  => array(
                        'no_sidebar'        => esc_html__('No Sidebar', 'roark'),
                        'sidebar_left'      => esc_html__('Sidebar Left', 'roark'),
                        'sidebar_right'     => esc_html__('Sidebar Right', 'roark'),
                    ),
                    'default'  => 'sidebar_right'
                ),


                array(
                    'id'       => 'related_post_number',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of posts related', 'roark'),
                    'default'  => '3'
                ),

                array(
                    'id'       => 'blog_excerpt',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Excerpt Length', 'roark'),
                    'subtitle'    => esc_html__( 'Set the length excerpt.', 'roark'),
                    'default'  => ''
                )
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Portfolio Settings', 'roark'),
            'id'         => 'portfolio_setting',
            'icon'       => 'dashicons dashicons-portfolio',
            'fields'     => array(
                array(
                    'id'       => 'portfolio_url',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Portfolio Page', 'roark'),
                    'subtitle' => esc_html__( 'Enter the url of portfolio template.', 'roark' ),
                    'default'  => esc_url(home_url('/'))
                ),
                array(
                    'id'       => 'portfolio_nav',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Hide Project Navigation', 'roark'),
                    'default'  => '0'
                ),

                array(
                    'id'       => 'portfolio_text_visit',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Text Button Vist Project', 'roark'),
                    'default'  => esc_html__('Visit project', 'roark')
                ),

                array(
                    'id'       => 'portfolio_animation',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Reveal Items', 'roark'),
                    'subtitle' => esc_html__('Your animations will be revealed when the user scrolls.', 'roark'),
                ),

                array(
                    'id'       => 'portfolio_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sidebar Of Single portfolio', 'roark'),
                    'options'  => array(
                        'full_width'        => esc_html__('Sidebar Full Width', 'roark'),
                        'sidebar_left'      => esc_html__('Sidebar Left', 'roark'),
                        'sidebar_right'     => esc_html__('Sidebar Right', 'roark'),
                        'no_sidebar'        => esc_html__('No Sidebar', 'roark'),
                    ),
                    'default'  => 'sidebar_right'
                ),

                array(
                    'id'       => 'portfolio_single_heading',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Hide Project Heading',  'roark'),
                    'default'   => '1'
                ),

                array(
                    'id'       => 'portfolio_single_social',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Show Share Project',  'roark'),
                    'default'   => '1'
                ),

                array(
                    'id'       => 'portfolio_related',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Hide Portfolio Related',  'roark'),
                    'default'   => '1'
                ),

                array(
                    'id'       => 'related_title',
                    'type'     => 'text',
                    'required' => array('portfolio_related','=', true ),
                    'title'    => esc_html__( 'Related Title', 'roark'),
                    'default'  => esc_html__('You may also like', 'roark')
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Twitter Settings', 'roark'),
            'id'         => 'twiter_setting',
            'icon'      => 'dashicons dashicons-twitter',
            'desc'       => wp_kses( __('<a href="http://blog.wiloke.com/how-to-get-twitter-api/" target="_blank">How to get twitter API key?</a>', 'roark'), array('a'=> array('href'=> array(), 'target'=> array())) ),
            'fields'     => array(
                array(
                    'id'       => 'consumer_key',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Comsumer Key', 'roark' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'consumer_secret',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Comsumer Secret', 'roark' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'access_token',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Access Token', 'roark' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'access_token_secret',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Access Token Secret', 'roark' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'cache_interval',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Cache Interval', 'roark' ),
                    'label'    => true,
                    'default'   => 0
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Footer Settings', 'roark'),
            'id'         => 'footer_setting',
            'icon'      => 'dashicons dashicons-editor-insertmore',
            'fields'     => array(
                array(
                    'id'       => 'footer_text',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Copyright', 'roark' ),
                    'label'    => true,
                    'default'   => esc_html__('COPYRIGHT © 2016 PORTFOLIO. ALL RIGHTS RESERVED', 'roark')
                ),

                array(
                   'id' => 'section-start',
                   'type' => 'section',
                   'title' => esc_html__('Footer Instagram', 'roark'),
                   'indent' => true 
                ),
                array(
                    'id'       => 'instagram_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Title', 'roark' ),
                    'label'    => true,
                    'default'   => esc_html__('FOLLOW US ON INSTAGRAM', 'roark')
                ),

                array(
                    'id'       => 'instagram_username',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Instagram User Name', 'roark' ),
                    'label'    => true,
                    'description'=> wp_kses( (__('<a target="_blank" href="http://blog.wiloke.com/find-instagram-user-id-access-token/">Find My Instagram Access Token and User Id</a>', 'roark')), array('a'=>array('href'=>array(), 'title'=>array(), 'target'=>array())) )
                ),

                array(
                    'id'       => 'instagram_cache_interval',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Cache Interval', 'roark' ),
                    'default'  => 86400,
                    'subtitle' => esc_html__('Leave empty to clear cache', 'roark')
                ),
                
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Typography', 'roark'),
            'id'         => 'typography',
            'icon'      => 'dashicons dashicons-media-text',
            'fields'     => array(
                array(
                    'id'            => 'roark_google_font',
                    'type'          => 'textarea',
                    'title'         => esc_html__( 'Enter your googlefonts. Note: After you have entered google font, hit Save Changes button then refresh this page.', 'roark' ),
                    'label'         => true,
                    'description'   => wp_kses( 'Enter each google font on the line. For example: <br>http://fonts.googleapis.com/css?family=Roboto+Condensed <br>https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic', array('br' => array())),
                    'default'       => ''
                ),
                array(
                    'id'       => 'roark_font_title',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Title font', 'roark'),
                    'options'  => $font_google,
                    'default'  => 'default'
                ),
                array(
                    'id'       => 'roark_font_sub_title',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sub-title font ', 'roark'),
                    'options'  => $font_google,
                    'default'  => 'default'
                ),
                array(
                    'id'       => 'roark_font_content',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Content font', 'roark'),
                    'options'  => $font_google,
                    'default'  => 'default'
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Color Settings', 'roark'),
            'id'         => 'color_setting',
            'icon'       => 'dashicons dashicons-art',
            'fields'     => array(
                array(
                    'id'       => 'color_paragraph',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Paragraph Color', 'roark' ),
                    'default'   => ''
                ),
                array(
                    'id'       => 'color_title',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Title Color', 'roark' ),
                    'default'   => ''
                ),
                array(
                    'id'       => 'color_hover',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Hover Color', 'roark' ),
                    'default'   => ''
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Advanced Settings', 'roark'),
            'id'         => 'custom',
            'icon'      => 'dashicons dashicons-media-code',
            'fields'     => array(
                array(
                    'id'       => 'googlemap_api',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Google Map API', 'roark' ),
                    'subtitle' => esc_html__( 'Enter Google Map API here. Go to this link https://developers.google.com/maps/documentation/javascript/get-api-key to create a new key.', 'roark' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'header_code',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Header Code', 'roark' ),
                    'subtitle' => esc_html__( 'The code will be inserted before close &lt;/head> tag.', 'roark' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'footer_code',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Footer Code', 'roark' ),
                    'subtitle' => esc_html__( 'The code will be inserted before close &lt;/body> tag.', 'roark' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'custom_css',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom CSS', 'roark' ),
                    'subtitle' => esc_html__( 'Paste your CSS code here.', 'roark' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'custom_js',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom javascript', 'roark' ),
                    'subtitle' => esc_html__( 'Paste your JS code here.', 'roark' ),
                    'mode'     => 'javascript',
                    'theme'    => 'chrome',
                    'default'  => esc_html__("jQuery(document).ready(function(){\n\n});", 'roark')
                ),
            )
        ));

    }   
 ?>