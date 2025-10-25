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
class Fannava_Home_1_Newsletter extends Widget_Base {

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
		return 'home-1-newsletter';
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
		return __( 'Home 1 Newsletter', 'fannavacore' );
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
            'fannava_newsletter_image',
            [
                'label' => esc_html__( 'Newsletter Image', 'fannavacore' ),
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
		 * Title and content section
		 */
		$this->start_controls_section(
			'fannava_section_title',
			[
				'label' => esc_html__('Title & Content', 'fannavacore'),
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
		 * Form section
		 */
        $this->start_controls_section(
            'fannavacore_contact',
            [
                'label' => esc_html__('Mailchimp Form', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannavacore_subscribe_form',
            [
                'label'   => esc_html__('Shortcode', 'netfusion-elementor'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default'        => __('Shortcode here', 'netfusion-elementor'),
                'description' => esc_html__('Add Your shortcode here', 'netfusion-elementor'),
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
		
		$this->add_render_attribute('title_args', 'class', 'te-subscribe-title');
		if ( !empty($settings['fannava_newsletter_image']['url']) ) {
			$fannava_newsletter_image = !empty($settings['fannava_newsletter_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_newsletter_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_newsletter_image']['url'];
		}            
		?>

		    <!-- Newsletter Section Start-->
			<div class="newsletter-area style-1">
                <div class="container">
                    <div class="row">
                        <div class="subscribe-area style-1">
                            <div class="te-subscribe-inner-area">
                                <div class="te-subscribe-collumn te-image-bg-collumn"  style="background-image: url(<?php echo esc_url($fannava_newsletter_image); ?>);"></div>
                                <div class="te-subscribe-collumn">
                                    <div class="te-content-wrapper">
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
											<p class="text"><?php echo fannava_kses( $settings['fannava_description'] ); ?></p>
										<?php endif; ?>
                                        <div class="te-subscribe-form-wrapper">
                                            <div class="te-subscribe-form-widget">
                                                <?php print do_shortcode(html_entity_decode($settings['fannavacore_subscribe_form'])); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Newsletter Section End-->
		
        <?php 
	}
}

$widgets_manager->register( new Fannava_Home_1_Newsletter() );