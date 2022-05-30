<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
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

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */

global $wp;
//echo '<pre>';
//print_r($wp->query_vars);
//echo '</pre>';

if (array_key_exists("orders", $wp->query_vars) || array_key_exists("view-order", $wp->query_vars)){
    $my_account_page_heading = get_field('my_order_page_heading', 'option');
    $my_account_page_short_description = get_field('my_order_page_sub_heading', 'option');
}elseif(array_key_exists("payment-methods", $wp->query_vars)){
    $my_account_page_heading = get_field('manage_payment_page_heading', 'option');
    $my_account_page_short_description = get_field('manage_payment_page_sub_heading', 'option');
}elseif(array_key_exists("edit-address", $wp->query_vars)){
    $my_account_page_heading = get_field('address_page_heading', 'option');
    $my_account_page_short_description = get_field('address_page_sub_heading', 'option');
}elseif(array_key_exists("edit-account", $wp->query_vars)){
    $my_account_page_heading = get_field('manage_account_page_heading', 'option');
    $my_account_page_short_description = get_field('manage_account_page_sub_heading', 'option');
}else{
    $my_account_page_heading = get_field('profile_page_heading', 'option');
    $my_account_page_short_description = get_field('profile_page_short_description', 'option');
}
?>
<!-- /.cart-wrapper start  -->
<section class="profile-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="text-uppercase black-text"><?php echo ($my_account_page_heading ? $my_account_page_heading : 'My Profile');?></h3>
                <p><?php echo $my_account_page_short_description;?></p>

            </div>

        </div>
    </div>
    <div class="woocommerce">
        <div class="profile">
            <div class="container">
                <?php
                //echo '<pre>';
                //print_r($current_user);
                //echo '</pre>';
                global $wp_query;
                $first_name = get_user_meta($current_user->ID,'first_name',true);
                $last_name = get_user_meta($current_user->ID,'last_name',true);
                $prof_name = '';
                if(!empty($first_name)){
                    $prof_name .= substr($first_name, 0, 1);
                }
                if(!empty($first_name)){
                    $prof_name .= substr($last_name, 0, 1);
                }
                ?>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        <div class="pro-box">
                            <div class="inner-box">
                                <div class="pro-info text-center">
                                    <div class="pro-img-box mb-3">
                                        <h2><?php echo $prof_name;?></h2>
                                    </div>

                                    <p class="font-weight-bold"><span class="font-weight-light">Hi,</span> <br>
                                        <?php echo $first_name.' '. $last_name;?></p>
                                </div>
                                <h4 class="text-uppercase text-left ">MY Account</h4>
                            </div>
                            <ul class="list-unstyled acc-list">
                                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                                    <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>

                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 ">
                        <?php do_action( 'woocommerce_account_content' );?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<!-- /.cart-wrapper end  -->
<?php
//do_action( 'woocommerce_account_navigation' ); ?>

<!--<div class="woocommerce-MyAccount-content">
	<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		//do_action( 'woocommerce_account_content' );
	?>
</div>-->
