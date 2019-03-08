<?php
/**
 * Created by PhpStorm.
 * User: Vabese
 * Date: 25-2-2019
 * Time: 13:16
 *
 * vbsagendaplugin - settings menu
 */
defined( 'ABSPATH' ) or die( 'NO direct access allowed' );

// display the plugin settings page
function vbsagendaplugin_display_settings_page() {

    // check if user is allowed access
    if ( ! current_user_can( 'manage_options' ) ) return;

    ?>

    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php

            // output security fields
            settings_fields( 'vbsagendaplugin_options' );

            // output setting sections
            do_settings_sections( 'vbsagendaplugin' );

            // submit button
            submit_button();

            ?>
        </form>
    </div>

    <?php
}