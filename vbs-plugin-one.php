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

// display the plugin settings page
function vbsagendaplugin_display_settings_page() {

    // check if user is allowed access
    if ( ! current_user_can( 'manage_options' ) ) return;

    ?>

    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">

            <?php

            // output security fields
            settings_fields( 'vbsagendaplugin_options' );

            // output setting sections
            do_settings_sections( 'vbsagendaplugin' );

            // submit button
            submit_button();

            ?>

        </form>
    </div>

    <?php

}

// add top-level administrative menu
function vbsagendaplugin_add_toplevel_menu() {

    /*
        add_menu_page(
            string   $page_title,
            string   $menu_title,
            string   $capability,
            string   $menu_slug,
            callable $function = '',
            string   $icon_url = '',
            int      $position = null
        )
    */

    add_menu_page(
        'VBSAgendaPlugin Settings',
        'VBSAgendaPlugin',
        'manage_options',
        'VBSAgendaPlugin',
        'VBSAgendaPlugin_display_settings_page',
        'dashicons-admin-generic',
        null
    );

}
add_action( 'admin_menu', 'vbsagendaplugin_add_toplevel_menu' );