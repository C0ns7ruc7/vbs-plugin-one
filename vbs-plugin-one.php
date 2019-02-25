<?php
/**
 * Plugin Name: vbs-plugin-one
 * Plugin URI:  https://github.com/C0ns7ruc7/vbs-plugin-one
 * Description: Wordpress agenda plugin
 * Version:     2.0.0
 * Author:      Valiant Hekert
 * Author URI:  https://valianthekert.wordpress.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: vbsagendaplugin
 *
 * {Plugin Name} is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * {Plugin Name} is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with {Plugin Name}. If not, see {License URI}.
 */

defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// when in in admin area
if ( is_admin() ){
    // include dep
    require_once plugin_dir_path( __file__ ) . 'admin/admin-menu.php';
    require_once plugin_dir_path( __file__ ) . 'admin/settings-page.php';
}