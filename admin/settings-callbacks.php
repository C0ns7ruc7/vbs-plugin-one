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
    echo '<p>These settings enable you to customize the WP Login screen.</p>';
}

// callback: admin section
function vbsagendaplugin_callback_section_admin() {
    echo '<p>These settings enable you to customize the WP Admin Area.</p>';
}

// callback: text field
function vbsagendaplugin_callback_field_text( $args ) {
    // todo: add callback functionality..
    echo 'This will be a text field.';
}

// callback: radio field
function vbsagendaplugin_callback_field_radio( $args ) {
    // todo: add callback functionality..
    echo 'This will be a radio field.';
}

// callback: textarea field
function vbsagendaplugin_callback_field_textarea( $args ) {
    // todo: add callback functionality..
    echo 'This will be a textarea.';
}

// callback: checkbox field
function vbsagendaplugin_callback_field_checkbox( $args ) {
    // todo: add callback functionality..
    echo 'This will be a checkbox.';
}

// callback: select field
function vbsagendaplugin_callback_field_select( $args ) {
    // todo: add callback functionality..
    echo 'This will be a select menu.';
}
