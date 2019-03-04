<!-- <archive-post-agenda.php> -->

<?php get_header()
/**
 * shows when a single page is on focus for the browser
 */
?>

<div class="container pt-5 pb-5">
    <h1><?php single_cat_title(); /** cat = category, not animals **/ ?></h1>

    <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <div class="card mb-2">
            <div class="card-body">
                <h3> <?php var_dump( get_post_meta( $post->ID, '_vbsagendaplugin_date_meta_key', true ) );?></h3>
                <h4><?php the_title(); ?></h4>

                <a href="<?php the_permalink(); ?>" class="btn btn-success">Read more</a>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer() ?>