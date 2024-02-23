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
 

trait Plugin_Framework_Trait {

	public static function instance( ...$args ): static {
		return new static(...$args);
	}

	/**
	 * Fire a custom action to allow dependencies
	 * after the successful plugin setup
	 */
	public function notify_plugin_loaded(){		
		do_action( $this->plugin['hook'] . '/plugin_loaded' );
	}
    

    /**
     * Add base hooks for the core functionality
     *
     * @access  private
     * @since   0.0.1
     * @return  void
     */
    public function base_hooks() {
        // TODO make this work correctly
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );		
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_backend_scripts_and_styles' ], 20 );
    }
    
    
    /**
     * Loads the plugin language files.
     *
     * @access  public
     * @since   0.0.1
     * @return  void
     */
    public function load_textdomain() {
        // TOOD this is not working
        echo 'load_textdomain';
        load_plugin_textdomain( $this->plugin['id'], FALSE, dirname( GFORM_TOGGLE_PATH ) . '/languages/' );
    }

}