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
class Fannava_Project_Details extends Widget_Base {

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
		return 'project-details';
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
		return __( 'Project Details', 'fannavacore' );
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

        $this->add_control(
            'fannava_bottom_right_image',
            [
                'label' => esc_html__( 'Bottom Right Image', 'fannavacore' ),
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
         * Content section
         */
        $this->start_controls_section(
            '_fannava_content_section',
            [
                'label' => esc_html__('Main Content', 'fannavacore'),
            ]
        );


        $this->add_control(
            'fannava_content_section_heading',
            [
                'label' => esc_html__('Content Heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Conent section heading', 'fannavacore'),
                'placeholder' => esc_html__('Type content section heading', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_content_section_desctiption',
            [
                'label' => esc_html__('Content Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Conent section description', 'fannavacore'),
                'placeholder' => esc_html__('Type content section description', 'fannavacore'),
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

        $this->end_controls_section();


        /**
         * Middle Content section
         */
        $this->start_controls_section(
            '_fannava_middle_content_section',
            [
                'label' => esc_html__('Middle Content', 'fannavacore'),
            ]
        );


        $this->add_control(
            'fannava_middle_content_section_heading',
            [
                'label' => esc_html__('Middle Content Heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Middle conent section heading', 'fannavacore'),
                'placeholder' => esc_html__('Type middle content section heading', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_middle_content_section_desctiption',
            [
                'label' => esc_html__('Middle Content Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Middle conent section description', 'fannavacore'),
                'placeholder' => esc_html__('Type middle content section description', 'fannavacore'),
            ]
        );   

        $this->end_controls_section();

        
        /**
         * Project information section
         */
        $this->start_controls_section(
            '_project_information',
            [
                'label' => esc_html__( 'Project Information', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'fannava_project_information_heding',
            [
                'label' => esc_html__('Heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Project Information', 'fannavacore'),
                'placeholder' => esc_html__('Type project information', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_project_information_heading_color',
            [
                'label' => __( 'Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-details .project-details-box .title h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'fannava_project_information_title', [
                'label' => esc_html__('Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Manager', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_project_information_title_color',
            [
                'label' => __( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-details .project-details-box .box-info-list li h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $repeater->add_control(
            'fannava_project_information_text', [
                'label' => esc_html__('Text', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Omshikat Rinali', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_project_information_text_color',
            [
                'label' => __( 'Text Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-details .project-details-box .box-info-list li p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'fannava_project_information_list',
            [
                'label' => esc_html__('Project Information', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_project_information_title' => esc_html__('Manager', 'fannavacore'),
                    ],
                    [
                        'fannava_project_information_title' => esc_html__('Location', 'fannavacore')
                    ],
                    [
                        'fannava_project_information_title' => esc_html__('Customer', 'fannavacore'),
                    ],
                    [
                        'fannava_project_information_title' => esc_html__('Category', 'fannavacore')
                    ],
                    [
                        'fannava_project_information_title' => esc_html__('Value', 'fannavacore')
                    ]
                ],
                'title_field' => '{{{ fannava_project_information_title }}}',
            ]
        );

        $this->end_controls_section();


        /**
         * User review section
         */
        $this->start_controls_section(
            'fannava_review_section_title',
            [
                'label' => esc_html__('Review', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_reviewer_name',
            [
                'label' => esc_html__('Reviewer Name', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Stanio Lainto', 'fannavacore'),
                'placeholder' => esc_html__('Type reviewer name', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_reviewer_name_color',
            [
                'label' => __( 'Reviewer Name Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fannava_review_text',
            [
                'label' => esc_html__('Review Text', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('justo, posuere loborti viverra laoreet matti ullamcorper posuere viverra liquam eros justo, posuere lobortis non, viverra laoreet augue mattis', 'fannavacore'),
                'placeholder' => esc_html__('Type review text', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_review_text_color',
            [
                'label' => __( 'Review Text Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fannava_reviwer_image',
            [
                'label' => esc_html__('Reviewer Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
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

            if ( !empty($settings['fannava_bottom_right_image']['url']) ) {
                $fannava_bottom_right_image = !empty($settings['fannava_bottom_right_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_bottom_right_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_bottom_right_image']['url'];
                $fannava_bottom_right_image_alt = get_post_meta($settings["fannava_bottom_right_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['fannava_reviwer_image']['url']) ) {
                $fannava_reviwer_image = !empty($settings['fannava_reviwer_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_reviwer_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_reviwer_image']['url'];
                $fannava_reviwer_image_alt = get_post_meta($settings["fannava_reviwer_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title');

        ?>

        <!-- Project Details Page Start !-->
            <div class="project-details">
                <div class="image">
                    <?php if ($settings['fannava_image']['url'] || $settings['fannava_image']['id']) : ?>  
                        <img src="<?php echo esc_url($fannava_image); ?>" alt="<?php echo esc_attr($fannava_image_alt); ?>">
                    <?php endif; ?>
                </div>  
                <div class="content">
                    <div class="text">
                        <?php
                        if ( !empty($settings['fannava_content_section_heading' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['fannava_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                fannava_kses( $settings['fannava_content_section_heading' ] )
                                );
                        endif;
                        ?>
                        <?php if ( !empty($settings['fannava_content_section_desctiption']) ) : ?>
                            <p><?php echo fannava_kses( $settings['fannava_content_section_desctiption'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="project-info-wrapper">
                        <?php if ( !empty($settings['fannava_project_information_heding' ]) ) : ?>
                            <h3 class="title"><?php echo fannava_kses( $settings['fannava_project_information_heding' ] );?></h3>
                        <?php endif;?>
                        <div class="project-info">
                            <?php
                            foreach ($settings['fannava_project_information_list'] as $item) : ?>
                                <div class="te-single-meta">
                                    <?php if ( !empty($item['fannava_project_information_title']) ) : ?>
                                        <span class="meta-title"><?php echo fannava_kses( $item['fannava_project_information_title'] ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( !empty($item['fannava_project_information_text']) ) : ?>
                                        <span class="meta-text"><?php echo fannava_kses( $item['fannava_project_information_text'] ); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project-details-overview">
                <div class="content">
                    <?php if ( !empty($settings['fannava_middle_content_section_heading']) ) : ?>
                        <h4><?php echo fannava_kses( $settings['fannava_middle_content_section_heading'] ); ?></h4>
                    <?php endif; ?>
                    <?php if ( !empty($settings['fannava_middle_content_section_desctiption']) ) : ?>
                        <p><?php echo fannava_kses( $settings['fannava_middle_content_section_desctiption'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="list-wrapper">
                    <div class="list-inner">
                        <div class="user-card">
                            <div class="image">
                            <?php if ($settings['fannava_reviwer_image']['url'] || $settings['fannava_reviwer_image']['id']) : ?>  
                                <img src="<?php echo esc_url($fannava_reviwer_image); ?>" alt="<?php echo esc_attr($fannava_reviwer_image_alt); ?>">
                            <?php endif; ?>
                            </div>
                            <div class="content">
                                <?php if ( !empty($settings['fannava_reviewer_name']) ) : ?>
                                    <h4 class="title"><?php echo fannava_kses( $settings['fannava_reviewer_name'] ); ?></h4>
                                <?php endif; ?>
                                <?php if ( !empty($settings['fannava_review_text']) ) : ?>
                                    <p class="text"><?php echo fannava_kses( $settings['fannava_review_text'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="image">
                        <?php if ($settings['fannava_bottom_right_image']['url'] || $settings['fannava_bottom_right_image']['id']) : ?>  
                            <img src="<?php echo esc_url($fannava_bottom_right_image); ?>" alt="<?php echo esc_attr($fannava_bottom_right_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <!-- Project Details Page End !-->
		<?php
	}

}

$widgets_manager->register( new Fannava_Project_Details() );