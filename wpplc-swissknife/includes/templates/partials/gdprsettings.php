<article class="plc-admin-page-gdprsettings plc-admin-page" style="padding: 10px 40px 40px 40px">
    <h1>GDPR Preferences</h1>
    <p>Here you can change the basic settings of swissknife plugin</p>

    <?php
    $bSiteKitInstalled = false;
    $sSiteKitInfo = '';
    if(is_plugin_active('google-site-kit/google-site-kit.php')) {
        $bSiteKitInstalled = true;
        if(defined('GOOGLESITEKIT_PLUGIN_MAIN_FILE')) {
            $aData = get_plugin_data(GOOGLESITEKIT_PLUGIN_MAIN_FILE);
            $sSiteKitInfo = '<small style="color:green;">Sitekit '.$aData['Version'].' found</small>';
        } else {
            $sSiteKitInfo = '<small style="color:yellow;">Sitekit (unknown version) found</small>';
        }
    } else {
        $sSiteKitInfo = '<small style="color:red;">Sitekit by Google is not active</small>';
    } ?>
    <!-- Rectangular switch -->
    <label class="plc-settings-switch">
        <?php $bEnableSitekitIPAnon = get_option( 'wpplc_swissknife_enable_sitekit_ip_anonymization', false ); ?>
        <input name="wpplc_swissknife_enable_sitekit_ip_anonymization" type="checkbox" <?=($bEnableSitekitIPAnon)?'checked':''?> class="plc-admin-ajax-checkbox"<?=(!$bSiteKitInstalled)?' disabled':''?>>
        <span class="plc-settings-slider"></span>
    </label>
    <span>Enable IP Anonymization for Google Sitekit <?=$sSiteKitInfo?></span>
</article>