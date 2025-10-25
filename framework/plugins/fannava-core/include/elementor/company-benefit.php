<?php
namespace FannavaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fannava Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Fannava_Company_Benefit extends Widget_Base {

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
		return 'company-benefit';
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
		return __( 'Company Benefit', 'fannavacore' );
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


        // fannava_section_title
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

        // Features group
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
            'fannava_features_text', [
                'label' => esc_html__('Features Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Feature Description', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_features_text_color',
            [
                'label' => __( 'Text Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .company-benefits .content-box .benefits-list .list-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
     
        $this->add_control(
            'fannava_features_list',
            [
                'label' => esc_html__('Features - List', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_features_title' => esc_html__('Discover', 'fannavacore'),
                    ],
                    [
                        'fannava_features_title' => esc_html__('Define', 'fannavacore')
                    ]
                ],
                'title_field' => '{{{ fannava_features_title }}}',
            ]
        );
        $this->end_controls_section();


        // fannava_btn_button_group
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
        $this->end_controls_section();

        // _fannava_image
		$this->start_controls_section(
            '_fannava_image',
            [
                'label' => esc_html__('Thumbnail', 'fannavacore'),
            ]
        );
       
        $this->add_control(
            'fannava_right_side_image',
            [
                'label' => esc_html__( 'Choose Right Side Image', 'fannavacore' ),
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

            if ( !empty($settings['fannava_right_side_image']['url']) ) {
                $fannava_right_side_image = !empty($settings['fannava_right_side_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_right_side_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_right_side_image']['url'];
                $fannava_right_side_image_alt = get_post_meta($settings["fannava_right_side_image"]["id"], "_wp_attachment_image_alt", true);
            }            

			$this->add_render_attribute('title_args', 'class', 'section-title');

            // Link
            if ('2' == $settings['fannava_btn_link_type']) {
                $this->add_render_attribute('fannava-button-arg', 'href', get_permalink($settings['fannava_btn_page_link']));
                $this->add_render_attribute('fannava-button-arg', 'target', '_self');
                $this->add_render_attribute('fannava-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('fannava-button-arg', 'class', 'link-anime v2');
            } else {
                if ( ! empty( $settings['fannava_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'fannava-button-arg', $settings['fannava_btn_link'] );
                    $this->add_render_attribute('fannava-button-arg', 'class', 'link-anime v2');
                }
            }
        ?>

        <section class="company-benefits">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-box">
                            <div class="section-title">
                                <?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
                                    <h6><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></h6>
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
                                    <p><?php echo fannava_kses( $settings['fannava_description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="benefits-list">
                                <ul>
                                    <?php foreach ($settings['fannava_features_list'] as $item) : ?>
                                        <li>
                                            <div class="my-icon">
                                                <?php if($item['fannava_service_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                        <?php fannava_render_icon($item, 'icon', 'selected_icon'); ?>
                                                    <?php endif; ?>   
                                                <?php else : ?>                                
                                                    <?php if (!empty($item['fannava_icon_image']['url'])): ?>  
                                                        <img src="<?php echo $item['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?> 
                                                <?php endif; ?> 
                                            </div>
                                            <div class="list-content">
                                                <h4><?php echo fannava_kses($item['fannava_features_title' ]); ?></h4>
                                                <p><?php echo fannava_kses($item['fannava_features_text' ]); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                
                                <?php if (!empty($settings['fannava_btn_text'])) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'fannava-button-arg' ); ?>>
                                        <?php echo $settings['fannava_btn_text']; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <?php if ($settings['fannava_right_side_image']['url'] || $settings['fannava_right_side_image']['id']) : ?>
                            <div class="box-img">
                                <img src="<?php echo esc_url($fannava_right_side_image); ?>" alt="<?php echo esc_attr($fannava_right_side_image_alt); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php 
	}
}

$widgets_manager->register( new Fannava_Company_Benefit() );