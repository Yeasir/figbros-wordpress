<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
<!-- /.cart-wrapper start  -->
<section class="cart-wrapper">
    <div class="container mb-45">
        <div class="row ">
            <div class="col">
                <h3 class="text-uppercase black-text ">Your Cart</h3>
            </div>

        </div>
    </div>
    <div class="woocommerce">
        <div class="woocommerce-notices-wrapper"></div>
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                        <div class=" table-responsive-md table-responsive-sm">
                            <table class="shop_table cart woocommerce-cart-form__contents cicon" cellspacing="0">

                                <tbody>
                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
                                ?>
                                <tr class="woocommerce-cart-form__cart-item cart_item cart-nfo">

                                    <td class="product-thumbnail" width="10%">
                                        <div class="product-thumb">
                                            <a href="<?php echo $product_permalink;?>"><img width="300" height="300" src="<?php  echo $image[0]; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="<?php  echo $image[0]; ?> 300w, <?php  echo $image[0]; ?> 150w, <?php  echo $image[0]; ?> 100w" sizes="(max-width: 300px) 100vw, 300px"></a>
                                        </div>
                                    </td>

                                    <td class="product-name" data-title="Product" width="25%">

                                        <?php
                                        if ( ! $product_permalink ) {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                        } else {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                        }
                                        ?>
                                        <h6><?php
                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                            ?></h6>
                                    </td>

                                    <td class="product-size text-center" data-title="size" width="25%">
                                        <p> <?php echo get_field( "pack_size", $product_id );?></p>
                                    </td>

                                    <td class="product-code text-center" data-title="code" width="25%">
                                        <p> <?php echo $_product->get_sku();?></p>
                                    </td>

                                    <td class="product-quantity prod-qnt text-right" data-title="Quantity" width="20%">
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                        } else {
                                            $product_quantity = woocommerce_quantity_input( array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ), $_product, false );
                                        }
                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                        ?>
                                    </td>


                                    <td class="product-remove position-relative" width="20%">
                                        <?php
                                        // @codingStandardsIgnoreLine
                                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                            '<a href="%s" class="remove position-absolute" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            __( 'Remove this item', 'woocommerce' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $_product->get_sku() )
                                        ), $cart_item_key );
                                        ?>
                                    </td>
                                </tr>
                                    <?php
                                }
                                }
                                ?>
                                <tr style="display: none">
                                    <td colspan="6" class="actions">

                                        <?php if ( wc_coupons_enabled() ) { ?>
                                            <div class="coupon">
                                                <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                            </div>
                                        <?php } ?>

                                        <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                                        <?php do_action( 'woocommerce_cart_actions' ); ?>

                                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 ml-auto">

                    <div class="cart-collaterals">
                        <?php
                        /**
                         * Cart collaterals hook.
                         *
                         * @hooked woocommerce_cross_sell_display
                         * @hooked woocommerce_cart_totals - 10
                         */
                        do_action( 'woocommerce_cart_collaterals' );
                        ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<!-- /.cart-wrapper end  -->
