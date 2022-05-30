<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$continue_shopping_url = get_field('continue_shopping_url', 'option');
?>
<a href="<?php echo $continue_shopping_url;?>" class=" btn alt wc-forward mb-5 shopingbtn">CONTINUE SHOPPING</a>

<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="alt wc-forward  btn text-uppercase">
	<?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
</a>
