<?php
/**
 * Plugin main file.
 *
 * @package   OnePlace\Swissknife
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch
 *
 * @wordpress-plugin
 * Plugin Name: WP PLC Swissknife
 * Plugin URI:  https://1plc.ch/wordpress-plugins/swissknife
 * Description: onePlace Swissknife for Wordpress. Increase Wordpress Security and Performance
 * Version:     0.3.3
 * Author:      Verein onePlace
 * Author URI:  https://1plc.ch
 * License:     GNU General Public License, version 2
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * Text Domain: wpplc
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define Version and directories for further use in plugin
define( 'WPPLC_SWISSKNIFE_VERSION', '0.3.3-stable' );
define( 'WPPLC_SWISSKNIFE_MAIN_FILE', __FILE__ );
define( 'WPPLC_SWISSKNIFE_MAIN_DIR', __DIR__ );
define( 'WPPLC_SWISSKNIFE_PUB_DIR',str_replace([$_SERVER['DOCUMENT_ROOT']],[''],WPPLC_SWISSKNIFE_MAIN_DIR));

/**
 * Handles plugin activation.
 *
 * Throws an error if the plugin is activated on an older version than PHP 5.4.
 *
 * @access private
 *
 * @param bool $network_wide Whether to activate network-wide.
 */
function wpplc_swissknife_activate_plugin( $network_wide ) {
    // check php version
    if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
        // show error if version is below 5.4
        wp_die(
            esc_html__( 'WP PLC Swissknife requires PHP version 5.4.', 'wpplc' ),
            esc_html__( 'Error Activating', 'wpplc' )
        );
    }

    // we currently support multisite - so we just activate on network wide
}
register_activation_hook( __FILE__, 'wpplc_swissknife_activate_plugin' );

/**
 * Handles plugin deactivation.
 *
 * @access private
 *
 * @param bool $network_wide Whether to deactivate network-wide.
 */
function wpplc_swissknife_deactivate_plugin( $network_wide ) {
    if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
        return;
    }

    // deactivation network wide is the same for now
}
register_deactivation_hook( __FILE__, 'wpplc_swissknife_deactivate_plugin' );

// make sure php version is up2date
if ( version_compare( PHP_VERSION, '5.4.0', '>=' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/loader.php';
}