<?php /* Template Name: Simple Template */ ?>

<?php get_header(); ?>

<?php

if ( has_post_thumbnail() ) {
    $featured_image = get_the_post_thumbnail_url();
  }else{
    $default = get_template_directory_uri().'/images/shipping-info.png';
}

    ?>
    <!-- /.inner-banner start  -->
    <section class="inner-banner" style="background-image: url(' <?php echo ($featured_image) ? $featured_image : $default ?>')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col text-left">
                    <h2 class="white-text"><?php  echo the_title(); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- /.inner-banner end  -->
        <!-- /.the-team start  -->
        <section class="page-content-box">
            <div class="container">
                <div class="row ">
                    <!--/.single-team-->
                    <div class="col-11 content-box m-auto">
                        <div class="box">
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                                the_content();
                            endwhile; else: ?>
                                <p><?php _e('Sorry, no posts matched your criteria'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--/.single-team-->
                </div>
            </div>

        </section>
        <!-- /.the-team end  -->

<?php get_footer(); ?>
