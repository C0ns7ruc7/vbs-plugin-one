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
        'VBS Agenda',
        'manage_options',
        'vbsagendaplugin',
        'vbsagendaplugin_display_settings_page',
        'dashicons-admin-generic',
        null
    );

}
add_action( 'admin_menu', 'vbsagendaplugin_add_toplevel_menu' );

// add sub-level administrative menu
function vbsagendaplugin_add_sublevel_menu() {

    /*

    add_submenu_page(
        string   $parent_slug,
        string   $page_title,
        string   $menu_title,
        string   $capability,
        string   $menu_slug,
        callable $function = ''
    );

    */

    add_submenu_page(
        'vbsagendaplugin',
        'General Settings',
        'Manage agenda',
        'manage_options',
        'vbsagendapluginsub',
        'vbsagendaplugin_display_settings_page'
    );

}
add_action( 'admin_menu', 'vbsagendaplugin_add_sublevel_menu' );