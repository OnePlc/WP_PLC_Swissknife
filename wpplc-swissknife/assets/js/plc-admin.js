jQuery(function () {
    /**
     * Show first page
     */
    jQuery('article.plc-admin-page-gdprsettings').show();

    /**
     * Ajax based navigation
     */
    jQuery('nav.plc-admin-menu ul li a').on('click',function() {
        var sPage = jQuery(this).attr('href').substring('#/'.length);

        jQuery('article.plc-admin-page').hide();
        jQuery('article.plc-admin-page-'+sPage).show();

        return false;
    });

    /**
     * Ajax based settings toggle
     */
    jQuery('input.plc-admin-ajax-checkbox').on('change',function() {
        var sName = jQuery(this).attr('name');
        var sVal = 0;
        if(jQuery(this).is(':checked')) {
            sVal = 1;
        }

        // show we are working
        jQuery('.plc-admin-alert-container').html('<img src="/wp-content/plugins/wpplc-swissknife/assets/img/ajax-loader.gif" style="position: absolute;" />');

        // update setting
        jQuery.post('/wp-content/plugins/wpplc-swissknife/includes/ajax/setting_update.php',{setting_name:sName,setting_val:sVal},function(retVal) {
           jQuery('.plc-admin-alert-container').html(retVal);
        });
    });

    /**
     * Hide Limit Revisions if disabled
     */
    jQuery('input[name="wpplc_swissknife_disable_revisions"]').on('change',function() {
        if(jQuery(this).is(':checked')) {
            jQuery('input[name="wpplc_swissknife_limit_revisions"]').parent('div').hide();
        } else {
            jQuery('input[name="wpplc_swissknife_limit_revisions"]').parent('div').show();
        }
    });
});