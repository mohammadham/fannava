<?php
namespace FannavaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fannava Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Fannava_Blog_Post extends Widget_Base {

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
		return 'blogpost';
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
		return __( 'Blog Post', 'fannavacore' );
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
            'fannava_post_',
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
        $this->add_control(
            'fannava_post__height',
            [
                'label' => esc_html__( 'Height', 'fannavacore' ),
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
                    '{{WRAPPER}} .fannava-project-img img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'fannava-post-thumb',
            ]
        );
        $this->add_control(
            'fannava_post__pagination',
            [
                'label' => esc_html__( 'Pagination', 'fannavacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'fannavacore' ),
                'label_off' => esc_html__( 'Hide', 'fannavacore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => array(
                    'fannava_design_style' => 'layout-1!',
                ),
            ]
        );

        $this->end_controls_section();
               

        /**
         * Title and content
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
                    '{{WRAPPER}} .fannava-sec-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();

        /**
         * Button
         */
        $this->start_controls_section(
            'fannava_btn_button_group',
            [
                'label' => esc_html__('Button', 'fannavacore'),
            ]
        );

        $this->add_control(
            'fannava_button_show',
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
                    'fannava_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'fannava_all_blog_btn_text',
            [
                'label' => esc_html__('All Blog Button Text', 'fannavacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Blog Button Text', 'fannavacore'),
                'title' => esc_html__('Enter all blog button text', 'fannavacore'),
                'label_block' => true,
                'condition' => array(
                    'fannava_button_show' => 'yes',
                    'fannava_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_control(
            'fannava_all_blog_btn_link',
            [
                'label' => esc_html__('All Blog Button link', 'fannavacore'),
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
                'condition' => array(
                    'fannava_button_show' => 'yes',
                    'fannava_design_style' => 'layout-1',
                ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        
        /**
         * Blog query section
         */
		$this->start_controls_section(
            'fannava_post_query',
            [
                'label' => esc_html__('Blog Query', 'fannavacore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'fannavacore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'fannavacore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'fannavacore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'fannavacore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => fannava_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'fannavacore'),
                'description' => esc_html__('Select a category to exclude', 'fannavacore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => fannava_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'fannavacore'),
                'type' => Controls_Manager::SELECT2,
                'options' => fannava_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'fannavacore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'fannavacore'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
			    ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'fannavacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'fannavacore' ),
                    'desc' 	=> esc_html__( 'Descending', 'fannavacore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'fannavacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'fannavacore' ),
                'label_off' => esc_html__( 'No', 'fannavacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'fannava_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'fannavacore'),
                'description' => esc_html__('Set how many word you want to display!', 'fannavacore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'fannava_post_content',
            [
                'label' => __('Content', 'fannavacore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fannavacore'),
                'label_off' => __('Hide', 'fannavacore'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'fannava_post_content_limit',
            [
                'label' => __('Content Limit', 'fannavacore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'fannava_post_content' => 'yes'
                ]
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

		if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args); ?>

        <?php if ( $settings['fannava_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>
 
             <!-- Latest Posts Area Start -->
            <div class="latest-posts-area style-1">
                <div class="container">
                    <!-- Section Title Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="te-section-title justify-content-center text-center">
                                <div class="te-section-content">
                                    <div>
                                        <?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
                                            <span class="short-title"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
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
                        </div>
                    </div>
                    <!-- Section Title End -->
                    <div class="row">
                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;
                                $categories = get_the_category($post->ID);
                            ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="te-post-card style-2">
                                        <div class="image">
                                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                <img src="<?php the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>" alt="Post image"/>
                                            <?php endif; ?>
                                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                <div class="te-post-date">
                                                    <span><?php echo get_the_date('d M Y')?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <div class="te-post-meta-info">
                                                <div class="te-single-meta">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-user"></i>
                                                    </span>
                                                    <span class="text">By <?php echo get_the_author(); ?></span>
                                                </div>
                                                <div class="te-single-meta">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-comments"></i>
                                                    </span>
                                                    <span class="text">Comments (<?php echo get_comments_number(); ?>)</span>
                                                </div>
                                            </div>
                                            <h3 class="title">
                                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['fannava_blog_title_word'], ''); ?></a>
                                            </h3>
                                            <div class="te-post-content">
                                                <?php if (!empty($settings['fannava_post_content'])):
                                                    $fannava_post_content_limit = (!empty($settings['fannava_post_content_limit'])) ? $settings['fannava_post_content_limit'] : ''; ?>
                                                    <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $fannava_post_content_limit, ''); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (!empty($settings['fannava_btn_text'])):?>
                                                <a class="read-btn" href="<?php the_permalink(); ?>"><?php echo fannava_kses($settings['fannava_btn_text']); ?> <i class="fa-solid fa-arrow-right"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_query(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Latest Posts Area End -->
    
        <?php else:
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <!-- Latest Posts Area Start -->
            <div class="latest-posts-area style-1 background-gradient">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="te-section-title justify-content-center text-center">
                                <div class="te-section-content">
                                    <div>
                                        <?php if ( !empty($settings['fannava_sub_title']) ) : ?>    
                                            <span class="short-title"><?php echo fannava_kses( $settings['fannava_sub_title'] ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( !empty($settings['fannava_title' ]) ) :
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
                    <div class="row">
                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;
                                $categories = get_the_category($post->ID);
                            ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="te-post-card style-1">
                                        <div class="image">
                                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                <img src="<?php the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>" alt="Post image"/>
                                            <?php endif; ?>
                                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                <div class="te-post-date">
                                                    <span><?php echo get_the_date('d M Y')?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <div class="te-post-meta-info">
                                                <div class="te-single-meta">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-user"></i>
                                                    </span>
                                                    <span class="text">By <?php echo get_the_author(); ?></span>
                                                </div>
                                                <div class="te-single-meta">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-comments"></i>
                                                    </span>
                                                    <span class="text">Comments (<?php echo get_comments_number(); ?>)</span>
                                                </div>
                                            </div>
                                            <h3 class="title">
                                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['fannava_blog_title_word'], ''); ?></a>
                                            </h3>
                                            <?php if (!empty($settings['fannava_post_content'])):
                                                $fannava_post_content_limit = (!empty($settings['fannava_post_content_limit'])) ? $settings['fannava_post_content_limit'] : '';?>
                                                <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $fannava_post_content_limit, ''); ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['fannava_btn_text'])):?>
                                                <a class="read-btn" href="<?php the_permalink(); ?>"><?php echo fannava_kses($settings['fannava_btn_text']); ?> <i class="fa-solid fa-arrow-right"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_query(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Latest Posts Area End -->

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new Fannava_Blog_Post() );