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

define('INIC_CF_CC_URL', plugin_dir_url(__FILE__));
define('INIC_CF_CC_PUBLIC_URL', INIC_CF_CC_URL . 'public/');

register_activation_hook( __FILE__, 'iNic_CF_CC_activation' );

/**
 * Activation hook
 */

function iNic_CF_CC_activation() {
	global $wp_version;

	$php = '5.6';
	$wp  = '5.0';

	if ( version_compare( PHP_VERSION, $php, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'This plugin can not be activated because it requires a PHP version greater than %1$s. Your PHP version can be updated by your hosting company.', 'my_plugin' ),
				$php
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'my_plugin' ) . '</a>'
		);
	}

	if ( version_compare( $wp_version, $wp, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'This plugin can not be activated because it requires a WordPress version greater than %1$s. Please go to Dashboard &#9656; Updates to gran the latest version of WordPress .', 'my_plugin' ),
				$wp
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'my_plugin' ) . '</a>'
		);
	}
}

/**
 * Deactivation hook
 */
register_deactivation_hook( __FILE__, 'iNic_CF_CC_deactivation' );
function iNic_CF_CC_deactivation() {
  // Deactivation rules here
}

/**
 * Init hook
 */
add_action( 'init', 'iNic_CF_CC_init' );
function iNic_CF_CC_init() {
	include_once plugin_dir_path( __FILE__ ).'admin/admin_cf_cc.php';
}