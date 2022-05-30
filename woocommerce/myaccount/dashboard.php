<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//echo '<pre>';
//print_r($current_user);
//echo '</pre>';
$first_name = get_user_meta($current_user->ID,'first_name',true);
$last_name = get_user_meta($current_user->ID,'last_name',true);
$user_phone_number = get_user_meta($current_user->ID,'user_phone_number',true);
$billing_address_1 = get_user_meta($current_user->ID,'billing_address_1',true);
$user_gender = get_user_meta($current_user->ID,'user_gender',true);
$user_birth_date = get_user_meta($current_user->ID,'user_birth_date',true);
//echo $current_user->user_pass;

$prof_name = '';
if(!empty($first_name)){
    $prof_name .= substr($first_name, 0, 1);
}
if(!empty($first_name)){
    $prof_name .= substr($last_name, 0, 1);
}
?>
    <div class="pro-content-box">
        <div class="top-title text-left mb-40">
            <h4 class="text-uppercase text-left"><?php echo ($profile_page_heading ? $profile_page_heading : 'My Profile');?></h4>
            <p><?php
                printf(
                    __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
                    esc_url( wc_get_endpoint_url( 'orders' ) ),
                    esc_url( wc_get_endpoint_url( 'edit-address' ) ),
                    esc_url( wc_get_endpoint_url( 'edit-account' ) )
                );
                ?></p>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="pro-info text-center">
                    <div class="pro-img-box mb-3">
                        <h2><?php echo $prof_name;?></h2>
                    </div>

                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 pro-form">

                <form id="edit_info" action="" method="post">
                    <div class="form-group row name-group align-items-center">
                        <label for="name" class="col-lg-2 col-md-3 col-sm-6 col-form-label">Name:</label>
                        <div class="col-lg-5 col-md-9 col-sm-12">
                            <p><span class="first_name"> <?php echo $first_name;?></span> <span class="last_name"><?php echo $last_name;?></span> <a href="javascript:void(0)" class="d-inline-block edit-btn pl-2"><i class="zmdi zmdi-edit"></i>Edit</a> </p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 input-box">
                            <input type="text" class="form-control d-inline" name="first_name" value="<?php if(!empty($first_name)){ echo $first_name; }?>" placeholder="FirstName">
                            <input type="text" class="form-control d-inline" name="last_name" value="<?php if(!empty($last_name)){ echo $last_name; }?>"  placeholder="Last Name">
                            <a href="javascript:void(0)" class="yellow-text close-btn d-inline pl-2"><i class="zmdi zmdi-close yellow-text"></i></a>
                        </div>

                    </div>

                    <div class="form-group row email-group align-items-center">
                        <label for="email" class="col-lg-2 col-md-3 col-sm-6 col-form-label">Email:</label>
                        <div class="col-lg-5 col-md-9 col-sm-12">
                            <p><a href="mailto:<?php echo $current_user->user_email;?>"><span class="user_email"><?php echo $current_user->user_email;?></span></a><a href="javascript:void(0)" class="d-inline-block edit-btn pl-2"><i class="zmdi zmdi-edit"></i>Edit</a> </p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 input-box">
                            <input type="email" class="form-control d-inline" name="user_email" id="email" value="<?php echo $current_user->user_email;?>" placeholder="Email">
                            <a href="javascript:void(0)" class="yellow-text close-btn pl-2 d-inline"><i class="zmdi zmdi-close yellow-text"></i></a>
                        </div>
                    </div>
                    <div class="form-group row phone-group align-items-center">
                        <label for="phone" class="col-lg-2 col-md-4 col-sm-6 col-form-label">Phone No. :</label>
                        <div class="col-lg-5 col-md-8 col-sm-12">
                            <p><a href="tel:<?php if(!empty($user_phone_number)){ echo $user_phone_number; }?>"><span class="user_phone_number"><?php if(!empty($user_phone_number)){ echo $user_phone_number; }?></span></a><a href="javascript:void(0)" class="d-inline-block edit-btn pl-2" ><i class="zmdi zmdi-edit"></i>Edit</a> </p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12  input-box">
                            <input type="text" class="form-control d-inline" name="user_phone_number" id="phone" value="<?php if(!empty($user_phone_number)){ echo $user_phone_number; }?>" placeholder="Phone">
                            <a href="javascript:void(0)" class="yellow-text close-btn pl-2 d-inline"><i class="zmdi zmdi-close yellow-text"></i></a>
                        </div>

                    </div>
                    <div class="form-group row address-group align-items-center">
                        <label for="address" class="col-lg-2 col-md-3 col-sm-6 col-form-label">Address :</label>
                        <div class="col-lg-5 col-md-9 col-sm-12">
                            <p><span class="billing_address_1"><?php if(!empty($billing_address_1)){ echo $billing_address_1; }?></span><a href="javascript:void(0)" class="d-inline-block edit-btn pl-2" ><i class="zmdi zmdi-edit"></i>Edit</a> </p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12  input-box">
                            <input type="text" class="form-control d-inline" name="billing_address_1" id="address" value="<?php if(!empty($billing_address_1)){ echo $billing_address_1; }?>" placeholder="Address">
                            <a href="javascript:void(0)" class="yellow-text close-btn pl-2 d-inline"><i class="zmdi zmdi-close yellow-text"></i></a>
                        </div>

                    </div>
                    <div class="form-group row gender-group align-items-center">
                        <label for="gender" class="col-lg-2 col-md-3 col-sm-6col-form-label">Gender:</label>
                        <div class="col-lg-5 col-md-9 col-sm-12">
                            <p><span class="user_gender"><?php if(!empty($user_gender)){ echo $user_gender; }?></span><a href="javascript:void(0)" class="d-inline-block edit-btn pl-2"><i class="zmdi zmdi-edit"></i>Edit</a> </p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12  input-box">
                            <input type="text" class="form-control d-inline" name="user_gender" id="gender" value="<?php if(!empty($user_gender)){ echo $user_gender; }?>" placeholder="Gender">
                            <a href="javascript:void(0)" class="yellow-text close-btn d-inline pl-2"><i class="zmdi zmdi-close yellow-text"></i></a>
                        </div>

                    </div>
                    <div class="form-group row birth-group align-items-center">
                        <label for="birthdate" class="col-lg-2 col-md-3 col-sm-6 col-form-label">Birthdate:</label>
                        <div class="col-lg-5 col-md-9 col-sm-12">
                            <p><span class="user_birth_date"><?php if(!empty($user_birth_date)){ echo date('d-M-Y',strtotime($user_birth_date)); }?></span><a href="javascript:void(0)" class="d-inline-block edit-btn pl-2"><i class="zmdi zmdi-edit"></i>Edit</a> </p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 input-box">
                            <input type="text" class="form-control d-inline" name="user_birth_date" id="birthdate" value="<?php if(!empty($user_birth_date)){ echo $user_birth_date; }?>" placeholder="Birthdate">
                            <a href="javascript:void(0)" class="yellow-text close-btn d-inline pl-2"><i class="zmdi zmdi-close yellow-text"></i></a>
                        </div>

                    </div>
                    <div class="form-group row pass-group align-items-center">
                        <label for="password" class="col-lg-2 col-md-3 col-sm-6 col-form-label">Password:</label>
                        <div class="col-lg-5 col-md-9 col-sm-12">
                            <p class="">*********<a href="javascript:void(0)" class="d-inline-block edit-btn pl-2"><i class="zmdi zmdi-edit"></i>Edit</a> </p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 input-box">
                            <input type="password" class="form-control d-inline" name="user_pass" id="password" placeholder="password">
                            <a href="javascript:void(0)" class="yellow-text close-btn d-inline pl-2"><i class="zmdi zmdi-close yellow-text"></i></a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<!--<p><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
?></p>

<p><?php
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
?></p>-->

<?php

	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	//do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	//do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	//do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
