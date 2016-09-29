<?php
/**
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


class maintenance {
		function __construct() {
			global	$maintenance_variable;
			$maintenance_variable = new stdClass;

			add_action( 'plugins_loaded', array( &$this, 'constants'), 	1);
			add_action( 'plugins_loaded', array( &$this, 'lang'),		2);
			add_action( 'plugins_loaded', array( &$this, 'includes'), 	3);
			add_action( 'plugins_loaded', array( &$this, 'admin'),	 	4);

			
			register_activation_hook  ( __FILE__, array( &$this,  'mt_activation' ));
			register_deactivation_hook( __FILE__, array( &$this, 'mt_deactivation') );
			
			add_action('wp', 		array( &$this, 'mt_template_redirect'), 1);
			add_action('wp_logout',	array( &$this, 'mt_user_logout'));
			add_action('init', 		array( &$this, 'mt_admin_bar'));
			add_action('init', 		array( &$this, 'mt_set_global_options'), 1);
		}
		
		function constants() {
			define( 'MAINTENANCE_VERSION', '2.0.0' );
			define( 'MAINTENANCE_DB_VERSION', 1 );
			define( 'MAINTENANCE_WP_VERSION', get_bloginfo( 'version' ));
			define( 'MAINTENANCE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
			define( 'MAINTENANCE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
			define( 'MAINTENANCE_INCLUDES', MAINTENANCE_DIR . trailingslashit( 'includes' ) );
			define( 'MAINTENANCE_LOAD',     MAINTENANCE_DIR . trailingslashit( 'load' ) );
		}
		
		function mt_set_global_options() {
			global $mt_options;
			$mt_options =  mt_get_plugin_options(true);		
		}
		
		function lang() {
			load_plugin_textdomain( 'maintenance', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );		
		}	
		
		function includes() {
			require_once( MAINTENANCE_INCLUDES . 'functions.php' ); 
			require_once( MAINTENANCE_INCLUDES . 'update.php' ); 
			require_once( MAINTENANCE_DIR 	   . 'load/functions.php' ); 
		}
		
		function admin() {
			if ( is_admin() ) {
				require_once( MAINTENANCE_INCLUDES . 'admin.php' );
			}	
		}
		
		function mt_activation() {
			/*Activation Plugin*/
			self::mt_clear_cache();
		}
		
		function mt_deactivation() {
			/*Deactivation Plugin*/
			self::mt_clear_cache();
		}
		
		public static function mt_clear_cache() {
			global $file_prefix;
			if ( function_exists( 'w3tc_pgcache_flush' ) ) w3tc_pgcache_flush(); 
			if ( function_exists( 'wp_cache_clean_cache' ) ) wp_cache_clean_cache( $file_prefix, true );
		}	
		
		function mt_user_logout() { 
			wp_safe_redirect(get_bloginfo('url'));
			exit; 
		}
		
		function mt_template_redirect() {
			load_maintenance_page();
		}
		
		function mt_admin_bar() {
			add_action('admin_bar_menu', 'maintenance_add_toolbar_items', 100);
			if (!is_super_admin() ) {
				$mt_options = mt_get_plugin_options(true);
				if (isset($mt_options['admin_bar_enabled']) && is_user_logged_in()) { 
					add_filter('show_admin_bar', '__return_true');  																	 
				} else {
					add_filter('show_admin_bar', '__return_false');  																	 
				}
			}	
		}
}

$maintenance = new maintenance();
?>
