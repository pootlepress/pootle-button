<?php
/**
 * Plugin Name: pootle buttons
 * Plugin URI: http://pootlepress.com/
 * Description: A cool plugin to add delicious buttons in WordPress editor
 * Version: 0.7
 * Author: pootlepress
 * Author URI: http://pootlepress.com/
 * License: GPL version 3
 * @developer wpdevelopment.me <shramee@wpdevelopment.me>
 */
add_action( 'admin_init', 'pbtn_tinymce_button' );
function pbtn_tinymce_button() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		add_filter( 'mce_buttons', 'pbtn_register_tinymce_button' );
		add_filter( 'mce_external_plugins', 'pbtn_add_tinymce_button' );
	}
}

function pbtn_register_tinymce_button( $buttons ) {
	array_push( $buttons, 'pbtn_add_btn' );
	return $buttons;
}

function pbtn_add_tinymce_button( $plugin_array ) {
	$plugin_array['my_button_script'] = plugins_url( '/assets/tmce-plgn.js', __FILE__ ) ;
	return $plugin_array;
}