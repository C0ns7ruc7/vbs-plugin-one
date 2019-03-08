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
        callable $sanitize_callback = ''
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
        esc_html__('Customize Login Page', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_section_login',
        'vbsagendaplugin'
    );

    add_settings_section(
        'vbsagendaplugin_section_admin',
        esc_html__('Customize Admin Area', 'vbsagendaplugin'),
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
        esc_html__('Custom URL', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_field_text',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_url', 'label' => esc_html__('Custom URL for the login logo link', 'vbsagendaplugin') ]
    );

    add_settings_field(
        'custom_title',
        esc_html__('Custom Title', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_field_text',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_title', 'label' => esc_html__('Custom title attribute for the logo link', 'vbsagendaplugin') ]
    );

    add_settings_field(
        'custom_style',
        esc_html__('Custom Style', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_field_radio',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_style', 'label' => esc_html__('Custom CSS for the Login screen', 'vbsagendaplugin') ]
    );

    add_settings_field(
        'custom_message',
        esc_html__('Custom Message', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_field_textarea',
        'vbsagendaplugin',
        'vbsagendaplugin_section_login',
        [ 'id' => 'custom_message', 'label' => esc_html__('Custom text and/or markup', 'vbsagendaplugin') ]
    );

    add_settings_field(
        'custom_footer',
        esc_html__('Custom Footer', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_field_text',
        'vbsagendaplugin',
        'vbsagendaplugin_section_admin',
        [ 'id' => 'custom_footer', 'label' => esc_html__('Custom footer text', 'vbsagendaplugin') ]
    );

    add_settings_field(
        'custom_toolbar',
        esc_html__('Custom Toolbar', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_field_checkbox',
        'vbsagendaplugin',
        'vbsagendaplugin_section_admin',
        [ 'id' => 'custom_toolbar', 'label' => esc_html__('Remove new post and comment links from the Toolbar', 'vbsagendaplugin') ]
    );

    add_settings_field(
        'custom_scheme',
        esc_html__('Custom Scheme', 'vbsagendaplugin'),
        'vbsagendaplugin_callback_field_select',
        'vbsagendaplugin',
        'vbsagendaplugin_section_admin',
        [ 'id' => 'custom_scheme', 'label' => esc_html__('Default color scheme for new users', 'vbsagendaplugin') ]
    );
}
add_action( 'admin_init', 'vbsagendaplugin_register_settings' );
