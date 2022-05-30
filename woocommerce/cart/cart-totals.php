<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals total-summery <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h3 class="text-uppercase black-text mb-45"><?php _e( 'Summary', 'woocommerce' ); ?></h3>

	<table cellspacing="0" class="shop_table shop_table_responsive">

		<tr class="cart-subtotal">
			<th class="text-left"><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
			<td class="text-right" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th class="text-left"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td class="text-right" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<tr class="shipping">
				<th class="text-left"><?php _e( 'Shipping', 'woocommerce' ); ?></th>
				<td class="text-right" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>
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

        if($total_discount > 0){
            if ( strpos( $total_discount, "." ) !== false ) {
            }else{
                $total_discount = $total_discount.'.00';
            }
        ?>
        <tr class="cart-subtotal">
            <th class="text-left">Discount</th>
            <td class="text-right" data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol();?></span><?php echo $total_discount;?></span></td>
        </tr>
        <?php };?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th class="text-left"><?php echo esc_html( $fee->name ); ?></th>
				<td class="text-right" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' <small>' . __( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
					: '';

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th class="text-left"><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
						<td class="text-right" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th class="text-left"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
					<td class="text-right" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr class="order-total">
			<th class="text-left"><?php _e( 'Order Total', 'woocommerce' ); ?></th>
			<td class="text-right" data-title="<?php esc_attr_e( 'Order Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</table>

	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
