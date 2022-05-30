<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="cart-wrapper">
    <div class="container mb-45">
        <div class="row ">
            <div class="col">
                <h3 class="text-uppercase black-text ">Your Cart</h3>
            </div>
        </div>
    </div>
    <div class="woocommerce">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    /*
                     * @hooked wc_empty_cart_message - 10
                     */
                    do_action( 'woocommerce_cart_is_empty' );
                    if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
                        <p class="return-to-shop">
                            <a class="button wc-backward" href="<?php echo get_field('continue_shopping_url', 'option');?>">
                                <?php esc_html_e( 'Return to shop', 'woocommerce' ); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
