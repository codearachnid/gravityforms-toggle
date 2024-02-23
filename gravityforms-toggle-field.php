<?php
/**
 * Gravity Forms: Toggle Field
 *
 * @package       Gform_Toggle
 * @author        Timothy Wood @codearachnid
 * @license       gplv2
 * @version       0.0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Gravity Forms: Toggle Field
 * Plugin URI:    ...
 * Description:   When you need a toggle (true/false) field on your form
 * Version:       0.0.1
 * Author:        Timothy Wood @codearachnid
 * Author URI:    https://codearachnid.com
 * Text Domain:   gravityforms-toggle-field
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Gravity Forms: Toggle Field. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The main function to load the only instance of the master class.
 *
 * @author  Timothy Wood @codearachnid
 * @since   0.0.1
 * @return  object|GForm_Toggle/Toggle_Field
 */

add_action('init', 'gform_toggle_field_init');
function gform_toggle_field_init(){
    
    // TODO define these with namespace
    define( 'GFORM_TOGGLE_PATH', plugin_dir_path( __FILE__ ) );
    define( 'GFORM_TOGGLE_URL', plugin_dir_url( __FILE__ ) );
    
    /**
     * Set the main trait+class for the core functionality
     */
    $gform_toggle_field_bootstrap = apply_filters( 'gform_toggle_field_bootstrap', [
        'core/trait-plugin', 
        'core/class-plugin'
    ] );
    
    foreach( $gform_toggle_field_bootstrap as $load_file ){
        require_once sprintf( '%s%s.php', GFORM_TOGGLE_PATH, $load_file );
    }
    
    /**
     * Launch the plugin logic
     */
    return \Gform_Toggle\Plugin::instance();
}