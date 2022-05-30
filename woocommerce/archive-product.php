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
if(isset($_GET['cat_search']) && $_GET['cat_search'] == 1){
    get_header('account');
}else {
    get_header('shop');
}

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

global $wp_query;
if($wp_query->queried_object->taxonomy == 'brand'){
    $brand_banner_image = get_field('brand_banner_image', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
    $brand_short_description = get_field('short_description', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
    $brand_image = get_field('brand_image', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
    $brand_description_heading = get_field('brand_description_heading', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
    ?>
    <!-- /.inner-banner start  -->
    <section class="inner-banner product-listing-banner" style="background-image: url('<?php echo $brand_banner_image;?>')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col text-left">
                    <div class="overlay-bg">
                        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                        <h1 class="white-text"><?php woocommerce_page_title(); ?></h1>
                        <?php endif; ?>
                        <p><?php echo $brand_short_description;?></p>
                        <a href="#" class="custom-btn text-uppercase product-scroll-btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.inner-banner end  -->
    <!-- /.cat-content-box start  -->
    <section class="cat-content-box cat-content-box-fix product-branding-box-fix prent-cat">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-4 col-md-5 col-sm-12  ml-auto p-lr ">
                    <div class="img-box">
                        <img src="<?php echo $brand_image;?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 col-sm-12 m-auto">
                    <div class="content-box">
                        <h2 class="black-text text-uppercase"><?php echo $brand_description_heading;?></h2>
                        <p><?php echo $wp_query->queried_object->description;?></p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.cat-content-box end  -->

    <?php if($wp_query->post_count > 0):?>

    <?php
    $product_categories = get_products_categories($wp_query->posts);
    if(!empty($product_categories)):
        foreach ($product_categories as $cat_id):
            $product_cat_object = get_term_by( 'id', $cat_id, 'product_cat' );
            $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => '4',
                'tax_query'             => array(
                    array(
                        'taxonomy'      => $wp_query->queried_object->taxonomy,
                        'field' => 'term_id',
                        'terms'         => $wp_query->queried_object->term_id,
                        'operator'      => 'IN'
                    ),
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'term_id',
                        'terms'         => $product_cat_object->term_id, // Possibly 'exclude-from-search' too
                        'operator'      => 'IN'
                    )
                )
            );
            $products = new WP_Query($args);
            ?>
        <!-- /.product-listing-cat-wrap start -->
        <section class="product-listing-cat-wrap product-sub-cat product-branding-wrap product-target-location">
            <div class="col-12 listing-cat-title">
                <h2 class="text-shadow-2 text-center yellow-text m-0"><?php echo $product_cat_object->name;?></h2>
            </div>
            <?php if ( $products->have_posts() ) : ?>
            <div class="product-listing-product">
                <div class="container-fluid">
                    <div class="row">
                        <div id="wait">&nbsp;</div>
                        <ul class="products columns-4 m-0">
                            <?php
                            while ( $products->have_posts() ) : $products->the_post(); global $product;
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                            ?>
                                <li class="entry product type-product post-<?php echo $product->get_id();?> status-publish first <?php echo $product->get_stock_status();?> has-post-thumbnail shipping-taxable purchasable product-type-<?php echo $product->get_type();?>">
                                    <a href="<?php echo $product->get_permalink();?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                        <?php if(!empty($image[0])):?>
                                            <img width="113" height="300" src="<?php  echo $image[0]; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw">
                                        <?php endif;?>
                                        <h2 class="woocommerce-loop-product__title"><?php echo $product->get_name();?></h2>
                                        <span class="price"><?php echo $product->get_price_html();?></span>
                                    </a>
                                    <a href="<?php echo $product->add_to_cart_url();?>" data-quantity="1" class="button product_type_<?php echo $product->get_type();?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_id();?>" data-product_sku="" aria-label="Add “test product” to your cart" rel="nofollow">Add to cart</a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <div class="clearfix"></div>
                        <?php if($product_cat_object->count > 4):?>
                        <div class="load-more load-more-ajax text-center text-uppercase col-12">
                            <a href="javascript:void(0);" data-brandid="<?php echo $wp_query->queried_object->term_id;?>" data-catid="<?php echo $product_cat_object->term_id;?>" data-curpageid="1" class="custom-btn loadmore">load more</a>
                        </div>
                        <?php endif;?>
                    </div>
                </div>

            </div>
            <?php else : ?>
                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </section>
        <!-- /.product-listing-cat-wrap end -->
        <?php endforeach;endif;?>
    <?php endif;?>

    <?php
    $selected_product_categories = get_field('select_product_categories', 'option');
    if(!empty($selected_product_categories)):?>
    <!-- /.product-category-section start -->
    <section class="product-category-section listing-product-category-section">
        <div class="product-category-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="pro-cat-heading yellow-text ">OTHER Categories</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php
                    foreach ($selected_product_categories as $selected_product_category):
                        $thumbnail_id = get_term_meta( $selected_product_category->term_id, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id );
                    ?>
                        <div class="col-lg-2dot4 col-md-2dot4  col-sm-2dot4">
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

            </div>
        </div>
    </section>
    <!-- /.product-category-section end -->
    <?php endif;?>
    <?php
}elseif(isset($_GET['cat_search']) && $_GET['cat_search'] == 1) {
    ?>
    <!-- /.product-listing-cat-wrap start -->
    <section class="product-listing-cat-wrap product-sub-cat search-result">
        <div class="col-12 listing-cat-title">
            <h2 class="text-shadow-2 text-center yellow-text m-0"><?php echo stripslashes($_GET['s_terms']);?></h2>
        </div>
        <?php  if (wc_get_loop_prop('total')) {?>
        <div class="product-listing-product">
            <div class="container-fluid">
                <!-- /.list-cat-short-desc start -->

                <!-- /.list-cat-short-desc end -->
                <div class="row">
                    <div id="wait">&nbsp;</div>
                    <ul class="products columns-4 m-0">
                        <?php while (have_posts()) {
                        the_post();global $product;
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                        ?>
                            <li class="entry product type-product post-<?php echo $product->get_id();?> status-publish first <?php echo $product->get_stock_status();?> has-post-thumbnail shipping-taxable purchasable product-type-<?php echo $product->get_type();?>">
                                <a href="<?php echo $product->get_permalink();?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                <?php if(!empty($image[0])):?>
                                    <img width="113" height="300" src="<?php  echo $image[0]; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw">
                                <?php endif;?>
                                    <h2 class="woocommerce-loop-product__title"><?php echo $product->get_name();?></h2>
                                    <span class="price"><?php echo $product->get_price_html();?></span>
                                </a>
                                <a href="<?php echo $product->add_to_cart_url();?>" data-quantity="1" class="button product_type_<?php echo $product->get_type();?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_id();?>" data-product_sku="" aria-label="Add “test product” to your cart" rel="nofollow">Add to cart</a>
                            </li>
                        <?php };?>
                    </ul>
                    <div class="clearfix"></div>
                    <?php if($wp_query->found_posts > 12):?>
                    <div class="load-more load-more-ajax text-center text-uppercase col-12">
                        <a href="javascript:void(0);" data-catname="<?php echo stripslashes($_GET['s_terms']);?>" data-brandname="<?php echo stripslashes($_GET['s_terms']);?>" data-curpageid="1" class="custom-btn loadmore2">load more</a>
                    </div>
                    <?php endif;?>
                </div>
            </div>

        </div>
        <?php }else{?>
        <div class="product-listing-product">
            <div class="container-fluid">
                <div class="row">
                    Please enter a search key in search input field first!
                </div>
            </div>
        </div>
        <?php };?>
    </section>
    <!-- /.product-listing-cat-wrap end -->
    <?php
}else{
    ?>
    <header class="woocommerce-products-header">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action('woocommerce_archive_description');
        ?>
    </header>
    <?php
    if (woocommerce_product_loop()) {

        /**
         * Hook: woocommerce_before_shop_loop.
         *
         * @hooked woocommerce_output_all_notices - 10
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        do_action('woocommerce_before_shop_loop');

        woocommerce_product_loop_start();

        if (wc_get_loop_prop('total')) {
            while (have_posts()) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 *
                 * @hooked WC_Structured_Data::generate_product_data() - 10
                 */
                do_action('woocommerce_shop_loop');

                wc_get_template_part('content', 'product');
            }
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action('woocommerce_after_shop_loop');
    } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action('woocommerce_no_products_found');
    }

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
}
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
