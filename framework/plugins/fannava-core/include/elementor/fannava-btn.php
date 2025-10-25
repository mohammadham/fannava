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
class Fannava_Btn extends Widget_Base {

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
		return 'fannava-btn';
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
		return __( 'Button', 'fannavacore' );
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

        // layout Panel
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

        <?php if (!empty($settings['fannava_btn_text'])) : ?>
            <a <?php echo $this->get_render_attribute_string( 'fannava-button-arg' ); ?>>
                <?php echo $settings['fannava_btn_text']; ?>
            </a>
        <?php endif; ?>

		<?php else: 
            // Link
            if ('2' == $settings['fannava_btn_link_type']) {
                $this->add_render_attribute('fannava-button-arg', 'href', get_permalink($settings['fannava_btn_page_link']));
                $this->add_render_attribute('fannava-button-arg', 'target', '_self');
                $this->add_render_attribute('fannava-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('fannava-button-arg', 'class', 'link-anime v1');
            } else {
                if ( ! empty( $settings['fannava_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'fannava-button-arg', $settings['fannava_btn_link'] );
                    $this->add_render_attribute('fannava-button-arg', 'class', 'link-anime v1');
                }
            }
		?>	

        <?php if (!empty($settings['fannava_btn_text'])) : ?>
            
            <a <?php echo $this->get_render_attribute_string( 'fannava-button-arg' ); ?>>
                <?php echo $settings['fannava_btn_text']; ?>
            </a>
    
        <?php endif; ?>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Fannava_Btn() );