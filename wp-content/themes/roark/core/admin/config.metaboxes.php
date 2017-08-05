<?php

add_filter( 'cmb_meta_boxes', 'config_metabox' );

function config_metabox() {

    $args['portfolio_info'] = array(

        'id'         => 'portfolio_info',
        'title'      => esc_html__( 'Portfolio Info', 'roark' ),
        'pages'      => array( 'portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(

            array(
                'name'     => esc_html__( 'Released at:', 'roark' ),
                'id'       => 'date',
                'type'     => 'text_date_timestamp',
            ),
            array(
                'name'     => esc_html__( 'Project Url', 'roark' ),
                'id'       => 'url',
                'type'     => 'text_url',
            ),

            array(
                'name'     => esc_html__( 'Description', 'roark' ),
                'id'       => 'description',
                'type'     => 'textarea',
                'description'   => esc_html__('Allows use the simple html tags.', 'roark')
            ),

            array(
                'name'     => esc_html__( 'Client', 'roark' ),
                'id'       => 'client',
                'type'     => 'textarea',
                'description'   => esc_html__('Allows use the simple html tags.', 'roark')
            ),

            array(
                'name'     => esc_html__( 'Tasks', 'roark' ),
                'id'       => 'tasks',
                'type'     => 'textarea',
            ),
        )
    );

    $args['portfolio_single'] = array(

        'id'         => 'portfolio_single',
        'title'      => esc_html__( 'Header Image Setting', 'roark' ),
        'pages'      => array( 'portfolio'), // Post type
        'context'    => 'side',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name'          => esc_html__( 'Header Image', 'roark' ),
                'id'            => 'header_img',
                'type'          => 'file',
                'allow' => array( 'attachment' ),
                'description'   => esc_html__('Upload background for heading of this project. Please note that you don\'t need upload this image if Hide Project Heading is checked(Appearance->Roark Options->Portfolio Settings->Hide Project Heading)', 'roark')
            ),
        )
    );

    return $args;
}
