<?php
namespace FannavaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;



use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use FannavaCore\Elementor\Controls\Group_Control_FannavaBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fannava Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Fannava_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About Us', 'fannavacore' );
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
            'fannava_sub_title',
            [
                'label' => esc_html__('Sub Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title', 'fannavacore'),
                'placeholder' => esc_html__('Type sub title', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'fannava_title',
            [
                'label' => esc_html__('Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'fannavacore'),
                'placeholder' => esc_html__('Type title', 'fannavacore'),
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

        // Experience
        $this->add_control(
            'fannava_experience_title',
            [
                'label' => esc_html__('Experience Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('10', 'fannavacore'),
                'placeholder' => esc_html__('Type experience title', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'fannava_experience_description',
            [
                'label' => esc_html__('Experience Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('years of experiences in this industry', 'fannavacore'),
                'placeholder' => esc_html__('Type experience description', 'fannavacore'),
                'condition' => [
                    'fannava_design_style' => 'layout-1',
                ],
            ]
        );

        // Activity
        $this->add_control(
            'fannava_single_icon_type',
            [
                'label' => esc_html__('Activity Icon Type', 'fannavacore'),
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
            'fannava_icon_image',
            [
                'label' => esc_html__('Activity Icon Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_single_icon_type' => 'image',
                    'fannava_design_style' => 'layout-2'
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
                        'fannava_single_icon_type' => 'icon',
                        'fannava_design_style' => 'layout-2'
                    ]
                ]
            );
        }

        $this->add_control(
            'fannava_activity_title',
            [
                'label' => esc_html__('Activity Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Daily Activity', 'fannavacore'),
                'placeholder' => esc_html__('Type activity title', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'fannava_activity_description',
            [
                'label' => esc_html__('Activity Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Activity description here', 'fannavacore'),
                'placeholder' => esc_html__('Type activity description', 'fannavacore'),
                'condition' => [
                    'fannava_design_style' => 'layout-2',
                ],
            ]
        );

        $this->end_controls_section();

        
        /**
         * Features section
         */
        $this->start_controls_section(
            'fannava_features',
            [
                'label' => esc_html__('Features List', 'fannavacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'fannava_features_title', [
                'label' => esc_html__('Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_features_title_color',
            [
                'label' => __( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .company-benefits .content-box .benefits-list .list-content h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'fannava_service_icon_type',
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

        $repeater->add_control(
            'fannava_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_service_icon_type' => 'image'
                ]

            ]
        );

        if (fannava_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'fannava_service_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
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
                        'fannava_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
     
        $this->add_control(
            'fannava_features_list',
            [
                'label' => esc_html__('Features - List', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_features_title' => esc_html__('List item 1', 'fannavacore'),
                    ],
                    [
                        'fannava_features_title' => esc_html__('List item 2', 'fannavacore')
                    ],
                    [
                        'fannava_features_title' => esc_html__('List item 3', 'fannavacore'),
                    ],
                    [
                        'fannava_features_title' => esc_html__('List item 4', 'fannavacore')
                    ]
                ],
                'title_field' => '{{{ fannava_features_title }}}',
            ]
        );
        $this->end_controls_section();


        /**
         * Big Features section
         */
        
		$this->start_controls_section(
			'fannava_big_features',
			[
				'label' => esc_html__('Big Features List', 'fannavacore'),
				'description' => esc_html__( 'Control all the style settings from Style tab', 'fannavacore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'fannava_big_features_title', [
				'label' => esc_html__('Title', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'basic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Professional', 'fannavacore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
            'fannava_features_counter_title_color',
            [
                'label' => __( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .get-in-touch .card-items-list p' => 'color: {{VALUE}}',
                ],
            ]
        );

		$repeater->add_control(
			'fannava_big_features_description', [
				'label' => esc_html__('Description', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'basic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Professional engineers play', 'fannavacore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
            'fannava_big_features_description_color',
            [
                'label' => __( 'Counter Number Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .get-in-touch .card-items-list h3' => 'color: {{VALUE}}',
                ],
            ]
        );

		// icon
		$repeater->add_control(
            'fannava_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
            ]
        );

        $repeater->add_control(
            'fannava_icon_image',
            [
                'label' => esc_html__('Upload Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_icon_type' => 'image'
                ]

            ]
        );
        if (fannava_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'fannava_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
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
                        'fannava_icon_type' => 'icon'
                    ]
                ]
            );
        }
		
		$this->add_control(
			'fannava_big_features_list',
			[
				'label' => esc_html__('Big Features - List', 'fannavacore'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'fannava_big_features_title' => esc_html__('Professional', 'fannavacore'),
					],
					[
						'fannava_big_features_title' => esc_html__('DataSense', 'fannavacore')
					]
				],
				'title_field' => '{{{ fannava_big_features_title }}}',
			]
		);
		$this->end_controls_section();


        /**
         * Image section
         */
		$this->start_controls_section(
            '_fannava_image',
            [
                'label' => esc_html__('Image', 'fannavacore'),
            ]
        );
        $this->add_control(
            'fannava_primary_image',
            [
                'label' => esc_html__( 'Primary Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'fannava_shape_image',
            [
                'label' => esc_html__( 'Shape Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-1',
                ],
            ]
        );
        
        $this->add_control(
            'fannava_secondary_image',
            [
                'label' => esc_html__( 'Secondary Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2',
                ],
            ]
        );
        $this->add_control(
            'fannava_arrow_shape_image',
            [
                'label' => esc_html__( 'Arrow Shape Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-2',
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
        $this->add_control(
            'fannava_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'fannavacore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'fannavacore'),
                'label_off' => esc_html__('No', 'fannavacore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'fannava_image_height',
            [
                'label' => esc_html__( 'Image Height', 'fannavacore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fannava-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'fannava_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'fannavacore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fannava-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'fannava_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();


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
            
            if ( !empty($settings['fannava_primary_image']['url']) ) {
                $fannava_primary_image = !empty($settings['fannava_primary_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_primary_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_primary_image']['url'];
                $fannava_primary_image_alt = get_post_meta($settings["fannava_primary_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['fannava_secondary_image']['url']) ) {
                $fannava_secondary_image = !empty($settings['fannava_secondary_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_secondary_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_secondary_image']['url'];
                $fannava_secondary_image_alt = get_post_meta($settings["fannava_secondary_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['fannava_arrow_shape_image']['url']) ) {
                $fannava_arrow_shape_image = !empty($settings['fannava_arrow_shape_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_arrow_shape_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_arrow_shape_image']['url'];
                $fannava_arrow_shape_image_alt = get_post_meta($settings["fannava_arrow_shape_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title');
        ?>
        <!-- About Us Area Start !-->
        <div class="about-us-area style-1">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-5">
                        <div class="te-about-image-card style-2 order-1 order-lg-2">
                            <div class="te-main-img-wrapper">
                                <div class="te-main-img-inner">
                                    <?php if ($settings['fannava_primary_image']['url'] || $settings['fannava_primary_image']['id']) : ?>
                                        <img class="tilt-animate" src="<?php echo esc_url($fannava_primary_image); ?>" alt="<?php echo esc_attr($fannava_primary_image_alt); ?>">
                                    <?php endif; ?>
                                    <div class="te-img-card-shape">
                                        <?php if ($settings['fannava_arrow_shape_image']['url'] || $settings['fannava_arrow_shape_image']['id']) : ?>
                                            <img src="<?php echo esc_url($fannava_arrow_shape_image); ?>" alt="<?php echo esc_attr($fannava_arrow_shape_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="te-another-image">
                                        <div class="te-another-image-inner">
                                            <?php if ($settings['fannava_secondary_image']['url'] || $settings['fannava_secondary_image']['id']) : ?>
                                                <img class="tilt-animate" src="<?php echo esc_url($fannava_secondary_image); ?>" alt="<?php echo esc_attr($fannava_secondary_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="te-badge-text">
                                            <div class="icon">
                                                <i class="fa-solid fa-chart-pie-simple"></i>
                                            </div>  
                                            <div class="text">
                                                <?php if ( !empty($settings['fannava_activity_title']) ) : ?>
                                                    <h4 class="title"><?php echo fannava_kses( $settings['fannava_activity_title'] ); ?></h4>
                                                <?php endif; ?>
                                                <?php if ( !empty($settings['fannava_activity_description']) ) : ?>
                                                    <span><?php echo fannava_kses( $settings['fannava_activity_description'] ); ?></h1>
                                                <?php endif; ?>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-7 order-2 order-lg-1">
                        <div class="te-about-info-card style-2">
                            <div class="te-about-info-content">
                                <div class="te-section-title">
                                    <div class="te-section-content">
                                        <div>
                                            <?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
                                                <span class="short-title only-divider">
                                                    <?php echo fannava_kses( $settings['fannava_sub_title'] ); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                            if ( !empty($settings['fannava_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape( $settings['fannava_title_tag'] ),
                                                    $this->get_render_attribute_string( 'title_args' ),
                                                    fannava_kses( $settings['fannava_title' ] )
                                                    );
                                            endif;
                                        ?>
                                        <div class="te-section-desc">
                                            <?php if ( !empty($settings['fannava_description']) ) : ?>
                                                <p><?php echo fannava_kses( $settings['fannava_description'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="te-list-item-wrapper">
                                    <?php foreach ($settings['fannava_features_list'] as $key => $item) :?>
                                        <div class="te-list-item">
                                            <span class="icon">
                                                <?php if($item['fannava_service_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                        <?php fannava_render_icon($item, 'icon', 'selected_icon'); ?>
                                                    <?php endif; ?>   
                                                <?php else : ?>                                
                                                    <?php if (!empty($item['fannava_icon_image']['url'])): ?>  
                                                        <img src="<?php echo $item['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?> 
                                                <?php endif; ?> 
                                            </span>
                                            <span class="text"><?php echo fannava_kses($item['fannava_features_title' ]); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="te-info-list">
                                    <?php foreach ($settings['fannava_big_features_list'] as $item) : ?>
									    <div class="te-single-info-list">
                                            <div class="icon">
                                                <?php if($item['fannava_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                        <?php fannava_render_icon($item, 'icon', 'selected_icon'); ?>
                                                    <?php endif; ?>   
                                                <?php else : ?>                                
                                                    <?php if (!empty($item['fannava_icon_image']['url'])): ?>  
                                                        <img src="<?php echo $item['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?> 
                                                <?php endif; ?>
                                            </div>
                                            <h3 class="title"><?php echo fannava_kses( $item['fannava_big_features_title'] ); ?></h3>
                                            <span class="short-title"><?php echo fannava_kses( $item['fannava_big_features_description'] ); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- About Us Area End !-->

		<?php else: 
            if ( !empty($settings['fannava_primary_image']['url']) ) {
                $fannava_primary_image = !empty($settings['fannava_primary_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_primary_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_primary_image']['url'];
                $fannava_primary_image_alt = get_post_meta($settings["fannava_primary_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['fannava_shape_image']['url']) ) {
                $fannava_shape_image = !empty($settings['fannava_shape_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_shape_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_shape_image']['url'];
                $fannava_shape_image_alt = get_post_meta($settings["fannava_shape_image"]["id"], "_wp_attachment_image_alt", true);
            }            
			$this->add_render_attribute('title_args', 'class', 'title');

        ?>	
        <!-- About Us Area Start !-->
        <div class="about-us-area style-2">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-7 col-lg-6 align-self-center order-2 order-lg-1">
                        <div class="te-about-info-card">
                            <div class="te-about-info-content">
                                <div class="te-section-title">
                                    <div class="te-section-content">
                                        <div>
                                            <?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
                                                <span class="short-title only-divider">
                                                    <?php echo fannava_kses( $settings['fannava_sub_title'] ); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                            if ( !empty($settings['fannava_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape( $settings['fannava_title_tag'] ),
                                                    $this->get_render_attribute_string( 'title_args' ),
                                                    fannava_kses( $settings['fannava_title' ] )
                                                    );
                                            endif;
                                        ?>
                                        <div class="te-section-desc">
                                            <?php if ( !empty($settings['fannava_description']) ) : ?>
                                                <p><?php echo fannava_kses( $settings['fannava_description'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="te-list-item-wrapper">
                                    <?php foreach ($settings['fannava_features_list'] as $key => $item) :?>
                                        <div class="te-list-item">
                                            <span class="icon">
                                                <?php if($item['fannava_service_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                        <?php fannava_render_icon($item, 'icon', 'selected_icon'); ?>
                                                    <?php endif; ?>   
                                                <?php else : ?>                                
                                                    <?php if (!empty($item['fannava_icon_image']['url'])): ?>  
                                                        <img src="<?php echo $item['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?> 
                                                <?php endif; ?> 
                                            </span>
                                            <span class="text"><?php echo fannava_kses($item['fannava_features_title' ]); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-5 col-lg-6 order-1 order-lg-2">
                        <div class="te-about-image-card">
                            <div class="te-main-img-wrapper text-right">
                                <div class="te-main-img-inner">
                                    <?php if ($settings['fannava_primary_image']['url'] || $settings['fannava_primary_image']['id']) : ?>
                                        <img class="tilt-animate" src="<?php echo esc_url($fannava_primary_image); ?>" alt="<?php echo esc_attr($fannava_primary_image_alt); ?>">
                                    <?php endif; ?>
                                    <div class="te-company-foundation-wrapper">
                                        <div class="te-company-foundation">
                                            <div class="te-counter-wrapper">
                                                <?php if ( !empty($settings['fannava_experience_title']) ) : ?>
                                                    <h1 class="counter-title"><?php echo fannava_kses( $settings['fannava_experience_title'] ); ?></h1>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ( !empty($settings['fannava_experience_description']) ) : ?>
                                                <h6 class="title"><?php echo fannava_kses( $settings['fannava_experience_description'] ); ?></h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="te-img-card-shape">
                                        <?php if ($settings['fannava_shape_image']['url'] || $settings['fannava_shape_image']['id']) : ?>
                                            <img class="tilt-animate" src="<?php echo esc_url($fannava_shape_image); ?>" alt="<?php echo esc_attr($fannava_shape_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Us Area End !-->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Fannava_About() );