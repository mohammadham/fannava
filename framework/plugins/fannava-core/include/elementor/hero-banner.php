<?php
namespace FannavaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fannava Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Fannava_Hero_Banner extends Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'fannavacore' );
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
         * Layout section
         */
        $this->start_controls_section(
            'fannava_layout',
            [
                'label' => esc_html__('Design Layout', 'fannavacore'),
            ]
        );
        $this->add_control(
            'fannava_design_style',
            [
                'label' => esc_html__('Select Layout', 'fannavacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'fannavacore'),
                    'layout-2' => esc_html__('Layout 2', 'fannavacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        /**
         * Title and content section
         */
        $this->start_controls_section(
            'fannava_section_title',
            [
                'label' => esc_html__('Title & Content', 'fannavacore'),
            ]
        );


        $this->add_control(
            'fannava_sub_title',
            [
                'label' => esc_html__('Sub Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Fannava Sub Title', 'fannavacore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .te-slider-content .te-slider-short-title' => 'color: {{VALUE}}',
                ],
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
                    '{{WRAPPER}} .te-slider-content .te-slider-title' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .te-slider-content .te-slider-short-desc' => 'color: {{VALUE}}',
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
                    'text-left' => [
                        'title' => esc_html__('Left', 'fannavacore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'fannavacore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'fannavacore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );


        // fannava need help
        $this->add_control(
            'fannava_single_icon_type',
            [
                'label' => esc_html__('Need Help Icon Type', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'fannava_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_single_icon_type' => 'image',
                    'fannava_design_style' => 'layout-1',
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
                        'fannava_single_icon_type' => 'icon',
                        'fannava_design_style' => 'layout-1',
                    ]
                ]
            );
        } else {
            $this->add_control(
                'need_help_selected_icon',
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
                        'fannava_single_icon_type' => 'icon',
                        'fannava_design_style' => 'layout-1',
                    ]
                ]
            );
        }

        
        $this->add_control(
            'fannava_need_help_heading',
            [
                'label' => esc_html__('Need help heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Need Help?', 'fannavacore'),
                'placeholder' => esc_html__('Type text before phone number', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'fannava_need_help_heading_color',
            [
                'label' => __( 'Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .talk-to-us .left-numbber .text-content h4' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'fannava_left_section_phone_number',
            [
                'label' => esc_html__('Phone Number', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('111-123123', 'fannavacore'),
                'placeholder' => esc_html__('Type your phone number', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'fannava_need_help_phone_number_color',
            [
                'label' => __( 'Phone Number Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .talk-to-us .left-numbber .text-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-1'
                ],
            ]
        );

        // how it works
        $this->add_control(
            'fannava_how_works_single_icon_type',
            [
                'label' => esc_html__('How It Works Icon Type', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'fannava_how_works_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_how_works_single_icon_type' => 'image',
                    'fannava_design_style' => 'layout-2'
                ],
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
                        'fannava_how_works_single_icon_type' => 'icon',
                        'fannava_design_style' => 'layout-2'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'how_works_selected_icon',
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
                        'fannava_how_works_single_icon_type' => 'icon',
                        'fannava_design_style' => 'layout-2'
                    ]
                ]
            );
        }

        $this->add_control(
            'fannava_how_works_heading',
            [
                'label' => esc_html__('How Works Heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('How it works', 'fannavacore'),
                'placeholder' => esc_html__('Type text how it works', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'fannava_how_works_heading_color',
            [
                'label' => __( 'Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .talk-to-us .left-numbber .text-content h4' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'fannava_how_works_url_link',
            [
                'label' => esc_html__('Link', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=7e90gBu4pas', 'fannavacore'),
                'placeholder' => esc_html__('Type your link', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Button section
         */
        $this->start_controls_section(
            'fannava_btn_button_group',
            [
                'label' => esc_html__('Button', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'fannavacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'fannavacore' ),
                'label_off' => esc_html__( 'Hide', 'fannavacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        // button 1
        $this->add_control(
            'fannava_btn_text',
            [
                'label' => esc_html__('Button Text', 'fannavacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'fannavacore'),
                'title' => esc_html__('Enter button text', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_btn_button_show' => 'yes'
                ],
            ]
        );
        
        $this->add_control(
            'fannava_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'fannavacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'fannava_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'fannava_btn_link',
            [
                'label' => esc_html__('Button link', 'fannavacore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'fannavacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'fannava_btn_link_type' => '1',
                    'fannava_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'fannava_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'fannavacore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => fannava_get_all_pages(),
                'condition' => [
                    'fannava_btn_link_type' => '2',
                    'fannava_btn_button_show' => 'yes'
                ]
            ]
        );
        // single icon or image for button one
		$this->add_control(
            'fannava_single_icon_type_button_one',
            [
                'label' => esc_html__('Select Icon Type for Button 1', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_icon_image_button_one',
            [
                'label' => esc_html__('Upload Icon Image for Phone', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_single_icon_type_button_one' => 'image',
                    'fannava_design_style' => 'layout-2'
                ],
                'label_block' => true,
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
                        'fannava_single_icon_type_button_one' => 'icon',
                        'fannava_design_style' => 'layout-2'
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
                        'fannava_single_icon_type_button_one' => 'icon',
                        'fannava_design_style' => 'layout-2'
                    ]
                ]
            );
        }

        $this->end_controls_section();
        /**
         * Award section
         */
        $this->start_controls_section(
            'fannava_hero_award_group',
            [
                'label' => esc_html__('Award', 'fannavacore'),
                'condition' => [
                    'fannava_design_style' => 'layout-1'
                ],
            ]
        );
        $this->add_control(
            'fannava_hero_award_group_show',
            [
                'label' => esc_html__( 'Award', 'fannavacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'fannavacore' ),
                'label_off' => esc_html__( 'Hide', 'fannavacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'fannava_award_title',
            [
                'label' => esc_html__('Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Award  Winning  Digital  Agency', 'fannavacore'),
                'placeholder' => esc_html__('Type Heading Text', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_award_title_color',
            [
                'label' => __( 'Award Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .circle-rotate-text span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'fannava_award_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
            ]
        );

        $this->add_control(
            'fannava_award_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_award_icon_type' => 'image'
                ]
            ]
        );

        if (fannava_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'award_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'fannava_award_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'selected_award_icon',
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
                        'fannava_award_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $this->end_controls_section();
        /**
         * Image section
         */
        $this->start_controls_section(
            'fannava_hero_image_group',
            [
                'label' => esc_html__('Image', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_hero_image',
            [
                'label' => esc_html__( 'Hero Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'fannava_feature_one_image',
            [
                'label' => esc_html__( 'Feature One Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'fannava_feature_two_image',
            [
                'label' => esc_html__( 'Feature Two Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'fannava_feature_three_image',
            [
                'label' => esc_html__( 'Feature Three Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'fannava_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();


		// TAB_STYLE
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
        ?>

        <?php if ( $settings['fannava_design_style']  == 'layout-2' ): 
        
            // Title
            $this->add_render_attribute('title_args', 'class', 'te-slider-title');
            // Button
            $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn'); 

            // button 1
            if ('2' == $settings['fannava_btn_link_type']) {
                $this->add_render_attribute('fannava-button-arg', 'href', get_permalink($settings['fannava_btn_page_link']));
                $this->add_render_attribute('fannava-button-arg', 'target', '_self');
                $this->add_render_attribute('fannava-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn');
            } else {
                if ( ! empty( $settings['fannava_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'fannava-button-arg', $settings['fannava_btn_link'] );
                    $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn');
                }
            }
            
            if ( !empty($settings['fannava_hero_image']['url']) ) {
                $fannava_hero_image = !empty($settings['fannava_hero_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_hero_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_hero_image']['url'];
            }

            if ( !empty($settings['fannava_feature_one_image']['url']) ) {
                $fannava_feature_one_image = !empty($settings['fannava_feature_one_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_feature_one_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_feature_one_image']['url'];
                $fannava_feature_one_image_alt = get_post_meta($settings["fannava_feature_one_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['fannava_feature_two_image']['url']) ) {
                $fannava_feature_two_image = !empty($settings['fannava_feature_two_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_feature_two_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_feature_two_image']['url'];
                $fannava_feature_two_image_alt = get_post_meta($settings["fannava_feature_two_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['fannava_feature_three_image']['url']) ) {
                $fannava_feature_three_image = !empty($settings['fannava_feature_three_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_feature_three_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_feature_three_image']['url'];
                $fannava_feature_three_image_alt = get_post_meta($settings["fannava_feature_three_image"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

        <!-- Slider Section Start !-->
        <div class="slider-area style-1">
            <div class="te-slider-wrapper">
                <!-- single slider start -->
                <div class="te-single-slider-wrapper">
                    <div class="te-single-slider" style="background-image: url(<?php echo esc_url($fannava_hero_image);?>)">
                        <div class="container h-100">
                            <div class="te-slider-container">
                                <div class="te-slider-column">
                                    <div class="te-slider-content-wrapper">
                                        <div class="te-slider-content">
                                            <?php if ( !empty($settings['fannava_sub_title']) ) : ?>
                                                <span class="te-slider-short-title"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
                                            <?php endif; ?>
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
                                                <p class="te-slider-short-desc"><?php echo fannava_kses( $settings['fannava_description'] ); ?></p>
                                            <?php endif; ?>
                                            <div class="te-slider-btn-wrapper">
                                                <?php if (!empty($settings['fannava_btn_text'])) : ?>
                                                    <a <?php echo $this->get_render_attribute_string( 'fannava-button-arg' ); ?>>
                                                        <?php echo $settings['fannava_btn_text']; ?>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?php echo esc_attr($settings['fannava_how_works_url_link']); ?>" class="te-call-btn video-play mfp-iframe">
                                                    <div class="te-icon">
                                                        <?php if($settings['fannava_how_works_single_icon_type'] !== 'image') : ?>
                                                            <?php if (!empty($settings['icon']) || !empty($settings['how_works_selected_icon']['value'])) : ?>
                                                                <?php fannava_render_icon($settings, 'icon', 'how_works_selected_icon'); ?>
                                                            <?php endif; ?>   
                                                        <?php else : ?>                                
                                                            <?php if (!empty($settings['fannava_how_works_icon_image']['url'])): ?>  
                                                                <img src="<?php echo $settings['fannava_how_works_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_how_works_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                            <?php endif; ?> 
                                                        <?php endif; ?> 
                                                    </div>
                                                    <div class="te-content">
                                                        <?php if ( !empty($settings['fannava_how_works_heading']) ) : ?>    
                                                            <span class="te-text"><?php echo fannava_kses( $settings['fannava_how_works_heading'] ); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="te-slider-column">
                                    <div class="slider-shape-bg">
                                        <div class="slider-shape shape-one">
                                            <img src="<?php echo esc_url($fannava_feature_one_image); ?>" alt="<?php echo esc_attr($fannava_feature_one_image_alt); ?>">
                                        </div>
                                        <div class="slider-shape shape-two">
                                            <img src="<?php echo esc_url($fannava_feature_two_image); ?>" alt="<?php echo esc_attr($fannava_feature_two_image_alt); ?>">
                                        </div>
                                        <div class="slider-shape shape-three">
                                            <img src="<?php echo esc_url($fannava_feature_three_image); ?>" alt="<?php echo esc_attr($fannava_feature_three_image_alt); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider end -->
            </div>
        </div>
        <!-- Slider Section End !-->

		<?php else: 
            if ( !empty($settings['fannava_hero_image']['url']) ) {
                $fannava_hero_image = !empty($settings['fannava_hero_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_hero_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_hero_image']['url'];
            }

            // Title
            $this->add_render_attribute('title_args', 'class', 'te-slider-title');

            // Button
            $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn'); 
            
            // Link
            if ('2' == $settings['fannava_btn_link_type']) {
                $this->add_render_attribute('fannava-button-arg', 'href', get_permalink($settings['fannava_btn_page_link']));
                $this->add_render_attribute('fannava-button-arg', 'target', '_self');
                $this->add_render_attribute('fannava-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn');
            } else {
                if ( ! empty( $settings['fannava_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'fannava-button-arg', $settings['fannava_btn_link'] );
                    $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn');
                }
            }
        ?>	
        <!-- Slider Section Start !-->
        <div class="slider-area style-2">
            <div class="te-slider-wrapper">
                <!-- single slider start -->
                <div class="te-single-slider-wrapper">
                    <div class="te-single-slider">
                        <div class="slider-left-shape">
                            <svg width="168" height="587" viewBox="0 0 168 587" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.5">
                                    <path d="M69.0979 152.302C71.3005 155.136 73.4462 158.048 75.5349 161.041C125.519 232.889 139.417 347.998 125.604 435.042C116.68 491.246 87.3605 542.545 48.1656 586" stroke="#317EFE" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M75.8862 144.815C74.6037 143.248 72.9701 142.181 71.192 141.749C69.4138 141.317 67.5709 141.54 65.8962 142.389C64.2215 143.238 62.7902 144.676 61.7832 146.52C60.7762 148.364 60.2387 150.531 60.2387 152.749C60.2387 154.966 60.7762 157.134 61.7832 158.978C62.7902 160.822 64.2215 162.259 65.8962 163.108C67.5709 163.957 69.4138 164.18 71.192 163.748C72.9701 163.316 74.6037 162.249 75.8862 160.682C76.7384 159.641 77.4144 158.404 77.8757 157.043C78.337 155.681 78.5744 154.222 78.5744 152.749C78.5744 151.275 78.337 149.816 77.8757 148.455C77.4144 147.094 76.7384 145.857 75.8862 144.815Z" fill="#317EFE"/>
                                    <path d="M8.77362 11.6633C11.5776 13.5572 14.3695 15.5257 17.1125 17.5388C157.873 121.106 223.437 393.332 106.109 586" stroke="#317EFE" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M13.4814 2.05719C11.8812 1.01363 10.064 0.574006 8.25949 0.793949C6.45499 1.01389 4.74427 1.88347 3.34385 3.29276C1.94344 4.70205 0.916225 6.58774 0.392031 8.71125C-0.132163 10.8348 -0.129725 13.1007 0.399025 15.2225C0.927775 17.3443 1.95902 19.2267 3.36246 20.6315C4.76589 22.0363 6.47849 22.9005 8.28345 23.1146C10.0884 23.3288 11.9047 22.8833 13.5027 21.8346C15.1007 20.7859 16.4086 19.1811 17.2608 17.2231C18.4031 14.5988 18.6466 11.527 17.9379 8.68304C17.2292 5.83911 15.6262 3.45589 13.4814 2.05719Z" fill="#317EFE"/>
                                </g>
                            </svg>
                        </div>
                        <div class="slider-feature-img">
                            <div class="slider-feature-img-overlay"></div>

                            <?php if ( !empty($settings['fannava_hero_award_group_show']) ) : ?>
                            <div class="company-award">
                                <div class="circle-rotate-wrapper">
                                    <div class="circle-rotate-inner">
                                        <?php if ( !empty($settings['fannava_award_title']) ) : ?>
                                            <div class="circle-rotate-text" data-circle-text='{"radius": 90, "forceWidth": true,"forceHeight": true}'>
                                                <?php echo fannava_kses( $settings['fannava_award_title'] ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <span class="icon">
                                   <?php if($settings['fannava_award_icon_type'] !== 'image') : ?>
                                       <?php if (!empty($settings['award_icon']) || !empty($settings['selected_award_icon']['value'])) : ?>
                                           <?php fannava_render_icon($settings, 'award_icon', 'selected_award_icon'); ?>
                                       <?php endif; ?>
                                   <?php else : ?>
                                       <?php if (!empty($settings['fannava_award_icon_image']['url'])): ?>
                                           <img src="<?php echo $settings['fannava_award_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_award_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                       <?php endif; ?>
                                   <?php endif; ?>
							    </span>
                            </div>
                            <?php endif;?>
                            <svg width="907" height="951" viewBox="0 0 907 951" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M1047.79 0V950.431H343.77C337.123 941.336 331.22 931.279 326.167 920.438C277.73 815.952 304.515 687.491 264.597 576.485C216.07 441.529 78.668 417.835 18.3071 292.089C-8.02125 237.229 -0.935242 156.008 15.1807 95.1532C27.0236 50.4328 46.8482 20.6233 71.3312 0.0366947L1047.79 0Z" fill="#D9D9D9"/>
                                <path d="M1047.79 0V950.431H343.77C337.123 941.336 331.22 931.279 326.167 920.438C277.73 815.952 304.515 687.491 264.597 576.485C216.07 441.529 78.668 417.835 18.3071 292.089C-8.02125 237.229 -0.935242 156.008 15.1807 95.1532C27.0236 50.4328 46.8482 20.6233 71.3312 0.0366947L1047.79 0Z" fill="url(#pattern0_1224_35)"/>
                                <defs>
                                    <pattern id="pattern0_1224_35" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_1224_35" transform="matrix(0.000680485 0 0 0.000749625 -0.180485 0)"/>
                                    </pattern>
                                    <image id="image0_1224_35" width="2000" height="1334" xlink:href="<?php echo esc_url($fannava_hero_image);?>"/>
                                </defs>
                            </svg>

                            <div class="slider-right-shape">
                                <svg width="138" height="481" viewBox="0 0 138 481" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M130.574 471.106C128.274 469.552 125.984 467.938 123.734 466.286C8.27369 381.335 -45.5063 158.038 50.7337 0" stroke="#317EFE" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M75.5234 362.485C76.5754 363.771 77.9154 364.646 79.3739 365C80.8324 365.354 82.3441 365.172 83.7178 364.475C85.0915 363.779 86.2656 362.6 87.0916 361.087C87.9175 359.575 88.3584 357.797 88.3584 355.978C88.3584 354.159 87.9175 352.381 87.0916 350.868C86.2656 349.356 85.0915 348.177 83.7178 347.48C82.3441 346.784 80.8324 346.601 79.3739 346.955C77.9154 347.31 76.5754 348.185 75.5234 349.47C74.8244 350.325 74.2698 351.339 73.8915 352.456C73.5131 353.572 73.3184 354.769 73.3184 355.978C73.3184 357.187 73.5131 358.383 73.8915 359.5C74.2698 360.617 74.8244 361.631 75.5234 362.485Z" fill="#317EFE"/>
                                    <path d="M81.0924 355.745C79.2857 353.421 77.5257 351.032 75.8124 348.577C34.8124 289.643 23.4123 195.224 34.7423 123.825C42.0623 77.7225 66.1123 35.6442 98.2623 0" stroke="#317EFE" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M126.713 479.582C128.025 480.438 129.516 480.799 130.996 480.618C132.476 480.438 133.879 479.725 135.028 478.569C136.177 477.413 137.019 475.866 137.449 474.124C137.879 472.382 137.877 470.524 137.444 468.783C137.01 467.043 136.164 465.499 135.013 464.346C133.862 463.194 132.457 462.485 130.976 462.31C129.496 462.134 128.006 462.499 126.695 463.359C125.385 464.22 124.312 465.536 123.613 467.142C122.676 469.295 122.476 471.814 123.057 474.147C123.639 476.48 124.953 478.435 126.713 479.582Z" fill="#317EFE"/>
                                </svg>
                            </div>

                            <div class="slider-circle-shape">
                                <svg width="183" height="224" viewBox="0 0 183 224" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M135.199 13.0347L133.742 14.8164L170.964 60.3467L172.421 58.565L135.199 13.0347Z" fill="#317EFE"/>
                                    <path d="M113.478 2.92912L112.021 4.71094L179.211 86.8973L180.667 85.1155L113.478 2.92912Z" fill="#317EFE"/>
                                    <path d="M97.7145 0.0765765L96.2578 1.8584L181.542 106.179L182.999 104.397L97.7145 0.0765765Z" fill="#317EFE"/>
                                    <path d="M84.4468 0.291526L82.9902 2.07324L181.37 122.412L182.827 120.63L84.4468 0.291526Z" fill="#317EFE"/>
                                    <path d="M72.7593 2.46047L71.3027 4.24219L179.589 136.699L181.046 134.917L72.7593 2.46047Z" fill="#317EFE"/>
                                    <path d="M62.2925 6.09719L60.8359 7.87891L176.632 149.521L178.088 147.739L62.2925 6.09719Z" fill="#317EFE"/>
                                    <path d="M52.777 10.9174L51.3203 12.6992L172.674 161.14L174.131 159.358L52.777 10.9174Z" fill="#317EFE"/>
                                    <path d="M44.1266 16.7563L42.6699 18.5381L167.891 171.71L169.348 169.928L44.1266 16.7563Z" fill="#317EFE"/>
                                    <path d="M36.2321 23.5756L34.7754 25.3574L162.337 181.392L163.794 179.61L36.2321 23.5756Z" fill="#317EFE"/>
                                    <path d="M29.0503 31.273L27.5938 33.0547L156.068 190.205L157.525 188.423L29.0503 31.273Z" fill="#317EFE"/>
                                    <path d="M22.5835 39.7681L21.127 41.5498L149.099 198.086L150.556 196.305L22.5835 39.7681Z" fill="#317EFE"/>
                                    <path d="M16.8122 49.1713L15.3555 50.9531L141.418 205.154L142.875 203.372L16.8122 49.1713Z" fill="#317EFE"/>
                                    <path d="M11.7926 59.4496L10.3359 61.2314L132.991 211.264L134.447 209.482L11.7926 59.4496Z" fill="#317EFE"/>
                                    <path d="M7.59722 70.7886L6.14062 72.5703L123.754 216.435L125.21 214.654L7.59722 70.7886Z" fill="#317EFE"/>
                                    <path d="M4.30425 83.2212L2.84766 85.0029L113.566 220.435L115.023 218.653L4.30425 83.2212Z" fill="#317EFE"/>
                                    <path d="M2.15785 97.0297L0.701172 98.8115L102.27 223.051L103.727 221.269L2.15785 97.0297Z" fill="#317EFE"/>
                                    <path d="M1.45668 112.63L0 114.412L89.5268 223.922L90.9835 222.14L1.45668 112.63Z" fill="#317EFE"/>
                                    <path d="M2.87856 130.83L1.42188 132.612L74.6499 222.185L76.1065 220.403L2.87856 130.83Z" fill="#317EFE"/>
                                    <path d="M8.57574 154.229L7.11914 156.011L55.5276 215.224L56.9842 213.443L8.57574 154.229Z" fill="#317EFE"/>
                                </svg>
                            </div>
                        </div>
                        <div class="container h-100 align-self-center">
                            <div class="row h-100">
                                <div class="col-lg-6 col-md-6 align-self-center mt-5">
                                    <div class="te-slider-content-wrapper">
                                        <div class="te-slider-content">
                                            <?php if ( !empty($settings['fannava_sub_title']) ) : ?>
                                                <span class="te-slider-short-title"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
                                            <?php endif; ?>
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
                                                <p class="te-slider-short-desc"><?php echo fannava_kses( $settings['fannava_description'] ); ?></p>
                                            <?php endif; ?>
                                            <div class="te-slider-btn-wrapper">
                                                <?php if (!empty($settings['fannava_btn_text'])) : ?>
                                                    <a <?php echo $this->get_render_attribute_string( 'fannava-button-arg' ); ?>>
                                                        <?php echo $settings['fannava_btn_text']; ?>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="tel:<?php echo esc_attr(str_replace(' ', '-', $settings['fannava_left_section_phone_number'])); ?>" class="te-call-btn">
                                                    <div class="te-icon">
                                                        <?php if($settings['fannava_single_icon_type'] !== 'image') : ?>
                                                            <?php if (!empty($settings['icon']) || !empty($settings['need_help_selected_icon']['value'])) : ?>
                                                                <?php fannava_render_icon($settings, 'icon', 'need_help_selected_icon'); ?>
                                                            <?php endif; ?>   
                                                        <?php else : ?>                                
                                                            <?php if (!empty($settings['fannava_icon_image']['url'])): ?>  
                                                                <img src="<?php echo $settings['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                            <?php endif; ?> 
                                                        <?php endif; ?> 
                                                    </div>
                                                    <div class="te-content">
                                                        <?php if ( !empty($settings['fannava_need_help_heading']) ) : ?>    
                                                            <span class="te-title"><?php echo fannava_kses( $settings['fannava_need_help_heading'] ); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ( !empty($settings['fannava_left_section_phone_number']) ) : ?>
                                                            <span class="te-text"><?php echo fannava_kses( $settings['fannava_left_section_phone_number'] ); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider end -->
            </div>
        </div>
        <!-- Slider Section End !-->

        <?php endif; ?>
        <?php 
	}

}

$widgets_manager->register( new Fannava_Hero_Banner() );