<?php
/*
Plugin Name: Divi Weblocomotive
Plugin URI:  weblocomotive.com
Description: WebLocomotive divi extentions
Version:     1.0.0
Author:      WebLocomotive
Author URI:  
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: diwe-divi-weblocomotive
Domain Path: /languages

Divi Weblocomotive is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divi Weblocomotive is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divi Weblocomotive. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


if ( ! function_exists( 'diwe_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function diwe_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviWeblocomotive.php';
}
add_action( 'divi_extensions_init', 'diwe_initialize_extension' );
endif;
