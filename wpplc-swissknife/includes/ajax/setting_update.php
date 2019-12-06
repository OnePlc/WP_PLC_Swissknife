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
switch($sName) {
    // disable comments options (boolean)
    case 'wpplc_swissknife_disable_comments':
        // Update Option
        $bSettingsVal = ($sVal == 1) ? true : false;
        update_option('wpplc_swissknife_disable_comments',$bSettingsVal);

        // Show Message
        $sMessage = 'Comments successfully ';
        $sMessage .= ($bSettingsVal) ? ' <b>deactivated</b>' : ' <b>activated</b>';
        $sClass = 'success';
        break;
    // google sitekit ip anonymization
    case 'wpplc_swissknife_enable_sitekit_ip_anonymization':
        // Update Option
        $bSettingsVal = ($sVal == 1) ? true : false;
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