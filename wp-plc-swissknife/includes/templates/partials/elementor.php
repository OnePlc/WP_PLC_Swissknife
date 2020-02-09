<article class="plc-admin-page-elementorsettings plc-admin-page" style="padding: 10px 40px 40px 40px;">
    <h1><?=__('More Tweaks','wpplc-swissknife')?></h1>
    <p>Here you have some more performance and security tweaks of swissknife plugin</p>

    <!-- Elementor Font Swap Toggle -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bSwapLoadFonts = get_option( 'wpplc_swissknife_swapload_elementor_fonts', false ); ?>
            <input name="wpplc_swissknife_swapload_elementor_fonts" type="checkbox" <?=($bSwapLoadFonts)?'checked':''?> class="plc-swissknife-ajax-checkbox">
            <span class="plc-settings-slider"></span>
        </label>
        <span>
            <?=__('Font Display "swap" For Elementor Fonts','wpplc-swissknife')?>
        </span>
    </div>
    <!-- Elementor Font Swap Toggle -->
</article>