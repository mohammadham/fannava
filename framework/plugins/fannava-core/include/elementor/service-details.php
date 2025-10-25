<?php
namespace FannavaCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
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
class Fannava_Service_Details extends Widget_Base {

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
		return 'service-details';
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
		return __( 'Service Details', 'fannavacore' );
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
         * Image section
         */
        $this->start_controls_section(
            '_fannava_image',
            [
                'label' => esc_html__('Image', 'fannavacore'),
            ]
        );
        $this->add_control(
            'fannava_image',
            [
                'label' => esc_html__( 'Primary Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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


        /**
         * Title and content
         */
        $this->start_controls_section(
            'fannava_section_title',
            [
                'label' => esc_html__('Title & Content', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_service_heading',
            [
                'label' => esc_html__('Fannava Service Heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Fannava Service Heading', 'fannavacore'),
                'placeholder' => esc_html__('Type Service Heading Here', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_service_heading_color',
            [
                'label' => __( 'Fannava Service Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details .service-content h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fannava_service_desctiption',
            [
                'label' => esc_html__('Service Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Fannava service description', 'fannavacore'),
                'placeholder' => esc_html__('Type service description here', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_service_desctiption_color',
            [
                'label' => __( 'Description Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details .service-content .service-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
			'fannava_service_bottom_description',
			[
				'label' => esc_html__( 'Service Bottom Description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Fannava service bottom description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type service bottom  description here', 'textdomain' ),
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
        $this->end_controls_section();


        /**
         * Features
         */
        $this->start_controls_section(
            'fannava_service_details_features',
            [
                'label' => esc_html__('Service Features List', 'fannavacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'fannava_service_details_features_title', [
                'label' => esc_html__('Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_service_details_features_title_color',
            [
                'label' => __( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list-mark.two-col-list h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'fannava_service_details_features_list',
            [
                'label' => esc_html__('Features - List', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_service_details_features_title' => esc_html__('Mistakes To Avoid to the dummy', 'fannavacore'),
                    ],
                    [
                        'fannava_service_details_features_title' => esc_html__('Your Startup industry standard loream saum', 'fannavacore')
                    ],
                    [
                        'fannava_service_details_features_title' => esc_html__('Knew About Fonts text the printing and', 'fannavacore'),
                    ]
                ],
                'title_field' => '{{{ fannava_service_details_features_title }}}',
            ]
        );

        $this->end_controls_section();


        /**
         * Left sidebar
         */
        $this->start_controls_section(
            '_service_category',
            [
                'label' => esc_html__( 'Left Sidebar', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'fannava_service_category_title',
            [
                'label' => esc_html__('Service Category Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Fannava Service Name Title', 'fannavacore'),
                'placeholder' => esc_html__('Type Service Name Title Text', 'fannavacore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fannava_service_category_title_color',
            [
                'label' => __( 'Service Category Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details .service-links-list h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'fannava_service_category_name', [
                'label' => esc_html__( 'Service Name', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is service name' , 'fannavacore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_service_category_name_color',
            [
                'label' => __( 'Service Name Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details .service-links-list li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'fannava_category_link',
            [
                'label' => esc_html__('Category link', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://your-link.com', 'fannavacore'),
                'default' => esc_html__('#'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'service_category',
            [
                'label' => esc_html__( 'Repeater FAQ', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_service_category_name' => esc_html__( 'Instralation Accecories', 'fannavacore' ),
                    ],
                    [
                        'fannava_service_category_name' => esc_html__( 'Business Advice', 'fannavacore' ),
                    ],
                    [
                        'fannava_service_category_name' => esc_html__( 'Stock Market', 'fannavacore' ),
                    ]
                ],
                'title_field' => '{{{ fannava_service_category_name }}}',
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

            if ( !empty($settings['fannava_image']['url']) ) {
                $fannava_image = !empty($settings['fannava_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_image']['url'];
                $fannava_image_alt = get_post_meta($settings["fannava_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title');

        ?>

        <!-- Service Details Page Start !-->
        <div class="service-details-page">       
            <div class="container">
                <div class="row">
                    <!-- sidebar Start -->
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="widget te_widget_categories">
                                <div class="te-widget-title">
                                    <?php if ( !empty($settings['fannava_service_category_title']) ) : ?>
                                        <h4 class="wp-block-heading"><?php echo fannava_kses( $settings['fannava_service_category_title'] ); ?></h4>
                                    <?php endif; ?>
                                </div>
                                <ul>
                                    <?php foreach ($settings['service_category'] as $item) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($item['fannava_category_link' ]); ?>" target="_self" rel="nofollow">
                                                <?php echo fannava_kses($item['fannava_service_category_name' ]); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- sidebar Start -->
                    <!-- Service Details Content Start -->
                    <div class="col-lg-8">
                        <div class="te-service-details-wrapper">
                                <div class="service-details">
                                    <div class="image">
                                        <?php if ($settings['fannava_image']['url'] || $settings['fannava_image']['id']) : ?>  
                                            <img src="<?php echo esc_url($fannava_image); ?>" alt="<?php echo esc_attr($fannava_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>  
                                    <div class="content">
                                        <div class="te-title-wrapper">
                                            <div class="title-inner">
                                                <span class="icon">
                                                    <i class="fa-light fa-gear"></i>
                                                </span>
                                                <?php
                                                if ( !empty($settings['fannava_service_heading' ]) ) :
                                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                                        tag_escape( $settings['fannava_title_tag'] ),
                                                        $this->get_render_attribute_string( 'title_args' ),
                                                        fannava_kses( $settings['fannava_service_heading' ] )
                                                        );
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <?php if ( !empty($settings['fannava_service_desctiption']) ) : ?>
                                                <p><?php echo fannava_kses( $settings['fannava_service_desctiption'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-details-overview">
                                    <div class="list-wrapper">
                                        <div class="icon">
                                            <i class="fa-light fa-lightbulb-on"></i>
                                        </div>
                                        <ul>
                                            <?php foreach ($settings['fannava_service_details_features_list'] as $item) : ?>
                                                <li>
                                                    <?php echo fannava_kses($item['fannava_service_details_features_title' ]); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <?php if ( !empty($settings['fannava_service_bottom_description']) ) : ?>
                                            <?php echo fannava_kses( $settings['fannava_service_bottom_description'] ); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Service Details Content End -->
                </div>
            </div>
        </div>
        <!-- Service Details Page End !-->

		<?php
	}

}

$widgets_manager->register( new Fannava_Service_Details() );