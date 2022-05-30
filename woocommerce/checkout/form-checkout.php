<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//$available_gateways2 = WC()->payment_gateways->get_available_payment_gateways();
//unset($available_gateways2['authorize_net_cim_credit_card']);
//echo '<pre>';
//print_r($available_gateways2);
//echo '</pre>';
/*do_action( 'woocommerce_before_checkout_form', $checkout );*/

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    ?>
<section class="cart-wrapper first-step">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 mr-auto ml-auto mb-70">
                <h3 class="black-text  text-uppercase">Checkout</h3>
            </div>
        </div>
    </div>
    <div class="woocommerce">
        <div class="shipping-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-12 col-sm-12 mr-auto ml-auto mb-70">
                        <?php
                        echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
                        return;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
$checkout_page_heading = get_field('checkout_page_heading', 'option');
$checkout_page_short_description = get_field('checkout_page_short_description', 'option');
?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
<!-- /.cart-wrapper start  -->
<section class="cart-wrapper first-step">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 mr-auto ml-auto mb-70">
                <h3 class="black-text  text-uppercase"><?php echo $checkout_page_heading;?></h3>
                <p><?php echo $checkout_page_short_description;?></p>
            </div>
        </div>
    </div>
    <div class="woocommerce">
        <div class="shipping-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12  ml-auto  border-right checkout-left">
                        <!--<form class="woocommerce-cart-form" action="http://localhost/figbros/cart/" method="post">-->
                            <div class=" table-responsive-md table-responsive-sm">
                                <div class="cart-collaterals">
                                    <div class=" table-box">
                                        <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents checkout-table">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="p-0 "><h4 class="black-text text-uppercase">Order Details</h4></td>
                                                </tr>
                                                <?php

                                                $total_discount = 0;
                                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                    $product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                                    if ( $product->is_on_sale() ) {
                                                        if ($product->is_type('simple')) {
                                                            $discount_amount = $product->get_regular_price() - $product->get_sale_price();
                                                            $discount_amount = $discount_amount * $cart_item['quantity'];
                                                        } elseif ($product->is_type('variable')) {
                                                            $discount_amount = 0;
                                                            foreach ($product->get_children() as $child_id) {
                                                                $variation = wc_get_product($child_id);
                                                                $price = $variation->get_regular_price();
                                                                $sale = $variation->get_sale_price();
                                                                if ($price != 0 && !empty($sale)) $percentage = $price - $sale;
                                                                if ($percentage > $discount_amount) {
                                                                    $discount_amount = $percentage;
                                                                    $discount_amount = $discount_amount * $cart_item['quantity'];
                                                                }
                                                            }
                                                        }
                                                        $total_discount += $discount_amount;
                                                    }
                                                }

                                                //echo $total_discount;


                                                //do_action( 'woocommerce_review_order_before_cart_contents' );
                                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
                                                ?>
                                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                                    <td class="product-thumbnail" width="1%">
                                                        <div class="product-thumb">
                                                            <a href="<?php echo $product_permalink;?>"><img width="300" height="300" src="<?php echo $image[0];?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="<?php echo $image[0];?> 300w, <?php echo $image[0];?> 150w, <?php echo $image[0];?> 100w" sizes="(max-width: 300px) 100vw, 300px"></a>
                                                        </div>
                                                    </td>

                                                    <td class="product-name" data-title="Product" width="60%">
                                                        <div class="product-info">
                                                            <a href="<?php echo $product_permalink;?>"><?php echo $_product->get_name();?></a>
                                                            <h6><?php
                                                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                                ?></h6>
                                                            <p>Item : <span>  <?php echo $cart_item['quantity'];?></span> <!--<a href="" class="d-inline-block edit-btn"><i class="zmdi zmdi-edit"></i>Edit</a>--></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                    <?php
                                                }
                                                }
                                                //do_action( 'woocommerce_review_order_after_cart_contents' );
                                                ?>

                                                <tr class="cart-subtotal">
                                                    <th class="text-left">Subtotal:</th>
                                                    <td class="text-right" data-title="Subtotal"><?php wc_cart_totals_subtotal_html(); ?></td>
                                                </tr>
                                                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                                                    <tr class="woocommerce-shipping-totals shipping">
                                                        <th class="text-left">Shipping</th>
                                                        <td class="text-right" data-title="Shipping">
                                                            <?php echo WC()->cart->get_cart_shipping_total();?>
                                                        </td>
                                                    </tr>

                                                <?php endif; ?>
                                                <?php
                                                if($total_discount > 0){
                                                    if ( strpos( $total_discount, "." ) !== false ) {
                                                    }else{
                                                    $total_discount = $total_discount.'.00';
                                                    }
                                                    ?>
                                                    <tr class="cart-subtotal">
                                                        <th class="text-left">Discount:</th>
                                                        <td class="text-right" data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol();?></span><?php echo $total_discount;?></span>
                                                        </td>
                                                    </tr>
                                                <?php };?>
                                                <tr class="order-total">
                                                    <th class="text-left" width="15%">Order Total:</th>
                                                    <td class="text-right" data-title="Total"><strong><?php wc_cart_totals_order_total_html(); ?></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <!--</form>-->
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 mr-auto">
                        <!--<form class="woocommerce-cart-form" action="http://localhost/figbros/cart/" method="post">-->
                            <div class=" table-responsive-md table-responsive-sm">
                                <div class="cart-collaterals">
                                    <div class="table-box billing-address-box">
                                        <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents float-lg-right float-md-right float-sm-none">
                                            <tbody>
                                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                                    <td class="address-info-wrap" data-title="Product" width="100%">
                                                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                                                        <?php
                                                        $billing_address = '';
                                                        if ( is_user_logged_in() ) {
                                                            $current_user_id = get_current_user_id();
                                                            $billing_first_name = get_user_meta($current_user_id,'billing_first_name',true);
                                                            $billing_last_name = get_user_meta($current_user_id,'billing_last_name',true);
                                                            $billing_address_1 = get_user_meta($current_user_id,'billing_address_1',true);
                                                            $billing_city = get_user_meta($current_user_id,'billing_city',true);
                                                            $billing_postcode = get_user_meta($current_user_id,'billing_postcode',true);
                                                            $billing_country = get_user_meta($current_user_id,'billing_country',true);
                                                            $billing_state = get_user_meta($current_user_id,'billing_state',true);
                                                            if(!empty($billing_first_name) || !empty($billing_last_name)){
                                                                $billing_address .= $billing_first_name.' '.$billing_last_name;
                                                            }
                                                            if(!empty($billing_address_1)){
                                                                $billing_address .= '<br/>'.$billing_address_1;
                                                            }
                                                            if(!empty($billing_city) || !empty($billing_state) || !empty($billing_postcode)){
                                                                $billing_address .= '<br/>';
                                                                if(!empty($billing_city)){
                                                                    $billing_address .= $billing_city;
                                                                }
                                                                if(!empty($billing_state)){
                                                                    $billing_address .= ', '.$billing_state;
                                                                }
                                                                if(!empty($billing_postcode)){
                                                                    $billing_address .= ' '.$billing_postcode;
                                                                }
                                                            }
                                                            if(empty($billing_address)){
                                                                $address_info_style = 'display: none';
                                                            }else{
                                                                $address_info_style = 'display: block';
                                                            }
                                                        } else {
                                                            $address_info_style = 'display: none';
                                                        }
                                                        ?>
                                                        <div class="address-info" style="<?php echo $address_info_style;?>">
                                                            <p><?php echo $billing_address;?></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="shipping-info-woo" style="position: absolute; left: -99999px; opacity: 0;
width: 1px; overflow: hidden; height: 1px;">
		                                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                                </div>

                                <div class="cart-collaterals">
                                    <div class="cart_totals table-box">
                                        <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents float-lg-right float-md-right float-sm-none d-none">
                                            <tbody>
                                            <tr class="woocommerce-shipping-totals shipping shipping2">
                                                <td data-title="Shipping">
                                                    <h4 class="text-uppercase black-text">Shipping Options</h4>

                                                    <ul id="shipping_method" class="woocommerce-shipping-methods">
                                                        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                                                            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                                                            <?php wc_cart_totals_shipping_html2(); ?>

                                                            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

                                                        <?php endif; ?>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class=" play-btn billing-address">
                                            <a href="javascript:void(0);" class="btn alt wc-forward btn-pay">Pay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.cart-wrapper end  -->

<!-- /.cart-wrapper start  -->
<section class="cart-wrapper second-step" style="display: none">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 mr-auto ml-auto mb-70">
                <h3  class="text-uppercase black-text">Place Order</h3>
                <p><?php echo $checkout_page_short_description;?></p>
            </div>
        </div>
    </div>
    <div class="woocommerce">
        <div class="shipping-option payment-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12  ml-auto border-right">
                        <!--<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">-->
                            <div class=" table-responsive-md table-responsive-sm">
                                <div class="cart-collaterals">
                                    <?php
                                    $current_user = wp_get_current_user();
                                    ?>
                                    <div class=" table-box card_list_container_wrapper" data-username="<?php echo $current_user->user_firstname .' '.$current_user->user_lastname;?>">
                                        <h4 class="text-uppercase black-text">Payment Options</h4>
                                        <?php //echo '????' . do_action('wc_authorize_net_cim_credit_card_payment_form_start');?>
                                        <div class="play-btn mb-35 pt-3">
                                            <a href="javascript:void(0);" class=" btn alt wc-forward addCartbtn">Add Card</a>
                                        </div>
                                        <!--<table cellspacing="0" class="shop_table shop_table_responsive option-table  default-table">
                                            <thead>
                                                <tr class="cart-subtotal">
                                                    <th class="text-left" width="50%"><p class="text-uppercase">
                                                            <input type="checkbox" name="shipping_method[0]" data-index="0" id="shipping_method_1_flat_rate1" value="flat_rate:1" class="card-method" checked="checked">
                                                            <label for="shipping_method_1_flat_rate1">Default</label>
                                                    </th>
                                                    <th class="text-right"><a class="yellow-text" href=""><i class="zmdi zmdi-close yellow-text"></i> Remove</a></th>

                                                </tr>
                                            </thead>
                                            <tbody class="card_list_container">
                                                <tr class="cart-subtotal">
                                                    <th class="text-left" colspan="2">
                                                        <p>Visa ****7890</p>
                                                        <p>   John Deo</p>
                                                        <p> Expires 		<span>12/2025</span></p>
                                                        <input type="text" class="form-control" placeholder="Enter CVV" >
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table cellspacing="0" class="shop_table shop_table_responsive option-table">
                                            <thead>
                                            <tr class="cart-subtotal">
                                                <th class="text-left" width="50%"><p class="text-uppercase">
                                                        <input type="checkbox" name="shipping_method[0]" data-index="0" id="shipping_method_0_flat_rate1" value="flat_rate:1" class="card-method" >
                                                        <label for="shipping_method_0_flat_rate1">debit card</label>
                                                </th>
                                                <th class="text-right"><a class="yellow-text" href=""><i class="zmdi zmdi-close yellow-text"></i> Remove</a></th>
                                            </tr>

                                            </thead>
                                            <tbody>
                                            <tr class="cart-subtotal">
                                                <th class="text-left" colspan="2">
                                                    <p>Visa ****7890</p>
                                                    <p>   John Deo</p>
                                                    <p> Expires 		<span>12/2025</span></p>
                                                </th>
                                            </tr>
                                            </tbody>
                                        </table>-->
                                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                                    </div>
                                </div>

                            </div>
                        <!--</form>-->
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 mr-auto">
                        <!--<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">-->
                            <div class=" table-responsive-md table-responsive-sm">
                                <div class="cart-collaterals">
                                    <div class="order-detals table-box">
                                        <h4 class="billing-address text-uppercase black-text">Order Details</h4>
                                        <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents float-lg-right float-md-right float-sm-none checkout-table">
                                            <tbody>
                                            <?php
                                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
                                            ?>
                                            <tr class="woocommerce-cart-form__cart-item cart_item">
                                                <td class="product-thumbnail" width="1%">
                                                    <div class="product-thumb">
                                                        <a href="<?php echo $product_permalink;?>"><img width="300" height="300" src="<?php echo $image[0];?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="<?php echo $image[0];?> 300w, <?php echo $image[0];?> 150w, <?php echo $image[0];?> 100w" sizes="(max-width: 300px) 100vw, 300px"></a>
                                                    </div>
                                                </td>

                                                <td class="product-name" data-title="Product" width="60%">
                                                    <div class="product-info">
                                                        <a href="<?php echo $product_permalink;?>"><?php echo $_product->get_name();?></a>
                                                        <h6><?php
                                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                            ?></h6>
                                                        <p>Item : <span>  <?php echo $cart_item['quantity'];?></span> <!--<a href="" class="d-inline-block edit-btn"><i class="zmdi zmdi-edit"></i>Edit</a>--></p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php };};?>
                                            <tr class="cart-subtotal">
                                                <th class="text-left">Subtotal</th>
                                                <td class="text-right" data-title="Subtotal"><?php wc_cart_totals_subtotal_html(); ?>
                                                </td>
                                            </tr>

                                            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                                                <tr class="woocommerce-shipping-totals shipping">
                                                    <th class="text-left">Shipping</th>
                                                    <td class="text-right" data-title="Shipping">
                                                        <?php echo WC()->cart->get_cart_shipping_total();?>
                                                    </td>
                                                </tr>

                                            <?php endif; ?>
                                            <!-- hide 24.07.2019 -->
                                            <?php //if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                                                <?php //do_action( 'woocommerce_review_order_before_shipping' ); ?>

                                                <?php //wc_cart_totals_shipping_html(); ?>

                                                <?php //do_action( 'woocommerce_review_order_after_shipping' ); ?>

                                            <?php //endif; ?>
                                            <!-- end -->
                                            <?php
                                            if($total_discount > 0){
                                                if ( strpos( $total_discount, "." ) !== false ) {
                                                }else{
                                                    $total_discount = $total_discount.'.00';
                                                }
                                                ?>
                                                <tr class="cart-subtotal">
                                                    <th class="text-left">Discount:</th>
                                                    <td class="text-right" data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol();?></span><?php echo $total_discount;?></span>
                                                    </td>
                                                </tr>
                                            <?php };?>

                                            <tr class="order-total">
                                                <th class="text-left" width="15%">Order Total</th>
                                                <td class="text-right" data-title="Total"><strong><?php wc_cart_totals_order_total_html(); ?></strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div class="play-btn billing-address">
                                            <!--<a href="http://localhost/figbros/checkout/"
                                               class=" btn alt wc-forward">Place Order
                                            </a>-->
                                            <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

                                            <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="btn alt wc-forward" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( 'Place Order' ) . '</button>' ); // @codingStandardsIgnoreLine ?>

                                            <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

                                            <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <!--</form>-->

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<!-- /.cart-wrapper end  -->
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
