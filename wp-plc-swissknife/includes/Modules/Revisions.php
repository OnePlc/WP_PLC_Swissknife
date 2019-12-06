<?php

/**
 * Wordress Page Revisions Tweaks
 *
 * @package   OnePlace\Swissknife\Modules
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Swissknife\Modules;

use OnePlace\Swissknife\Plugin;

final class Revisions {
    /**
     * Main instance of the module
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Enable Revisions Management
     *
     * @since 0.1-stable
     */
    public function register() {
        $bDisableAutosave = get_option('wpplc_swissknife_disable_autosave');

        // disable autosave
        if($bDisableAutosave == true) {
            add_action( 'admin_init', [ $this, 'disableAutosave' ] );
        } else {
            // change autosave interval from 60 to x seconds
            if(defined('AUTOSAVE_INTERVAL')) {
                $iNewInterval = (get_option('wpplc_swissknife_autosave_interval')) ? (int)get_option('wpplc_swissknife_autosave_interval') : 300;
                define('AUTOSAVE_INTERVAL', $iNewInterval);
            }
        }

        // disable or limit post revision
        if(defined('WP_POST_REVISIONS')) {
            $bDisableRevisions = get_option('wpplc_swissknife_disable_revisions');
            if($bDisableRevisions == true) {
                define('WP_POST_REVISIONS', false);
            } else {
                $iNewRevisionLimit = (get_option('wpplc_swissknife_limit_revisions')) ? (int)get_option('wpplc_swissknife_limit_revisions') : 3;
                define('WP_POST_REVISIONS', $iNewRevisionLimit);
            }
        }
    }

    /**
     * Disable Autosave completly
     *
     * @since 0.3.4
     */
    public function disableAutosave() {
        wp_deregister_script( 'autosave' );
    }

    /**
     * Loads the module main instance and initializes it.
     *
     * @since 0.1-stable
     *
     * @return bool True if the plugin main instance could be loaded, false otherwise.
     */
    public static function load() {
        if ( null !== static::$instance ) {
            return false;
        }
        static::$instance = new self();
        static::$instance->register();
        return true;
    }
}