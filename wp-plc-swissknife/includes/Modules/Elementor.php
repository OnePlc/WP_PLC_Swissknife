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

final class Elementor {
    /**
     * Main instance of the module
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Custom wordpress tweaks
     *
     * @since 0.1-stable
     */
    public function register() {
        // load elementor fonts display by swap
        if(get_option( 'wpplc_swissknife_swapload_elementor_fonts') == true) {
            add_action('init', [$this, 'loadElementorFontSwap']);
        }
    }

    /**
     * load elementor font display swap
     *
     * @since 0.3.5
     */
    public function loadElementorFontSwap() {
        add_filter( 'elementor_pro/custom_fonts/font_display', function( $current_value, $font_family, $data ) {
            return 'swap';
        }, 10, 3 );
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