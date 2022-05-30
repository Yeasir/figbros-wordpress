<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">

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
            $style = 'display: block';
            $edit_button = 'display: none !important';
        }else{
            $style = 'display: none';
            $edit_button = 'display: block';
        }
    } else {
        $style = 'display: block';
        $edit_button = 'display: none !important';
    }
    ?>

	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

        <h4 class="text-uppercase black-text"><?php esc_html_e( 'Billing Address', 'woocommerce' ); ?> <a href="javascript:void(0);" class="d-inline-block edit-btn" style="<?php echo $edit_button;?>"><i class="zmdi zmdi-edit"></i>Edit</a></h4>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper wbfrmwrap" style="<?php echo $style;?>">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
