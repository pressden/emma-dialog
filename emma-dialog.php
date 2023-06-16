<?php
/**
 * Plugin Name:       Emma Dialog
 * Description:       Emma Dialog is a WordPress plugin that adds a configurable dialog/popup block to the Gutenberg editor for the Emma theme.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Eric Michel
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       emma-dialog
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_emma_dialog_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_emma_dialog_block_init' );
