<?php

/**
 * Plugin Name: UTexas SMTP Helper
 * Version: 0.1.0
 * Description: UT-specific configuration for use with the WP Mail SMTP plugin.
 * Author: Web Content Management Solutions, UT Austin
 * Text Domain: utexas-smtp-helper
 * Plugin URI: https://github.com/utexas-wp/utexas-smtp-helper
 * Update URI: https://github.com/utexas-wp/utexas-smtp-helper/archive/refs/heads/master.zip
 * Requires Plugins: wp-mail-smtp
 *
 * @package utexas-smtp-helper
 */

// This plugin only populates values in Pantheon environments.
if ( function_exists( 'pantheon_get_secret' ) ) {
	// See https://wpmailsmtp.com/docs/how-to-secure-smtp-settings-by-using-constants/.
	define( 'WPMS_ON', true );
	define( 'WPMS_MAILER', 'smtp' );
	define( 'WPMS_SSL', 'tls' );
	define( 'WPMS_SMTP_AUTH', true );
	define( 'WPMS_SMTP_AUTOTLS', true );

	$settings = array(
		'WPMS_SMTP_HOST'     => 'utexas_smtp_host',
		'WPMS_SMTP_PORT'     => 'utexas_smtp_port',
		'WPMS_SMTP_PROTOCOL' => 'utexas_smtp_protocol',
		'WPMS_SMTP_USER'     => 'utexas_smtp_username',
		'WPMS_SMTP_PASS'     => 'utexas_smtp_password',
	);
	foreach ( $settings as $constant => $secret ) {
		$credential = pantheon_get_secret( $secret ) ?? '';
		define( $constant, $credential );
	}
}
