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
//echo '>>>>>>>>>>>>>>';
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
$category_short_description = get_field('category_short_description', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
$category_description_heading = get_field('category_description_heading', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
$category_detail_page_image = get_field('category_detail_page_image', $wp_query->queried_object->taxonomy . '_' . $wp_query->queried_object->term_id);
?>
    <!-- /.inner-banner start  -->
    <section class="inner-banner product-listing-banner" style="background-image: url('<?php echo $category_banner_image;?>')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col text-left">
                    <div class="overlay-bg">
                        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                            <h1 class="white-text"><?php woocommerce_page_title(); ?></h1>
                        <?php endif; ?>
                        <p><?php echo $category_short_description;?></p>
                        <a href="#cbl" class="custom-btn text-uppercase product-scroll-btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.inner-banner end  -->
    <!-- /.cat-content-box start  -->
    <section class="cat-content-box cat-content-box-fix">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-6 col-md-12 col-sm-12  ml-auto p-lr ">
                    <div class="img-box">
                        <img src="<?php echo $category_detail_page_image;?>" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 m-auto">
                    <div class="content-box">
                        <h2 class="black-text"><?php echo $category_description_heading;?></h2>
                        <p><?php echo $wp_query->queried_object->description;?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.cat-content-box end  -->
    <?php if($wp_query->post_count > 0):
    $product_brands = get_products_brands($wp_query->posts);
    //echo '<pre>';
    //print_r($product_brands);
    //echo '</pre>';
    if(!empty($product_brands)):?>
    <!-- /.category-brand-logo start -->
    <section class="category-brand-logo" id="cbl">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <?php foreach ($product_brands as $brand_id):
                    $product_brand_object = get_term_by( 'id', $brand_id, 'brand' );
                    $category_page_brand_logo = get_field('category_page_brand_logo', $product_brand_object->taxonomy . '_' . $product_brand_object->term_id);
                      if (!empty($category_page_brand_logo)){
                    ?>
                <div class="col" style="flex-grow: 0">
                    <div class="cat-logo">
                        <a href="#<?php echo $brand_id;?>"><img src="<?php echo $category_page_brand_logo;?>" alt=""></a>
                    </div>
                </div>
                <?php } endforeach;?>
            </div>
        </div>
    </section>
    <!-- /.category-brand-logo end -->
    <?php endif;endif;?>

    <?php if($wp_query->post_count > 0):?>
    <?php
    $product_brands = get_products_brands($wp_query->posts);

    if(!empty($product_brands)):
    foreach ($product_brands as $brand_id):
    $product_brand_object = get_term_by( 'id', $brand_id, 'brand' );
    //echo '<pre>';
    //print_r($product_brand_object);
    //echo '</pre>';
    $brand_description_heading = get_field('brand_description_heading', $product_brand_object->taxonomy . '_' . $product_brand_object->term_id);
    $brand_short_description = get_field('short_description', $product_brand_object->taxonomy . '_' . $product_brand_object->term_id);

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
                'taxonomy'      => 'brand',
                'field'         => 'term_id',
                'terms'         => $product_brand_object->term_id, // Possibly 'exclude-from-search' too
                'operator'      => 'IN'
            )
        )
    );
    $products = new WP_Query($args);

    ?>
    <!-- /.product-listing-cat-wrap start -->
    <section class="product-listing-cat-wrap product-sub-cat product-target-location" id="<?php echo $brand_id;?>">
        <div class="col-12 listing-cat-title">
            <h2 class="text-shadow-2 text-center yellow-text m-0"><?php echo $product_brand_object->name;?></h2>
        </div>
        <div class="product-listing-product">
            <div class="container-fluid">
                <!-- /.list-cat-short-desc start -->
                <div class="row list-cat-short-desc">
                    <div class="col-lg-6 col-12 offset-lg-3 text-center">
                        <p><?php echo $brand_short_description;?> <a href="<?php echo get_term_link($product_brand_object);?>">read more...</a></p>
                    </div>
                </div>
                <!-- /.list-cat-short-desc end -->

                <?php if ( $products->have_posts() ) : ?>
                <div class="row">
                    <div id="wait">&nbsp;</div>
                    <ul class="products columns-4 m-0">
                        <?php while ( $products->have_posts() ) : $products->the_post(); global $product;
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
                    <?php if($product_brand_object->count > 4):?>
                    <div class="load-more load-more-ajax text-center text-uppercase col-12">
                        <a href="javascript:void(0);" data-catid="<?php echo $wp_query->queried_object->term_id;?>" data-brandid="<?php echo $product_brand_object->term_id;?>" data-curpageid="1" class="custom-btn loadmore">load more</a>
                    </div>
                    <?php endif;?>
                </div>
                <?php else : ?>
                    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
                <?php endif; ?>
            </div>

        </div>
    </section>
    <!-- /.product-listing-cat-wrap end -->
    <?php endforeach;endif;?>

    <?php endif;?>

    <?php
    $selected_product_categories = get_field('select_product_categories', 'option');
    if(!empty($selected_product_categories)):
    ?>
    <!-- /.product-category-section start -->
    <section class="product-category-section listing-product-category-section">
        <div class="product-category-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="pro-cat-heading yellow-text ">OTHER Categories</h2>
                    </div>

                </div>
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

            </div>
        </div>
    </section>
    <!-- /.product-category-section end -->
    <?php endif;?>
<?php
get_footer( 'shop' );
