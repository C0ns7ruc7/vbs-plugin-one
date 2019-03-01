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

function save_date_picker_fields_meta( $post_id ) {
    // verify nonce
    if ( !wp_verify_nonce( $_POST['vbs_agenda_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }

    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    // check permissions
    if ( 'page' === $_POST['agenda_post'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    $old = get_post_meta( $post_id, '_agenda_date_picker_meta_key', true );
    $new = $_POST['_agenda_date_picker_meta_key'];

    if ( $new && $new !== $old ) {
        update_post_meta(
            $post_id,
            'vbsagendaplugin_callback_date_select',
            $new
        );
    } elseif ( '' === $new && $old ) {
        delete_post_meta(
            $post_id,
            'vbsagendaplugin_callback_date_select',
            $old
        );
    }

    
}
add_action( 'save_post', 'save_date_picker_fields_meta' );

