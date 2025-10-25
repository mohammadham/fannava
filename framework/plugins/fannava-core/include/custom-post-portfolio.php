<?php 
class FannavaPortfolioPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'portfolio_template_include' ) );
	}
	
	public function portfolio_template_include( $template ) {
		if ( is_singular( 'portfolio' ) ) {
			return $this->get_template( 'single-portfolio.php');
		}
		return $template;
	}
	
	public function get_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = FANNAVA_ADDONS_DIR . '/include/template/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}
	
	
	public function register_custom_post_type() {
        $labels = array(
            'name'               => __( 'Portfolios', 'Post Type General Name', 'fannava-core'),
            'singular_name'      => __( 'Portfolio', 'Post Type Singular Name', 'fannava-core'),
            'menu_name'          => __( 'Portfolios', 'fannava-core'),
            'parent_item_colon'  => __( 'Parent Portfolio', 'fannava-core'),
            'all_items'          => __( 'All  Portfolios', 'fannava-core'),
            'view_item'          => __( 'View  Portfolios', 'fannava-core'),
            'add_new_item'       => __( 'Add New  Portfolio', 'fannava-core'),
            'add_new'            => __( 'Add New  Portfolio', 'fannava-core'),
            'edit_item'          => __( 'Edit  Portfolio', 'fannava-core'),
            'update_item'        => __( 'Update  Portfolios', 'fannava-core'),
            'search_items'       => __( 'Search  Portfolios', 'fannava-core'),
            'not_found'          => __( 'Not found', 'fannava-core'),
            'not_found_in_trash' => __( 'Not found in Trash', 'fannava-core'),
        );

		$args   = array(
            'label'               => __( 'Portfolios', 'fannava-core'),
            'description'         => __( 'Create and manage all bdevs portfolio', 'fannava-core'),
            'labels'              => $labels,
            'supports'            => array( 'title','thumbnail', 'editor'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 14,
            'rewrite'             =>  array( 'slug' => 'portfolio-post', 'with_front' => false ),
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'menu_icon'           => 'dashicons-awards',
		);

		register_post_type( 'portfolio', $args );
	}

	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Portfolio Categories', 'Taxonomy General Name', 'fannava-core' ),
			'singular_name'              => esc_html_x( 'Portfolio Categories', 'Taxonomy Singular Name', 'fannava-core' ),
			'menu_name'                  => esc_html__( 'Portfolio Categories', 'fannava-core' ),
			'all_items'                  => esc_html__( 'All Portfolio Category', 'fannava-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'fannava-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'fannava-core' ),
			'new_item_name'              => esc_html__( 'New Portfolio Category Name', 'fannava-core' ),
			'add_new_item'               => esc_html__( 'Add New Portfolio Category', 'fannava-core' ),
			'edit_item'                  => esc_html__( 'Edit Portfolio Category', 'fannava-core' ),
			'update_item'                => esc_html__( 'Update Portfolio Category', 'fannava-core' ),
			'view_item'                  => esc_html__( 'View Portfolio Category', 'fannava-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'fannava-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'fannava-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'fannava-core' ),
			'popular_items'              => esc_html__( 'Popular Portfolio Category', 'fannava-core' ),
			'search_items'               => esc_html__( 'Search Portfolio Category', 'fannava-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'fannava-core' ),
			'no_terms'                   => esc_html__( 'No Portfolio Category', 'fannava-core' ),
			'items_list'                 => esc_html__( 'Portfolio Category list', 'fannava-core' ),
			'items_list_navigation'      => esc_html__( 'Portfolio Category list navigation', 'fannava-core' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('portfolio-cat','portfolio', $args );
	}

}

new FannavaPortfolioPost();