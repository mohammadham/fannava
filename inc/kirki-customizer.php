<?php
/**
 * ekobyte customizer
 *
 * @package ekobyte
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function ekobyte_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'ekobyte_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Ekobyte Customizer', 'ekobyte' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_setting', [
        'title'       => esc_html__( 'Header Setting', 'ekobyte' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'ekobyte_customizer',
    ] );
    
    $wp_customize->add_section( 'social_setting', [
        'title'       => esc_html__( 'Social Setting', 'ekobyte' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'ekobyte_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'ekobyte' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'ekobyte_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'ekobyte' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'ekobyte_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'ekobyte' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'ekobyte_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'ekobyte' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'ekobyte_customizer',
    ] );
}

add_action( 'customize_register', 'ekobyte_customizer_panels_sections' );


/*
Header Settings
 */
function _ekobyte_header_settings_fields( $fields ) {

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'ekobyte' ),
        'section'     => 'header_setting',
        'placeholder' => esc_html__( 'Select an option...', 'ekobyte' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.jpg',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.jpg',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'favicon_url',
        'label'       => esc_html__( 'Favicon', 'ekobyte' ),
        'description' => esc_html__( 'Upload Your Favicon', 'ekobyte' ),
        'section'     => 'header_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/favicon.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'ekobyte' ),
        'description' => esc_html__( 'Upload Your Logo.', 'ekobyte' ),
        'section'     => 'header_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_topbar_switch',
        'label'    => esc_html__( 'Topbar Swicher', 'ekobyte' ),
        'section'  => 'header_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
        ],
    ];

    // phone
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_phone_num',
        'label'    => esc_html__( 'Phone Number', 'ekobyte' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( '234-567899', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // email
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_mail_id',
        'label'    => esc_html__( 'Mail ID', 'ekobyte' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( 'info@ekobyte.com', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]; 

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_right_contact_switch',
        'label'    => esc_html__( 'Header Right Switcher', 'ekobyte' ),
        'section'  => 'header_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];
    
    // button
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_button_text',
        'label'    => esc_html__( 'Button Text', 'ekobyte' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( 'Get A Quote', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_right_contact_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'ekobyte_button_link',
        'label'    => esc_html__( 'Button URL', 'ekobyte' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( '#', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_right_contact_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_ekobyte_header_settings_fields' );


/*
Social Setting
 */
function _ekobyte_social_setting_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_topbar_social_switch',
        'label'    => esc_html__( 'Topbar Social Swicher', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_side_info_social_switch',
        'label'    => esc_html__( 'Side Info Social Swicher', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => '$ekobyte_footer_social_switch',
        'label'    => esc_html__( 'Footer Social Swicher', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];
    
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_footer_social_connect_text',
        'label'    => esc_html__( 'Social Connect Text', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'Follow Us:', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_footer_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://facebook.com', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://twitter.com', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://linkedin.com', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://youtube.com', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://www.instagram.com/', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_pinterest_url',
        'label'    => esc_html__( 'pinterest Url', 'ekobyte' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://www.pinterest.com/', 'ekobyte' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'ekobyte_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_ekobyte_social_setting_fields' );



/*
Breadcrumb
 */
function _ekobyte_breadcrumb_fields( $fields ) {
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'ekobyte' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'ekobyte' ),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/section-bg/page-header.png',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'ekobyte_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'ekobyte' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'ekobyte' ),
        'section'     => 'breadcrumb_setting',
        'default'     => 'linear-gradient(180deg, #A0D7FE 0%, #F6FBFF 100%);',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__( 'Breadcrumb Info switch', 'ekobyte' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_switch',
        'label'    => esc_html__( 'Breadcrumb Hide', 'ekobyte' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_ekobyte_breadcrumb_fields' );

/*
Blog
 */
function _ekobyte_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'ekobyte_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'ekobyte' ),
            'off' => esc_html__( 'Disable', 'ekobyte' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'ekobyte' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'ekobyte' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'ekobyte' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'ekobyte' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_ekobyte_blog_fields' );

/*
Footer
 */
function _ekobyte_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'ekobyte' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'ekobyte' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.jpg',
            'footer-style-2' => get_template_directory_uri() . '/inc/img/footer/footer-2.jpg',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'ekobyte_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'ekobyte' ),
        'description' => esc_html__( 'Footer Background Image.', 'ekobyte' ),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/shape/footer-one-shape.png',
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '!=',
                'value'    => 'footer-style-2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'footer_logo',
        'label'       => esc_html__( 'Footer Logo', 'ekobyte' ),
        'description' => esc_html__( 'Upload Your Logo.', 'ekobyte' ),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/footer-logo-white.png',
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
        ],
    ];

   
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_copyright',
        'label'    => esc_html__( 'Copyright', 'ekobyte' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2024 Ekobyte. All Rights Reserved', 'ekobyte' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_ekobyte_footer_fields' );

// 404
function ekobyte_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'ekobyte_404_bg',
        'label'       => esc_html__( '404 Image.', 'ekobyte' ),
        'description' => esc_html__( '404 Image.', 'ekobyte' ),
        'section'     => '404_page',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_error_title',
        'label'    => esc_html__( 'Not Found Title', 'ekobyte' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'ekobyte' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'ekobyte_error_desc',
        'label'    => esc_html__( '404 Description Text', 'ekobyte' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'ekobyte' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'ekobyte_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'ekobyte' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'ekobyte' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'ekobyte_404_fields' );






/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function ekobyte_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'ekobyte' ) ) {
        $value = Kirki::get_option( ekobyte_get_theme(), $name );
    }

    return apply_filters( 'ekobyte_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function ekobyte_get_theme() {
    return 'ekobyte';
}