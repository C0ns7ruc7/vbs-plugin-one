<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 26-2-2019
 * Time: 10:28
 *
 * vbsagendaplugin - Core Functions
 */

defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// custom login logo url
function vbsagendaplugin_custom_login_url( $url ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {
        $url = esc_url( $options['custom_url'] );
    }

    return $url;
}
add_filter( 'login_headerurl', 'vbsagendaplugin_custom_login_url' );

// custom login logo title
function vbsagendaplugin_custom_login_title( $title ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {
        $title = esc_attr( $options['custom_title'] );
    }

    return $title;
}
add_filter( 'login_headertitle', 'vbsagendaplugin_custom_login_title' );

// custom login styles
function vbsagendaplugin_custom_login_styles() {
    $styles = false;

    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    if ( isset( $options['custom_style'] ) && ! empty( $options['custom_style'] ) ) {
        $styles = sanitize_text_field( $options['custom_style'] );
    }

    if ( 'enable' === $styles ) {

        /*

        wp_enqueue_style(
            string           $handle,
            string           $src = '',
            array            $deps = array(),
            string|bool|null $ver = false,
            string           $media = 'all'
        )

        wp_enqueue_script(
            string           $handle,
            string           $src = '',
            array            $deps = array(),
            string|bool|null $ver = false,
            bool             $in_footer = false
        )

        */

        wp_enqueue_style(
            'vbsagendaplugin',
            plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/vbsagendaplugin-login.css',
            array(),
            null,
            'screen'
        );

        wp_enqueue_script(
            'vbsagendaplugin',
            plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/vbsagendaplugin-login.js',
            array(),
            null,
            true );
    }
}
add_action( 'login_enqueue_scripts', 'vbsagendaplugin_custom_login_styles' );

// custom login message
function vbsagendaplugin_custom_login_message( $message ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {
        $message = wp_kses_post( $options['custom_message'] ) . $message;
    }

    return $message;
}
add_filter( 'login_message', 'vbsagendaplugin_custom_login_message' );

// custom admin footer
function vbsagendaplugin_custom_admin_footer( $message ) {
    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    if ( isset( $options['custom_footer'] ) && ! empty( $options['custom_footer'] ) ) {
        $message = sanitize_text_field( $options['custom_footer'] );
    }

    return $message;
}
add_filter( 'admin_footer_text', 'vbsagendaplugin_custom_admin_footer' );

// custom toolbar items
function vbsagendaplugin_custom_admin_toolbar() {
    $toolbar = false;

    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    if ( isset( $options['custom_toolbar'] ) && ! empty( $options['custom_toolbar'] ) ) {
        $toolbar = (bool) $options['custom_toolbar'];
    }

    if ( $toolbar ) {
        global $wp_admin_bar;

        $wp_admin_bar->remove_menu( 'comments' );
        $wp_admin_bar->remove_menu( 'new-content' );
    }
}
add_action( 'wp_before_admin_bar_render', 'vbsagendaplugin_custom_admin_toolbar', 999 );

// custom admin color scheme
function vbsagendaplugin_custom_admin_scheme( $user_id ) {
    $scheme = 'default';

    $options = get_option( 'vbsagendaplugin_options', vbsagendaplugin_options_default() );

    if ( isset( $options['custom_scheme'] ) && ! empty( $options['custom_scheme'] ) ) {
        $scheme = sanitize_text_field( $options['custom_scheme'] );
    }

    $args = array( 'ID' => $user_id, 'admin_color' => $scheme );

    wp_update_user( $args );
}
add_action( 'user_register', 'vbsagendaplugin_custom_admin_scheme' );

/**
 * load stylesheets
 */

function vbsagendaplugin_load_stylesheets(){
    wp_enqueue_script(
        'bootstrap', // sheet name
        plugin_dir_url( __FILE__ ) . 'public/css/bootstrap.min.css', // link to Dir
        array(), // dependant stylesheets
        false, // version
        'all' // applied on
    );

    wp_enqueue_script(
        'stylesheet',
        plugin_dir_url( __FILE__ ) . 'public//style.css',
        array(),
        false,
        'all'
    );

    wp_enqueue_script(
        'bootstrap',
        plugin_dir_url( __FILE__ ) . 'public/js/bootstrap.min.js',
        array(),
        false,
        true
    );

    wp_deregister_script('jquery'); // unloads script by this name

    wp_enqueue_script(
        'jquery',
        plugin_dir_url( __FILE__ ) . 'public/js/jquery.3-3-1.min.js',
        '',
        1,
        true // footer y/n
    );
}
add_action('wp_enqueue_scripts', 'vbsagendaplugin_load_stylesheets'); // add to style/scripts