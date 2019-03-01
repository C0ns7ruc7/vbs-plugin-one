<?php
/**
 * uninstall.php
 * fires when plugin is uninstalled via the Plugins screen
 */


// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// delete the plugin options
delete_option( 'vbsagendaplugin_options' );
remove_meta_box(
    'date_picker_meta_box',
    'post_agenda',
    'normal'
);

/**
 * examples of deleting data
 *
 * Delete options:               delete_option()
 * Delete options (Multisite):   delete_site_option()
 * Delete transient:             delete_transient()
 * Delete metadata:              delete_metadata()
 **

Delete database table:

global $wpdb;
$table_name = $wpdb->prefix . 'myplugin_table';
$wpdb->query( "DROP TABLE IF EXISTS {$table_name}" );


Delete cron event:

$timestamp = wp_next_scheduled( 'sfs_cron_cache' );
wp_unschedule_event( $timestamp, 'sfs_cron_cache' );
 */