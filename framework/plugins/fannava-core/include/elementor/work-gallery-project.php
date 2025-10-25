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
class Fannava_Work_Gallery_Project extends Widget_Base {

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
		return 'work-gallery-project-list';
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
		return __( 'Work Gallery/Project', 'fannavacore' );
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

        $layout_array = ["layout-1", "layout-2"];

        
        /**
         * Title and content
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'fannava_design_style' => $layout_array,
                ],
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
       

        <?php if ( $settings['fannava_design_style']  == 'layout-3' ): ?>
      
            <!-- Project Page Start -->
            <div class="project-page-wrapper">
                <div class="container">
                    <div class="row">
                        <?php
                            $post_number = 12;
                            $orderby = 'post__in';
                            $post_order = 'ASC';
                            $content_word_count = 6;

                        if (!empty($cat->term_id)) {
                            $q = new \WP_Query(array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => $post_number,
                                'orderby' => 'menu_order ' . $orderby,
                                'order' => $post_order,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'portfolio-cat',
                                        'field' => 'term_id',
                                        'terms' => array($term_id),
                                        'operator' => 'IN',
                                    ),
                                ),
                                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                            ));
                        } else {
                            $q = new \WP_Query(array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => $post_number,
                                'orderby' => 'menu_order ' . $orderby,
                                'order' => $post_order,
                                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                            ));
                        }

                        if ($q->have_posts()) :
                            
                            while ($q->have_posts()) : $q->the_post(); ?>
                            
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="te-portfolio-card style-3">
                                        <div class="image">
                                            <img src="<?php echo the_post_thumbnail_url(); ?>" alt="Portfolio Image">
                                            <div class="te-content-wrapper">
                                                <div class="content">
                                                    <div class="content-inner">
                                                        <h3 class="title">
                                                            <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                        </h3>
                                                        <span class="sub-title"><?php echo wp_trim_words(get_the_content(), $content_word_count, '');?></span>
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <a href="<?php the_permalink();?>"><i class="fa-solid fa-arrow-up-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            endwhile;

                            wp_reset_postdata();
                        endif;
                        ?>  
                    </div>

                    <?php
                        $big_number = 999999999;
                        echo paginate_links( array(
                        'base' => str_replace( $big_number, '%#%', get_pagenum_link( $big_number ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $q->max_num_pages
                    ) );?>

<!--                    <div class="te-basic-pagination">-->
<!--                        <ul class="justify-content-center">-->
<!--                            <li>-->
<!--                                <span aria-current="page" class="page-numbers current">1</span>-->
<!--                            </li>-->
<!--                            <li><a class="page-numbers" href="#">2</a></li>-->
<!--                            <li><a class="page-numbers" href="#">3</a></li>-->
<!--                            <li><span class="page-numbers dots">…</span></li>-->
<!--                            <li><a class="page-numbers" href="#">5</a></li>-->
<!--                            <li>-->
<!--                                <a class="next page-numbers" href="#"><i class="fa fa-arrow-right"></i></a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->

                </div>
            </div>
            <!-- Project Page Start -->

        <?php elseif ( $settings['fannava_design_style']  == 'layout-2' ): 

            $this->add_render_attribute('title_args', 'class', 'title');

        ?>
            <!-- Portfolio Area Start -->
            <div class="portfolio-area style-2">
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

                    <div class="row">
                        <?php
                            $post_number = 3;
                            $orderby = 'post__in';
                            $post_order = 'ASC';
                            $content_word_count = 6;

                        if (!empty($cat->term_id)) {
                            $q = new \WP_Query(array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => $post_number,
                                'orderby' => 'menu_order ' . $orderby,
                                'order' => $post_order,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'portfolio-cat',
                                        'field' => 'term_id',
                                        'terms' => array($term_id),
                                        'operator' => 'IN',
                                    ),
                                ),
                            ));
                        } else {
                            $q = new \WP_Query(array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => $post_number,
                                'orderby' => 'menu_order ' . $orderby,
                                'order' => $post_order,
                            ));
                        }

                        if ($q->have_posts()) :
                            
                            while ($q->have_posts()) : $q->the_post(); ?>
                            
                                    <div class="col-lg-4 col-sm-6 col-xs-12">
                                        <div class="te-portfolio-card style-3">
                                            <div class="image">
                                                <img src="<?php echo the_post_thumbnail_url(); ?>" alt="Portfolio Image">
                                                <div class="te-content-wrapper">
                                                    <div class="content">
                                                        <div class="content-inner">
                                                            <h3 class="title">
                                                                <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                            </h3>
                                                            <span class="sub-title"><?php echo wp_trim_words(get_the_content(), $content_word_count, '');?></span>
                                                        </div>
                                                        <div class="btn-wrapper">
                                                            <a href="<?php the_permalink();?>"><i class="fa-solid fa-arrow-up-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>  
                    </div>
                </div>
            </div>
            <!-- Portfolio Area End -->  

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'title');
		?>

            <!-- Portfolio Area Start -->
            <div class="portfolio-area style-1">
                <div class="container">
                    <div class="row">
                        <?php
                        $post_number = -1;
                        $orderby = 'post__in';
                        $post_order = 'ASC';

                        $args = array(
                            'posts_per_page' => $post_number,
                            'post_type' => 'portfolio',
                            'orderby' => 'menu_order ' . $orderby,
                            'order' => $post_order
                        );

                        $filteArr = array();
                        $postArr = new \WP_Query($args);

                        if (is_array($postArr->posts) && !empty($postArr->posts)) {

                            foreach ($postArr->posts as $item) {
                                $taxsArr = wp_get_post_terms($item->ID, 'portfolio-cat', array("fields" => "all"));
                                if (is_array($taxsArr) && !empty($taxsArr)) {
                                    foreach ($taxsArr as $tax) {
                                        $filteArr[$tax->slug] = $tax->name;
                                    }
                                }
                            }
                        }
                        ?>

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
                            <?php
                            if (is_array($filteArr) && !empty($filteArr)) : ?>
                                <ul class="te-portfolio-filter">
                                    <li class="active" data-filter="*">All</li>
                                    <?php
                                        foreach ($filteArr as $tax_slug => $tax_name) { ?>
                                            <li data-filter=".<?php print esc_attr($tax_slug); ?>"><?php print esc_html($tax_name); ?></li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            <?php endif; ?>
                        </div>  
                    </div>

                    <div class="row te-portfolio-isotope-wrapper">

                        <?php
                        if (!empty($cat->term_id)) {
                            $q = new \WP_Query(array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => $post_number,
                                'orderby' => 'menu_order ' . $orderby,
                                'order' => $post_order,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'portfolio-cat',
                                        'field' => 'term_id',
                                        'terms' => array($term_id),
                                        'operator' => 'IN',
                                    ),
                                ),
                            ));
                        } else {
                            $q = new \WP_Query(array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => $post_number,
                                'orderby' => 'menu_order ' . $orderby,
                                'order' => $post_order,
                            ));
                        }

                        if ($q->have_posts()) :
                            
                            while ($q->have_posts()) : $q->the_post();
                                $item_classes = '';
                                $item_cats = get_the_terms(get_the_id(), 'portfolio-cat');
                                if ($item_cats) :
                                    foreach ($item_cats as $item_cat) {
                                        $item_classes .= $item_cat->slug . ' ';
                                    }
                                endif;
                                ?>
                                    <div class="col-lg-4 col-sm-6 te-single-isotop <?php print esc_attr($item_classes); ?>">
                                        <div class="te-portfolio-card style-2">
                                            <div class="image">
                                                <img src="<?php echo the_post_thumbnail_url(); ?>" alt="Portfolio Image">
                                                <div class="te-content-wrapper">
                                                    <div class="content">
                                                        <div class="btn-wrapper">
                                                            <a href="<?php the_permalink();?>"><i class="fa-solid fa-arrow-up-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            endwhile;
                            
                        else : ?>
                            <p class="text-center"><?php _e( 'Sorry, no project found.' ); ?></p>
                        <?php
                        endif;
                        wp_reset_postdata();
                        ?>  
                    </div>
                </div>
            </div>
            <!-- Portfolio Area End -->  

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Fannava_Work_Gallery_Project() );