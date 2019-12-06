<?php

/**
 * Wordress Comments Mods
 *
 * @package   OnePlace\Swissknife\Modules
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Swissknife\Modules;

use OnePlace\Swissknife\Plugin;

final class Settings {
    /**
     * Main instance of the module
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Disable wordpress comments entirely
     *
     * @since 0.1-stable
     */
    public function register() {
        // add custom scripts for admin section
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueueScripts' ] );

        // Add submenu page for settings
        add_action("admin_menu", [ $this, 'addSubMenuPage' ]);

        // Register Settings
        add_action( 'admin_init', [ $this, 'registerSettings' ] );

        // Add Plugin Languages
        add_action('plugins_loaded', [ $this, 'loadTextDomain' ] );
    }

    /**
     * load text domain (translations)
     *
     * @since 0.3.4
     */
    public function loadTextDomain() {
        load_plugin_textdomain( 'wpplc-swissknife', false, dirname( plugin_basename(WPPLC_SWISSKNIFE_MAIN_FILE) ) . '/language/' );
    }

    /**
     * Register Plugin Settings in Wordpress
     *
     * @since 0.3.4
     */
    public function registerSettings() {
        // Module Comments
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_comments', false );

        // Module Sitekit
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_enable_sitekit_ip_anonymization', false );

        // Module Revisions
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_revisions', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_limit_revisions', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_autosave', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_autosave_interval', false );

        // Module Tweaks
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_emojis', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_xmlrpc', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_embeds', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_self_pingback', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_remove_qry_static', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_remove_jquery_migrate', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_remove_shortlink', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_rssfeeds', false );
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_disable_restapi', false );

    }

    /**
     * Enqueue Style and Javascript for Admin Panel
     *
     * @since 0.3.4
     */
    public function enqueueScripts() {
        // add necessary javascript libs
        wp_enqueue_script( 'plc-admin-controls', WPPLC_SWISSKNIFE_PUB_DIR.'/assets/js/plc-admin.js', [ 'jquery' ] );

        // add necessary css files
        wp_enqueue_style( 'plc-admin-style', WPPLC_SWISSKNIFE_PUB_DIR.'/assets/css/plc-admin-style.css');
    }

    /**
     * Add Submenu Page to Wordpress Settings Menu
     *
     * @since 0.3.4
     */
    public function addSubMenuPage() {
        add_submenu_page(
            'options-general.php',
            'WP PLC Swissknife',
            'WP PLC Swissknife',
            'administrator',
            'wpplc-swissknife-options',
            [ $this, 'renderSettingsPage' ] );
    }

    /**
     * Render Settings Page for Plugin
     *
     * @since 0.3.4
     */
     public function renderSettingsPage() {
         require_once __DIR__.'/../templates/settings.php';
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