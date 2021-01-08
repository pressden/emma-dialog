<?php
/*
Plugin Name: Emma Dialog
Plugin URI: https://github.com/pressden/emma-dialog
Description: Emma Dialog is a WordPress plugin that adds a configurable dialog/popup block to the Gutenberg editor for the Emma theme.
Version: 1.0.0
Author: Eric Michel
Author URI: http://pressden.com/
License: GPLv2 or later
Text Domain: emma_dialog
*/

/**
 * Register and conditionally enqueue frontend scripts
 */
function emma_dialog_enqueue_frontend() {
  $dialog_library_js = plugin_dir_url( __FILE__ ) . 'vendor/dialog-polyfill/dialog-polyfill.js';
  $dialog_frontend_js = plugin_dir_url( __FILE__ ) . 'js/dialog-frontend.js';;
  $dialog_version = '3.4.1';

  global $post;
  if( has_block( 'emma/dialog', $post ) ) {
    wp_enqueue_script( 'dialog-library', $dialog_library_js, [], $dialog_version, true );
    wp_enqueue_script( 'dialog-frontend', $dialog_frontend_js, ['dialog-library'], $dialog_version, true );
  }
}
add_action( 'wp_enqueue_scripts', 'emma_dialog_enqueue_frontend' );

/**
 * Register and enqueue editor scripts
 */
function emma_dialog_enqueue_editor() {
  $dialog_editor_js = plugin_dir_url( __FILE__ ) . 'js/dialog-editor.js';
  $dialog_block_version = '1.0.0';

  wp_enqueue_script( 'dialog-editor', $dialog_editor_js, ['wp-blocks','wp-editor'], $dialog_block_version, true );
}
add_action( 'enqueue_block_editor_assets', 'emma_dialog_enqueue_editor' );
