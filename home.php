<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package figbros
 */

get_header();
?>
    <?php
    $home_slider = get_field('slider_settings', 'option');
    //echo '<pre>';
    //print_r($home_slider);
    //echo '</pre>';
    if(!empty($home_slider)):
    ?>
    <!-- /.slider-area start  -->
    <section class="slider-area  slider">
        <?php foreach ($home_slider as $slider):?>
        <div>
            <div style="background-image: url('<?php echo $slider['home_slider_image'];?>'); background-size:cover;" class="slide">
                <div class="caption">
                    <div class="container pl-100">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="overlay-bg">
                                    <?php echo $slider['slider_title'];?>
                                    <p class="white-text"><?php echo $slider['slider_description'];?></p>
                                    <a href="<?php echo $slider['slider_button_url'];?>" class="btn custom-btn"><?php echo $slider['slider_button_text'];?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </section>
    <!-- /.slider-area end  -->
    <?php endif;?>
    <section class="about-us">
        <div class="container">
            <div class="row">
                <?php
                $about_us_left_image = get_field('about_us_left_image', 'option');
                $about_us_right_image = get_field('about_us_right_image', 'option');
                $about_us_heading = get_field('about_us_heading', 'option');
                $about_us_short_description = get_field('about_us_short_description', 'option');
                $about_us_button_text = get_field('about_us_button_text', 'option');
                $about_us_button_url = get_field('about_us_button_url', 'option');
                ?>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-center">
                    <img src="<?php echo $about_us_left_image;?>" alt="product">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 ml-5 content-box">
                    <?php echo $about_us_heading;?>
                    <p class="white-text"><?php echo $about_us_short_description;?></p>
                    <a href="<?php echo $about_us_button_url;?>" class="btn text-uppercase"><?php echo $about_us_button_text;?></a>
                </div>
                <div class="content-img" style="background-image: url('<?php echo $about_us_right_image;?>')"></div>
            </div>
        </div>
    </section>

    <?php
    $product_category_heading = get_field('product_category_heading', 'option');
    $selected_product_categories = get_field('select_product_categories', 'option');
    ?>
    <!-- /.product-category-section start -->
    <section class="product-category-section">
        <div class="product-category-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="pro-cat-heading yellow-text "><?php echo $product_category_heading;?></h2>
                    </div>
                </div>
                <?php if(!empty($selected_product_categories)):?>
                <div class="row">
                    <?php foreach ($selected_product_categories as $selected_product_category):
                        $thumbnail_id = get_term_meta( $selected_product_category->term_id, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id );
                        ?>
                        <div class="col-lg-2dot4 col-md-2dot4 col-sm-2dot4">
                            <a href="<?php echo get_term_link($selected_product_category);?>" class="black-text">
                                <!-- /.pro-cat-wrap start -->
                                <div class="pro-cat-wrap text-center">
                                    <div class="pro-cat" >
                                        <img src="<?php echo $image;?>" alt="">
                                    </div>
                                    <h5 class="text-uppercase"><?php echo $selected_product_category->name;?></h5>
                                </div>
                                <!-- /.pro-cat-wrap end -->
                            </a>
                        </div>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
            </div>
        </div>
    </section>
    <!-- /.product-category-section end -->
    <!-- /.section-our-brand start -->
    <?php
    $brand_heading = get_field('brand_heading', 'option');
    $brand_description = get_field('brand_description', 'option');
    $brand_section_image = get_field('brand_section_image', 'option');
    $select_brands_for_home_page = get_field('select_brands_for_home_page', 'option');
    ?>
    <section class="section-our-brand">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-12 text-center">
                    <img src="<?php echo $brand_section_image;?>" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-7 col-12 brand-content">
                    <?php echo $brand_heading;?>
                    <p><?php echo $brand_description;?></p>
                </div>
                <div class="clearfix"></div>
                <?php if(!empty($select_brands_for_home_page)):
                    $num_of_brands = count($select_brands_for_home_page);
                    $counter = 1;
                    ?>
                <div class="col-lg-12 col-sm-12 col-12 brand-logo text-center">
                    <div class="row">
                        <?php foreach ($select_brands_for_home_page as $home_brand):
                            $brand_logo = get_field('brand_logo', $home_brand->taxonomy . '_' . $home_brand->term_id);
                            ?>
                        <div class="<?php if($num_of_brands <= 5){?>brand-logo-fix <?php }elseif($counter > 5){?>brand-logo-fix <?php };?>brand-col col-lg-2dot4 col-md-2dot4  col-sm-2dot4">
                            <div>
                                <a href="<?php echo get_term_link($home_brand);?>"><img src="<?php echo $brand_logo;?>" class="img-fluid" alt="<?php echo $home_brand->name;?>"></a>
                            </div>
                        </div>
                        <?php $counter++;endforeach;?>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </section>
    <!-- /.section-our-brand end -->
    <?php
    $product_development_image = get_field('product_development_image', 'option');
    $product_development_heading = get_field('product_development_heading', 'option');
    $product_development_sub_heading = get_field('product_development_sub_heading', 'option');
    $product_development_description = get_field('product_development_description', 'option');
    $product_development_button_text = get_field('product_development_button_text', 'option');
    $product_development_button_url = get_field('product_development_button_url', 'option');

    $private_label_image = get_field('private_label_image', 'option');
    $private_label_heading = get_field('private_label_heading', 'option');
    $private_label_sub_heading = get_field('private_label_sub_heading', 'option');
    $private_label_description = get_field('private_label_description', 'option');
    $private_label_button_text = get_field('private_label_button_text', 'option');
    $private_label_button_url = get_field('private_label_button_url', 'option');
    ?>
    <!-- /.section-product-private start -->
    <section class="section-product-private">
        <div class="product-private-bg">
            <div class="container">
                <div class="row ml-0 mr-0">
                    <!-- /.product-dev start -->
                    <div class="col-lg-6 col-sm-12 col-12 pro-pri-wrap pro-pri-has-thumb product-dev p-0">
                        <div class="pro-pri-thumbs text-center">
                            <a href="<?php echo $product_development_button_url;?>">
                                <img src="<?php echo $product_development_image;?>" class="img-fluid" alt="product development">
                            </a>
                        </div>
                        <div class="pro-pri-item">
                            <div class="pro-pri-contents">
                                <h3 class="pro-pri-title text-uppercase m-0">
                                    <a href="<?php echo $product_development_button_url;?>"><?php echo $product_development_heading;?></a>
                                </h3>
                                <h4 class="text-uppercase m-0 red-text"><?php echo $product_development_sub_heading;?></h4>
                                <p><?php echo $product_development_description;?></p>
                                <a href="<?php echo $product_development_button_url;?>" class="custom-btn btn text-uppercase"><?php echo $product_development_button_text;?></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.product-dev end -->
                    <!-- /.product-dev start -->
                    <div class="col-lg-6 col-sm-12 col-12 pro-pri-wrap private-dev pro-pri-has-thumb p-0">
                        <div class="pro-pri-thumbs text-center">
                            <a href="<?php echo $private_label_button_url;?>">
                                <img src="<?php echo $private_label_image;?>" class="img-fluid" alt="private label">
                            </a>
                        </div>
                        <div class="pro-pri-item">
                            <div class="pro-pri-contents">
                                <h3 class="pro-pri-title text-uppercase m-0">
                                    <a href="<?php echo $private_label_button_url;?>"><?php echo $private_label_heading;?></a>
                                </h3>
                                <h4 class="text-uppercase m-0 red-text"><?php echo $private_label_sub_heading;?></h4>
                                <p><?php echo $private_label_description;?></p>
                                <a href="<?php echo $private_label_button_url;?>" class="custom-btn btn text-uppercase"><?php echo $private_label_button_text;?></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.product-dev end -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.section-product-private end -->
    <?php
    $blog_heading = get_field('blog_heading', 'option');
    $select_blogs = get_field('select_blogs', 'option');
    $blog_button_text = get_field('blog_button_text', 'option');
    ?>
    <!-- /.blog-grid start -->
    <section class="section-blog">
        <div class="container">
            <div class="row">
                <!-- /.blog-heading start -->
                <div class="col-12 blog-heading text-center">
                    <h2 class="black-text"><?php echo $blog_heading;?></h2>
                </div>
                <!-- /.blog-heading end -->
                <?php if(!empty($select_blogs)):
                    foreach ($select_blogs as $select_blog):
                        $img_url = get_the_post_thumbnail_url( $select_blog,'blog-thumbnail' );
                    ?>
                <!-- /.blog-boxes start -->
                <div class="col-lg-4 col-sm-6 col-12 blog-items">
                    <div class="blog-boxes blog-thumbs-has">
                        <div class="blog-thumbs text-center">
                            <a href="<?php echo get_permalink($select_blog);?>">
                                <img src="<?php echo $img_url;?>" class="img-fluid" alt="<?php echo $select_blog->post_title;?>">
                            </a>
                        </div>
                        <div class="blog-contents">
                            <h4 class="blog-title">
                                <a href="<?php echo get_permalink($select_blog);?>"><?php echo $select_blog->post_title;?></a>
                            </h4>
                            <p><?php echo $select_blog->post_excerpt;?></p>
                        </div>
                        <div class="text-center">
                            <a href="<?php echo get_permalink($select_blog);?>" class="btn read-more"><?php echo $blog_button_text;?></a>
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
