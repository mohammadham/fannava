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
class Fannava_About_Talk_To_Us extends Widget_Base {

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
		return 'about-talk-to-us';
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
		return __( 'About Talk To Us', 'fannavacore' );
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
	protected function register_controls() {

		// _fannava_image
		$this->start_controls_section(
			'_fannava_image',
			[
				'label' => esc_html__('Thumbnail & Phone', 'fannavacore'),
			]
		);
		$this->add_control(
			'fannava_image',
			[
				'label' => esc_html__( 'Choose Image', 'fannavacore' ),
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
		
		// single icon or image
		$this->add_control(
            'fannava_single_icon_type',
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
            'fannava_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_single_icon_type' => 'image'
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
                        'fannava_single_icon_type' => 'icon'
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
                        'fannava_single_icon_type' => 'icon'
                    ]
                ]
            );
        }

		$this->add_control(
			'fannava_talk_to_us_heading',
			[
				'label' => esc_html__('Talk to us heading', 'fannavacore'),
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Need Help?', 'fannavacore'),
				'placeholder' => esc_html__('Type text before phone number', 'fannavacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'fannava_talk_to_us_heading_color',
            [
                'label' => __( 'Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .talk-to-us .left-numbber .text-content h4' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'fannava_talk_to_us_phone',
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
            'fannava_talk_to_us_phone_color',
            [
                'label' => __( 'Phone Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .talk-to-us .left-numbber .text-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();

		// form title and sub title
		$this->start_controls_section(
			'fannava_section_title',
			[
				'label' => esc_html__('Form Title & Sub Title', 'fannavacore'),
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
				'description' => fannava_get_allowed_html_desc( 'intermediate' ),
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
		$this->end_controls_section();

		// form
        $this->start_controls_section(
            'fannavacore_contact',
            [
                'label' => esc_html__('Contact Form', 'fannavacore'),
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
		?>

			<section class="talk-to-us v2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="left-img-numbber">
                                <div class="left-img">
								<?php if ($settings['fannava_image']['url'] || $settings['fannava_image']['id']) : ?>  
                                    <img src="<?php echo esc_url($fannava_image); ?>" alt="<?php echo esc_attr($fannava_image_alt); ?>">
                                <?php endif; ?>
                                </div>
                                <div class="left-numbber">
                                    <div class="my-icon">
                                        <?php if($settings['fannava_single_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
                                                <?php fannava_render_icon($settings, 'icon', 'selected_icon'); ?>
                                            <?php endif; ?>   
                                        <?php else : ?>                                
                                            <?php if (!empty($settings['fannava_icon_image']['url'])): ?>  
                                                <img src="<?php echo $settings['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?> 
                                        <?php endif; ?> 
                                    </div>
                                    <div class="text-content">
                                        <?php if ( !empty($settings['fannava_talk_to_us_heading']) ) : ?>    
        									<h4><?php echo fannava_kses( $settings['fannava_talk_to_us_heading'] ); ?></h4>
        								<?php endif; ?>
                                        <?php if ( !empty($settings['fannava_left_section_phone_number']) ) : ?>
                                            <h3><a href="tel:<?php echo esc_attr(str_replace(' ', '-', $settings['fannava_left_section_phone_number'])); ?>"><?php echo fannava_kses( $settings['fannava_left_section_phone_number'] ); ?></a></h3>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-content">
                                <div class="section-title">
								<?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
									<h6><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></h6>
								<?php endif; ?>

								<?php
									if ( !empty($settings['fannava_title' ]) ) :
										printf( '<%1$s %2$s>%3$s</%1$s>',
											tag_escape( $settings['fannava_title_tag'] ),
											$this->get_render_attribute_string( 'title' ),
											fannava_kses( $settings['fannava_title' ] )
											);
									endif;
								?>
								</div>

								<?php if( !empty($settings['fannavacore_select_contact_form']) ) : ?> 
								<div class="message-form"> 
									<?php echo do_shortcode( '[contact-form-7  id="'.$settings['fannavacore_select_contact_form'].'"]' ); ?> 
								</div> 
								<?php else : ?>
									<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'fannavacore' ). '</p></div>'; ?>
								<?php endif; ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php 
	}
}

$widgets_manager->register( new Fannava_About_Talk_To_Us() );