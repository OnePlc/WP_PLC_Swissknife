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
     * @var Plugin|null
     * @since 0.1.0
     */
    private static $instance = null;

    /**
     * Disable wordpress comments entirely
     *
     * @since 0.1.0
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

        add_action('wp_ajax_save_swissknife_setting', [ $this, 'updateSettings' ] );

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

        // Elementor Tweaks
        register_setting( 'wpplc_swissknife_options', 'wpplc_swissknife_swapload_elementor_fonts', false );
    }

    /**
     * Enqueue Style and Javascript for Admin Panel
     *
     * @since 0.3.4
     */
    public function enqueueScripts() {
        // add necessary javascript libs
        wp_enqueue_script( 'plc-swissknife-controls', plugins_url('assets/js/plc-swissknife.js', WPPLC_SWISSKNIFE_MAIN_FILE), [ 'jquery' ] );
        wp_localize_script('plc-swissknife-controls', 'oSwissKnife', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'plugin_url' => plugins_url('', WPPLC_SWISSKNIFE_MAIN_FILE),
        ]);


        // add necessary css files
        wp_enqueue_style( 'plc-swissknife-style',  plugins_url('assets/css/plc-swissknife-style.css', WPPLC_SWISSKNIFE_MAIN_FILE));
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

     public function updateSettings() {

         // set default message class and content
         $sClass = 'danger';
         $sMessage = 'Fehler';

         if($_SERVER['REQUEST_METHOD'] === 'POST') {
             // get setting key and value
             $sName = $_REQUEST['setting_name'];
             $sVal = $_REQUEST['setting_val'];

             /**
              * Save Settings based on key
              */
             // Default is boolean
             $bSettingsVal = ($sVal == 1) ? true : false;
             switch ($sName) {
                 // disable rest-api (boolean)
                 case 'wpplc_swissknife_swapload_elementor_fonts':
                     // Update Option
                     update_option('wpplc_swissknife_swapload_elementor_fonts', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Font Swap successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
                     $sClass = 'success';
                     break;

                 // disable rest-api (boolean)
                 case 'wpplc_swissknife_disable_restapi':
                     // Update Option
                     update_option('wpplc_swissknife_disable_restapi', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Rest-API successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
                     $sClass = 'success';
                     break;
                 // disable rss feeds (boolean)
                 case 'wpplc_swissknife_disable_rssfeeds':
                     // Update Option
                     update_option('wpplc_swissknife_disable_rssfeeds', $bSettingsVal);

                     // Show Message
                     $sMessage = 'RSS Feeds successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
                     $sClass = 'success';
                     break;
                 // remove jquery shortlink (boolean)
                 case 'wpplc_swissknife_remove_shortlink':
                     // Update Option
                     update_option('wpplc_swissknife_remove_shortlink', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Shortlink successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>removed</b>' : ' <b>added</b>';
                     $sClass = 'success';
                     break;
                 // remove jquery migrate (boolean)
                 case 'wpplc_swissknife_remove_jquery_migrate':
                     // Update Option
                     update_option('wpplc_swissknife_remove_jquery_migrate', $bSettingsVal);

                     // Show Message
                     $sMessage = 'jQuery migrate successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>removed</b>' : ' <b>added</b>';
                     $sClass = 'success';
                     break;
                 // disable querystring for static files (boolean)
                 case 'wpplc_swissknife_remove_qry_static':
                     // Update Option
                     update_option('wpplc_swissknife_remove_qry_static', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Querystring for static files successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>removed</b>' : ' <b>added</b>';
                     $sClass = 'success';
                     break;
                 // disable self-pingback (boolean)
                 case 'wpplc_swissknife_disable_self_pingback':
                     // Update Option
                     update_option('wpplc_swissknife_disable_self_pingback', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Self-Pingback successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
                     $sClass = 'success';
                     break;
                 // disable embeds (boolean)
                 case 'wpplc_swissknife_disable_embeds':
                     // Update Option
                     update_option('wpplc_swissknife_disable_embeds', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Embeds successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
                     $sClass = 'success';
                     break;
                 // disable xmlrpc (boolean)
                 case 'wpplc_swissknife_disable_xmlrpc':
                     // Update Option
                     update_option('wpplc_swissknife_disable_xmlrpc', $bSettingsVal);

                     // Show Message
                     $sMessage = 'XML-RPC successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
                     $sClass = 'success';
                     break;
                 // disable emojis options (boolean)
                 case 'wpplc_swissknife_disable_emojis':
                     // Update Option
                     update_option('wpplc_swissknife_disable_emojis', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Emojis successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
                     $sClass = 'success';
                     break;
                 // disable comments options (boolean)
                 case 'wpplc_swissknife_disable_comments':
                     // Update Option
                     update_option('wpplc_swissknife_disable_comments', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Comments successfully ';
                     $sMessage .= ($bSettingsVal) ? ' <b>deactivated</b>' : ' <b>activated</b>';
                     $sClass = 'success';
                     break;
                 // google sitekit ip anonymization
                 case 'wpplc_swissknife_enable_sitekit_ip_anonymization':
                     // Update Option
                     update_option('wpplc_swissknife_enable_sitekit_ip_anonymization', $bSettingsVal);

                     // Show Message
                     $sMessage = 'Sitekit IP Anonimization is now ';
                     $sMessage .= ($bSettingsVal) ? ' <b>active</b>' : ' <b>inactive</b>';
                     $sClass = 'success';
                     break;
                 default:
                     break;
             }
         }?>
         <div class="plc-alert plc-alert-<?=$sClass?>">
             <?=$sMessage?>
         </div>
        <?php
         exit();
     }

    /**
     * Loads the module main instance and initializes it
     *
     * @return bool True if the plugin main instance could be loaded, false otherwise.
     * @since 0.1.0
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