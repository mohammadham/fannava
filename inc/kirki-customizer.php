<?php
/**
 * fannava customizer
 *
 * @package fannava
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function fannava_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'fannava_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Fannava Customizer', 'fannava' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_setting', [
        'title'       => esc_html__( 'Header Setting', 'fannava' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'fannava_customizer',
    ] );
    
    $wp_customize->add_section( 'social_setting', [
        'title'       => esc_html__( 'Social Setting', 'fannava' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'fannava_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'fannava' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'fannava_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'fannava' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'fannava_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'fannava' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'fannava_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'fannava' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'fannava_customizer',
    ] );
}

add_action( 'customize_register', 'fannava_customizer_panels_sections' );


/*
Header Settings
 */
function _fannava_header_settings_fields( $fields ) {

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'fannava' ),
        'section'     => 'header_setting',
        'placeholder' => esc_html__( 'Select an option...', 'fannava' ),
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
        'label'       => esc_html__( 'Favicon', 'fannava' ),
        'description' => esc_html__( 'Upload Your Favicon', 'fannava' ),
        'section'     => 'header_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/favicon.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'fannava' ),
        'description' => esc_html__( 'Upload Your Logo.', 'fannava' ),
        'section'     => 'header_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_topbar_switch',
        'label'    => esc_html__( 'Topbar Swicher', 'fannava' ),
        'section'  => 'header_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
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
        'settings' => 'fannava_phone_num',
        'label'    => esc_html__( 'Phone Number', 'fannava' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( '234-567899', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // email
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_mail_id',
        'label'    => esc_html__( 'Mail ID', 'fannava' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( 'info@fannava.ir', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]; 

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_right_contact_switch',
        'label'    => esc_html__( 'Header Right Switcher', 'fannava' ),
        'section'  => 'header_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];
    
    // button
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_button_text',
        'label'    => esc_html__( 'Button Text', 'fannava' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( 'Get A Quote', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_right_contact_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'fannava_button_link',
        'label'    => esc_html__( 'Button URL', 'fannava' ),
        'section'  => 'header_setting',
        'default'  => esc_html__( '#', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_right_contact_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_fannava_header_settings_fields' );


/*
Social Setting
 */
function _fannava_social_setting_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_topbar_social_switch',
        'label'    => esc_html__( 'Topbar Social Swicher', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_side_info_social_switch',
        'label'    => esc_html__( 'Side Info Social Swicher', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => '$fannava_footer_social_switch',
        'label'    => esc_html__( 'Footer Social Swicher', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];
    
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_footer_social_connect_text',
        'label'    => esc_html__( 'Social Connect Text', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'Follow Us:', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_footer_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://facebook.com', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://twitter.com', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://linkedin.com', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://youtube.com', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://www.instagram.com/', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_pinterest_url',
        'label'    => esc_html__( 'pinterest Url', 'fannava' ),
        'section'  => 'social_setting',
        'default'  => esc_html__( 'https://www.pinterest.com/', 'fannava' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'fannava_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_fannava_social_setting_fields' );



/*
Breadcrumb
 */
function _fannava_breadcrumb_fields( $fields ) {
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'fannava' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'fannava' ),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/section-bg/page-header.png',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'fannava_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'fannava' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'fannava' ),
        'section'     => 'breadcrumb_setting',
        'default'     => 'linear-gradient(180deg, #A0D7FE 0%, #F6FBFF 100%);',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__( 'Breadcrumb Info switch', 'fannava' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_switch',
        'label'    => esc_html__( 'Breadcrumb Hide', 'fannava' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_fannava_breadcrumb_fields' );

/*
Blog
 */
function _fannava_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'fannava_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'fannava' ),
            'off' => esc_html__( 'Disable', 'fannava' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'fannava' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'fannava' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'fannava' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'fannava' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_fannava_blog_fields' );

/*
Footer
 */
function _fannava_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'fannava' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'fannava' ),
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
        'settings'    => 'fannava_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'fannava' ),
        'description' => esc_html__( 'Footer Background Image.', 'fannava' ),
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
        'label'       => esc_html__( 'Footer Logo', 'fannava' ),
        'description' => esc_html__( 'Upload Your Logo.', 'fannava' ),
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
        'settings' => 'fannava_copyright',
        'label'    => esc_html__( 'Copyright', 'fannava' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2025 Fannava. All Rights Reserved', 'fannava' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_fannava_footer_fields' );

// 404
function fannava_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'fannava_404_bg',
        'label'       => esc_html__( '404 Image.', 'fannava' ),
        'description' => esc_html__( '404 Image.', 'fannava' ),
        'section'     => '404_page',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_error_title',
        'label'    => esc_html__( 'Not Found Title', 'fannava' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'fannava' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'fannava_error_desc',
        'label'    => esc_html__( '404 Description Text', 'fannava' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'fannava' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'fannava_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'fannava' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'fannava' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'fannava_404_fields' );






/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function fannava_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'fannava' ) ) {
        $value = Kirki::get_option( fannava_get_theme(), $name );
    }

    return apply_filters( 'fannava_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function fannava_get_theme() {
    return 'fannava';
}