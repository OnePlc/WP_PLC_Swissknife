<article class="plc-admin-page-commentsettings plc-admin-page" style="padding: 10px 40px 40px 40px;">
    <h1>Comment Preferences</h1>
    <p>Here you can change the comment settings of swissknife plugin</p>
    <!-- Rectangular switch -->
    <label class="plc-settings-switch">
        <?php $bDisableComments = get_option( 'wpplc_swissknife_disable_comments', false ); ?>
        <input name="wpplc_swissknife_disable_comments" type="checkbox" <?=($bDisableComments)?'checked':''?> class="plc-admin-ajax-checkbox">
        <span class="plc-settings-slider"></span>
    </label>
    <span>Disable Wordpress Comments</span>
</article>