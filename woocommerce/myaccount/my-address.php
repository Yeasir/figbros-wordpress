<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'woocommerce' ),
		'shipping' => __( 'Shipping address', 'woocommerce' ),
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'woocommerce' ),
	), $customer_id );
}

$oldcol = 1;
$col    = 1;
$address_page_short_description_heading = get_field('address_page_short_description_heading', 'option');
$address_page_short_description = get_field('address_page_short_description', 'option');


$billing_first_name = get_user_meta( $customer_id, 'billing_first_name', true );
$billing_last_name = get_user_meta( $customer_id, 'billing_last_name', true );
$billing_address_1 = get_user_meta( $customer_id, 'billing_address_1', true );
$billing_city = get_user_meta( $customer_id, 'billing_city', true );
$billing_postcode = get_user_meta( $customer_id, 'billing_postcode', true );
$billing_country = get_user_meta( $customer_id, 'billing_country', true );
$billing_state = get_user_meta( $customer_id, 'billing_state', true );

$default_order_address = '';
if(!empty($billing_first_name) || !empty($billing_last_name)) {
    $default_order_address = '' . $billing_first_name . ' ' . $billing_last_name . ' <br>';
}
if(!empty($billing_address_1)) {
    $default_order_address .= $billing_address_1 . ' <br>';
}
if(!empty($billing_city) || !empty($billing_state) || !empty($billing_postcode)) {
    $default_order_address .= '' . $billing_city . ', ' . $billing_state . ' ' . $billing_postcode . ' <br>';
}
if(!empty($billing_country)) {
    $default_order_address .= '' . $billing_country . '';
}
//echo $default_order_address;

$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types( 'view-orders' ),
    'post_status' => array_keys( wc_get_order_statuses() ),
) ) );

?>

<div class="pro-content-box manage-box">
    <div class="top-title text-left mb-40">
        <h4 class="text-uppercase text-left"><?php echo $address_page_short_description_heading;?></h4>
        <p><?php echo $address_page_short_description;?></p>
    </div>
    <form class="woocommerce-cart-form" action="" method="post">
        <div class=" table-responsive-md table-responsive-sm">
            <div class="cart-collaterals">
                <div class=" table-box">
                    <div class="row">
                        <?php
                        //$fields = WC()->checkout()->checkout_fields;
                        //foreach ( $fields['billing'] as $key => $field ) {
                            //woocommerce_form_field( $key, $field, WC()->checkout()->get_value( $key ) );
                        //}
                        ?>
                        <?php
                        $address_array = [];
                        $related_address_array = [];
                        foreach ( $customer_orders as $customer_order ) :
                            $order      = wc_get_order( $customer_order );
                            $customer_order_address = ''.$order->get_billing_first_name().' '.$order->get_billing_last_name().' <br>';
                            $customer_order_address .= $order->get_billing_address_1().' <br>';
                            $customer_order_address .= ''.$order->get_billing_city().', '.$order->get_billing_state().' '.$order->get_billing_postcode().' <br>';
                            $customer_order_address .= ''.$order->get_billing_country().'';

                            if (!in_array($customer_order_address, $address_array)) {
                                $address_array[$order->get_id()] = $customer_order_address;
                                $new_id = $order->get_id();
                            } else {
                                $related_address_array[$new_id][] = $order->get_id();
                            }
                            //echo $customer_order_address;
                            //if(strcmp($customer_order_address, $default_order_address) == 0){
                            //}

                        endforeach;
                        if(!empty($address_array)):
                            foreach ($address_array as $key => $value):
                                $remove_address = get_post_meta($key,'remove_address',true);
                                if(isset($remove_address) && $remove_address == 1){
                                }else{
                        ?>
                        <div class="col-lg-6 col-md-12 col-sm-12 ord_addr_con">
                            <table cellspacing="0" class="shop_table option-table   woocommerce-cart-form__contents">
                                <thead>
                                    <tr class="cart-subtotal">
                                        <th class="text-left" width="50%"><p class="text-uppercase">
                                                <input type="checkbox" name="shipping_method" id="shipping_method_<?php echo $key;?>" value="" class="card-method" <?php if($value === $default_order_address){?>checked="checked"<?php };?>>
                                                <label for="shipping_method_<?php echo $key;?>" class="chn_dft_addr" data-order_id="<?php echo $key;?>">Default</label>
                                        </th>
                                        <th class="text-right"><a class="yellow-text delete_card2" href="javascript:void(0);" data-order_id="<?php echo $key;?>" data-same_addr_ids="<?php if(!empty($related_address_array[$key])){ echo implode(',',$related_address_array[$key]);}?>"><i class="zmdi zmdi-close yellow-text"></i> Remove</a> <a href="javascript:void(0)" class="d-inline-block edit-btn" data-order_id="<?php echo $key;?>" data-same_addr_ids="<?php if(!empty($related_address_array[$key])){ echo implode(',',$related_address_array[$key]);}?>" <?php if($value === $default_order_address){?>data-default="1"<?php }else{?>data-default="0"<?php };?>><i class="zmdi zmdi-edit"></i>Edit</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th class="text-left" colspan="2">
                                            <p><?php echo $value;?></p>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }; endforeach;endif;?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
