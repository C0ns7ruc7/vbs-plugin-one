<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 25-2-2019
 * Time: 12:20
 *
 * file contains old practice code
 */

/** 1.0
 * Creates a function that contains the menu-building code */

function vbs_one_plugin_menu() {
    add_options_page(
        'My Plugin Options',
        'My Plugin',
        'manage_options',
        'my-unique-identifier',
        'my_plugin_options' );
}

/** 1.1
 * Creates the HTML output for the page (screen) displayed when
 * the menu item is clicked */

function vbs_one_plugin_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    echo '<div class="wrap">';
    echo '<p>Here is where the form would go if I actually had options.</p>';
    echo '</div>';
}

/** 1.2
 * Registers the 1.0 function using the admin_menu action hook.
 * (If one is adding an admin menu for the Network, use network_admin_menu instead).
 */

add_action( 'admin_menu', 'vbs_one_plugin_menu' );
// next plugins should avoid using 'plugin' in the name


/** 1.3
 * run on start
 */
function vbs_one_on_activation(){ // public functions need unique prefix, else class.
    if ( ! current_user_can('activate_plugins') ) return;

    add_option( 'vbs_one_posts_per_page', 10 );
    add_option( 'vbs_one_show_welcome_page', true );
}
register_activation_hook( __FILE__, 'vbs_one_on_activation');

/** 1.4
 * run on deactivation
 */
function vbs_one_on_deactivation() {

    if ( ! current_user_can( 'activate_plugins' ) ) return;

    flush_rewrite_rules();

}
register_deactivation_hook( __FILE__, 'vbs_one_on_deactivation' );

/** 1.5
 * run on uninstall
 */

function vbs_one_on_uninstall() {

    if ( ! current_user_can( 'activate_plugins' ) ) return;

    delete_option( 'vbs_one_posts_per_page', 10 );
    delete_option( 'vbs_one_show_welcome_page', true );

}
register_uninstall_hook( __FILE__, 'vbs_one_on_uninstall' );