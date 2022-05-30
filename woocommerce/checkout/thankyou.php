<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$order_confirmation_page_heading = get_field('order_confirmation_page_heading', 'option');
$order_confirmation_message = get_field('order_confirmation_message', 'option');
?>

<!-- /.cart-wrapper start  -->
<section class="cart-wrapper">
    <?php if ( $order ) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 mr-auto ml-auto mb-70">
                <h3  class="text-uppercase black-text"><?php echo ($order_confirmation_page_heading ? $order_confirmation_page_heading : 'Order Confirmation');?></h3>
                <p class="confirm"><i class="zmdi zmdi-check"></i>  <?php echo ($order_confirmation_message ? $order_confirmation_message : 'Your order is confirmed!');?></p>
            </div>
        </div>
    </div>
    <div class="woocommerce">
        <div class="shipping-option ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12  ml-auto border-right">
                        <form class="woocommerce-cart-form" action="http://localhost/figbros/cart/" method="post">
                            <div class=" table-responsive-md table-responsive-sm">
                                <div class="cart-collaterals">
                                    <div class="table-box order-box billing-address-box">
                                        <h4 class="text-uppercase black-text" >Arriving:</h4>
                                        <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents  ">
                                            <tbody>
                                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                                    <td class="address-info-wrap" data-title="Product" width="100%">
                                                        <div class="address-info">
                                                            <p>  Monday, January 9 to</p>
                                                            <p>Sunday, January 15</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <h4 class="text-uppercase black-text">Your order Will Be Send to:</h4>
                                        <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents ">
                                            <tbody>
                                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                                    <td class="address-info-wrap" data-title="Product" width="100%">
                                                        <div class="address-info">
                                                            <p>
                                                            <?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>
                                                            <?php if ( $order->get_billing_phone() ) : ?>
                                                                <p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
                                                            <?php endif; ?>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th class="text-left">Order# :</th>
                                                    <td class="text-right"><?php echo $order->get_order_number(); ?></span></td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th class="text-left">Order Date :	</th>
                                                    <td class="text-right" ><?php echo date('d/m/Y',strtotime($order->get_date_created())); ?></span></td>
                                                </tr>

                                                <tr class="order-total">
                                                    <th class="text-left" width="30%">Order Total:</th>
                                                    <td class="text-right" data-title="Total"><strong><?php echo $order->get_formatted_order_total(); ?></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 mr-auto">
                        <form class="woocommerce-cart-form" action="http://localhost/figbros/cart/" method="post">
                            <div class=" table-responsive-md table-responsive-sm">
                                <div class="cart-collaterals">
                                    <div class=" table-box">
                                        <h4 class="billing-address  text-uppercase black-text">Order Details</h4>
                                        <table cellspacing="0" class="shop_table woocommerce-cart-form__contents float-lg-right float-md-right float-sm-none checkout-table">
                                            <tbody>
                                            <?php
                                            $order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
                                            $show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
                                            $show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
                                            //echo '<pre>';
                                            //print_r($order_items);
                                            //echo '</pre>';

                                            foreach ( $order_items as $item_id => $item ) {
                                                $_product = $item->get_product();
                                                $product_id = $_product->get_id();
                                               // echo $item['quantity'];
                                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
                                            ?>
                                            <tr class="woocommerce-cart-form__cart-item cart_item">
                                                <td class="product-thumbnail" width="15%">
                                                    <div class="product-thumb">
                                                        <a href="<?php echo $_product->get_permalink();?>"><img width="300" height="300" src="<?php echo $image[0];?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="<?php echo $image[0];?> 300w, <?php echo $image[0];?> 150w, <?php echo $image[0];?> 100w" sizes="(max-width: 300px) 100vw, 300px"></a>
                                                    </div>
                                                </td>

                                                <td class="product-name" data-title="Product" width="60%">
                                                    <div class="product-info">
                                                        <a href="<?php echo $_product->get_permalink();?>"><?php echo $_product->get_name();?></a>
                                                        <h6><?php echo WC()->cart->get_product_price( $_product );?></h6>
                                                        <p>Item : <span>  <?php echo $item['quantity'];?></span> <!--<a href="" class="d-inline-block edit-btn"><i class="zmdi zmdi-edit"></i>Edit</a>--></p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php };?>

                                            <?php
                                            foreach ( $order->get_order_item_totals() as $key => $total ) {
                                                $label = str_replace(':','',$total['label']);
                                                $cls_name = 'cart-subtotal';
                                                if($label == 'Payment method'){
                                                    $cls_name = 'd-none';
                                                }elseif($label == 'Total'){
                                                    $cls_name = 'order-total';
                                                }

                                                if($label == 'Total'){
                                                    $label = 'Order Total';
                                                }

                                            ?>
                                                <tr class="<?php echo $cls_name;?>">
                                                    <th class="text-left"><?php echo $label; ?>:</th>
                                                    <td class="text-right" data-title="<?php echo $label; ?>"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : $total['value']; ?></span>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
<!-- /.cart-wrapper end  -->
