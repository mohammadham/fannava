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
class Fannava_Testimonial extends Widget_Base {

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
		return 'fannava-testimonial';
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
		return __( 'Fannava Testimonial', 'fannavacore' );
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
                    'layout-3' => esc_html__('Layout 3', 'fannavacore'),
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
         * Review section
         */
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'fannavacore' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'fannavacore' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'fannavacore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_designation_color',
            [
                'label' => __( 'Designation Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .profile-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'review_heading', [
                'label' => esc_html__( 'Review Heading', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Highly Recommended!' , 'fannavacore' ),
                'label_block' => true,
            ]
        );        


        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'fannavacore' ),
            ]
        );

        $repeater->add_control(
            'review_content_color',
            [
                'label' => __( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .client-card .client-card-2 p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'fannavacore' ),
                        'reviewer_designation' => esc_html__( 'CEO', 'fannavacore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'fannavacore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'fannavacore' ),
                        'reviewer_designation' => esc_html__( 'MD', 'fannavacore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'fannavacore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'fannavacore' ),
                        'reviewer_designation' => esc_html__( 'Manager', 'fannavacore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'fannavacore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
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

        <?php if ( $settings['fannava_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>
        
        <!-- Testimonial Area Start -->
        <div class="testimonial-slider-area style-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-section-title left-align-title">
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
                            <div  class="te-section-desc">
                                <div class="te-slider-btn-wrapper">
                                    <a href="#" class="te-slider-nav te-slider-prev" id="testimonial_slider_prev">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </a>
                                    <a href="#" class="te-slider-nav te-slider-next" id="testimonial_slider_next">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="te-testimonial-slider-wrapper" id="testimonial_one">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $fannava_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $fannava_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div>
                                    <div class="te-testimonial-card style-3">
                                        <div class="te-content-wrapper">
                                            <div class="content">
                                                <?php if ( !empty($item['review_heading']) ) : ?>
                                                    <h4 class="title"><?php echo fannava_kses($item['review_heading']); ?></h4>
                                                <?php endif; ?>
                                                <?php if ( !empty($item['review_content']) ) : ?>
                                                    <p><?php echo fannava_kses($item['review_content']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="te-user-meta">
                                                <div class="te-user-info">
                                                    <?php if ( !empty($fannava_reviewer_image) ) : ?> 
                                                        <div class="image">
                                                            <img src="<?php echo esc_url($fannava_reviewer_image); ?>" alt="<?php echo esc_url($fannava_reviewer_image_alt); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="info">
                                                        <div class="rating">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                            <h2 class="name"><?php echo fannava_kses($item['reviewer_name']); ?>, 
                                                                <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                                                    <span><?php echo fannava_kses($item['reviewer_designation']); ?></span>
                                                                <?php endif; ?>
                                                            </h2>
                                                        <?php endif; ?>                                   
                                                    </div>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-solid fa-quote-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial Area End -->

		<?php elseif ( $settings['fannava_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>
    
        <!-- Testimonial Area Start -->
        <div class="testimonial-slider-area style-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-section-title justify-content-center text-center">
                            <div class="te-section-content">
                                <?php if ( !empty($settings['fannava_sub_title']) ) : ?>   
                                    <div>
                                        <span class="short-title"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php
                                    if ( !empty($settings['fannava_title']) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['fannava_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            fannava_kses( $settings['fannava_title' ] )
                                            );
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="te-testimonial-slider-wrapper" id="testimonial_two">
                <?php foreach ($settings['reviews_list'] as $index => $item) :
                    if ( !empty($item['reviewer_image']['url']) ) {
                        $fannava_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                        $fannava_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                    <div class="te-slick-item">
                        <div class="te-testimonial-card-two">
                            <div class="te-content-wrapper">
                                <div class="te-user-meta">
                                    <div class="te-user-info">
                                        <div class="icon">
                                            <i class="fa-solid fa-quote-right"></i>
                                        </div>
                                        <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h2 class="name"><?php echo fannava_kses($item['reviewer_name']); ?></h2>
                                        <?php endif; ?>
                                        <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                            <span class="designation"><?php echo fannava_kses($item['reviewer_designation']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( !empty($fannava_reviewer_image) ) : ?>
                                        <div class="image">   
                                            <img src="<?php echo esc_url($fannava_reviewer_image); ?>" alt="<?php echo esc_url($fannava_reviewer_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="content">
                                    <?php if ( !empty($item['review_content']) ) : ?>
                                        <p><?php echo fannava_kses($item['review_content']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Testimonial Area End -->
        <div class="testimonial-bg-area"></div>

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'title');
        ?>

        <!-- Testimonial Area Start -->
        <div class="testimonial-slider-area style-1">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-section-title left-align-title">
                            <div class="te-section-content">
                                <?php if ( !empty($settings['fannava_sub_title']) ) : ?>
                                    <div>
                                        <span class="short-title only-divider"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
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
                            <div  class="te-section-desc">
                                <div class="te-slider-btn-wrapper">
                                    <a href="#" class="te-slider-nav te-slider-prev" id="testimonial_slider_prev">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </a>
                                    <a href="#" class="te-slider-nav te-slider-next" id="testimonial_slider_next">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="te-testimonial-slider-wrapper" id="testimonial_one">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $fannava_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $fannava_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div>
                                    <div class="te-testimonial-card">
                                        <div class="te-content-wrapper">
                                            <div class="content">
                                                <?php if ( !empty($item['review_content']) ) : ?>
                                                    <p><?php echo fannava_kses($item['review_content']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="te-user-meta">
                                                <div class="te-user-info">
                                                    <?php if ( !empty($fannava_reviewer_image) ) : ?> 
                                                        <div class="image">
                                                            <img src="<?php echo esc_url($fannava_reviewer_image); ?>" alt="<?php echo esc_url($fannava_reviewer_image_alt); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="info">
                                                        <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                            <h2 class="name"><?php echo fannava_kses($item['reviewer_name']); ?></h2>
                                                        <?php endif; ?>
                                                        <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                                            <span class="designation"><?php echo fannava_kses($item['reviewer_designation']); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-solid fa-quote-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial Area End -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Fannava_Testimonial() );