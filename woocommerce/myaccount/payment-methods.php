<?php
/**
 * Payment methods
 *
 * Shows customer payment methods on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/payment-methods.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$manage_payment_short_description_heading = get_field('manage_payment_short_description_heading', 'option');
$manage_payment_short_description = get_field('manage_payment_short_description', 'option');

$saved_methods = wc_get_customer_saved_methods_list( get_current_user_id() );
$has_methods   = (bool) $saved_methods;
$types         = wc_get_account_payment_methods_types();

$current_user = wp_get_current_user();

//$_wc_authorize_net_cim_credit_card_add_payment_method_transaction_data = get_user_meta($current_user->ID,'_wc_authorize_net_cim_credit_card_add_payment_method_transaction_data',true);
//echo '<pre>';
//print_r($_wc_authorize_net_cim_credit_card_add_payment_method_transaction_data);
//echo '</pre>';

$environment = 'test';
$meta_key = '_wc_authorize_net_cim_credit_card_payment_tokens_'.$environment;
$_wc_authorize_net_cim_credit_card_payment_tokens_test = get_user_meta($current_user->ID,$meta_key,true);
//echo '<pre>';
//print_r($_wc_authorize_net_cim_credit_card_payment_tokens_test);
//echo '</pre>';

do_action( 'woocommerce_before_account_payment_methods', $has_methods ); ?>


<div class="pro-content-box manage-box payment-box" data-username="<?php echo $current_user->user_firstname .' '.$current_user->user_lastname;?>">
    <div class="top-title text-left mb-40">
        <h4 class="text-uppercase text-left"><?php echo $manage_payment_short_description_heading;?></h4>
        <p><?php echo $manage_payment_short_description;?></p>
    </div>
    <form class="woocommerce-cart-form" action="http://localhost/figbros/cart/" method="post">
        <div class=" table-responsive-md table-responsive-sm">
            <div class="cart-collaterals">
                <div class=" table-box ">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 adonc">
                            <?php if(!empty($_wc_authorize_net_cim_credit_card_payment_tokens_test)) : ?>
                            <?php $card_delete_nonce = wp_create_nonce( 'wc-authorize-net-cim-token-action' );?>
                            <?php foreach ($_wc_authorize_net_cim_credit_card_payment_tokens_test as $key => $value):
                                    $del_url = get_bloginfo('url').'/my-account/payment-methods/?wc-authorize-net-cim-token='.$key.'&wc-authorize-net-cim-action=delete&_wpnonce='.$card_delete_nonce;
                                    ?>
                            <table cellspacing="0" class="shop_table option-table  default-table  woocommerce-cart-form__contents">
                                <thead>
                                    <tr class="cart-subtotal">
                                        <th class="text-left" width="50%"><p class="text-uppercase">
                                                <input type="checkbox" name="authorize_payment_method" data-index="0" id="wc-authorize-net-cim-credit-card-payment-token-<?php echo $key;?>" value="" class="card-method check-card2" <?php if(isset($value['default']) && $value['default'] == 1){?>checked="checked"<?php };?>>
                                                <label for="wc-authorize-net-cim-credit-card-payment-token-<?php echo $key;?>" class="check-card-label2" data-token-id="<?php echo $key;?>"><?php if(isset($value['default']) && $value['default'] == 1){?>Default<?php }else{ echo str_replace('_',' ',$value['type']);};?></label>
                                        </th>
                                        <th class="text-right"><a class="yellow-text delete_card" href="<?php echo $del_url;?>"><i class="zmdi zmdi-close yellow-text"></i> Remove</a> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th class="text-left" colspan="2">
                                            <p><?php echo ucfirst($value['card_type']);?> ****<?php echo $value['last_four'];?></p>
                                            <p>   <?php echo $current_user->user_firstname .' '.$current_user->user_lastname;?></p>
                                            <?php if(isset($value['exp_year'])){?>
                                            <p> Expires 		<span><?php echo $value['exp_month'];?>/<?php echo $value['exp_year'];?></span></p>
                                            <?php };?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <?php
                            $installed_payment_methods = WC()->payment_gateways->payment_gateways();
                            //$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
                            ?>
                            <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents mt--30">
                                <tbody>
                                <?php
                                if( $installed_payment_methods ) {
                                    foreach( $installed_payment_methods as $gk => $gv ) {
                                        if( $gv->enabled == 'yes' ) {
                                            ?>
                                            <tr class="card-info">
                                                <th class="text-left"><a href="" class="black-text"><?php echo $gv->title;?></a></th>
                                                <td class="text-right" data-title="Total">
                                                    <?php if($gv->title == 'PayPal'):?>
                                                        <img src="<?php bloginfo('template_url');?>/images/paypal.png" alt="">
                                                    <?php else:?>
                                                        <img src="<?php bloginfo('template_url');?>/images/card.png" alt="">
                                                        <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php if ( $has_methods ) : ?>

	<!--<table class="woocommerce-MyAccount-paymentMethods shop_table shop_table_responsive account-payment-methods-table">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_payment_methods_columns() as $column_id => $column_name ) : ?>
					<th class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr( $column_id ); ?> payment-method-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<?php foreach ( $saved_methods as $type => $methods ) : ?>
			<?php foreach ( $methods as $method ) : ?>
				<tr class="payment-method<?php echo ! empty( $method['is_default'] ) ? ' default-payment-method' : ''; ?>">
					<?php foreach ( wc_get_account_payment_methods_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr( $column_id ); ?> payment-method-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php
							if ( has_action( 'woocommerce_account_payment_methods_column_' . $column_id ) ) {
								do_action( 'woocommerce_account_payment_methods_column_' . $column_id, $method );
							} elseif ( 'method' === $column_id ) {
								if ( ! empty( $method['method']['last4'] ) ) {
									/* translators: 1: credit card type 2: last 4 digits */
									echo sprintf( __( '%1$s ending in %2$s', 'woocommerce' ), esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) ), esc_html( $method['method']['last4'] ) );
								} else {
									echo esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) );
								}
							} elseif ( 'expires' === $column_id ) {
								echo esc_html( $method['expires'] );
							} elseif ( 'actions' === $column_id ) {
								foreach ( $method['actions'] as $key => $action ) {
									echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>&nbsp;';
								}
							}
							?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</table>-->

<?php else : ?>

	<!--<p class="woocommerce-Message woocommerce-Message--info woocommerce-info"><?php esc_html_e( 'No saved methods found.', 'woocommerce' ); ?></p>-->

<?php endif; ?>

<?php //do_action( 'woocommerce_after_account_payment_methods', $has_methods ); ?>

<?php if ( WC()->payment_gateways->get_available_payment_gateways() ) : ?>
	<!--<a class="button" href="<?php echo esc_url( wc_get_endpoint_url( 'add-payment-method' ) ); ?>"><?php esc_html_e( 'Add payment method', 'woocommerce' ); ?></a>-->
<?php endif; ?>
