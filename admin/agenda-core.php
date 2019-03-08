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

// callback: date selector custom meta box
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
    <b><?php echo esc_html__('Old date', 'vbsagendaplugin') . ': ' . ($meta ? $meta: esc_html__('Never', 'vbsagendaplugin') ); ?></b>

<?php }


// save date selection to database
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




