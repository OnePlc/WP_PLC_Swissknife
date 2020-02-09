<?php

/**
 * Custom Wordpress Tweaks
 *
 * @package   OnePlace\Swissknife\Modules
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Swissknife\Modules;

use OnePlace\Swissknife\Plugin;

final class Tweaks {
    /**
     * Main instance of the module
     *
     * @var Plugin|null
     * @since 0.1.0
     */
    private static $instance = null;

    /**
     * Custom wordpress tweaks
     *
     * @since 0.1.0
     */
    public function register() {
        // Disable wordpress emojis
        if(get_option( 'wpplc_swissknife_disable_emojis') == true) {
            add_action('init', [$this, 'disableEmojis']);
        }

        // Disable XML-RPC
        if(get_option( 'wpplc_swissknife_disable_xmlrpc') == true) {
            add_filter('xmlrpc_enabled', '__return_false');
        }

        // Disable wordpress embeds
        if(get_option( 'wpplc_swissknife_disable_embeds') == true) {
            add_action('init', [$this, 'disableEmbeds'], 9999);
        }

        // Disable Self Pingbacks
        if(get_option( 'wpplc_swissknife_disable_self_pingback') == true) {
            add_action('pre_ping', [$this, 'disableSelfPingbacks']);
        }

        // Remove Query String from Static resources
        if(get_option( 'wpplc_swissknife_remove_qry_static') == true) {
            add_filter('style_loader_src', [$this, 'removeCssJsVersion'], 10, 2);
            add_filter('script_loader_src', [$this, 'removeCssJsVersion'], 10, 2);
        }

        // Remove jQuery Migrate
        if(get_option( 'wpplc_swissknife_remove_jquery_migrate') == true) {
            add_action('wp_default_scripts', [$this, 'removeJqueryMigrate']);
        }

        // Remove Shortlink
        if(get_option( 'wpplc_swissknife_remove_shortlink') == true) {
            add_filter('after_setup_theme', [$this, 'removeShortlink']);
        }

        // Disable RSS Feed
        if(get_option( 'wpplc_swissknife_disable_rssfeeds') == true) {
            add_action('do_feed', [$this, 'disableRSSFeed'], 1);
            add_action('do_feed_rdf', [$this, 'disableRSSFeed'], 1);
            add_action('do_feed_rss', [$this, 'disableRSSFeed'], 1);
            add_action('do_feed_rss2', [$this, 'disableRSSFeed'], 1);
            add_action('do_feed_atom', [$this, 'disableRSSFeed'], 1);
            add_action('do_feed_rss2_comments', [$this, 'disableRSSFeed'], 1);
            add_action('do_feed_atom_comments', [$this, 'disableRSSFeed'], 1);
        }

        // Disable Rest API
        if(get_option( 'wpplc_swissknife_disable_restapi') == true) {
            add_filter('rest_authentication_errors', [$this, 'disableRestAPI']);
        }
    }

    /**
     * disable rest API endpoints
     * if not logged in
     *
     * @since 0.3.4
     */
    public function disableRestAPI($access) {
        if( ! is_user_logged_in() ) {
            return new \WP_Error( 'rest_cannot_access', __( 'Only authenticated users can access the REST API.', 'disable-json-api' ), [ 'status' => rest_authorization_required_code() ] );
        }
        return $access;
    }

    /**
     * disable rss and atom feeds
     *
     * @since 0.3.4
     */
    public function disableRSSFeed() {
        wp_die( __( 'No feed available, please visit our website!' ) );
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'feed_links', 2 );
    }

    /**
     * remove shortlink tag
     *
     * @since 0.3.4
     */
    public function removeShortlink() {
        // remove HTML meta tag
        // <link rel='shortlink' href='http://example.com/?p=25' />
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);

        // remove HTTP header
        // Link: <https://example.com/?p=25>; rel=shortlink
        remove_action( 'template_redirect', 'wp_shortlink_header', 11);
    }

    /**
     * remove jquery migrate from frontend
     *
     * @since 0.3.4
     */
    public function removeJqueryMigrate($scripts) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $script = $scripts->registered['jquery'];

            if ( $script->deps ) { // Check whether the script has any dependencies
                $script->deps = array_diff( $script->deps, [ 'jquery-migrate' ] );
            }
        }
    }

    /**
     * remove query string from static resources
     *
     * @since 0.3.4
     */
    public function removeCssJsVersion($src) {
        if( strpos( $src, '?ver=' ) ) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }

    /**
     * disable self pingbacks
     *
     * @since 0.3.4
     */
    public function disableSelfPingbacks(&$links) {
        foreach ( $links as $l => $link ) {
            if (0 === strpos($link, get_option('home'))) {
                unset($links[$l]);
            }
        }
    }

    /**
     * disable wordpress embeds
     *
     * @since 0.3.4
     */
    public function disableEmbeds() {
        // Remove the REST API endpoint.
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );

        // Turn off oEmbed auto discovery.
        add_filter( 'embed_oembed_discover', '__return_false' );

        // Don't filter oEmbed results.
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

        // Remove oEmbed discovery links.
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
        add_filter( 'tiny_mce_plugins', [ $this, 'disableEmbedsTinyMCEPlugin' ] );

        // Remove all embeds rewrite rules.
        add_filter( 'rewrite_rules_array', [ $this, 'disableEmbedsRewrites'] );

        // Remove filter of the oEmbed result before any HTTP requests are made.
        remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );

        // deregister embed scripts
        add_action( 'wp_footer', [ $this, 'deregisterEmbedScripts' ] );
    }

    /**
     * deregister embed scripts
     *
     * @since 0.3.4
     */
    public function deregisterEmbedScripts() {
        wp_dequeue_script( 'wp-embed' );
    }

    /**
     * disable embeds in tinymce
     *
     * @since 0.3.4
     */
    public function disableEmbedsTinyMCEPlugin($aPlugins) {
        return array_diff($aPlugins, array('wpembed'));
    }

    /**
     * disable embeds in rewrites
     *
     * @since 0.3.4
     */
    public function disableEmbedsRewrites($aRules) {
        foreach($aRules as $rule => $rewrite) {
            if(false !== strpos($rewrite, 'embed=true')) {
                unset($aRules[$rule]);
            }
        }
        return $aRules;
    }

    /**
     * disable wordpress emojis enterily
     *
     * @since 0.3.3
     */
    public function disableEmojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    }

    /**
     * Loads the module main instance and initializes it.
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