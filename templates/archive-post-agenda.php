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

            <?php if ( have_posts() ) : while( have_posts() ) : the_post(); // get the wordpress loop

                $costum_meta = get_post_meta( // get the database date selection
                        $post->ID,
                        '_vbsagendaplugin_date_meta_key',
                        true
                );

                if(isset($date_meta_array)){ // is this second loop?

                    $date_meta_array_old = $date_meta_array; //
                    $date_meta_array = explode("-", $costum_meta); // get individual data

                    $date_skip[0] = $date_meta_array[0] - $date_meta_array_old[0]; // year
                    $date_skip[1] = $date_meta_array[1] - $date_meta_array_old[1]; // month
                    $date_skip[2] = $date_meta_array[2] - $date_meta_array_old[2]; // day

                }else{ // run on first loop

                    $date_meta_array = explode("-", $costum_meta);

                    $date_skip[0] = 0; // year
                    $date_skip[1] = 0; // month
                    $date_skip[2] = 0; // day

                }

                $daysmonth = cal_days_in_month(CAL_GREGORIAN, $date_meta_array[1], $date_meta_array[0]);

                if ($date_skip[2] < 0) : // display the changed days after the filled ones ?>

                    <?php ++$date_skip[2]; ?>

                    <section class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

                        <div class="btn btn-light card h-100">

                            <div class="card-body">

                                <?php echo (
                                ( $date_skip[2]) // empty days
                                ); ?>

                            </div>

                        </div>

                    </section>

                <?php

                endif;

                while ($date_skip[0] > 0) : // display the year change ?>

                    <?php --$date_skip[0];?>

                    <section class="col-12 m-1">

                        <div class="card h-100">

                            <div class="card-body">

                                <?php echo (

                                    ($date_meta_array[0] - $date_skip[0]) // years

                                );
                                $date_skip[1] = $date_meta_array[1] // reset months ?>

                            </div>

                        </div>

                    </section>

                <?php endwhile;

                while ($date_skip[1] > 0) : // display the changed months

                    --$date_skip[1]; ?>

                    <section class="col-12 mt-1">

                        <div class="card h-100">

                            <div class="card-body">

                                <?php echo (

                                    ($date_meta_array[1] - $date_skip[1]) // months

                                );
                                echo("<br>" . $daysmonth);

                                $date_skip[2] = $date_meta_array[2] // reset days ?>

                            </div>

                        </div>

                    </section>

                <?php endwhile; ?>

                <?php while ($date_skip[2] > 1) : // display the changed days ?>

                    <?php --$date_skip[2];?>

                    <section class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

                        <div class="btn btn-light card h-100">

                            <div class="card-body">

                                <?php echo (
                                    ($date_meta_array[2] - $date_skip[2]) // empty days
                                ); ?>

                            </div>

                        </div>

                    </section>

                    <?php

                endwhile;

            // display the filled days ?>

                <section class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

                    <a href="<?php the_permalink(); ?>" class="btn btn-light card h-100">

                        <div class="card-body">

                            <h2><?php echo $date_meta_array[2]; /* filled days */ ?></h2>

                            <p><?php the_title(); ?></p>

                        </div>

                    </a>

                </section>

            <?php endwhile; endif; ?>

        </div>

    </div>

</div>

<?php get_footer() ?>