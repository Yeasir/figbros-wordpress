<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package figbros
 */
if( is_user_logged_in() ) :
    wp_redirect( home_url().'/my-account' );
    exit();
endif;
get_header('account');
?>
    <section class="sign-box">
        <div class="container">
            <div class="row">
                <div id="wait">&nbsp;</div>
                <div class="col-lg-5 col-md-8 col-sm-12 m-auto ">
                    <div class="content-box">
                        <h2 class="text-center black-text">LOGIN</h2>
                        <h6 class="text-center black-text">Please enter your details...</h6>
                        <div class="alert alert-danger d-none" role="alert"></div>
                        <?php
                        /*$args = array(
                            'echo'           => true,
                            'remember'       => true,
                            'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                            'form_id'        => 'loginform',
                            'id_username'    => 'user_login',
                            'id_password'    => 'user_pass',
                            'id_remember'    => 'rememberme',
                            'id_submit'      => 'wp-submit',
                            'label_username' => __( 'Username or Email Address' ),
                            'label_password' => __( 'Password' ),
                            'label_remember' => __( 'Remember Me' ),
                            'label_log_in'   => __( 'Log In' ),
                            'value_username' => '',
                            'value_remember' => false
                        );
                        wp_login_form( $args );*/
                        ?>
                        <form name="loginform" id="loginFrm" action="<?php echo site_url( '/wp-login.php' ); ?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="log" id="user_login" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="pwd" id="user_pass" autocomplete="current-password"  placeholder="Password" required>
                            </div>
                            <div class="row">
                                <div class="col-6 text-left">
                                    <div class="form-check">
                                        <input name="rememberme" class="form-check-input" type="checkbox" id="check" value="forever">
                                        <label class="form-check-label" for="check">Remember me	</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="black-text">   Forgot password?</a>
                                </div>
                            </div>
                            <div class="sub-box text-center">
                                <button type="submit" class="btn sub-btn login-sub-btn">LOGIN</button>
                                <p>Dont' have an account yet?<a href="<?php bloginfo('url');?>/sign-up" class="red-text"> Sign up now</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
