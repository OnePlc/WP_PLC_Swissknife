<?php
?>
<div class="plc-admin" style="margin: 0 0 -65px -20px;">
    <div class="plc-settings-wrapper" style="margin:0; padding:0; display: block !important;">
        <div class="plc-settings-header" style="padding: 20px 50px 80px; background:#13b4df;">
            <div class="plc-settings-header-main" style="padding-top:12px; position: relative; display: flex; justify-content: space-between;">
                <div style="width:33%; text-align: left;">
                    <div class="plc-settings-header-main-title" style="height: 52px;line-height: 52px;font-size: 17px;color:#fff;margin: 0;">WP PLC Swissknife <small>Version 0.3.4</small></div>
                </div>
                <div style="width:33%; text-align: center;">
                    <img src="/wp-content/plugins/wpplc-swissknife/assets/img/icon.png" style="max-height:42px;"/>
                </div>
                <div style="width:33%; text-align: right;">
                    Need help?
                </div>
            </div>
        </div>
        <main class="plc-admin-main" style="position: relative;background:#fff;border-radius: 5px;margin: -60px 50px 0;box-shadow: 0 3px 6px rgba(0,0,0,.11);min-height: 600px;">
            <div class="plc-admin-menu-container" style="width:100%; padding-left:40px; display: inline-block; float:left; border-bottom:1px solid lightgray;">
                <nav class="plc-admin-menu" style="width:70%; float:left;">
                    <ul class="elfsight-admin-menu-list" style="margin: 20px 0; list-style-type: none; padding: 0;">
                        <li class="plc-admin-menu-list-item">
                            <a href="#/gdprsettings" data-elfsight-admin-page="widgets" class="active">
                                GDPR Preferences
                            </a>
                        </li>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/commentsettings" data-elfsight-admin-page="support">
                                Comments
                            </a>
                        </li>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/revisionsettings" data-elfsight-admin-page="activation" class="elfsight-admin-tooltip-trigger">
                                Revisions
                            </a>
                        </li>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/tweaks" data-elfsight-admin-page="activation" class="elfsight-admin-tooltip-trigger">
                                Tweaks
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="plc-admin-alert-container" style="float:left; width:30%; padding:40px 0 40px 0;">

                </div>
            </div>
            <div class="plc-admin-page-container" style="width:100%; display: inline-block; float: left;">
                <?php
                // Include Settings Pages
                require_once __DIR__.'/partials/gdprsettings.php';
                require_once __DIR__.'/partials/commentsettings.php';
                require_once __DIR__.'/partials/revisionsettings.php';
                require_once __DIR__.'/partials/tweaks.php';
                ?>
            </div>

        </main>
    </div>
</div>