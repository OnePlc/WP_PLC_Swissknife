<article class="plc-admin-page-tweaks plc-admin-page" style="padding: 10px 40px 40px 40px;">
    <h1>More Tweaks</h1>
    <p>Here you have some more performance and security tweaks of swissknife plugin</p>

    <!-- Disable Emojis Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableEmojis = get_option( 'wpplc_swissknife_disable_emojis', false ); ?>
            <input name="wpplc_swissknife_disable_emojis" type="checkbox" <?=($bDisableEmojis)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable Wordpress Emojis</span>
    </div>
    <!-- Disable Emojis Toggle -->

    <!-- Disable XML-RPC Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableXMLRPC = get_option( 'wpplc_swissknife_disable_xmlrpc', false ); ?>
            <input name="wpplc_swissknife_disable_xmlrpc" type="checkbox" <?=($bDisableXMLRPC)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable XML-RPC Interface</span>
    </div>
    <!-- Disable XML-RPC Toggle -->

</article>