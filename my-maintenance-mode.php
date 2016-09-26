<?php

/**h
 * My Maintenance Mode
 *
 * Plugin Name: My Maintenance Mode
 * Plugin URI: http://haqem.my/
 * Description: Shut down your blog use maintenance mode, easy to used, theme is elegent. Give notice for visitor come in your blog with message
 * Version: 1.0.0
 * Author: Ahmad Luqman Haqem
 * Author URI: http://haqem.my/
 * Twitter: iamHaqem
 * GitHub Plugin URI: https://github.com/haqem/My-Maintenance-Mode/
 * GitHub Branch: master
 * Text Domain: my-maintenance-mode
 * License: GPL-3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * DEFINE PATHS
 */
define('MYMM_PATH', plugin_dir_path(__FILE__));
define('MYMM_CLASSES_PATH', MYMM_PATH . 'includes/classes/');
define('MYMM_FUNCTIONS_PATH', MYMM_PATH . 'includes/functions/');
define('MYMM_LANGUAGES_PATH', basename(MYMM_PATH) . '/languages/');
define('MYMM_VIEWS_PATH', MYMM_PATH . 'views/');
define('MYMM_CSS_PATH', MYMM_PATH . 'assets/css/')
