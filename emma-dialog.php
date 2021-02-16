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
  $dialog_library_css = plugin_dir_url( __FILE__ ) . 'vendor/dialog-polyfill/dialog-polyfill.css';
  $dialog_library_version = '0.5.2';

  $dialog_frontend_js = plugin_dir_url( __FILE__ ) . 'js/dialog-frontend.js';
  $dialog_frontend_version = '1.0.0';

  global $post;
  if( has_block( 'emma/dialog', $post ) ) {
    wp_enqueue_script( 'dialog-library', $dialog_library_js, [], $dialog_library_version, true );
    wp_enqueue_style( 'dialog-library', $dialog_library_css, [], $dialog_library_version );
    
    wp_enqueue_script( 'dialog-frontend', $dialog_frontend_js, ['dialog-library'], $dialog_editor_version, true );
  }
}
add_action( 'wp_enqueue_scripts', 'emma_dialog_enqueue_frontend' );

/**
 * Register and enqueue editor scripts
 */
function emma_dialog_enqueue_editor() {
  $dialog_editor_js = plugin_dir_url( __FILE__ ) . 'js/dialog-editor.js';
  $dialog_editor_version = '1.0.0';

  wp_enqueue_script( 'dialog-editor', $dialog_editor_js, ['wp-blocks','wp-editor'], $dialog_editor_version, true );
}
add_action( 'enqueue_block_editor_assets', 'emma_dialog_enqueue_editor' );

/**
 * Add SCSS to compiler
 */
function emma_dialog_compile_theme_css( $import_scss_files ) {
  $import_scss_files[] = plugin_dir_path(__FILE__) . 'sass/dialog-frontend';

  return $import_scss_files;
}
add_filter( 'emma_child_theme_scss', 'emma_dialog_compile_theme_css' );
