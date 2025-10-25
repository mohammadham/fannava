<?php
/**
	* Plugin Name: Fannava Core
	* Description: Fannava core plugin.
	* Plugin URI:  https://themeforest.net/user/themeearth/portfolio
	* Version:     1.0.1
	* Author:      themeearth
	* Author URI:  https://themeforest.net/user/themeearth/portfolio
	* Text Domain: fannavacore
	* Elementor tested up to: 3.5.6
	* Elementor Pro tested up to: 3.5.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;

/**
 * Define
*/
define('FANNAVA_ADDONS_URL', plugins_url('/', __FILE__));
define('FANNAVA_ADDONS_DIR', dirname(__FILE__));
define('FANNAVA_ADDONS_PATH', plugin_dir_path(__FILE__));
define('FANNAVA_ELEMENTS_PATH', FANNAVA_ADDONS_DIR . '/include/elementor');
define('FANNAVA_WIDGET_PATH', FANNAVA_ADDONS_DIR . '/include/widgets');
define('FANNAVA_INCLUDE_PATH', FANNAVA_ADDONS_DIR . '/include');

// $GLOBAL['fannavacore_icons'] = 
/**
 * Include all files
*/

include_once(FANNAVA_ADDONS_DIR . '/include/custom-post-portfolio.php');
include_once(FANNAVA_ADDONS_DIR . '/include/common-functions.php');
include_once(FANNAVA_ADDONS_DIR . '/include/class-ocdi-importer.php');
include_once(FANNAVA_ADDONS_DIR . '/include/allow-svg.php');


/**
 * Fannava Custom Widget
*/
include_once(FANNAVA_WIDGET_PATH . '/fannava-blog-post-sidebar.php');
include_once(FANNAVA_WIDGET_PATH . '/fannava-category-sidebar.php');
include_once(FANNAVA_WIDGET_PATH . '/fannava-tag-sidebar.php');
include_once(FANNAVA_WIDGET_PATH . '/fannava-latest-posts-footer.php');
include_once(FANNAVA_WIDGET_PATH . '/fannava-subscriber-widget.php');
include_once(FANNAVA_WIDGET_PATH . '/fannava-logo-subscriber-widget.php');


/**
 * Main Fannava Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Fannava_Core {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load text domain
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
	
	/**
	 * Load plugin textdomain for translations
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 
			'fannavacore', 
			false, 
			dirname( plugin_basename( __FILE__ ) ) . '/languages/' 
		);
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

	
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'fannavacore' ),
			'<strong>' . esc_html__( 'Fannava Core', 'fannavacore' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'fannavacore' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'fannavacore' ),
			'<strong>' . esc_html__( 'Fannava Core', 'fannavacore' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'fannavacore' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'fannavacore' ),
			'<strong>' . esc_html__( 'Fannava Core', 'fannavacore' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'fannavacore' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

/**
 * Enqueue Fannava Core Styles (RTL & Persian Font)
 */
function fannava_core_enqueue_styles() {
    // فونت شبنم
    wp_enqueue_style( 
        'fannava-shabnam-font', 
        FANNAVA_ADDONS_URL . 'assets/css/shabnam-font.css', 
        array(), 
        '1.0.0' 
    );
    
    // استایل‌های RTL
    wp_enqueue_style( 
        'fannava-core-rtl', 
        FANNAVA_ADDONS_URL . 'assets/css/fannava-rtl.css', 
        array('fannava-shabnam-font'), 
        '1.0.0' 
    );
}
add_action( 'wp_enqueue_scripts', 'fannava_core_enqueue_styles' );
add_action( 'elementor/frontend/after_enqueue_styles', 'fannava_core_enqueue_styles' );

/**
 * Enqueue Elementor Editor Styles
 */
function fannava_core_editor_styles() {
    wp_enqueue_style( 
        'fannava-shabnam-font-editor', 
        FANNAVA_ADDONS_URL . 'assets/css/shabnam-font.css', 
        array(), 
        '1.0.0' 
    );
    
    wp_enqueue_style( 
        'fannava-core-rtl-editor', 
        FANNAVA_ADDONS_URL . 'assets/css/fannava-rtl.css', 
        array(), 
        '1.0.0' 
    );
}
add_action( 'elementor/editor/after_enqueue_styles', 'fannava_core_editor_styles' );

// Instantiate Fannava_Core.
new Fannava_Core();