<?php
/**
* Plugin Name: Contact form 7 country code drop down
* Plugin URI: https://indianic.com
* Description: Add country drop-down field for phone number. Required minimum version of PHP is 5.6 and Wordpress version 5.0.
* Version: 1.0.0
* Author: Indianic
* Author URI: https://indianic.com
* License: GPL2
*/

if (!defined('ABSPATH')) {
		exit;
}

define('INIC_CF_CC_URL', plugin_dir_url(__FILE__));
define('INIC_CF_CC_PUBLIC_URL', INIC_CF_CC_URL . 'public/');

define('ITI4CF7_VERSION', '1.5.7');
  define('ITI4CF7_BASENAME', plugin_basename(__FILE__));
  define('ITI4CF7_DIR', plugin_dir_path(__FILE__));
  define('ITI4CF7_URL', plugin_dir_url(__FILE__));
  define('ITI4CF7_ASSETS_DIR', ITI4CF7_DIR . 'assets/');
  define('ITI4CF7_INCLUDES_DIR', ITI4CF7_DIR . 'includes/');
  define('ITI4CF7_VENDOR_DIR', ITI4CF7_DIR . 'vendor/');
  define('ITI4CF7_ASSETS_URL', ITI4CF7_URL . 'assets/');
  define('ITI4CF7_INCLUDES_URL', ITI4CF7_URL . 'includes/');
  define('ITI4CF7_VENDOR_URL', ITI4CF7_URL . 'vendor/');
  define('ITI4CF7_PUBLIC_URL', ITI4CF7_URL . 'public/');

register_activation_hook( __FILE__, 'iNic_CF_CC_activation' );

/**
 * Activation hook for version 1.0.0
 */

function iNic_CF_CC_activation() {
	global $wp_version;

	$php_version = '5.6';
	$wordpress_version  = '5.0';

	if ( version_compare( PHP_VERSION, $php_version, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'Required version for PHP is %1$s. Please update your PHP version to activate this plugin.', 'iNic_CF_CC_plugin' ),
				$php_version
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'iNic_CF_CC_plugin' ) . '</a>'
		);
	}

	if ( version_compare( $wp_version, $wordpress_version, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'Required version for WordPress is %1$s. Please update your WordPress version to activate this plugin.', 'iNic_CF_CC_plugin' ),
				$wordpress_version
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'iNic_CF_CC_plugin' ) . '</a>'
		);
	}
}

/**
 * Deactivation hook for version 1.0.0
 */
register_deactivation_hook( __FILE__, 'iNic_CF_CC_deactivation' );
function iNic_CF_CC_deactivation() {
  // Deactivation rules here
}


/**
 * Init hook for version 1.0.0
 */
add_action( 'init', 'iNic_CF_CC_init' );
function iNic_CF_CC_init() {
	include_once plugin_dir_path( __FILE__ ).'admin/admin_init.php';
	include_once plugin_dir_path( __FILE__ ).'public/iNic-CF7-CC-form-tag.php';
	include_once plugin_dir_path( __FILE__ ).'admin/iNic-CF7-CC-mail.php';
}