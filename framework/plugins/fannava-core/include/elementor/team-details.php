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
class Fannava_Team_Details extends Widget_Base {

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
		return 'team-details';
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
		return __( 'Team Details', 'fannavacore' );
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

    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'fannavacore'),
            'apple' => esc_html__('Apple', 'fannavacore'),
            'behance' => esc_html__('Behance', 'fannavacore'),
            'bitbucket' => esc_html__('BitBucket', 'fannavacore'),
            'codepen' => esc_html__('CodePen', 'fannavacore'),
            'delicious' => esc_html__('Delicious', 'fannavacore'),
            'deviantart' => esc_html__('DeviantArt', 'fannavacore'),
            'digg' => esc_html__('Digg', 'fannavacore'),
            'dribbble' => esc_html__('Dribbble', 'fannavacore'),
            'email' => esc_html__('Email', 'fannavacore'),
            'facebook' => esc_html__('Facebook', 'fannavacore'),
            'flickr' => esc_html__('Flicker', 'fannavacore'),
            'foursquare' => esc_html__('FourSquare', 'fannavacore'),
            'github' => esc_html__('Github', 'fannavacore'),
            'houzz' => esc_html__('Houzz', 'fannavacore'),
            'instagram' => esc_html__('Instagram', 'fannavacore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'fannavacore'),
            'linkedin' => esc_html__('LinkedIn', 'fannavacore'),
            'medium' => esc_html__('Medium', 'fannavacore'),
            'pinterest' => esc_html__('Pinterest', 'fannavacore'),
            'product-hunt' => esc_html__('Product Hunt', 'fannavacore'),
            'reddit' => esc_html__('Reddit', 'fannavacore'),
            'slideshare' => esc_html__('Slide Share', 'fannavacore'),
            'snapchat' => esc_html__('Snapchat', 'fannavacore'),
            'soundcloud' => esc_html__('SoundCloud', 'fannavacore'),
            'spotify' => esc_html__('Spotify', 'fannavacore'),
            'stack-overflow' => esc_html__('StackOverflow', 'fannavacore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'fannavacore'),
            'tumblr' => esc_html__('Tumblr', 'fannavacore'),
            'twitch' => esc_html__('Twitch', 'fannavacore'),
            'twitter' => esc_html__('Twitter', 'fannavacore'),
            'vimeo' => esc_html__('Vimeo', 'fannavacore'),
            'vk' => esc_html__('VK', 'fannavacore'),
            'website' => esc_html__('Website', 'fannavacore'),
            'whatsapp' => esc_html__('WhatsApp', 'fannavacore'),
            'wordpress' => esc_html__('WordPress', 'fannavacore'),
            'xing' => esc_html__('Xing', 'fannavacore'),
            'yelp' => esc_html__('Yelp', 'fannavacore'),
            'youtube' => esc_html__('YouTube', 'fannavacore'),
        ];
    }


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
                'label' => esc_html__( 'Profile Image', 'fannavacore' ),
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
         * Title and content section
         */
        $this->start_controls_section(
            'fannava_section_title',
            [
                'label' => esc_html__('Title & Content', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_name',
            [
                'label' => esc_html__('Name', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Chriastion Pershion', 'fannavacore'),
                'placeholder' => esc_html__('Type name', 'fannavacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fannava_name_color',
            [
                'label' => __( 'Name Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-details .info-title h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'fannava_job_title',
            [
                'label' => esc_html__('Job Title', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Fannava Job Title', 'fannavacore'),
                'placeholder' => esc_html__('Type Job Title Text', 'fannavacore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fannava_job_title_color',
            [
                'label' => __( 'Job Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-details .info-title h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fannava_short_desctiption',
            [
                'label' => esc_html__('Short Description', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Fannava short description here', 'fannavacore'),
                'placeholder' => esc_html__('Type short section description here', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_short_desctiption_color',
            [
                'label' => __( 'Short Description Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-details .info-title p' => 'color: {{VALUE}}',
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
         * Social profile section
         */
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'fannavacore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'fannavacore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'fannavacore'),
                'placeholder' => esc_html__('Add your profile link', 'fannavacore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ],
                    [
                        'link' => ['url' => 'https://instagram.com/'],
                        'name' => 'instagram'
                    ],
                    [
                        'link' => ['url' => 'https://youtube.com/'],
                        'name' => 'youtube'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'fannavacore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'fannavacore'),
                'label_off' => esc_html__('Hide', 'fannavacore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

 
        /**
         * Skill bar
         */
        $this->start_controls_section(
            'fannava_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_skill_heading',
            [
                'label' => esc_html__('Skill Heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Fannava Skill Heading', 'fannavacore'),
                'placeholder' => esc_html__('Type skill heading', 'fannavacore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fannava_skill_heading_color',
            [
                'label' => __( 'Skill Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-details .team-description h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Name', 'fannavacore' ),
                'default' => esc_html__( 'Design', 'fannavacore' ),
                'placeholder' => esc_html__( 'Type a skill name', 'fannavacore' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => esc_html__( 'Level (Out Of 100)', 'fannavacore' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__( 'Want To Customize?', 'fannavacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'fannavacore' ),
                'label_off' => esc_html__( 'No', 'fannavacore' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this skill bar color from here or customize from Style tab', 'fannavacore' ),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'percentage_color',
            [
                'label' => esc_html__( 'Percentage label Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .percentage' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_group_control(
            Group_Control_FannavaBGGradient::get_type(),
            [
                'name' => 'level_color',
                'label' => esc_html__('Level Color', 'fannavacore'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress-bar',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => esc_html__( 'Base Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .progress' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'The Walt Disney Company',
                        'level' => ['size' => 45, 'unit' => '%']
                    ],
                    [
                        'name' => 'Louis Vuitton',
                        'level' => ['size' => 80, 'unit' => '%']
                    ],
                    [
                        'name' => 'The Walt Disney Company',
                        'level' => ['size' => 45, 'unit' => '%']
                    ],
                    [
                        'name' => 'Louis Vuitton',
                        'level' => ['size' => 80, 'unit' => '%']
                    ]
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Awards section
         */
        $this->start_controls_section(
            'fannava_awards_section_title',
            [
                'label' => esc_html__('Honors & Awards', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_awards_heading',
            [
                'label' => esc_html__('Awards Heading', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Honors & Awards', 'fannavacore'),
                'placeholder' => esc_html__('Type awards heading', 'fannavacore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fannava_awards_heading_color',
            [
                'label' => __( 'Awards Heading Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-details .team-description h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fannava_awards_text',
            [
                'label' => esc_html__('Awards Text', 'fannavacore'),
                'description' => fannava_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Eros justo, posuere loborti viverra laoreet matti ullamcorper posuere viverra .Aliquam eros just posuere lobortis, viverra laoreet augue mattis fermentum ullamcorper viverra laoreet Aliquam eros justo, posuere loborti viverra laoreet matti ullamcorper posuere viverra', 'fannavacore'),
                'placeholder' => esc_html__('Type awards text', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_awards_text_color',
            [
                'label' => __( 'Awards Text Color', 'fannavacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-details .team-description p' => 'color: {{VALUE}}',
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
            $this->add_render_attribute('title_args', 'class', 'title');

        ?>

        <!-- Team Details Page Start !-->
        <div class="team-details-page">       
            <div class="container">
                <div class="row">
                    <!-- Team Details Content Start -->
                    <div class="col-12">
                        <div class="team-details-wrapper">
                            <div class="team-details">
                                <div class="image">
                                <?php if ($settings['fannava_image']['url'] || $settings['fannava_image']['id']) : ?>  
                                    <img src="<?php echo esc_url($fannava_image); ?>" alt="<?php echo esc_attr($fannava_image_alt); ?>">
                                <?php endif; ?>
                                </div>  
                                <div class="content">
                                    <div class="user-meta">
                                        <?php
                                        if ( !empty($settings['fannava_name' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['fannava_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                fannava_kses( $settings['fannava_name' ] )
                                                );
                                        endif;
                                        ?>
                                        <?php if ( !empty($settings['fannava_job_title']) ) : ?>    
                                            <p class="desc"><?php echo fannava_kses( $settings['fannava_job_title'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                                        <div class="social">
                                            <?php
                                            foreach ($settings['profiles'] as $profile) :
                                                $icon = esc_attr($profile['name']);
                                                $url = esc_url($profile['link']['url']);
                                                ?>
                                                <a href="<?php echo $url;?>"><i class="fa-brands fa-<?php echo $icon;?>"></i></a>
                                            <?php
                                            endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="short-desc">
                                        <?php if ( !empty($settings['fannava_short_desctiption']) ) : ?>
                                            <p><?php echo fannava_kses( $settings['fannava_short_desctiption'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="team-details-overview-wrapper">
                                <?php if ( !empty($settings['fannava_skill_heading']) ) : ?>    
                                    <h3 class="sec-title"><?php echo fannava_kses( $settings['fannava_skill_heading'] ); ?></h3>
                                <?php endif; ?>
                                <div class="team-details-overview">
                                    <div class="skill-progressbar-wrapper">
                                        <?php foreach ( $settings['skills'] as $index => $skill ) : ?>
                                            <div class="skill-progressbar">
                                                <div class="progress-inner" data-percentage="<?php echo esc_attr( $skill['level']['size'] ); ?>%">
                                                    <h4 class="progress-inner-item">
                                                        <span class="skill-title"><?php echo esc_html( $skill['name'] ); ?></span>
                                                        <span class="progressbar-number">
                                                            <span class="progress-number-count">
                                                                <span class="progress-percent"></span>
                                                            </span>
                                                        </span>
                                                    </h4>
                                                    <div class="progress-content-outter">
                                                        <div class="progress-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="content">
                                        <?php if ( !empty($settings['fannava_awards_heading']) ) : ?>    
                                            <h3 class="sec-title"><?php echo fannava_kses( $settings['fannava_awards_heading'] ); ?></h3>
                                        <?php endif; ?>
                                        <?php if ( !empty($settings['fannava_awards_text']) ) : ?>
                                            <p><?php echo fannava_kses( $settings['fannava_awards_text'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Team Details Content End -->
                </div>
            </div>
        </div>
        <!-- Team Details Page End !-->

		<?php
	}

}

$widgets_manager->register( new Fannava_Team_Details() );