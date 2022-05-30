<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package figbros
 */

get_header();
?>
    <?php
    while ( have_posts() ) :
    the_post();?>
    <!-- /.inner-banner start  -->
    <section class="inner-banner" style="background-image: url('<?php the_field('banner_image','option');?>')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col text-left">
                    <h1 class="white-text"><?php the_title();?> </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- /.inner-banner end  -->
    <!-- /.about-content start  -->
    <section class="about-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 p-0 m-0">
                    <div class="heading-box">
                        <h3 class="black-text"> <?php the_field('content_top_section_title','option');?></h3>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 fig-box p-0 m-0">
                    <div class="fig f1" style="background-image: url('<?php the_field('content_top_section_left_image','option');?>')"></div>
                    <div class="fig f2" style="background-image: url('<?php the_field('content_top_section_right_image','option');?>')"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 p-lab p-0  mb-4">
                    <?php
                    if ( has_post_thumbnail() ) {?>
                    <div class="content-img" style="background-image:url('<?php the_post_thumbnail_url();?>')">
                        <div class="text-box">
                            <?php the_field('about_us_featured_image_text','option');?>
                        </div>
                    </div>
                    <?php };?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 ml-auto">
                    <div class="content-box">
                        <?php echo get_the_content();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endwhile; // End of the loop.
    ?>
    <!-- /.about-content end  -->
    <?php
    $the_teams = get_field('the_team_section', 'option');
    if(!empty($the_teams)):
    ?>
    <!-- /.the-team start  -->
    <section class="the-team">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="yellow-text">The Team</h2>
                </div>
            </div>
            <div class="row team-box">
                <?php foreach ($the_teams as $key => $team_member):?>
                <!--/.single-team-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-team text-center">
                        <div class="team-img <?php if($key % 2 == 0){?>bottom-right<?php }else{?>top-left<?php };?>" style="background-image: url('<?php echo $team_member['team_member_image'];?>')">
                        </div>
                        <h5><?php echo $team_member['team_member_name'];?></h5>
                        <p><?php echo $team_member['team_member_designation'];?></p>
                        <p> <?php echo $team_member['team_member_department'];?></p>

                    </div>
                </div>
                <!--/.single-team-->
                <?php endforeach;?>
            </div>
        </div>

    </section>
    <!-- /.the-team end  -->
    <?php endif;?>

    <?php
    $the_news_section_heading = get_field('the_news_section_heading', 'option');
    $select_news = get_field('select_news', 'option');
    $news_section_button_text = get_field('news_section_button_text', 'option');
    ?>

    <!-- /.blog-grid start -->
    <section class="section-blog section-news">
        <div class="container">
            <div class="row">
                <!-- /.blog-heading start -->
                <div class="col-12 blog-heading text-center">
                    <h2 class="black-text"><?php echo $the_news_section_heading;?></h2>
                </div>
                <!-- /.blog-heading end -->
                <?php if(!empty($select_news)):
                    foreach ($select_news as $s_news):
                        $img_url = get_the_post_thumbnail_url( $s_news,'blog-thumbnail' );
                        ?>
                        <!-- /.blog-boxes start -->
                        <div class="col-lg-4 col-sm-6 col-12 blog-items">
                            <div class="blog-boxes blog-thumbs-has">
                                <div class="blog-thumbs text-center">
                                    <a href="<?php echo get_permalink($s_news);?>">
                                        <img src="<?php echo $img_url;?>" class="img-fluid" alt="<?php echo $s_news->post_title;?>">
                                    </a>
                                </div>
                                <div class="blog-contents">
                                    <h4 class="blog-title">
                                        <a href="<?php echo get_permalink($s_news);?>"><?php echo $s_news->post_title;?></a>
                                    </h4>
                                    <p><?php echo $s_news->post_excerpt;?></p>
                                </div>
                                <div class="text-center">
                                    <a href="<?php echo get_permalink($s_news);?>" class="btn read-more"><?php echo $news_section_button_text;?></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.blog-boxes end -->
                    <?php endforeach;endif;?>
            </div>
        </div>
    </section>
    <!-- /.blog-grid end -->

<?php
get_footer();
