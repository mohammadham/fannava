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
class Fannava_Faq extends Widget_Base {

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
		return 'fannava-faq';
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
		return __( 'Fannava FAQ', 'fannavacore' );
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
                'placeholder' => esc_html__('Type Sub Title Text', 'fannavacore'),
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
                'placeholder' => esc_html__('Type Title Text', 'fannavacore'),
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


        // FAQ Accordin
		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'fannavacore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_title_color',
            [
                'label' => __( 'Accordion Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #commonFaqAccordion button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_description_color',
            [
                'label' => __( 'Description Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-content-body p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #1', 'fannavacore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #2', 'fannavacore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #3', 'fannavacore' ),
                    ]
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->add_control(
            'space_accordion_item',
            [
                'label' => esc_html__( 'Accordion space gap', 'fannavacore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rn-card + .rn-card' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        /**
         * Image and counter section
         */
		$this->start_controls_section(
            '_fannava_image',
            [
                'label' => esc_html__('Image & Counter', 'fannavacore'),
            ]
        );
       
        $this->add_control(
            'fannava_faq_image',
            [
                'label' => esc_html__( 'FAQ Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'fannava_border_shape_image',
            [
                'label' => esc_html__( 'Border Shape Image', 'fannavacore' ),
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

        
        // Top left counter
        $this->add_control(
            'fannava_top_left_counter_text',
            [
                'label' => esc_html__('Top Left Counter Text', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Counter text', 'fannavacore'),
                'placeholder' => esc_html__('Type counter text', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_top_left_counter_value',
            [
                'label' => esc_html__('Top Left Counter Value', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('10', 'fannavacore'),
                'placeholder' => esc_html__('Type counter value', 'fannavacore'),
                'label_block' => true,
            ]
        );

        // Bottom right counter
        $this->add_control(
            'fannava_bottom_right_counter_text',
            [
                'label' => esc_html__('Bottom Right Counter Text', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Counter text', 'fannavacore'),
                'placeholder' => esc_html__('Type counter text', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_bottom_right_counter_value',
            [
                'label' => esc_html__('Bottom Right Counter Value', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1061', 'fannavacore'),
                'placeholder' => esc_html__('Type counter value', 'fannavacore'),
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

        if ( !empty($settings['fannava_faq_image']['url']) ) {
            $fannava_faq_image = !empty($settings['fannava_faq_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_faq_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_faq_image']['url'];
            $fannava_faq_image_alt = get_post_meta($settings["fannava_faq_image"]["id"], "_wp_attachment_image_alt", true);
        }

        if ( !empty($settings['fannava_border_shape_image']['url']) ) {
            $fannava_border_shape_image = !empty($settings['fannava_border_shape_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_border_shape_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_border_shape_image']['url'];
            $fannava_border_shape_image_alt = get_post_meta($settings["fannava_border_shape_image"]["id"], "_wp_attachment_image_alt", true);
        }
                
        $this->add_render_attribute('title_args', 'class', 'title');
        ?>

        <!-- FAQ Area Start -->
        <div class="faq-area style-1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 order-2 order-xxl-1 order-xl-1">
                        <!-- Accordion Start -->
                        <div class="accordion-wrapper">
                            <div class="te-section-title">
                                <div class="te-section-content">
                                    <div>
                                        <?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
                                            <span class="short-title only-divider"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
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
                                </div>
                            </div>
                            <div class="te-accordion-box-wrapper" id="faq_list">
                                <?php foreach ($settings['accordions'] as $index => $item) :
                                    $collapsed = ($index == '0' ) ? '' : 'collapsed';
                                    $show = ($index == '0' ) ? "show" : "";
                                    ?>
                                    <!-- Single Accordion Start -->
                                    <div class="te-accordion-list-item">
                                        <div id="headingThree">
                                            <div class="te-accordion-head <?php echo esc_attr($collapsed);?>" role="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($index);?>" aria-expanded="false" aria-controls="collapseThree">
                                                <h3 class="te-accordion-title"><?php echo esc_html($item['accordion_title']); ?></h3>
                                            </div>
                                        </div>
                                        <div id="collapse<?php echo esc_attr($index);?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingThree" data-bs-parent="#faq_list">
                                            <div class="te-accordion-body">
                                                <p><?php echo fannava_kses($item['accordion_description']); ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Accordion End -->
                                <?php endforeach; ?> 
                            </div>
                        </div>
                        <!-- Accordion End -->
                    </div>
                    <div class="col-xl-5 p-xxl-0 p-xl-0 order-1 order-xxl-2 order-xl-2">
                        <div class="te-faq-image">
                            <div class="te-image-wrapper">
                                <div class="te-main-img-inner">
                                    <?php if ($settings['fannava_faq_image']['url'] || $settings['fannava_faq_image']['id']) : ?>
                                        <img src="<?php echo esc_url($fannava_faq_image); ?>" alt="<?php echo esc_attr($fannava_faq_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="te-image-shape">
                                    <?php if ($settings['fannava_border_shape_image']['url'] || $settings['fannava_border_shape_image']['id']) : ?>
                                        <img src="<?php echo esc_url($fannava_border_shape_image); ?>" alt="<?php echo esc_attr($fannava_border_shape_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="top-content content">
                                    <?php if ( !empty($settings['fannava_top_left_counter_value']) ) : ?>
                                        <h2 class="number"><span class="counter"><?php echo fannava_kses( $settings['fannava_top_left_counter_value'] ); ?></span>K+</h2>
                                    <?php endif; ?>
                                    <?php if ( !empty($settings['fannava_top_left_counter_text']) ) : ?>
                                        <h6 class="title"><?php echo fannava_kses( $settings['fannava_top_left_counter_text'] ); ?></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="bottom-content">
                                    <div class="bottom-content-inner content">
                                        <?php if ( !empty($settings['fannava_bottom_right_counter_text']) ) : ?>
                                            <h6 class="title"><?php echo fannava_kses( $settings['fannava_bottom_right_counter_text'] ); ?></h6>
                                        <?php endif; ?>
                                        <?php if ( !empty($settings['fannava_bottom_right_counter_value']) ) : ?>
                                            <h2 class="number"><span class="counter"><?php echo fannava_kses( $settings['fannava_bottom_right_counter_value'] ); ?></span></h2>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ Area End -->

        <?php 
	}
}

$widgets_manager->register( new Fannava_Faq() );