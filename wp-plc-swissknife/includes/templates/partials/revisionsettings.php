<article class="plc-admin-page-revisionsettings plc-admin-page" style="padding: 10px 40px 40px 40px;">
    <h1><?=__('Revision Preferences','wpplc-swissknife')?></h1>
    <p>Here you can change the revision settings of swissknife plugin</p>

    <!-- Disable Revisions Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableRevisions = get_option( 'wpplc_swissknife_disable_revisions', false ); ?>
            <input name="wpplc_swissknife_disable_revisions" type="checkbox" <?=($bDisableRevisions)?'checked':''?> class="plc-swissknife-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable Revisions for Pages / Posts / Custom Post Types</span>
    </div>
    <!-- Disable Revisions Toggle -->

    <!-- Limit Revisions -->
    <div class="plc-admin-settings-field">
        <?php $iDisableRevisions = get_option( 'wpplc_swissknife_limit_revisions', 5 ); ?>
        <input name="wpplc_swissknife_limit_revisions" type="number" min="0" max="5" step="1" size="1" value="<?=$iDisableRevisions?>">
        <span>Limit Revisions for Pages / Posts / Custom Post Types</span>
    </div>
    <!-- Limit Toggle -->

    <!-- Disable Autosave Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bDisableAutosave = get_option( 'wpplc_swissknife_disable_autosave', false ); ?>
            <input name="wpplc_swissknife_disable_autosave" type="checkbox" <?=($bDisableAutosave)?'checked':''?> class="plc-swissknife-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>Disable Autosave for Pages / Posts / Custom Post Types</span>
    </div>
    <!-- Disable Autosave Toggle -->

    <!-- Autosave Interval -->
    <div class="plc-admin-settings-field">
        <?php $iAutosaveInterval = get_option( 'wpplc_swissknife_autosave_interval', 300 ); ?>
        <input name="wpplc_swissknife_autosave_interval" type="number" min="30" max="600" step="30" size="3" value="<?=$iAutosaveInterval?>">
        <span> Autosave Interval in seconds</span>
    </div>
    <!-- Autosave Interval -->

</article>