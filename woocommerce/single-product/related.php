<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

    <div class="col-12 listing-cat-title">
        <h2 class="text-shadow-2 text-center yellow-text m-0"><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>
    </div>
    <div class="product-listing-product">
        <div class="container-fluid">
            <div class="row">
                <ul class="products columns-4">
                    <?php woocommerce_product_loop_start(); ?>
                    <?php foreach ( $related_products as $related_product ) :
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $related_product->get_id() ), 'full' );
                        ?>
                    <li class="entry product type-product post-<?php echo $related_product->get_id();?> status-publish first <?php echo $related_product->get_stock_status();?> has-post-thumbnail shipping-taxable purchasable product-type-<?php echo $related_product->get_type();?>">
                        <a href="<?php echo $related_product->get_permalink();?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                            <?php if(!empty($image[0])):?>
                            <img width="113" height="300" src="<?php  echo $image[0]; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw">
                            <?php endif;?>
                            <h2 class="woocommerce-loop-product__title"><?php echo $related_product->get_name();?></h2>
                            <span class="price"><?php echo $related_product->get_price_html();?></span>
                        </a>
                        <a href="<?php echo $related_product->add_to_cart_url();?>" data-quantity="1" class="button product_type_<?php echo $related_product->get_type();?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $related_product->get_id();?>" data-product_sku="" aria-label="Add “test product” to your cart" rel="nofollow">Add to cart</a>
                    </li>
                    <?php endforeach; ?>
                    <?php woocommerce_product_loop_end(); ?>
                </ul>
            </div>
        </div>
    </div>

<?php endif;

wp_reset_postdata();
