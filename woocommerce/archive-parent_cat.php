<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );
global $wp_query;
$category_banner_image = get_field('category_banner_image', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
$category_description_heading = get_field('category_description_heading', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
$category_detail_page_image = get_field('category_detail_page_image', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
$newsletter_section_heading = get_field('newsletter_section_heading', 'option');
$newsletter_section_sub_heading = get_field('newsletter_section_sub_heading', 'option');
$newsletter_section_image = get_field('newsletter_section_image', 'option');
$category_short_description = get_field('category_short_description', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
?>
    <!-- /.inner-banner start  -->
    <section class="inner-banner product-parent-cat" style="background-image: url('<?php echo $category_banner_image;?>')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col text-left">
                    <div class="overlay-bg">
                        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                            <h1 class="white-text"><?php woocommerce_page_title(); ?></h1>
                        <?php endif; ?>
                        <p><?php echo $category_short_description;?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.inner-banner end  -->
    <!-- /.cat-content-box start  -->
    <section class="cat-content-box prent-cat">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-4 col-md-5 col-sm-12  ml-auto p-lr ">
                    <div class="img-box">
                        <img src="<?php echo $category_detail_page_image;?>" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 m-auto">
                    <div class="content-box">
                        <h2 class="black-text text-uppercase"><?php echo $category_description_heading;?></h2>
                        <p><?php echo $wp_query->queried_object->description;?></p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.cat-content-box end  -->

    <!-- /.product-sub-cat start  -->
    <section class="product-sub-cat">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                        <h2 class="yellow-text"><?php woocommerce_page_title(); ?></h2>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="cat-box">
            <div class="container">
                <div class="row ">
                    <?php
                    $children = get_terms( $wp_query->queried_object->taxonomy, array(
                        'parent'    => $wp_query->queried_object->term_id,
                        'hide_empty' => false
                    ) );
                    if($children) {
                        foreach ($children as $child):
                            $thumbnail_id = get_term_meta( $child->term_id, 'thumbnail_id', true );
                            $image = wp_get_attachment_url( $thumbnail_id );
                            ?>
                            <!--.single-cat-->
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <div class="single-cat text-center">
                                    <a href="<?php echo get_term_link($child);?>"><div class="cat-img-box" style="background-image: url('<?php echo $image; ?>')"></div></a>
                                    <a href="<?php echo get_term_link($child);?>" class="btn cat-btn text-uppercase"> <?php echo $child->name;?></a>
                                </div>
                            </div>
                            <!--.single-cat-->
                    <?php
                        endforeach;
                    };
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /.product-sub-cat end  -->
    <!-- /.subscribe start  -->
    <section class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="black-text"><?php echo $newsletter_section_heading;?></h2>
                    <h5 class="black-text"><?php echo $newsletter_section_sub_heading;?></h5>
                    <?php echo do_shortcode('[newsletter_form form="1"]');?>
                    <div class="img-subscrib-box">
                        <img src="<?php echo $newsletter_section_image;?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.subscribe end  -->
<?php
get_footer( 'shop' );
