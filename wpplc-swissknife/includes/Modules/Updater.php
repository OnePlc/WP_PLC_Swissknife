<?php

/**
 * Plugin loader.
 *
 * @package   OnePlace\Swissknife
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Swissknife\Modules;

use OnePlace\Swissknife\Plugin;

final class Updater {
    /**
     * Main instance of the module
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    private $sRepoUser;
    private $sRepoName;
    private $sRepoToken;
    private $sSlug;
    private $githubAPIResult;
    private $aPluginData;

    /**
     * Enable Google Sitekit IP Anonymization
     *
     * @since 0.1-stable
     */
    public function register() {
        $this->sRepoName = 'PLC_WP_Swissknife';
        $this->sRepoUser = 'OnePlc';
        $this->sRepoToken = '';
        $this->sSlug = 'wpplc-swissknife';
        $this->aPluginData = [
            'Name' => 'WP PLC Swissknife',
            'AuthorName' => 'onePlace',
            'PluginURI' => 'https://wp.1plc.ch/wordpress-plugins/swissknife',
            'Description' => 'onePlace Swissknife for Wordpress. Increase Wordpress Security and Performance',
        ];

        // For TESTING ONLY
        set_site_transient( 'update_plugins', null );

        add_filter( "pre_set_site_transient_update_plugins", [$this, "setTransient" ] );

        add_filter( "plugins_api", [ $this, "setPluginInfo" ], 10, 3 );
    }

    // Push in plugin version information to display in the details lightbox
    public function setPluginInfo( $false, $action, $response ) {
        // Get plugin & GitHub release information
        //$this->initPluginData();
        $this->getRepoReleaseInfo();

        // If nothing is found, do nothing
        if ( empty( $response->slug ) || $response->slug != $this->sSlug ) {
            return false;
        }

        // Add our plugin information
        $response->last_updated = $this->githubAPIResult->published_at;
        $response->slug = $this->sSlug;
        $response->plugin_name  = $this->pluginData["Name"];
        $response->version = $this->githubAPIResult->tag_name;
        $response->author = $this->pluginData["AuthorName"];
        $response->homepage = $this->pluginData["PluginURI"];

        // Create tabs in the lightbox
        $response->sections = [
            'description' => $this->pluginData["Description"],
            'changelog' => class_exists( "Parsedown" )
                ? \Parsedown::instance()->parse( $this->githubAPIResult->body )
                : $this->githubAPIResult->body
        ];

        // This is our release download zip file
        $downloadLink = $this->githubAPIResult->zipball_url;

        // Include the access token for private GitHub repos
        if ( !empty( $this->sRepoToken ) ) {
            $downloadLink = add_query_arg(
                [ "access_token" => $this->sRepoToken ],
                $downloadLink
            );
        }
        $response->download_link = $downloadLink;

        return $response;
    }

    public function setTransient($transient) {
        // If we have checked the plugin data before, don't re-check
        if ( empty( $transient->checked ) ) {
            return $transient;
        }

        // Get plugin & GitHub release information
        $this->getRepoReleaseInfo();

        // Check the versions if we need to do an update
        $doUpdate = version_compare( $this->githubAPIResult->tag_name, $transient->checked[$this->sSlug] );

        // Update the transient to include our updated plugin data
        if ( $doUpdate == 1 ) {
            $package = $this->githubAPIResult->zipball_url;

            // Include the access token for private GitHub repos
            if ( !empty( $this->sRepoToken ) ) {
                $package = add_query_arg( [ "access_token" => $this->sRepoToken ], $package );
            }

            $obj = new \stdClass();
            $obj->slug = $this->sSlug;
            $obj->new_version = $this->githubAPIResult->tag_name;
            $obj->url = 'https://1plc.ch';
            $obj->package = $package;
            $obj->tested = '5.3';
            $obj->requires = '5.2.4';

            $transient->response[$this->sSlug.'/'.$this->sSlug.'.php'] = $obj;
        }

        return $transient;
    }

    public function getRepoReleaseInfo() {
        if ( ! empty( $this->githubAPIResult ) ) {
            return;
        }
        // Query the Gitea API
        $url = "https://api.github.com/repos/{$this->sRepoUser}/{$this->sRepoName}/releases";

        // We need the access token for private repos
        if ( ! empty( $this->sRepoToken ) ) {
            $url = add_query_arg( [ "access_token" => $this->sRepoToken ], $url );
        }
        // Get the results
        $this->githubAPIResult = wp_remote_retrieve_body( wp_remote_get( $url, ['sslverify'=>false] ) );

        if ( ! empty( $this->githubAPIResult ) ) {
            $this->githubAPIResult = json_decode( $this->githubAPIResult );
        }

        // Use only the latest release
        if ( is_array( $this->githubAPIResult ) ) {
            $this->githubAPIResult = $this->githubAPIResult[0];
        }
    }

    /**
     * Loads the plugin main instance and initializes it.
     *
     * @since 0.1-stable
     *
     * @param string $main_file Absolute path to the plugin main file.
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