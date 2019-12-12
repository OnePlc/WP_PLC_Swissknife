<article class="plc-admin-page-tweaks plc-admin-page" style="padding: 10px 40px 40px 40px;">
    <h1><?=__('More Tweaks','wpplc-swissknife')?></h1>
    <p>Here you have some more performance and security tweaks of swissknife plugin</p>

    <!-- Disable Emojis Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bSwapLoadFonts = get_option( 'wpplc_swissknife_swapload_elementor_fonts', false ); ?>
            <input name="wpplc_swissknife_swapload_elementor_fonts" type="checkbox" <?=($bSwapLoadFonts)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Font Display "swap" For Elementor Fonts</span>
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

    <!-- Disable Embeds Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableEmbeds = get_option( 'wpplc_swissknife_disable_embeds', false ); ?>
            <input name="wpplc_swissknife_disable_embeds" type="checkbox" <?=($bDisableEmbeds)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable Embeds</span>
    </div>
    <!-- Disable Embeds Toggle -->

    <!-- Disable Self-Pingback Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableSelfPingback = get_option( 'wpplc_swissknife_disable_self_pingback', false ); ?>
            <input name="wpplc_swissknife_disable_self_pingback" type="checkbox" <?=($bDisableSelfPingback)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable Self-Pingback</span>
    </div>
    <!-- Disable Self-Pingback Toggle -->

    <!-- Remove Querystring from Statics Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bRemoveQryStatic = get_option( 'wpplc_swissknife_remove_qry_static', false ); ?>
            <input name="wpplc_swissknife_remove_qry_static" type="checkbox" <?=($bRemoveQryStatic)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Remove Querystring from Static Resources</span>
    </div>
    <!-- Remove Querystring from Statics Toggle -->

    <!-- Remove jQuery Migrate -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bRemoveJqueryMigrate = get_option( 'wpplc_swissknife_remove_jquery_migrate', false ); ?>
            <input name="wpplc_swissknife_remove_jquery_migrate" type="checkbox" <?=($bRemoveJqueryMigrate)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Remove jQuery Migrate</span>
    </div>
    <!-- Remove jQuery Migrate -->

    <!-- Remove Shortlink -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bRemoveShortlink = get_option( 'wpplc_swissknife_remove_shortlink', false ); ?>
            <input name="wpplc_swissknife_remove_shortlink" type="checkbox" <?=($bRemoveShortlink)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Remove Shortlink</span>
    </div>
    <!-- Remove Shortlink -->

    <!-- Disable RSS Feeds -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableRSS = get_option( 'wpplc_swissknife_disable_rssfeeds', false ); ?>
            <input name="wpplc_swissknife_disable_rssfeeds" type="checkbox" <?=($bDisableRSS)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable RSS Feeds</span>
    </div>
    <!-- Disable RSS Feeds -->

    <!-- Disable REST API -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableRestAPI = get_option( 'wpplc_swissknife_disable_restapi', false ); ?>
            <input name="wpplc_swissknife_disable_restapi" type="checkbox" <?=($bDisableRestAPI)?'checked':''?> class="plc-admin-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable REST API (if not logged-in)</span>
    </div>
    <!-- Disable REST API -->

</article>