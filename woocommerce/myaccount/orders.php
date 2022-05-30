<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$my_order_page_short_description_heading = get_field('my_order_page_short_description_heading', 'option');
$my_order_page_short_description = get_field('my_order_page_short_description', 'option');

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>


    <div class="pro-content-box my-order-box">
        <!-- /.cart-wrapper start  -->
        <section class="cart-wrapper p-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-12 col-sm-12  mb-25">
                        <h4 class="black-text text-uppercase"><?php echo $my_order_page_short_description_heading;?></h4>
                        <p>
                            <?php echo $my_order_page_short_description;?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="woocommerce">
                <div class="shipping-option  ">
                    <div class="container">
                        <div class="row">
                            <?php foreach ( $customer_orders->orders as $customer_order ) :
                                $order      = wc_get_order( $customer_order );
                                $item_count = $order->get_item_count();
                                $order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
                                $actions = wc_get_account_orders_actions( $order );
                                $order_date = $order->get_date_created();
                                foreach ( $order_items as $item_id => $item ) {
                                    $_product = $item->get_product();
                                    $product_id = $_product->get_id();
                                    // echo $item['quantity'];
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
                            ?>
                            <div class="col-lg-5 col-md-12 col-sm-12 p-20">
                                <form class="woocommerce-cart-form" action="" method="post">
                                    <div class=" table-responsive-md table-responsive-sm">
                                        <div class="cart-collaterals">
                                            <div class=" table-box">
                                                <p class=" black-text ">Order#: <?php echo $order->get_order_number(); ?></p>
                                                <table cellspacing="0" class="shop_table shop_table_responsive   woocommerce-cart-form__contents checkout-table">
                                                    <tbody>
                                                    <tr class="woocommerce-cart-form__cart-item cart_item">
                                                        <td class="product-thumbnail" width="15%">
                                                            <div class="product-thumb">
                                                                <a href="<?php echo $_product->get_permalink();?>"><img width="300" height="300" src="<?php echo $image[0];?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="<?php echo $image[0];?> 300w, <?php echo $image[0];?> 150w, <?php echo $image[0];?> 100w" sizes="(max-width: 300px) 100vw, 300px"></a>
                                                            </div>
                                                        </td>

                                                        <td class="product-name" data-title="Product" width="85%">
                                                            <div class="product-info">
                                                                <a href="<?php echo $_product->get_permalink();?>"><?php echo $_product->get_name();?></a>
                                                                <h6><?php
                                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                                    ?>
                                                                </h6>
                                                                <p>Item : <span>  <?php echo $item['quantity'];?></span> <br class="d-lg-none d-md-block d-sm-block">
                                                                    <span>Date :  &nbsp; &nbsp; &nbsp;  <?php echo date('m/d/Y', strtotime($order_date));?></span></p>
                                                                <p>
                                                                    <?php
                                                                    if ( ! empty( $actions ) ) {
                                                                        foreach ( $actions as $key => $action ) {
                                                                            if($key == 'view'){
                                                                                $action['name'] = 'View Details';
                                                                                echo '<a href="' . esc_url($action['url']) . '">' . esc_html($action['name']) . '</a>';
                                                                            }else {
                                                                                echo '<a href="' . esc_url($action['url']) . '">' . esc_html($action['name']) . '</a>';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <!--<a href="individual-order-view.html">View Details</a>
                                                                    <a href="">Order again</a>-->
                                                                </p>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <?php };endforeach;?>
                        </div>
                    </div>
                </div>


            </div>
        </section>
        <!-- /.cart-wrapper end  -->

    </div>




	<!--<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ( $customer_orders->orders as $customer_order ) :
				$order      = wc_get_order( $customer_order );
				$item_count = $order->get_item_count();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
									<?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									}
								}
								?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>-->
	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php _e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go shop', 'woocommerce' ); ?>
		</a>
		<?php _e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
