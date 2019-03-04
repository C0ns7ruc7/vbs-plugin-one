<?php
// force use of templates from plugin folder
function vbsagendaplugin_force_template( $template )
{
    $posttype = 'post-agenda';

    if( is_archive( $posttype ) ) {
        $template = plugin_dir_path( __file__ ) . 'templates/archive-post-agenda.php';
    }

    if( is_singular( $posttype ) ) {
        $template = plugin_dir_path( __file__ ) . 'templates/single-post-agenda.php';
    }

    return $template;
}
add_filter( 'template_include', 'vbsagendaplugin_force_template' );