<?php

namespace Gform_Toggle;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new GForm_Toggle/Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

/**
 * Main GForm_Toggle/Plugin Class.
 *
 * @package		Gform_Toggle
 * @subpackage	Classes/GForm_Toggle
 * @since		0.0.1
 * @author		Timothy Wood @codearachnid
 */
final class Plugin {
	
	use \Gform_Toggle\Plugin_Framework_Trait;

	public $plugin;

	/**
	 * Gform_Toggle helpers object.
	 *
	 * @access	public
	 * @since	0.0.1
	 * @var		object|GForm_Toggle/Helpers
	 */
	// public $helpers;

	/**
	 * Gform_Toggle settings object.
	 *
	 * @access	public
	 * @since	0.0.1
	 * @var		object|GForm_Toggle/Settings
	 */
	// public $settings;

	/**
	 * Throw error on object clone.
	 *
	 * Cloning instances of the class is forbidden.
	 *
	 * @access	public
	 * @since	0.0.1
	 * @return	void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'gravityforms-toggle-field' ), '0.0.1' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @access	public
	 * @since	0.0.1
	 * @return	void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'gravityforms-toggle-field' ), '0.0.1' );
	}
	
	/**
	 * Disable construction of the class.
	 *
	 * @access	public
	 * @since	0.0.1
	 * @return	void
	 */
	public function __construct() {
		
		$this->plugin = [
			'name' => 'Gravity Forms: Toggle Field',
			'hook' => 'gform_toggle_field',
			'id' => 'gform-toggle-field',
			'version' => '0.0.1' 
		];

		$this->includes(); // TOOD optimize this
		// $this->helpers		= new \Gform_Toggle\Helpers();
		// $this->settings		= new \Gform_Toggle\Settings();
		
		// register the field with GF_Fields framework
		if( class_exists('\GF_Fields') ){
			\GF_Fields::register( new Toggle_Field() );	
		} else if( is_admin() ) {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to re-register Gform_Toggle.', 'gravityforms-toggle-field' ), '0.0.1' );
		}
		
		add_action( $this->plugin['hook'] . '/plugin_loaded', [ $this, 'base_hooks' ] );
		
		// allow hooking once plugin is loaded
		$this->notify_plugin_loaded();
		// add_action( 'plugins_loaded', array( $this, 'plugin_loaded' ) );
	 }

	/**
	 * Include required files.
	 *
	 * @access  private
	 * @since   0.0.1
	 * @return  void
	 */
	private function includes() {
		require_once 'class-toggle_field.php';
		require_once 'class-helpers.php';
		require_once 'class-settings.php';
	}
	
	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts andstyles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	0.0.1
	 *
	 * @return	void
	 */
	public function enqueue_backend_scripts_and_styles() {
		wp_enqueue_style( $this->plugin['id'] . '-backend-styles', 
			GFORM_TOGGLE_URL . 'assets/css/backend-styles.css', 
			[], 
			$this->plugin['version'],
			 'all' 
		 );
	}


}