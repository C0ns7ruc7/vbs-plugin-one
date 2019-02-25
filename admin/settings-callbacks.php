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

// callback: text field
function vbsagendaplugin_callback_field_text( $args ) {

    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    echo '<input id="vbsagendaplugin_options_'. $id .'" name="vbsagendaplugin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
    echo '<label for="vbsagendaplugin_options_'. $id .'">'. $label .'</label>';
}

// callback: radio field
function vbsagendaplugin_callback_field_radio( $args ) {

    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    $radio_options = array(
        'enable'  => 'Enable custom styles',
        'disable' => 'Disable custom styles'
    );

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

// callback: select field
function vbsagendaplugin_callback_field_select( $args ) {

    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    $select_options = array(

        'default'   => 'Default',
        'light'     => 'Light',
        'blue'      => 'Blue',
        'coffee'    => 'Coffee',
        'ectoplasm' => 'Ectoplasm',
        'midnight'  => 'Midnight',
        'ocean'     => 'Ocean',
        'sunrise'   => 'Sunrise',

    );

    echo '<select id="vbsagendaplugin_options_'. $id .'" name="vbsagendaplugin_options['. $id .']">';

    foreach ( $select_options as $value => $option ) {

        $selected = selected( $selected_option === $value, true, false );

        echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';

    }

    echo '</select> <label for="vbsagendaplugin_options_'. $id .'">'. $label .'</label>';
}
