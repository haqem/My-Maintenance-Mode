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
 * Copyright 2016  Ahmad Luqman Haqem (email : iam@haqem.my)
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
define('MYMM_CSS_PATH', MYMM_PATH . 'assets/css/') ;


/**
 * Init
 *
 * @package WordPress
 * @subpackage My_Maintenance_Mode
 * @since 0.1
 */

/**
 * Require config to get our initial values
 */

load_plugin_textdomain('my-maintenance-mode',false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');

require_once('framework/framework.php');
require_once('inc/config.php');

/**
 * Upon activation of the plugin, see if we are running the required version and deploy theme in defined.
 *
 * @since 0.1
 */
function seedprod_ucsp_activation() {
    if ( version_compare( get_bloginfo( 'version' ), '3.0', '<' ) ) {
        deactivate_plugins( __FILE__  );
        wp_die( __('WordPress 3.0 and higher required. The plugin has now disabled itself. On a side note why are you running an old version :( Upgrade!','my-maintenance-mode') );
    }
}

add_action( 'after_plugin_row_' .  plugin_basename( __FILE__ ), 'seedprod_ucsp_deprication_msg', 10, 2 );

function seedprod_ucsp_deprication_msg($file, $plugin){
	echo '<tr class="plugin-update-tr"><td colspan="3" class="plugin-update">';
	echo '<div style=" color: #a94442; background:#f2dede; padding:10px; border: 1px #ebccd1 solid;"><strong>Important:</strong> Ultimate Coming Soon Page plugin is being deprecated and will be removed soon from wordpress.org. Please use our new version located at: <a href="plugin-install.php?tab=search&s=Coming+Soon+Page+%26+Maintenance+Mode+by+SeedProd">Coming Soon Page & Maintenance Mode by SeedProd. </a></div>';
	echo '</td></tr>';
}
