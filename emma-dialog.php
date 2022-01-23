<?php
/**
 * Plugin Name: Emma Dialog
 * Plugin URI: https://github.com/pressden/emma-dialog
 * Description: Emma Dialog is a WordPress plugin that adds a configurable dialog/popup block to the Gutenberg editor for the Emma theme.
 * Version: 1.0.0
 * Author: Eric Michel
 * Author URI: http://pressden.com/
 * License: GPLv2 or later
 * Text Domain: emma_dialog
 *
 * @package EmmaDialog
 */

define( 'EMMA_DIALOG_VERSION',         '1.0.00' );
define( 'EMMA_DIALOG_LIBRARY_VERSION', '0.5.2' );

/**
 * Register and conditionally enqueue frontend scripts
 */
function emma_dialog_enqueue_frontend() {
	global $post;

	$dialog_library_version = '0.5.2';
	$dialog_library_js = plugin_dir_url( __FILE__ ) . 'vendor/dialog-polyfill/dialog-polyfill.js';
	$dialog_library_css = plugin_dir_url( __FILE__ ) . 'vendor/dialog-polyfill/dialog-polyfill.css';
	$dialog_frontend_js = plugin_dir_url( __FILE__ ) . 'js/dialog-frontend.js';

	if( has_block( 'emma/dialog', $post ) ) {
		wp_enqueue_script( 'dialog-library', $dialog_library_js, [], EMMA_DIALOG_LIBRARY_VERSION, true );
		wp_enqueue_style( 'dialog-library', $dialog_library_css, [], EMMA_DIALOG_LIBRARY_VERSION );
		wp_enqueue_script( 'dialog-frontend', $dialog_frontend_js, ['dialog-library'], EMMA_DIALOG_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'emma_dialog_enqueue_frontend' );

/**
 * Register and enqueue editor scripts
 */
function emma_dialog_enqueue_editor() {
	$dialog_editor_js = plugin_dir_url( __FILE__ ) . 'js/dialog-editor.js';

	wp_enqueue_script( 'dialog-editor', $dialog_editor_js, ['wp-blocks','wp-editor'], EMMA_DIALOG_VERSION, true );
}
add_action( 'enqueue_block_editor_assets', 'emma_dialog_enqueue_editor' );
