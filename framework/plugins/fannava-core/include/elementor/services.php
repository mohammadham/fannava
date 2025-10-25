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
class Fannava_Services extends Widget_Base {

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
        return 'services';
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
        return __( 'Services', 'fannavacore' );
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
        

        /**
         * Service section
         */
        $this->start_controls_section(
            'fannava_services',
            [
                'label' => esc_html__('Services List', 'fannavacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'fannavacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'fannava_service_bg_color',
            [
                'label' => esc_html__('Background Color', 'fannavacore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .te-info-card' => 'background-color: {{VALUE}}',
                ],
            ]
        );
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
            'fannava_service_title', [
                'label' => esc_html__('Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_service_title_color',
            [
                'label' => __( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .te-info-card .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'fannava_service_description',
            [
                'label' => esc_html__('Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fannava_service_description_color',
            [
                'label' => __( 'Description Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .te-info-card .desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'fannava_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'fannavacore' ),
                'label_off' => esc_html__( 'No', 'fannavacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'fannava_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'fannavacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'fannavacore'),
                'title' => esc_html__('Enter button text', 'fannavacore'),
                'label_block' => true,
                'condition' => [
                    'fannava_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'fannava_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'fannava_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'fannava_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'fannavacore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'fannava_services_link_type' => '1',
                    'fannava_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'fannava_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'fannavacore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => fannava_get_all_pages(),
                'condition' => [
                    'fannava_services_link_type' => '2',
                    'fannava_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'fannava_service_list',
            [
                'label' => esc_html__('Services - List', 'fannavacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fannava_service_title' => esc_html__('Business Stratagy', 'fannavacore'),
                    ],
                    [
                        'fannava_service_title' => esc_html__('Website Development', 'fannavacore')
                    ],
                    [
                        'fannava_service_title' => esc_html__('Marketing & Reporting', 'fannavacore')
                    ]
                ],
                'title_field' => '{{{ fannava_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'fannava_service_align',
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

        <?php if ( $settings['fannava_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>
            <!-- Feature Area Start-->
            <div class="feature-area style-1">
                <div class="container">
                    <div class="feature-area-wrapper">
                        <!-- Section Title Start -->
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
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                        <!-- Section Title End -->
                        <div class="row">
                            <?php
                            foreach ($settings['fannava_service_list'] as $key => $item) :
                                // Link
                                if ('2' == $item['fannava_services_link_type']) {
                                    $link = get_permalink($item['fannava_services_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['fannava_services_link']['url']) ? $item['fannava_services_link']['url'] : '';
                                    $target = !empty($item['fannava_services_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['fannava_services_link']['nofollow']) ? 'nofollow' : '';
                                }
                            ?> 
                                <!-- single Service start -->
                                <div class="col-md-6 col-lg-4 elementor-repeater-item-<?php echo $item['_id']; ?>">
                                    <div class="te-info-card style-2">
                                        <div class="te-info-card-inner">
                                            <div class="image">
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
                                            <div class="te-content-wrapper">
                                                <div class="te-title-wrapper">
                                                    <?php if (!empty($item['fannava_service_title' ])): ?>
                                                        <h2 class="title">
                                                            <a href="<?php echo esc_url($link); ?>"><?php echo fannava_kses($item['fannava_service_title' ]); ?></a>
                                                        </h2>
                                                    <?php endif; ?> 
                                                </div>
                                                <div class="content">
                                                    <?php if (!empty($item['fannava_service_description' ])): ?>
                                                        <p class="desc"><?php echo fannava_kses($item['fannava_service_description']); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (!empty($link)) : ?>
                                                    <div class="te-read-more">
                                                        <a class="te-theme-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                                            <?php echo fannava_kses($item['fannava_services_btn_text']); ?> <i class="fa fa-solid fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                           
                                </div>
                                <!-- single Service end -->
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feature Area End !-->

        <?php else: 
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>
            <!-- Feature Area Start-->
            <div class="feature-area style-2">
                <div class="container">
                    <div class="feature-area-wrapper">
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
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                        <?php foreach ($settings['fannava_service_list'] as $key => $item) :
                                // Link
                                if ('2' == $item['fannava_services_link_type']) {
                                    $link = get_permalink($item['fannava_services_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['fannava_services_link']['url']) ? $item['fannava_services_link']['url'] : '';
                                    $target = !empty($item['fannava_services_link']['is_external']) ? '_blank' : '_self';
                                    $rel = !empty($item['fannava_services_link']['nofollow']) ? 'nofollow' : '';
                                } 
                            ?>
                                <!-- single te-info-card start -->
                                <div class="col-md-6 col-lg-4 elementor-repeater-item-<?php echo $item['_id']; ?>" >
                                    <div class="te-info-card style-1 red-100">
                                        <div class="te-info-card-inner">
                                            <div class="te-content-wrapper">
                                                <div class="te-title-wrapper">
                                                    <div class="icon">
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
                                                    <?php if (!empty($item['fannava_service_title' ])): ?>
                                                        <?php if ($item['fannava_services_link_switcher'] == 'yes') : ?>
                                                            <h3 class="title">
                                                                <a href="<?php echo esc_url($link); ?>"><?php echo fannava_kses($item['fannava_service_title' ]); ?></a>
                                                            </h3>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <div class="divider"></div>
                                                </div>
                                                <div class="content">
                                                    <?php if (!empty($item['fannava_service_description' ])): ?>
                                                        <p class="desc"><?php echo fannava_kses($item['fannava_service_description']); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (!empty($link)) : ?>
                                                        <div class="te-read-more">
                                                            <a class="te-theme-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                                                <?php echo fannava_kses($item['fannava_services_btn_text']); ?> <i class="fa fa-solid fa-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single te-info-card End-->
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feature Area End !-->

        <?php endif; ?>

        <?php 
    }
}

$widgets_manager->register( new Fannava_Services() );