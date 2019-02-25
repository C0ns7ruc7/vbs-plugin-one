<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 25-2-2019
 * Time: 14:40
 *
 * vbsagendaplugin - Register settings
 */

defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// register plugin settings
function vbsagendaplugin_register_settings() {
    /*
    register_setting(
        string   $option_group,
        string   $option_name,
        callable $sanitize_callback
    );
    */

    register_setting(
        'vbsagendaplugin_options',
        'vbsagendaplugin_options',
        'vbsagendaplugin_callback_validate_options'
    );
    /*
    add_settings_section(
        string   $id,
        string   $title,
        callable $callback,
        string   $page
    );
    */

    add_settings_section(
        'vbsagendaplugin_section_login',
        'Customize Login Page',
        'vbsagendaplugin_callback_section_login',
        'vbsagendaplugin'
    );

    add_settings_section(
        'vbsagendaplugin_section_admin',
        'Customize Admin Area',
        'vbsagendaplugin_callback_section_admin',
        'vbsagendaplugin'
    );

    /*
    add_settings_field(
        string   $id,
        string   $title,
        callable $callback,
        string   $page,
        string   $section = 'default',
        array    $args = []
    );
    */

    add_settings_field(
        'custom_url',
        'Custom URL',
        'vbsagendaplugin_callback_field_text',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_url', 'label' => 'Custom URL for the login logo link' ]
    );

    add_settings_field(
        'custom_title',
        'Custom Title',
        'vbsagendaplugin_callback_field_text',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_title', 'label' => 'Custom title attribute for the logo link' ]
    );

    add_settings_field(
        'custom_style',
        'Custom Style',
        'vbsagendaplugin_callback_field_radio',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_style', 'label' => 'Custom CSS for the Login screen' ]
    );

    add_settings_field(
        'custom_message',
        'Custom Message',
        'vbsagendaplugin_callback_field_textarea',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_message', 'label' => 'Custom text and/or markup' ]
    );

    add_settings_field(
        'custom_footer',
        'Custom Footer',
        'vbsagendaplugin_callback_field_text',
        'vbsagendaplugin',
        'vbsagendaplugin_section_admin',
        [ 'id' => 'custom_footer', 'label' => 'Custom footer text' ]
    );

    add_settings_field(
        'custom_toolbar',
        'Custom Toolbar',
        'vbsagendaplugin_callback_field_checkbox',
        'vbsagendaplugin',
        'vbsagendaplugin_section_admin',
        [ 'id' => 'custom_toolbar', 'label' => 'Remove new post and comment links from the Toolbar' ]
    );

    add_settings_field(
        'custom_scheme',
        'Custom Scheme',
        'vbsagendaplugin_callback_field_select',
        'vbsagendaplugin',
        'vbsagendaplugin_section_admin',
        [ 'id' => 'custom_scheme', 'label' => 'Default color scheme for new users' ]
    );
}

add_action( 'admin_init', 'vbsagendaplugin_register_settings' );
