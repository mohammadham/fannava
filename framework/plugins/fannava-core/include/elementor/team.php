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
class Fannava_Team extends Widget_Base {

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
		return 'fannava-team';
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
		return __( 'Team', 'fannavacore' );
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
         * Layout Section
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
                    'layout-3' => esc_html__('Layout 3', 'fannavacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $layout_array = ["layout-1", "layout-2"];

         /**
         * Title & Content
         */
        $this->start_controls_section(
            'fannava_section_title',
            [
                'label' => esc_html__('Title & Content', 'fannavacore'),
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
            ]
        );

        $this->end_controls_section();

         /**
         * Members
         */
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'fannavacore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'fannavacore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'fannavacore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Name', 'fannavacore' ),
                'default' => __( 'Member Name', 'fannavacore' ),
                'placeholder' => __( 'Type name here', 'fannavacore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => __( 'Name Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .te-team-card .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'fannavacore' ),
                'default' => __( 'Fannava Officer', 'fannavacore' ),
                'placeholder' => __( 'Type designation here', 'fannavacore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'fannava_title_color',
            [
                'label' => __( 'Job Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .te-team-card .dec' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'URL', 'fannavacore' ),
                'placeholder' => __( 'Type link here', 'fannavacore' ),
                'default' => __( '#', 'fannavacore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'fannavacore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'fannavacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'fannavacore' ),
                'label_off' => __( 'No', 'fannavacore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );
    

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'fannavacore' ),
                'default' => __( '#', 'fannavacore' ),
                'placeholder' => __( 'Add your facebook link', 'fannavacore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'fannavacore' ),
                'default' => __( '#', 'fannavacore' ),
                'placeholder' => __( 'Add your twitter link', 'fannavacore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'fannavacore' ),
                'default' => __( '#', 'fannavacore' ),
                'placeholder' => __( 'Add your instagram link', 'fannavacore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'fannavacore' ),
                'default' => __( '#', 'fannavacore' ),
                'placeholder' => __( 'Add your pinterest link', 'fannavacore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // Repeater
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'fannavacore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'fannavacore' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'fannavacore' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'fannavacore' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'fannavacore' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'fannavacore' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'fannavacore' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'fannavacore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'fannavacore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'fannavacore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'fannavacore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
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

        <?php if ( $settings['fannava_design_style']  == 'layout-3' ): 
        ?>

        <!-- Team Page Start !-->
        <div class="team-page">       
            <div class="container">
                <div class="row">
                 
                    <?php foreach ( $settings['teams'] as $key => $item ) :
                        $title = fannava_kses( $item['title' ] );
                        $item_url = esc_url($item['item_url']);

                        if ( !empty($item['image']['url']) ) {
                            $fannava_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                            $fannava_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                        }            
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="te-team-card style-2">
                            <div class="image">
                                <?php if( !empty($fannava_team_image_url) ) : ?>
                                    <img src="<?php echo esc_url($fannava_team_image_url); ?>" alt="<?php echo esc_attr($fannava_team_image_alt); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="te-content-wrapper">
                                <div class="content">
                                    <?php if( !empty($item['show_social'] ) ) : ?> 
                                        <div class="social">
                                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                            <?php endif; ?>
                                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                            <?php endif; ?>
                                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                            <?php endif; ?>
                                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty($item['title']) ) : ?>
                                        <h2 class="title"><a href="<?php echo esc_url( $item['item_url'] ); ?>"><?php echo fannava_kses( $item['title' ] );?></a></h2>
                                    <?php endif; ?>
                                    <?php if( !empty($item['designation']) ) : ?>
                                        <p class="desc"><?php echo fannava_kses( $item['designation'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>  
                </div>
            </div>
        </div>
        <!-- Team Page End !-->

        <?php elseif ( $settings['fannava_design_style']  == 'layout-2' ): 
            $this->add_render_attribute( 'title_args', 'class', 'title' );
        ?>
        <!-- Team Member Slider Area Start -->
        <div class="team-slider-area style-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-section-title justify-content-center text-center">
                            <?php if ( !empty($settings['fannava_section_title_show']) ) : ?>
                                <div class="te-section-content">
                                    <?php if ( !empty($settings['fannava_sub_title']) ) : ?>  
                                        <div>
                                            <span class="short-title"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
                                        </div>
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
                                </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="te-team-member-slider-wrapper" id="team_slider_wrapper">
                        <?php foreach ( $settings['teams'] as $key => $item ) :
                            $title = fannava_kses( $item['title' ] );
                            $item_url = esc_url($item['item_url']);

                            if ( !empty($item['image']['url']) ) {
                                $fannava_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                $fannava_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                            }            
                        ?>  
                            <div>
                                <div class="te-team-card style-2">
                                    <div class="image">
                                        <?php if( !empty($fannava_team_image_url) ) : ?>
                                            <img src="<?php echo esc_url($fannava_team_image_url); ?>" alt="<?php echo esc_attr($fannava_team_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="te-content-wrapper">
                                        <div class="content">
                                            <?php if( !empty($item['show_social'] ) ) : ?> 
                                                <div class="social">
                                                    <?php if( !empty($item['facebook_title'] ) ) : ?>
                                                        <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                                    <?php endif; ?>
                                                    <?php if( !empty($item['twitter_title'] ) ) : ?>
                                                        <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                                    <?php endif; ?>
                                                    <?php if( !empty($item['instagram_title'] ) ) : ?>
                                                        <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                                    <?php endif; ?>
                                                    <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                                        <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if( !empty($item['title']) ) : ?>
                                                <h2 class="title"><a href="<?php echo esc_url( $item['item_url'] ); ?>"><?php echo fannava_kses( $item['title' ] );?></a></h2>
                                            <?php endif; ?>
                                            <?php if( !empty($item['designation']) ) : ?>
                                                <p class="desc"><?php echo fannava_kses( $item['designation'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>  
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Member Slider Area End -->

        <?php else: 
            $this->add_render_attribute( 'title_args', 'class', 'title' );
        ?>

        <!-- Team Member Slider Area Start -->
        <div class="team-slider-area style-1">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-section-title left-align-title">
                            <?php if ( !empty($settings['fannava_section_title_show']) ) : ?>
                                <div class="te-section-content">
                                    <?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
                                        <div>
                                            <span class="short-title only-divider"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( !empty($settings['fannava_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['fannava_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            fannava_kses( $settings['fannava_title' ] )
                                        );
                                    endif; ?>
                                </div>
                            <?php endif; ?>
                            <div  class="te-section-desc">
                                <div class="te-slider-btn-wrapper">
                                    <a href="#" class="te-slider-nav te-slider-prev" id="team_slider_prev">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </a>
                                    <a href="#" class="te-slider-nav te-slider-next" id="team_slider_next">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="te-team-member-slider-wrapper" id="team_slider_wrapper">
                <?php foreach ( $settings['teams'] as $key => $item ) :
                    $title = fannava_kses( $item['title' ] );
                    $item_url = esc_url($item['item_url']);

                    if ( !empty($item['image']['url']) ) {
                        $fannava_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                        $fannava_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                    }            
                ?>
                    <div>
                        <div class="te-team-card">
                            <div class="image">
                                <?php if( !empty($fannava_team_image_url) ) : ?>
                                    <img src="<?php echo esc_url($fannava_team_image_url); ?>" alt="<?php echo esc_attr($fannava_team_image_alt); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="te-content-wrapper">
                                <div class="content">
                                    <?php if( !empty($item['show_social'] ) ) : ?> 
                                        <div class="social">
                                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                            <?php endif; ?>
                                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                            <?php endif; ?>
                                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                            <?php endif; ?>
                                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty($item['title']) ) : ?>
                                        <h2 class="title"><a href="<?php echo esc_url( $item['item_url'] ); ?>"><?php echo fannava_kses( $item['title' ] );?></a></h2>
                                    <?php endif; ?>

                                    <?php if( !empty($item['designation']) ) : ?>
                                        <p class="desc"><?php echo fannava_kses( $item['designation'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>  
            </div>
        </div>
        <!-- Team Member Slider Area End -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Fannava_Team() );