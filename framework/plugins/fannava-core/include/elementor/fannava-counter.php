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
class Fannava_Counter extends Widget_Base {

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
        return 'fannava-counter';
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
        return __( 'Fannava Counters', 'fannavacore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        /**
         * Image section
         */
		$this->start_controls_section(
            '_fannava_image',
            [
                'label' => esc_html__('Image', 'fannavacore'),
                'condition' => [
                    'fannava_design_style' => 'layout-1',
                ],
            ],
        );
        $this->add_control(
            'fannava_counter_bg_image',
            [
                'label' => esc_html__( 'Background Image', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-1',
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
                ],
                'condition' => [
                    'fannava_design_style' => 'layout-1',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Counter section
         */
        $this->start_controls_section(
            'fannava_counter_section',
            [
                'label' => esc_html__('Counters', 'fannavacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'fannava_counter_title',
            [
                'label' => esc_html__('Counter Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Winning award', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_count_number', [
                'label' => esc_html__('Count Number', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_counter_icon_type',
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
                    'fannava_counter_icon_type' => 'image'
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
                        'fannava_counter_icon_type' => 'icon'
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
                        'fannava_counter_icon_type' => 'icon'
                    ]
                ]
            );
        }
 
        $this->add_control(
            'fannava_counter_list',
            [
                'label' => esc_html__('Counters - List', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_counter_title' => esc_html__('Winning Award', 'fannavacore'),
                    ],
                    [
                        'fannava_counter_title' => esc_html__('Happy Clients', 'fannavacore')
                    ],
                    [
                        'fannava_counter_title' => esc_html__('Completed Project', 'fannavacore')
                    ],
                    [
                        'fannava_counter_title' => esc_html__('Client Review', 'fannavacore')
                    ]
                ],
                'title_field' => '{{{ fannava_counter_title }}}',
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

        <?php if ( $settings['fannava_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'section-title');
        ?>

        <!-- counter section start -->
        <div class="counter-up-area style-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-counter-card">
                            <?php foreach ($settings['fannava_counter_list'] as $key => $item) : ?> 
                                <div class="te-counter-item">
                                    <div class="te-counter-title">
                                        <div class="icon">
                                            <?php if($item['fannava_counter_icon_type'] !== 'image') : ?>
                                                <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                    <?php fannava_render_icon($item, 'icon', 'selected_icon'); ?>
                                                <?php endif; ?>   
                                            <?php else : ?>                                
                                                <?php if (!empty($item['fannava_icon_image']['url'])): ?>  
                                                    <img src="<?php echo $item['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?> 
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <?php if (!empty($item['fannava_counter_title' ])): ?>
                                                <p class="title"><?php echo fannava_kses($item['fannava_counter_title' ]); ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($item['fannava_count_number' ])): ?>
                                            <h2 class="number">
                                                <span class="counter"><?php echo fannava_kses($item['fannava_count_number']);?></span><span>+</span>
                                            </h2>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- counter section end -->

        <?php else: 
            $this->add_render_attribute('title_args', 'class', 'section-title');

            if ( !empty($settings['fannava_counter_bg_image']['url']) ) {
                $fannava_counter_bg_image = !empty($settings['fannava_counter_bg_image']['id']) ? wp_get_attachment_image_url( $settings['fannava_counter_bg_image']['id'], $settings['fannava_image_size_size']) : $settings['fannava_counter_bg_image']['url'];
            }
        ?>
       
        <!-- counter section start -->
        <div class="counter-up-area style-1" style="background-image: url(<?php echo esc_url($fannava_counter_bg_image); ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-counter-card">
                            <?php foreach ($settings['fannava_counter_list'] as $item) : ?> 
                                <div class="te-counter-item">
                                    <div class="te-counter-title">
                                        <div class="icon">
                                            <?php if($item['fannava_counter_icon_type'] !== 'image') : ?>
                                                <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                    <?php fannava_render_icon($item, 'icon', 'selected_icon'); ?>
                                                <?php endif; ?>   
                                            <?php else : ?>                                
                                                <?php if (!empty($item['fannava_icon_image']['url'])): ?>  
                                                    <img src="<?php echo $item['fannava_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fannava_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?> 
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <?php if (!empty($item['fannava_counter_title' ])): ?>
                                                <p class="title"><?php echo fannava_kses($item['fannava_counter_title' ]); ?></p>
                                            <?php endif; ?> 
                                            <h2 class="number">
                                                <span class="counter"><?php echo fannava_kses($item['fannava_count_number']);?></span><span>+</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- counter section end -->
        <?php endif; ?>
        
        <?php 
    }
}

$widgets_manager->register( new Fannava_Counter() );