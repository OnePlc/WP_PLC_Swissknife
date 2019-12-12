<?php

// load wordpress core functions
require_once '../../../../../wp-load.php';

// get setting key and value
$sName = $_REQUEST['setting_name'];
$sVal = $_REQUEST['setting_val'];

// set default message class and content
$sClass = 'danger';
$sMessage = 'Fehler';

/**
 * Save Settings based on key
 */
// Default is boolean
$bSettingsVal = ($sVal == 1) ? true : false;
switch($sName) {
    // disable rest-api (boolean)
    case 'wpplc_swissknife_swapload_elementor_fonts':
        // Update Option
        update_option('wpplc_swissknife_swapload_elementor_fonts',$bSettingsVal);

        // Show Message
        $sMessage = 'Font Swap successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
        $sClass = 'success';
        break;

    // disable rest-api (boolean)
    case 'wpplc_swissknife_disable_restapi':
        // Update Option
        update_option('wpplc_swissknife_disable_restapi',$bSettingsVal);

        // Show Message
        $sMessage = 'Rest-API successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
        $sClass = 'success';
        break;
    // disable rss feeds (boolean)
    case 'wpplc_swissknife_disable_rssfeeds':
        // Update Option
        update_option('wpplc_swissknife_disable_rssfeeds',$bSettingsVal);

        // Show Message
        $sMessage = 'RSS Feeds successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
        $sClass = 'success';
        break;
    // remove jquery shortlink (boolean)
    case 'wpplc_swissknife_remove_shortlink':
        // Update Option
        update_option('wpplc_swissknife_remove_shortlink',$bSettingsVal);

        // Show Message
        $sMessage = 'Shortlink successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>removed</b>' : ' <b>added</b>';
        $sClass = 'success';
        break;
    // remove jquery migrate (boolean)
    case 'wpplc_swissknife_remove_jquery_migrate':
        // Update Option
        update_option('wpplc_swissknife_remove_jquery_migrate',$bSettingsVal);

        // Show Message
        $sMessage = 'jQuery migrate successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>removed</b>' : ' <b>added</b>';
        $sClass = 'success';
        break;
    // disable querystring for static files (boolean)
    case 'wpplc_swissknife_remove_qry_static':
        // Update Option
        update_option('wpplc_swissknife_remove_qry_static',$bSettingsVal);

        // Show Message
        $sMessage = 'Querystring for static files successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>removed</b>' : ' <b>added</b>';
        $sClass = 'success';
        break;
    // disable self-pingback (boolean)
    case 'wpplc_swissknife_disable_self_pingback':
        // Update Option
        update_option('wpplc_swissknife_disable_self_pingback',$bSettingsVal);

        // Show Message
        $sMessage = 'Self-Pingback successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
        $sClass = 'success';
        break;
    // disable embeds (boolean)
    case 'wpplc_swissknife_disable_embeds':
        // Update Option
        update_option('wpplc_swissknife_disable_embeds',$bSettingsVal);

        // Show Message
        $sMessage = 'Embeds successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
        $sClass = 'success';
        break;
    // disable xmlrpc (boolean)
    case 'wpplc_swissknife_disable_xmlrpc':
        // Update Option
        update_option('wpplc_swissknife_disable_xmlrpc',$bSettingsVal);

        // Show Message
        $sMessage = 'XML-RPC successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
        $sClass = 'success';
        break;
    // disable emojis options (boolean)
    case 'wpplc_swissknife_disable_emojis':
        // Update Option
        update_option('wpplc_swissknife_disable_emojis',$bSettingsVal);

        // Show Message
        $sMessage = 'Emojis successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>disabled</b>' : ' <b>enabled</b>';
        $sClass = 'success';
        break;
    // disable comments options (boolean)
    case 'wpplc_swissknife_disable_comments':
        // Update Option
        update_option('wpplc_swissknife_disable_comments',$bSettingsVal);

        // Show Message
        $sMessage = 'Comments successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>deactivated</b>' : ' <b>activated</b>';
        $sClass = 'success';
        break;
    // google sitekit ip anonymization
    case 'wpplc_swissknife_enable_sitekit_ip_anonymization':
        // Update Option
        update_option('wpplc_swissknife_enable_sitekit_ip_anonymization',$bSettingsVal);

        // Show Message
        $sMessage = 'Sitekit IP Anonimization is now ';
        $sMessage .= ($bSettingsVal) ? ' <b>active</b>' : ' <b>inactive</b>';
        $sClass = 'success';
        break;
    default:
       break;
}
?>
<div class="plc-alert plc-alert-<?=$sClass?>">
    <?=$sMessage?>
</div>