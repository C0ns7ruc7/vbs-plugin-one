<!-- <archive-post-agenda.php> -->

<?php get_header()
/**
 * shows when a single page is on focus for the browser
 */
?>

<div class="container pt-5 pb-5">
    <h1><?php single_cat_title(); /** cat = category, not animals **/ ?></h1>

    <div class="container">
        <div class="row no-gutters">
            <?php if ( have_posts() ) : while( have_posts() ) : the_post();

                $costum_meta = get_post_meta(
                        $post->ID,
                        '_vbsagendaplugin_date_meta_key',
                        true
                );

                if(isset($date_meta_array)){

                    $date_meta_array_old = $date_meta_array;
                    $date_meta_array = explode("-", $costum_meta);

                    $date_skip[0] = $date_meta_array[0] - $date_meta_array_old[0]; // year
                    $date_skip[1] = $date_meta_array[1] - $date_meta_array_old[1]; // month
                    $date_skip[2] = $date_meta_array[2] - $date_meta_array_old[2]; // day

                    // echo $date_skip[0] . '-' . $date_skip[1] . '-' . $date_skip[2];

                }else{
                    $date_meta_array = explode("-", $costum_meta);
                }

                if( isset($date_skip )){
                    while ($date_skip[2] > 1) : ?>
                        <?php --$date_skip[2];?>
                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                <div href="" class="btn btn-light card h-100">
                                    <div class="card-body">
                                    <?php echo (
                                        $date_meta_array[0] . '-' .
                                        $date_meta_array[1] . '-' .
                                        ($date_meta_array[2] - $date_skip[2])
                                    ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                    endwhile;
                }
            ?>

                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="<?php the_permalink(); ?>" class="btn btn-light card h-100">
                        <div class="card-body">

                            <h4><?php echo $costum_meta;?></h4>
                            <h5><?php the_title(); ?></h5>

                        </div>
                    </a>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>

<?php get_footer() ?>