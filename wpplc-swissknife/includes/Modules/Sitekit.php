<?php

/**
 * Google Sitekit option tweaks
 *
 * @package   OnePlace\Swissknife\Modules
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Swissknife\Modules;

use OnePlace\Swissknife\Plugin;

final class Sitekit {
    /**
     * Main instance of the module
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Enable Google Sitekit IP Anonymization
     *
     * @since 0.1-stable
     */
    public function register() {
        // Google Site-kit Anonymizing IP Addresses
        add_filter('googlesitekit_gtag_opt', function(array $options) {
            $options['anonymize_ip'] = true;
            return $options;
        } );
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