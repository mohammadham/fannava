<?php
namespace FannavaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fannava Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Fannava_Contact_Form extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'contactform';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Contact Form', 'fannavacore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fannava-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'fannavacore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'fannavacore' ];
	}


    public function get_fannava_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $fannava_cfa         = array();
        $fannava_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $fannava_forms       = get_posts( $fannava_cf_args );
        $fannava_cfa         = ['0' => esc_html__( 'Select Form', 'fannavacore' ) ];
        if( $fannava_forms ){
            foreach ( $fannava_forms as $fannava_form ){
                $fannava_cfa[$fannava_form->ID] = $fannava_form->post_title;
            }
        }else{
            $fannava_cfa[ esc_html__( 'No contact form found', 'fannavacore' ) ] = 0;
        }
        return $fannava_cfa;
	}
	
		/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'fannavacore'),
            'apple' => esc_html__('Apple', 'fannavacore'),
            'behance' => esc_html__('Behance', 'fannavacore'),
            'bitbucket' => esc_html__('BitBucket', 'fannavacore'),
            'codepen' => esc_html__('CodePen', 'fannavacore'),
            'delicious' => esc_html__('Delicious', 'fannavacore'),
            'deviantart' => esc_html__('DeviantArt', 'fannavacore'),
            'digg' => esc_html__('Digg', 'fannavacore'),
            'dribbble' => esc_html__('Dribbble', 'fannavacore'),
            'email' => esc_html__('Email', 'fannavacore'),
            'facebook' => esc_html__('Facebook', 'fannavacore'),
            'flickr' => esc_html__('Flicker', 'fannavacore'),
            'foursquare' => esc_html__('FourSquare', 'fannavacore'),
            'github' => esc_html__('Github', 'fannavacore'),
            'houzz' => esc_html__('Houzz', 'fannavacore'),
            'instagram' => esc_html__('Instagram', 'fannavacore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'fannavacore'),
            'linkedin' => esc_html__('LinkedIn', 'fannavacore'),
            'medium' => esc_html__('Medium', 'fannavacore'),
            'pinterest' => esc_html__('Pinterest', 'fannavacore'),
            'product-hunt' => esc_html__('Product Hunt', 'fannavacore'),
            'reddit' => esc_html__('Reddit', 'fannavacore'),
            'slideshare' => esc_html__('Slide Share', 'fannavacore'),
            'snapchat' => esc_html__('Snapchat', 'fannavacore'),
            'soundcloud' => esc_html__('SoundCloud', 'fannavacore'),
            'spotify' => esc_html__('Spotify', 'fannavacore'),
            'stack-overflow' => esc_html__('StackOverflow', 'fannavacore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'fannavacore'),
            'tumblr' => esc_html__('Tumblr', 'fannavacore'),
            'twitch' => esc_html__('Twitch', 'fannavacore'),
            'twitter' => esc_html__('Twitter', 'fannavacore'),
            'vimeo' => esc_html__('Vimeo', 'fannavacore'),
            'vk' => esc_html__('VK', 'fannavacore'),
            'website' => esc_html__('Website', 'fannavacore'),
            'whatsapp' => esc_html__('WhatsApp', 'fannavacore'),
            'wordpress' => esc_html__('WordPress', 'fannavacore'),
            'xing' => esc_html__('Xing', 'fannavacore'),
            'yelp' => esc_html__('Yelp', 'fannavacore'),
            'youtube' => esc_html__('YouTube', 'fannavacore'),
        ];
    }


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		/**
		 * Form
		 */

        $this->start_controls_section(
            'fannavacore_contact',
            [
                'label' => esc_html__('Contact Form', 'fannavacore'),
            ]
		);
		
		$this->add_control(
			'fannava_form_title',
			[
				'label' => esc_html__('Form Title', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Get A Quote', 'fannavacore'),
				'placeholder' => esc_html__('Type form title', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'fannava_form_title_color',
            [
                'label' => __( 'Form Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}}',
                ],
            ]
		);

        $this->add_control(
            'fannavacore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'fannavacore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_fannava_contact_form(),
            ]
        );

		$this->end_controls_section();


		/**
		 * Information
		 */
		$this->start_controls_section(
			'_information',
			[
				'label' => esc_html__( 'Information', 'fannavacore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'fannava_section_title_show',
			[
				'label' => esc_html__( 'Section Title & Content', 'fannavacore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'fannavacore' ),
				'label_off' => esc_html__( 'Hide', 'fannavacore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'fannava_title',
			[
				'label' => esc_html__('Title', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Fannava Title Here', 'fannavacore'),
				'placeholder' => esc_html__('Type Heading Text', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'fannava_title_color',
            [
                'label' => __( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'fannava_description',
			[
				'label' => esc_html__('Description', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Fannava section description here', 'fannavacore'),
				'placeholder' => esc_html__('Type section description here', 'fannavacore'),
			]
		);

		$this->add_control(
            'fannava_description_color',
            [
                'label' => __( 'Description Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'fannava_title_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'fannavacore'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h1' => [
						'title' => esc_html__('H1', 'fannavacore'),
						'icon' => 'eicon-editor-h1'
					],
					'h2' => [
						'title' => esc_html__('H2', 'fannavacore'),
						'icon' => 'eicon-editor-h2'
					],
					'h3' => [
						'title' => esc_html__('H3', 'fannavacore'),
						'icon' => 'eicon-editor-h3'
					],
					'h4' => [
						'title' => esc_html__('H4', 'fannavacore'),
						'icon' => 'eicon-editor-h4'
					],
					'h5' => [
						'title' => esc_html__('H5', 'fannavacore'),
						'icon' => 'eicon-editor-h5'
					],
					'h6' => [
						'title' => esc_html__('H6', 'fannavacore'),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h2',
				'toggle' => false,
			]
		);

		$this->add_responsive_control(
			'fannava_align',
			[
				'label' => esc_html__('Alignment', 'fannavacore'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'fannavacore'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'fannavacore'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'fannavacore'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		// location
		$this->add_control(
			'fannava_single_icon_type_location',
			[
				'label' => esc_html__('Select Icon Type for Location', 'fannavacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__('Image', 'fannavacore'),
					'icon' => esc_html__('Icon', 'fannavacore'),
				],
			]
		);

		$this->add_control(
			'fannava_icon_image_location',
			[
				'label' => esc_html__('Upload Icon Image for Location', 'fannavacore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'fannava_single_icon_type_location' => 'image'
				]

			]
		);

		if (fannava_is_elementor_version('<', '2.6.0')) {
			$this->add_control(
				'icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'fannava_single_icon_type_location' => 'icon'
					]
				]
			);
		} else {
			$this->add_control(
				'selected_icon3',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'label_block' => true,
					'default' => [
						'value' => 'far fa-star',
						'library' => 'regular',
					],
					'condition' => [
						'fannava_single_icon_type_location' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'fannava_left_info_location_heading',
			[
				'label' => esc_html__('Location Heading', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Location', 'fannavacore'),
				'placeholder' => esc_html__('Type location heading', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'fannava_left_info_location_heading_color',
			[
				'label' => __( 'Location Heading Color', 'fannavacore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-us .contact-left .content h4' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'fannava_left_info_location',
			[
				'label' => esc_html__('Location', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('99 chicago,America', 'fannavacore'),
				'placeholder' => esc_html__('Type your location', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'fannava_left_info_location_color',
			[
				'label' => __( 'Location Color', 'fannavacore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-us .contact-left .content p' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'fannava_left_info_location_map',
			[
				'label' => esc_html__('Location Map', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('https://goo.gl/maps/qzqY2PAcQwUz1BYN9', 'fannavacore'),
				'placeholder' => esc_html__('Type your location map address', 'fannavacore'),
				'label_block' => true,
			]
		);
		
        // phone
		$this->add_control(
            'fannava_single_icon_type_phone',
            [
                'label' => esc_html__('Select Icon Type for Phone', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
            ]
        );

        $this->add_control(
            'fannava_icon_image_phone',
            [
                'label' => esc_html__('Upload Icon Image for Phone', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_single_icon_type_phone' => 'image'
                ]

            ]
        );

        if (fannava_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'fannava_single_icon_type_phone' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'far fa-star',
                        'library' => 'regular',
                    ],
                    'condition' => [
                        'fannava_single_icon_type_phone' => 'icon'
                    ]
                ]
            );
        }
		$this->add_control(
			'fannava_left_info_phone_heading',
			[
				'label' => esc_html__('Phone Number Heading', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Phone Number', 'fannavacore'),
				'placeholder' => esc_html__('Type phone number heading', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'fannava_left_info_phone_heading_color',
            [
                'label' => __( 'Phone Number Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-us .contact-left .content h4' => 'color: {{VALUE}}',
                ],
            ]
		);
		
		$this->add_control(
			'fannava_left_info_phone_number',
			[
				'label' => esc_html__('Phone Number', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('111-123123', 'fannavacore'),
				'placeholder' => esc_html__('Type your phone number', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'fannava_left_info_phone_number_color',
            [
                'label' => __( 'Phone Number Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-us .contact-left .content p' => 'color: {{VALUE}}',
                ],
            ]
        );
		
		// email
		$this->add_control(
            'fannava_single_icon_type_email',
            [
                'label' => esc_html__('Select Icon Type for Email', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
            ]
        );

        $this->add_control(
            'fannava_icon_image_email',
            [
                'label' => esc_html__('Upload Icon Image for Email', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_single_icon_type_email' => 'image'
                ]

            ]
        );

        if (fannava_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'fannava_single_icon_type_email' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'selected_icon2',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'far fa-star',
                        'library' => 'regular',
                    ],
                    'condition' => [
                        'fannava_single_icon_type_email' => 'icon'
                    ]
                ]
            );
        }
        
		$this->add_control(
			'fannava_left_info_email_heading',
			[
				'label' => esc_html__('Email Heading', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'fannavacore'),
				'placeholder' => esc_html__('Type email heading', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'fannava_left_info_email_heading_color',
            [
                'label' => __( 'Email Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-us .contact-left .content h4' => 'color: {{VALUE}}',
                ],
            ]
		);
		
		$this->add_control(
			'fannava_left_info_email',
			[
				'label' => esc_html__('Email', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('your@email.com', 'fannavacore'),
				'placeholder' => esc_html__('Type your email', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'fannava_left_info_email_color',
            [
                'label' => __( 'Email Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-us .contact-left .content p' => 'color: {{VALUE}}',
                ],
            ]
		);
		
		$this->end_controls_section();

		/**
         * Social profile section
         */
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'fannavacore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'fannavacore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'fannavacore'),
                'placeholder' => esc_html__('Add your profile link', 'fannavacore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ],
                    [
                        'link' => ['url' => 'https://instagram.com/'],
                        'name' => 'instagram'
                    ],
                    [
                        'link' => ['url' => 'https://youtube.com/'],
                        'name' => 'youtube'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'fannavacore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'fannavacore'),
                'label_off' => esc_html__('Hide', 'fannavacore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
		

		/**
		 * Map
		 */
		$this->start_controls_section(
			'_fannava_map',
			[
				'label' => esc_html__( 'Google Map', 'fannavacore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fannava_google_map_src',
			[
				'label' => esc_html__('Google Map', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423284.04409246973!2d-118.74137159485794!3d34.020608470699536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1692992084415!5m2!1sen!2sbd" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade', 'fannavacore'),
				'placeholder' => esc_html__('Type your google map iframe src', 'fannavacore'),
				'label_block' => true,
			]
		);
		
		$this->end_controls_section();


		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'fannavacore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'fannavacore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'fannavacore' ),
					'uppercase' => __( 'UPPERCASE', 'fannavacore' ),
					'lowercase' => __( 'lowercase', 'fannavacore' ),
					'capitalize' => __( 'Capitalize', 'fannavacore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget oufannavaut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('title_args', 'class', 'title');

		if ( !empty($settings['fannava_google_map_src']) ) {
            $fannava_google_map_src = !empty($settings['fannava_google_map_src']) ? $settings['fannava_google_map_src'] : 'Iframe src is invalid';
		}
		?>
		
		<!-- Contact Form Section Start -->
		<div class="contact-form-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 order-2 order-lg-1">
						<!-- Comment Form Start -->
						<div class="te-comment-respond mt-0">
							<?php
								if ( !empty($settings['fannava_form_title' ]) ) :
									printf( '<%1$s %2$s>%3$s</%1$s>',
										tag_escape( $settings['fannava_title_tag'] ),
										$this->get_render_attribute_string( 'title_args' ),
										fannava_kses( $settings['fannava_form_title' ] )
										);
								endif;
							?>
							<?php if( !empty($settings['fannavacore_select_contact_form']) ) : ?> 
								<div class="te-comment-form"> 
									<?php echo do_shortcode( '[contact-form-7  id="'.$settings['fannavacore_select_contact_form'].'"]' ); ?> 
								</div> 
							<?php else : ?>
									<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'fannavacore' ). '</p></div>'; ?>
							<?php endif; ?>

						</div>
						<!-- Comment Form End -->
					</div>
					<div class="col-lg-4 order-1 order-lg-2">
						<!-- Contact Info Section Start !-->
						<div class="te-contact-info-wrapper">
							<div class="te-title-wrapper">
								<?php
								if ( !empty($settings['fannava_title' ]) ) :
									printf( '<%1$s %2$s>%3$s</%1$s>',
										tag_escape( $settings['fannava_title_tag'] ),
										$this->get_render_attribute_string( 'title_args' ),
										fannava_kses( $settings['fannava_title' ] )
										);
								endif;
							?>
								<?php if ( !empty($settings['fannava_description']) ) : ?>
									<p><?php echo fannava_kses( $settings['fannava_description'] ); ?></p>
								<?php endif; ?>
							</div>
							<div class="te-contact-info">
								<div class="te-icon-card style-2">
									<div class="icon">
										<?php if($settings['fannava_single_icon_type_location'] !== 'image') : ?>
											<?php if (!empty($settings['icon']) || !empty($settings['selected_icon3']['value'])) : ?>
												<?php fannava_render_icon($settings, 'icon', 'selected_icon3'); ?>
											<?php endif; ?>   
										<?php else : ?>                                
											<?php if (!empty($settings['fannava_icon_image']['url'])): ?>  
												<img src="<?php echo $settings['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
											<?php endif; ?> 
										<?php endif; ?> 
									</div>
									<div class="content">
										<?php if ( !empty($settings['fannava_left_info_location_heading']) ) : ?>    
											<h3 class="title"><?php echo fannava_kses( $settings['fannava_left_info_location_heading'] ); ?></h3>
										<?php endif; ?>
										<?php if ( !empty($settings['fannava_left_info_location']) ) : ?>
											<span class="desc"><a href="<?php echo fannava_kses( $settings['fannava_left_info_location_map'] ); ?>"><?php echo fannava_kses( $settings['fannava_left_info_location'] ); ?></a></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="te-icon-card style-2">
									<div class="icon">
										<?php if($settings['fannava_single_icon_type_phone'] !== 'image') : ?>
											<?php if (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
												<?php fannava_render_icon($settings, 'icon', 'selected_icon'); ?>
											<?php endif; ?>   
										<?php else : ?>                                
											<?php if (!empty($settings['fannava_icon_image']['url'])): ?>  
												<img src="<?php echo $settings['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
											<?php endif; ?> 
										<?php endif; ?> 
									</div>
									<div class="content">
										<?php if ( !empty($settings['fannava_left_info_phone_heading']) ) : ?>    
											<h3 class="title"><?php echo fannava_kses( $settings['fannava_left_info_phone_heading'] ); ?></h3>
										<?php endif; ?>
										<?php if ( !empty($settings['fannava_left_info_phone_number']) ) : ?>
											<a href="tel:<?php echo esc_attr(str_replace(' ', '-', $settings['fannava_left_info_phone_number'])); ?>" class="desc"><?php echo fannava_kses( $settings['fannava_left_info_phone_number'] ); ?></a>
										<?php endif; ?>
									</div>
								</div>

								<div class="te-icon-card style-2">
									<div class="icon">
										<?php if($settings['fannava_single_icon_type_email'] !== 'image') : ?>
											<?php if (!empty($settings['icon']) || !empty($settings['selected_icon2']['value'])) : ?>
												<?php fannava_render_icon($settings, 'icon', 'selected_icon2'); ?>
											<?php endif; ?>   
										<?php else : ?>                                
											<?php if (!empty($settings['fannava_icon_image']['url'])): ?>  
												<img src="<?php echo $settings['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
											<?php endif; ?> 
										<?php endif; ?>
									</div>
									<div class="content">
										<?php if ( !empty($settings['fannava_left_info_email_heading']) ) : ?>    
											<h3 class="title"><?php echo fannava_kses( $settings['fannava_left_info_email_heading'] ); ?></h3>
										<?php endif; ?>
										<?php if ( !empty($settings['fannava_left_info_email']) ) : ?>
											<a href="mailto:<?php echo fannava_kses( $settings['fannava_left_info_email'] ); ?>" class="desc"><?php echo fannava_kses( $settings['fannava_left_info_email'] ); ?></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
								<div class="te-social-profile-link">
									<?php
									foreach ($settings['profiles'] as $profile) :
										$icon = esc_attr($profile['name']);
										$url = esc_url($profile['link']['url']);
										?>
										<a href="<?php echo $url;?>"><i class="fa-brands fa-<?php echo $icon;?>"></i></a>
									<?php
									endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
						<!-- Contact Info Section End -->
					</div>
				</div>
			</div>
		</div>
		<!-- Contact Form Section End -->

		<!-- Map start -->
		<div class="contact-map-area">
			<div class="te-map-widget">
				<iframe src="<?php echo esc_url($fannava_google_map_src);?>"></iframe>
			</div>
		</div>
		<!-- Map end -->

        <?php 
	}
}

$widgets_manager->register( new Fannava_Contact_Form() );