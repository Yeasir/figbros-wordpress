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
                        <h2 class="text-center black-text">Sign Up</h2>
                        <h6 class="text-center black-text">Please enter your details...</h6>
                        <div class="alert alert-danger d-none" role="alert"></div>
                        <div class="alert alert-success d-none"></div>
                        <form name="registerform" id="registerform" action="<?php bloginfo('url');?>/wp-login.php?action=register" method="post" novalidate="novalidate">
                            <div class="form-group">
                                <input type="text" class="form-control" id="user_login" name="user_login" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="form-control"  placeholder="Password" required>
                            </div>
                            <div class="sub-box text-center">
                                <button type="submit" class="btn sub-btn sign-sub-btn">SIGN UP</button>
                                <p>Already have an account? <a href="<?php bloginfo('url');?>/login" class="red-text">Login here!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
