<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 25-2-2019
 * Time: 14:42
 *
 * vbsagendaplugin - settings callback
 */

defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// callback: login section
function vbsagendaplugin_callback_section_login() {
    echo '<p>'. esc_html__('These settings enable you to customize the WP Login screen.', 'vbsagendaplugin') .'</p>';
}

// callback: admin section
function vbsagendaplugin_callback_section_admin() {
    echo '<p>'. esc_html__('These settings enable you to customize the WP Admin Area.', 'vbsagendaplugin') .'</p>';
}

// callback: text field
function vbsagendaplugin_callback_field_text( $args ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    echo '<input id="vbsagendaplugin_options_'. $id .'" name="vbsagendaplugin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
    echo '<label for="vbsagendaplugin_options_'. $id .'">'. $label .'</label>';
}

// radio field options
function vbsagendaplugin_options_radio() {
    return array(
        'enable'  => esc_html__('Enable custom styles', 'vbsagendaplugin'),
        'disable' => esc_html__('Disable custom styles', 'vbsagendaplugin')
    );
}

// callback: radio field
function vbsagendaplugin_callback_field_radio( $args ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    $radio_options = vbsagendaplugin_options_radio();

    foreach ( $radio_options as $value => $label ) {
        $checked = checked( $selected_option === $value, true, false );

        echo '<label><input name="vbsagendaplugin_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
        echo '<span>'. $label .'</span></label><br />';
    }
}

// callback: textarea field
function vbsagendaplugin_callback_field_textarea( $args ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $allowed_tags = wp_kses_allowed_html( 'post' );

    $value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';

    echo '<textarea id="vbsagendaplugin_options_'. $id .'" name="vbsagendaplugin_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
    echo '<label for="vbsagendaplugin_options_'. $id .'">'. $label .'</label>';
}

// callback: checkbox field
function vbsagendaplugin_callback_field_checkbox( $args ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';

    echo '<input id="vbsagendaplugin_options_'. $id .'" name="vbsagendaplugin_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
    echo '<label for="vbsagendaplugin_options_'. $id .'">'. $label .'</label>';
}

// select field options
function vbsagendaplugin_options_select() {
    return array(
        'default'   => esc_html__('Default',   'vbsagendaplugin'),
        'light'     => esc_html__('Light',     'vbsagendaplugin'),
        'blue'      => esc_html__('Blue',      'vbsagendaplugin'),
        'coffee'    => esc_html__('Coffee',    'vbsagendaplugin'),
        'ectoplasm' => esc_html__('Ectoplasm', 'vbsagendaplugin'),
        'midnight'  => esc_html__('Midnight',  'vbsagendaplugin'),
        'ocean'     => esc_html__('Ocean',     'vbsagendaplugin'),
        'sunrise'   => esc_html__('Sunrise',   'vbsagendaplugin'),
    );
}

// callback: select field
function vbsagendaplugin_callback_field_select( $args ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    $select_options = vbsagendaplugin_options_select();

    echo '<select id="vbsagendaplugin_options_'. $id .'" name="vbsagendaplugin_options['. $id .']">';

    foreach ( $select_options as $value => $option ) {
        $selected = selected( $selected_option === $value, true, false );

        echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
    }

    echo '</select> <label for="vbsagendaplugin_options_'. $id .'">'. $label .'</label>';
}