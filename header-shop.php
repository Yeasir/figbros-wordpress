<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package figbros
 */
global $wp_query;
if(is_account_page()):
    if(!isset($wp_query->query['lost-password'])) {
        if (!is_user_logged_in()) :
            wp_redirect(home_url() . '/login');
            exit();
        endif;
    }
endif;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_field('site_favicon','option');?>">

	<?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
    <!-- /.header start  -->
    <header class="header ">
        <!-- /.navbar start -->
        <div class="container-fluid ">
            <nav class="navbar navbar-expand-lg custom-navbar transparent-bg">
                <?php $header_logo = get_field('header_logo', 'option'); ?>
                <a class="navbar-brand" href="<?php bloginfo('url');?>">
                    <img src="<?php echo $header_logo;?>" alt="Figbros">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="zmdi zmdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                    wp_nav_menu( array(
                        'menu_class'        => "navbar-nav mr-auto",
                        'container'         => "",
                        'theme_location'    => 'menu-1',
                        'depth'	          => 2,
                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'            => new WP_Bootstrap_Navwalker()
                    ) );
                    ?>
                    <div class="search-form my-2 my-lg-0 ">
                        <a href="#" data-toggle="modal" data-target="#search-model"><i class="zmdi zmdi-search"></i></a>
                        <a href="<?php bloginfo('url');?>/my-account"><i class="zmdi zmdi-account-circle"></i></a>
                        <a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>"><i class="zmdi zmdi-shopping-cart"></i></a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- /.navbar end -->
    </header>
    <!-- /.header -->
    <!-- /.main start  -->
    <main class="main">
        <?php //global $template; echo $template;?>


