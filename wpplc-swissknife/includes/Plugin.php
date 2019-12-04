<?php

/**
 * Plugin loader.
 *
 * @package   OnePlace\Swissknife
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Swissknife;

/**
 * Main class for the plugin
 */
final class Plugin {
    /**
     * Main instance of the plugin.
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Retrieves the main instance of the plugin.
     *
     * @since 0.1-stable
     *
     * @return Plugin Plugin main instance.
     */
    public static function instance() {
        return static::$instance;
    }

    /**
     * Registers the plugin with WordPress.
     *
     * @since 0.1-stable
     */
    public function register() {
        // Enable Custom Comments Settings
        Modules\Comments::load();

        // Enable Custom Revision Settings
        Modules\Revisions::load();

        // Enable Sitekit Custom Settings
        Modules\Sitekit::load();

        // Enable custom wordpress tweaks
        Modules\Tweaks::load();
    }

    /**
     * Loads the plugin main instance and initializes it.
     *
     * @since 0.1-stable
     *
     * @param string $main_file Absolute path to the plugin main file.
     * @return bool True if the plugin main instance could be loaded, false otherwise.
     */
    public static function load( $main_file ) {
        if ( null !== static::$instance ) {
            return false;
        }
        static::$instance = new static( $main_file );
        static::$instance->register();
        return true;
    }
}