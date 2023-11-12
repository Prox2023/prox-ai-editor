<?php
/**
 * Plugin Name: Prox AI Editor.
 * Description: An assistant for reviewing your text and giving you suggestions.
 * Version: 1.0
 * Author: Marcel Santing
 * Author URI: https://prox-web.nl
 * Text Domain: prox-ai-editor
 * Domain Path: /languages
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package Prox_Ai_Editor
 */

/**
 * The main class for the Prox Ai Editor.
 *
 * @package Prox_Ai_Editor
 * @since 1.0
 * @version 1.0
 * @Author Marcel Santing
 * @Email marcel@prox-web.nl
 */
class ProxAiEditor {

	/**
	 * The instance of the Prox Ai Editor.
	 *
	 * @var $instance ProxAiEditor The single instance of the class
	 */
	private static $instance;

	/**
	 * The constructor for the Prox Ai Editor.
	 */
	public function __construct() {
	}


	/**
	 * Returns the instance of the Prox Ai Editor
	 *
	 * @return ProxAiEditor
	 */
	public static function instance(): ProxAiEditor {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ProxAiEditor ) ) {
			self::$instance = new ProxAiEditor();
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->init_hooks();
		}
		return self::$instance;
	}

	/**
	 * Sets up the constants for the Prox Ai Editor
	 *
	 * @since 1.0
	 * @version 1.0
	 * @return void
	 */
	private function setup_constants() {
		if ( ! defined( 'PROX_AI_EDITOR_VERSION' ) ) {
			define( 'PROX_AI_EDITOR_VERSION', '1.0' );
		}
		if ( ! defined( 'PROX_AI_EDITOR_FILE' ) ) {
			define( 'PROX_AI_EDITOR_FILE', __FILE__ );
		}
		if ( ! defined( 'PROX_AI_EDITOR_PATH' ) ) {
			define( 'PROX_AI_EDITOR_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'PROX_AI_EDITOR_URL' ) ) {
			define( 'PROX_AI_EDITOR_URL', plugin_dir_url( __FILE__ ) );
		}
	}

	/**
	 * Includes the files for the Prox Ai Editor.
	 *
	 * @since 1.0
	 * @version 1.0
	 * @return void
	 */
	private function includes() {
		require_once PROX_AI_EDITOR_PATH . 'functions.php';
		require_once PROX_AI_EDITOR_PATH . 'class-prox-admin.php';
	}

	/**
	 * Initializes the hooks for the Prox Ai Editor.
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'admin_menu', array( $this, 'prox_ai_settings_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_prox_ai_scripts' ) );
	}

	/**
	 * Adds the settings page for Prox Ai.
	 *
	 * @return void
	 */
	public function prox_ai_settings_page() {
		add_options_page(
			'Prox AI Editor Setting', // Page title.
			'Prox Settings',     // Menu title.
			'manage_options',     // Capability.
			'prox-ai-settings',     // Menu slug.
			array( $this, 'display_prox_settings' ) // Callback function.
		);
	}

	/**
	 * Displays the setting page for Prox Ai
	 *
	 * @return void
	 */
	public function display_prox_settings() {
		// HTML and PHP code to display your settings.
		echo '<div id="prox-ai-editor-app" class="prox-wrap"></div>';
	}

	/**
	 * Load scripts and styles for the Prox AI settings page.
	 */
	public function load_prox_ai_scripts( $hook ) {
		// Check if we're on the Prox AI settings page.
		if ( 'settings_page_prox-ai-settings' !== $hook ) {
			return;
		}

		// Enqueue React and CSS assets.
		wp_enqueue_script( 'prox-ai-react-app', PROX_AI_EDITOR_URL . 'dist/bundle.js', array(), PROX_AI_EDITOR_VERSION, true );
		wp_enqueue_style( 'prox-ai-styles', PROX_AI_EDITOR_URL . 'dist/main.css', array(), PROX_AI_EDITOR_VERSION );
	}
}

/**
 * Returns the instance of the Prox Ai Editor.
 *
 * @return ProxAiEditor
 */
function PROX(): ProxAiEditor {
	return ProxAiEditor::instance();
}
add_action( 'plugins_loaded', 'PROX', 8 );
