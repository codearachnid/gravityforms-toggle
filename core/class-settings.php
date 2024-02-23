<?php

namespace Gform_Toggle;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This class contains all of the plugin related settings.
 * Everything that is relevant data and used multiple times throughout 
 * the plugin.
 * 
 * To define the actual values, we recommend adding them as shown above
 * within the __construct() function as a class-wide variable. 
 * This variable is then used by the callable functions down below. 
 * These callable functions can be called everywhere within the plugin 
 * as followed using the get_plugin_name() as an example: 
 * 
 * Gform_Toggle->settings->get_plugin_name();
 * 
 * HELPER COMMENT END
 */

/**
 * Class GForm_Toggle/Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		Gform_Toggle
 * @subpackage	Classes/GForm_Toggle/Settings
 * @author		Timothy Wood @codearachnid
 * @since		0.0.1
 */
class Settings{

	/**
	 * The plugin name
	 *
	 * @var		string
	 * @since   0.0.1
	 */
	// private $plugin_name;

	/**
	 * constructor 
	 * to run the plugin logic.
	 *
	 * @since 0.0.1
	 */
	function __construct(){

		// $this->plugin_name = 'Gravity Forms: Toggle Field';
	}

	/**
	 * ######################
	 * ###
	 * #### CALLABLE FUNCTIONS
	 * ###
	 * ######################
	 */

	/**
	 * Return the plugin name
	 *
	 * @access	public
	 * @since	0.0.1
	 * @return	string The plugin name
	 */
	public function get_plugin_name(){
		return apply_filters( 'gform_toggle_field/settings/get_plugin_name', $this->plugin_name );
	}
}
