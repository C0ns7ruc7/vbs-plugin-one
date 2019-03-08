<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 4-3-2019
 * Time: 12:59
 *
 * add post type post-agenda
 */

defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// add custom post type
function vbsagendaplugin_add_custom_post_type() {

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
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'vbsagendaplugin_date_picker_meta_box' );

function vbsagendaplugin_pre_get_posts( $query ) {

    // do not modify queries in the admin
    if( is_admin() ) {

        return $query;

    }


    // only modify queries for 'event' post type
    if( isset($query->query_vars['post_type']) &&
        $query->query_vars['post_type'] == 'post-agenda' ) {

        $query->set('orderby', 'meta_value');
        $query->set('meta_key', '_vbsagendaplugin_date_meta_key');
        $query->set('order', 'ASC');
        $query->set( 'posts_per_page', -1 );

    }


    // return
    return $query;

}

add_action('pre_get_posts', 'vbsagendaplugin_pre_get_posts');
