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
class Fannava_Home_2_CTA extends Widget_Base {

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
		return 'home-2-cta';
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
		return __( 'Home 2 CTA', 'fannavacore' );
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
        // single icon or image for cta button
		$this->add_control(
            'fannava_single_icon_type_cta',
            [
                'label' => esc_html__('Select Icon Type for Button', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'fannavacore'),
                    'icon' => esc_html__('Icon', 'fannavacore'),
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_icon_image_button',
            [
                'label' => esc_html__('Upload Icon Image for Button', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_single_icon_type_cta' => 'image',
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
                        'fannava_single_icon_type_cta' => 'icon',
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
                        'fannava_single_icon_type_cta' => 'icon',
                    ]
                ]
            );
        }

        $this->end_controls_section();

        /**
         * Image section
         */
        $this->start_controls_section(
            'fannava_cta_image_group',
            [
                'label' => esc_html__('Image', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_cta_image',
            [
                'label' => esc_html__( 'CTA Image', 'fannavacore' ),
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
        ?>

        <?php

            if ( !empty($settings['fannava_cta_image']['url']) ) {
                $fannava_cta_image = !empty($settings['fannava_cta_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_cta_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_cta_image']['url'];
                $fannava_cta_image_alt = get_post_meta($settings["fannava_cta_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Title
            $this->add_render_attribute('title_args', 'class', 'te-cta-title');

            // Button
            $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn yellow-btn'); 
            
            // Link
            if ('2' == $settings['fannava_btn_link_type']) {
                $this->add_render_attribute('fannava-button-arg', 'href', get_permalink($settings['fannava_btn_page_link']));
                $this->add_render_attribute('fannava-button-arg', 'target', '_self');
                $this->add_render_attribute('fannava-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn yellow-btn');
            } else {
                if ( ! empty( $settings['fannava_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'fannava-button-arg', $settings['fannava_btn_link'] );
                    $this->add_render_attribute('fannava-button-arg', 'class', 'te-theme-btn yellow-btn');
                }
            }
        ?>	
        <div class="cta-and-portfolio-area">
            <!-- Call To Action Area Start !-->
            <div class="cta-section-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="cta-area style-1">
                                <div class="te-cta-inner-area">
                                    <div class="te-cta-collumn te-column-bg-image">
                                        <?php if ($settings['fannava_cta_image']['url'] || $settings['fannava_cta_image']['id']) : ?>
                                            <img src="<?php echo esc_url($fannava_cta_image); ?>" alt="<?php echo esc_attr($fannava_cta_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="te-cta-collumn">
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
                                            <div class="te-btn-wrapper">
                                                <?php if (!empty($settings['fannava_btn_text'])) : ?>
                                                    <a <?php echo $this->get_render_attribute_string( 'fannava-button-arg' ); ?>>
                                                        <?php echo $settings['fannava_btn_text']; ?>
                                                            <?php if($settings['fannava_single_icon_type_cta'] !== 'image') : ?>
                                                                <?php if (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
                                                                    <?php fannava_render_icon($settings, 'icon', 'selected_icon'); ?>
                                                                <?php endif; ?>   
                                                            <?php else : ?>                                
                                                                <?php if (!empty($settings['fannava_icon_image_button']['url'])): ?>  
                                                                    <img src="<?php echo $settings['fannava_icon_image_button']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_icon_image_button']['url']), '_wp_attachment_image_alt', true); ?>">
                                                                <?php endif; ?> 
                                                            <?php endif; ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Call To Action Area End !-->
        </div>
        
        <?php 
	}

}

$widgets_manager->register( new Fannava_Home_2_CTA() );