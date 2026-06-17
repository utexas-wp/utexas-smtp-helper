<?php

/**
 * Plugin Name: UTexas SMTP Helper
 * Version: 0.1.0
 * Description: UT-specific configuration for use with the WP Mail SMTP plugin.
 * Author: Web Content Management Solutions, UT Austin
 * Text Domain: utexas-smtp-helper
 * Plugin URI: https://github.com/utexas-wp/utexas-smtp-helper
 * Requires Plugins: wp-mail-smtp
 *
 * @package utexas-smtp-helper
 */

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
	$credential = function_exists( 'pantheon_get_secret' ) ? pantheon_get_secret( $secret ) ?? '' : '';
	define( $constant, $credential );
}

// Display message on the dashboard when WP Mail SMTP plugin missing.
function utexas_missing_plugin_wp_smtp__warning() {
	?>
	<div class="notice notice-warning is-dismissible">
		<p><?php _e( 'UTexas SMTP Helper requires the WP Mail SMTP plugin - please activate it.', 'utexas-smtp-helper-wp' ); ?></p>
	</div>
	<?php
}

// Check if required plugins are active -- if not, display a warning message on the dashboard.
function utexas_smtp_helper_wp_check_plugins() {
	if ( ! is_plugin_active( 'wp-mail-smtp/wp_mail_smtp.php' ) ) {
		add_action( 'admin_notices', 'utexas_missing_plugin_wp_smtp__warning' );
	}
}

add_action( 'admin_init', 'utexas_smtp_helper_wp_check_plugins' );

// Activate other required plugins when this plugin is activated.
function utexas_smtp_helper_wp_activate() {
	if ( ! is_plugin_active( 'wp-mail-smtp/wp-mail-smtp.php' ) ) {
		activate_plugins( array( 'wp-mail-smtp/wp-mail-smtp.php' ) );
	}
}
