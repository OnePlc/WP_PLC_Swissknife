<?php

/**
 * Plugin loader.
 *
 * @package   OnePlace\Swissknife
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Swissknife;

/**
 * Load composer autoload files
 *
 * we currently don't have any external libs
 *
require __DIR__ . '/vendor/autoload.php';
 **/

// Load Plugin
require_once __DIR__.'/Plugin.php';

// Load Modules
require_once __DIR__.'/Modules/Comments.php';
require_once __DIR__.'/Modules/Revisions.php';
require_once __DIR__.'/Modules/Sitekit.php';
require_once __DIR__.'/Modules/Tweaks.php';
require_once __DIR__.'/Modules/Updater.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Plugin::load(WPPLC_SWISSKNIFE_MAIN_FILE);

