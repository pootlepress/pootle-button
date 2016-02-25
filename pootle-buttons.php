<?php
/**
 * Plugin Name: pootle buttons
 * Plugin URI: http://pootlepress.com/
 * Description: A cool plugin to add delicious buttons in WordPress editor
 * Version: 0.7
 * Author: pootlepress
 * Author URI: http://pootlepress.com/
 * License: GPL version 3
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */

add_action( 'admin_head', 'pbtn_l10n' );
add_action( 'wp_header', 'pbtn_l10n' );
function pbtn_l10n() {
	?>
	<script></script>
	<?php
}

add_filter( 'mce_buttons', 'pbtn_register_tinymce_button' );
function pbtn_register_tinymce_button( $buttons ) {
	array_push( $buttons, 'pbtn_add_btn' );
	return $buttons;
}

add_filter( 'mce_external_plugins', 'pbtn_add_tinymce_button' );
function pbtn_add_tinymce_button( $plugin_array ) {
	$plugin_array['pbtn_script'] = plugins_url( '/tmce-plgn.js', __FILE__ ) ;
	return $plugin_array;
}