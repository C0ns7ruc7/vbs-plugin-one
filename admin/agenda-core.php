<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 28-2-2019
 * Time: 10:36
 *
 * vbsagendaplugin - core functions
 */

defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// add custom post type
function vbsagendaplugin_add_custom_post_type() {

    /*

        register_post_type(
            string       $post_type,
            array|string $args = array()
        )

        For a list of $args, check out:
        https://developer.wordpress.org/reference/functions/register_post_type/

    */

    $args = array(
        'labels'             => array( 'name' => 'Agendas' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'agenda' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor'),
    );

    register_post_type( 'post_agenda', $args );

}
add_action( 'init', 'vbsagendaplugin_add_custom_post_type' );

// meta box for date
function date_picker_meta_box() {
    add_meta_box(
        'date_picker_meta_box',
        'Select Date',
        'vbsagendaplugin_callback_date_select',
        'post_agenda',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'date_picker_meta_box' );

// callback: date selector
function vbsagendaplugin_callback_date_select( $post ){
    $meta = get_post_meta( $post->ID, '_vbsagendaplugin_date_meta_key', true );

    wp_nonce_field( basename( __FILE__ ), 'vbs_agenda_nonce' );

    $currentdate = date("Y-m-d");
    ?>

    <!-- All fields will go here -->

    <label for="agenda-date"><?php echo esc_html__('Start date', 'vbsagendaplugin'); ?></label>

    <input type="date"
           id="agenda-date"
           name="agenda-date"
           value="<?php echo ($meta ? $meta : $currentdate); ?>"
           min="<?php echo $currentdate; ?>"
    >
    <b><?php echo esc_html__('Old date', 'vbsagendaplugin') . ': ' . ($meta ? $meta: null ); ?></b>


<?php }


function save_date_picker_fields_meta( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );

    $is_valid_nonce = false;

    if ( isset( $_POST[ 'vbs_agenda_nonce' ] ) ) {

        if ( wp_verify_nonce( $_POST[ 'vbs_agenda_nonce' ], basename( __FILE__ ) ) ) {

            $is_valid_nonce = true;

        }

    }

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;

    if ( array_key_exists( 'agenda-date', $_POST ) ) {

        update_post_meta(
            $post_id,                                            // Post ID
            '_vbsagendaplugin_date_meta_key',                                // Meta key
            sanitize_text_field( $_POST[ 'agenda-date' ] ) // Meta value
        );

    }

}
add_action( 'save_post', 'save_date_picker_fields_meta' );

