<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 4-3-2019
 * Time: 12:59
 *
 * add post type post-agenda
 */

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

    register_post_type( 'post-agenda', $args );

}
add_action( 'init', 'vbsagendaplugin_add_custom_post_type' );

// meta box for date
function vbsagendaplugin_date_picker_meta_box() {
    add_meta_box(
        'date_picker_meta_box',
        'Select Date',
        'vbsagendaplugin_callback_date_select',
        'post-agenda',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'vbsagendaplugin_date_picker_meta_box' );
