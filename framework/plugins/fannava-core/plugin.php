<?php
namespace FannavaCore;

use FannavaCore\PageSettings\Page_Settings;
use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Fannava_Core_Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

    public function fannava_core_elementor_category($manager)
    {

        $categories = [];
		$categories['fannavacore'] =
			[
				'title' => __( 'Element Helper ( Fannava )', 'fannavacore' ),
				'icon'  => 'eicon-banner'
			];

		$old_categories = $manager->get_categories();
		$categories = array_merge($categories, $old_categories);

		$set_categories = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $manager, $categories );
		
    }
		
		

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'fannavacore', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'fannavacore-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * fannava_enqueue_editor_scripts
	 */
    function fannava_enqueue_editor_scripts()
    {
        wp_enqueue_style('fannava-element-addons-editor', FANNAVA_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
    }

    

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'fannavacore-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		foreach($this->fannavacore_widget_list() as $widget_file_name){
			require_once( FANNAVA_ELEMENTS_PATH . "/{$widget_file_name}.php" );
		}
	}

	public function fannavacore_widget_list() {
		return [
			'heading',
			'fannava-btn',
			'hero-banner',
			'about',
			'services',
			'team',
			'process',
			'fannava-testimonial',
			'blog-post',
			'contact-form',
			'work-gallery-project',
			'company-benefit',
			'fannava-faq',
			'fannava-counter',
			'team-details',
			'service-details',
			'project-details',
			'home-2-cta',
			'home-1-newsletter',
			'home-2-newsletter',
			'about-talk-to-us',
		];
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}


	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

    public function register_controls(Controls_Manager $controls_Manager)
    {
        include_once(FANNAVA_ADDONS_DIR . '/controls/fannavagradient.php');
        $fannavagradient = 'FannavaCore\Elementor\Controls\Group_Control_FannavaGradient';
        $controls_Manager->add_group_control($fannavagradient::get_type(), new $fannavagradient());

        include_once(FANNAVA_ADDONS_DIR . '/controls/fannavabggradient.php');
        $fannavabggradient = 'FannavaCore\Elementor\Controls\Group_Control_FannavaBGGradient';
        $controls_Manager->add_group_control($fannavabggradient::get_type(), new $fannavabggradient());
    }


    

    public function fannava_add_custom_icons_tab($tabs = array()){

        // Feather icons
        $feather_icons = array(
            'feather-activity',
            'feather-airplay',
            'feather-alert-circle',
            'feather-alert-octagon',
            'feather-alert-triangle',
            'feather-align-center',
            'feather-align-justify',
            'feather-align-left',
            'feather-align-right',
        );

        $tabs['fannava-feather-icons'] = array(
            'name' => 'fannava-feather-icons',
            'label' => esc_html__('Fannava - Feather Icons', 'fannavacore'),
            'labelIcon' => 'fannava-icon',
            'prefix' => '',
            'displayPrefix' => 'fannava',
            'url' => FANNAVA_ADDONS_URL . 'assets/css/feather.css',
            'icons' => $feather_icons,
            'ver' => '1.0.0',
		); 

		// Custom icons
		$custom_icons = array(
			'icon-24-help',
			'icon-chack-mark-solid',
			'icon-angle-arrow-right',
			'icon-angle-arrow-left',
			'icon-arrow-down',
			'icon-arrow-left',
			'icon-arrow-right',
			'icon-arrow-top-right',
			'icon-call',
			'icon-envelope',
			'icon-envelope-solid',
			'icon-facebook',
			'icon-instagram',
			'icon-linkedin',
			'icon-twitter',
			'icon-pinterest',
			'icon-google-plus',
			'icon-location-pin',
			'icon-location-pin-solid',
			'icon-group-icon-3',
			'icon-group-icon-4',
			'icon-group-icon-5',
			'icon-group-icon-6',
			'icon-group-icon-7',
			'icon-group-icon-8',
			'icon-chack-mark',
			'icon-user-group',
			'icon-Outer-Lines',
			'icon-Outer-Lines-1',
			'icon-Outer-Lines-2',
			'icon-Outer-Lines-3',
			'icon-Outer-Lines-4',
			'icon-Outer-Lines-5',
			'icon-Outer-Lines-6',
			'icon-Outline',
			'icon-play',
			'icon-plus',
			'icon-folder',
			'icon-user',
			'icon-user-solid',
			'icon-phone-book',
			'icon-dobble-angle-left',
			'icon-dobble-angle-right',
			'icon-user-stars',
			'icon-quote-right',
			'icon-start',
			'icon-start-solid',
			'icon-paper-plan',
			'icon-paper-plan-solid',
			'icon-calendar',
			'icon-chats',
			'icon-location',
			'icon-search',
		  );
		
		$tabs['fannava-custom-icons'] = array(
			'name' => 'fannava-custom-icons',
			'label' => esc_html__('Fannava - Custom Icons', 'fannavacore'),
			'labelIcon' => 'fannava-icon',
			'prefix' => '',
			'displayPrefix' => 'fannava',
			'url' => FANNAVA_ADDONS_URL . 'assets/css/fannava-customicon.css',
			'icons' => $custom_icons,
			'ver' => '1.0.0',
		); 

		// Font Awesome Pro
        $fontawesome_icons = array(
	        'angle-up',
	        'check',
	        'times',
	        'calendar',
	        'language',
	        'shopping-cart',
	        'bars',
	        'search',
	        'map-marker',
	        'arrow-right',
	        'arrow-left',
	        'arrow-up',
	        'arrow-down',
	        'angle-right',
	        'angle-left',
	        'angle-up',
	        'angle-down',
	        'phone',
	        'users',
	        'user',
	        'map-marked-alt',
	        'trophy-alt',
	        'envelope',
	        'marker',
	        'globe',
	        'broom',
	        'home',
	        'bed',
	        'chair',
	        'bath',
	        'tree',
	        'laptop-code',
	        'cube',
	        'cog',
	        'play',
	        'trophy-alt',
	        'heart',
	        'truck',
	        'user-circle',
	        'map-marker-alt',
	        'comments',
	         'award',
	        'bell',
	        'book-alt',
	        'book-open',
	        'book-reader',
	        'graduation-cap',
	        'laptop-code',
	        'music',
	        'ruler-triangle',
	        'user-graduate',
	        'microscope',
	        'glasses-alt',
	        'theater-masks',
	        'atom'
        );

        $tabs['fannava-fontawesome-icons'] = array(
            'name' => 'fannava-fontawesome-icons',
            'label' => esc_html__('Fannava - Fontawesome Pro Light', 'fannavacore'),
            'labelIcon' => 'fannava-icon',
            'prefix' => 'fa-',
            'displayPrefix' => 'fal',
            'url' => FANNAVA_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
            'icons' => $fontawesome_icons,
            'ver' => '1.0.0',
        );        

        return $tabs;
    }


	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		add_action('elementor/elements/categories_registered', [$this, 'fannava_core_elementor_category']);

		// Register custom controls
	    add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

	    add_filter('elementor/icons_manager/additional_tabs', [$this, 'fannava_add_custom_icons_tab']);

	    // $this->fannava_add_custom_icons_tab();

	    add_action('elementor/editor/after_enqueue_scripts', [$this, 'fannava_enqueue_editor_scripts'] );

		$this->add_page_settings_controls();

	}


}

// Instantiate Plugin Class
Fannava_Core_Plugin::instance();