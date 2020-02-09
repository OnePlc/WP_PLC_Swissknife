<?php
?>
<div class="plc-admin">
    <div class="plc-settings-wrapper">
        <!-- Header START -->
        <div class="plc-settings-header">
            <div class="plc-settings-header-main">
                <div style="width:33%; text-align: left;">
                    <div class="plc-settings-header-main-title">
                        WP PLC Swissknife <small>Version <?=(defined('WPPLC_SWISSKNIFE_VERSION')) ? WPPLC_SWISSKNIFE_VERSION : '(unknown)'?></small>
                    </div>
                </div>
                <div style="width:33%; text-align: center;">
                    <img src="<?=plugins_url('assets/img/icon.png', WPPLC_SWISSKNIFE_MAIN_FILE)?>" />
                </div>
                <div style="width:33%; text-align: right;">
                    <a href="https://t.me/wp_plc_swissknife" target="_blank" title="Telegram Support">
                        <?=__('Need help?','wpplc')?>
                    </a>
                </div>
            </div>
        </div>
        <!-- Header END -->
        <main class="plc-admin-main">
            <!-- Menu START -->
            <div class="plc-admin-menu-container">
                <nav class="plc-admin-menu" style="width:70%; float:left;">
                    <ul class="plc-admin-menu-list">
                        <li class="plc-admin-menu-list-item">
                            <a href="#/gdprsettings" data-elfsight-admin-page="widgets" class="active">
                                <?=__('GDPR Preferences','wpplc-swissknife')?>
                            </a>
                        </li>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/commentsettings" data-elfsight-admin-page="support">
                                <?=__('Comments','wpplc-swissknife')?>
                            </a>
                        </li>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/revisionsettings" data-elfsight-admin-page="activation" class="elfsight-admin-tooltip-trigger">
                                <?=__('Revisions','wpplc-swissknife')?>
                            </a>
                        </li>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/elementorsettings" data-elfsight-admin-page="activation" class="elfsight-admin-tooltip-trigger">
                                <?=__('Elementor','wpplc-swissknife')?>
                            </a>
                        </li>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/tweaks" data-elfsight-admin-page="activation" class="elfsight-admin-tooltip-trigger">
                                <?=__('Tweaks','wpplc-swissknife')?>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="plc-admin-alert-container" style="float:left; width:30%; padding:40px 0 40px 0;">

                </div>
            </div>
            <!-- Menu END -->

            <!-- Content START -->
            <div class="plc-admin-page-container" style="width:100%; display: inline-block; float: left;">
                <?php
                // Include Settings Pages
                require_once __DIR__.'/partials/gdprsettings.php';
                require_once __DIR__.'/partials/commentsettings.php';
                require_once __DIR__.'/partials/revisionsettings.php';
                require_once __DIR__.'/partials/tweaks.php';
                require_once __DIR__.'/partials/elementor.php';
                ?>
            </div>
            <!-- Content END -->
        </main>
    </div>
</div>