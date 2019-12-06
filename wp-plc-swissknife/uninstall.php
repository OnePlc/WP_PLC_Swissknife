<?php
/**
 * Plugin reset and uninstall cleanup.
 *
 * @package   OnePlace\Swissknife
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch
 */

namespace OnePlace\Swissknife;

// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' )) {
    die;
}

$aOptions = [
    'wpplc_swissknife_disable_comments',
    'wpplc_swissknife_enable_sitekit_ip_anonymization',
    'wpplc_swissknife_disable_revisions',
    'wpplc_swissknife_limit_revisions',
    'wpplc_swissknife_disable_autosave',
    'wpplc_swissknife_autosave_interval',
    'wpplc_swissknife_disable_emojis',
    'wpplc_swissknife_disable_xmlrpc',
    'wpplc_swissknife_disable_embeds',
    'wpplc_swissknife_disable_self_pingback',
    'wpplc_swissknife_remove_qry_static',
    'wpplc_swissknife_remove_jquery_migrate',
    'wpplc_swissknife_remove_shortlink',
    'wpplc_swissknife_disable_rssfeeds',
    'wpplc_swissknife_disable_restapi',
];

foreach($aOptions as $sOption) {
    // delete option
    delete_option($sOption);
    // for site options in Multisite
    delete_site_option($sOption);
}
