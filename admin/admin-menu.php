<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 25-2-2019
 * Time: 13:15
 *
 * vbsagendaplugin - admin menu
 */
defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// add top-level administrative menu
function vbsagendaplugin_add_menus() {

    add_submenu_page(
        'edit.php?post_type=post_agenda',
        'Agenda Settings',
        'Agenda Settings',
        'manage_options',
        'vbsagendaplugin',
        'vbsagendaplugin_display_settings_page'
    );
}
add_action( 'admin_menu', 'vbsagendaplugin_add_menus' );