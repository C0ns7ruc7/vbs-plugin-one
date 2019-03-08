<!-- <single-post-agenda.php> -->

<?php get_header()

/**
 * shows when a single post is on focus for the browser
 */
?>

<div class="container pt-5 pb-5">

    <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <div class="card mb-2">
            <div class="card-body">
                <h1><?php the_title(); ?></h1>
                <?php echo( get_post_meta( $post->ID, '_vbsagendaplugin_date_meta_key', true ) );?>

                <arcticle>
                    <?php the_content(); ?>
                </arcticle>

            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer() ?>