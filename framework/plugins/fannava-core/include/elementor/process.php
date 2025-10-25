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
class Fannava_Process extends Widget_Base {

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
		return 'process';
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
		return __( 'Process Step', 'fannavacore' );
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
                    '{{WRAPPER}} .te-section-title .short-title' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .te-section-title .title' => 'color: {{VALUE}}',
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
         * Process list
         */
        $this->start_controls_section(
            'fannava_process',
            [
                'label' => esc_html__('Process List', 'fannavacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'fannava_process_bg_color',
            [
                'label' => esc_html__('Background Color', 'fannavacore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .te-process-step' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        // step image
        $repeater->add_control(
            'fannava_step_image',
            [
                'label' => esc_html__('Step Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // process image/icon
        $repeater->add_control(
            'fannava_process_icon_type',
            [
                'label' => esc_html__('Process Icon/Image', 'fannavacore'),
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
                'label' => esc_html__('Upload Image', 'fannavacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_process_icon_type' => 'image'
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
                        'fannava_process_icon_type' => 'icon'
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
                        'fannava_process_icon_type' => 'icon'
                    ]
                ]
            );
        }

        // process step
        $repeater->add_control(
            'fannava_process_step', [
                'label' => esc_html__('Process Step', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step - 01', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_process_step_color',
            [
                'label' => __( 'Step Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our-simple-step.v2 .process-card .process-card-header h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'fannava_process_title', [
                'label' => esc_html__('Process Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process title here', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_process_title_color',
            [
                'label' => __( 'Process Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-card-header h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'fannava_process_description',
            [
                'label' => esc_html__('Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_process_description_color',
            [
                'label' => __( 'Description Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-card p' => 'color: {{VALUE}}',
                ],
            ]
        );

        

        $this->add_control(
            'fannava_process_list',
            [
                'label' => esc_html__('Process - List', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_process_title' => esc_html__('Discover', 'fannavacore'),
                    ],
                    [
                        'fannava_process_title' => esc_html__('Define', 'fannavacore')
                    ],
                    [
                        'fannava_process_title' => esc_html__('Develop', 'fannavacore')
                    ]
                ],
                'title_field' => '{{{ fannava_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'fannava_process_align',
            [
                'label' => esc_html__( 'Alignment', 'fannavacore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'fannavacore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'fannavacore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'fannavacore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
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
			$this->add_render_attribute('title_args', 'class', 'title');
        ?>	
            <!-- Process Step Area Start -->
            <div class="te-process-step-area style-1">
                <div class="container">
                    <div class="row">
                        <?php if ( !empty($settings['fannava_section_title_show']) ) : ?>
                        <div class="col-12">
                            <div class="te-section-title justify-content-center text-center">
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
                                    endif;?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php foreach ($settings['fannava_process_list'] as $key => $item) : ?> 
                            <!-- Single Service Start !-->
                            <div class="col-12 col-md-6 col-lg-4 elementor-repeater-item-<?php echo $item['_id']; ?>">
                                <div class="te-process-step">
                                    <div class="te-content-wrapper">
                                        <div class="te-counter-wrapper">
                                            <?php if (!empty($item['fannava_process_step' ])): ?>
                                                <span class="counter-number"><?php echo fannava_kses($item['fannava_process_step' ]); ?></span>
                                            <?php endif; ?>
                                            <div class="shape">
                                                <?php if (!empty($item['fannava_step_image']['url'])): ?>  
                                                    <img src="<?php echo $item['fannava_step_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_step_image']['url']), '_wp_attachment_image_alt', true); ?>"> 
                                                <?php endif; ?> 
                                            </div>
                                        </div>
                                        <div class="te-title-wrapper">
                                            <div class="icon">
                                                <?php if($item['fannava_process_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                        <?php fannava_render_icon($item, 'icon', 'selected_icon'); ?>
                                                    <?php endif; ?>   
                                                    <?php else : ?>                                
                                                    <?php if (!empty($item['fannava_icon_image']['url'])): ?>  
                                                        <img src="<?php echo $item['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?> 
                                                <?php endif; ?>
                                            </div>
                                            <?php if (!empty($item['fannava_process_title' ])): ?>
                                                <h3 class="title"><?php echo fannava_kses($item['fannava_process_title' ]); ?></h4>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <?php if (!empty($item['fannava_process_description' ])): ?>
                                                <p class="desc"><?php echo fannava_kses($item['fannava_process_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Service End !-->
                        <?php endforeach; ?>   
                    </div>
                </div>
            </div>
            <!-- Process Step Area End -->
        <?php 
	}
}

$widgets_manager->register( new Fannava_Process() );