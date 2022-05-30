<?php
/**
 * figbros functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package figbros
 */

if ( ! function_exists( 'figbros_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function figbros_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on figbros, use a find and replace
		 * to change 'figbros' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'figbros', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'figbros' ),
			'menu-2' => esc_html__( 'Footer Menu', 'figbros' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'figbros_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

        add_theme_support( 'woocommerce' );

        add_image_size( 'blog-thumbnail', 392, 291, true );
	}
endif;
add_action( 'after_setup_theme', 'figbros_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function figbros_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'figbros_content_width', 640 );
}
add_action( 'after_setup_theme', 'figbros_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function figbros_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'figbros' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'figbros' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'figbros_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function figbros_scripts() {
	wp_enqueue_style( 'figbros-style', get_stylesheet_uri() );

    wp_enqueue_style( 'figbros-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'figbros-jquery-ui-css', get_template_directory_uri() . '/css/jquery-ui.min.css' );
    wp_enqueue_style( 'figbros-fonts-googleapis', 'https://fonts.googleapis.com/css?family=Anton|Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese' );
    wp_enqueue_style( 'figbros-material-design-iconic-font', get_template_directory_uri() . '/css/material-design-iconic-font.min.css' );
    wp_enqueue_style( 'figbros-lightbox-min', get_template_directory_uri() . '/css/lightbox.min.css' );
    wp_enqueue_style( 'figbros-main-style', get_template_directory_uri() . '/css/styles.css' );
    wp_enqueue_style( 'figbros-custom-style', get_template_directory_uri() . '/css/custom.css' );

	wp_enqueue_script( 'figbros-popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), time(), true );
    wp_script_add_data( 'figbros-popper-js', 'integrity', 'sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' );
    wp_script_add_data( 'figbros-popper-js', 'crossorigin', 'anonymous' );
    //wp_enqueue_script( 'figbros-imagesloaded-js', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array('jquery'), time(), true );
    wp_enqueue_script( 'figbros-imagesloaded-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), time(), true );
	wp_enqueue_script( 'figbros-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), time(), true );
	wp_enqueue_script( 'figbros-jquery-ui-js', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), time(), true );
	wp_enqueue_script( 'figbros-chosen-js', get_template_directory_uri() . '/js/chosen.jquery.min.js', array('jquery'), time(), true );
	wp_enqueue_script( 'figbros-slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), time(), true );
	wp_enqueue_script( 'figbros-lightbox-js', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), time(), true );
	wp_enqueue_script( 'figbros-isotope-js', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), time(), true );

    //wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery') );

	wp_enqueue_script( 'figbros-functions-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), time(), true );

    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no
    $title        = '';
    $empty        = 1;

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
    );
    $all_categories = get_categories( $args );
    $categories = [];
    $parent_categories = [];
    if(!empty($all_categories)):
        foreach ($all_categories as $term):

            if($term->name == 'Uncategorized')
                continue;

            if(!in_array($term->term_id,$categories)):
                $categories[] = $term->term_id;
            endif;
            if($term->parent) {
                if (!in_array($term->parent, $parent_categories)):
                    $parent_categories[] = $term->parent;
                endif;
            }
        endforeach;
    endif;

    $cat_result = array_diff($categories,$parent_categories);
    sort($cat_result);

    if(!empty($cat_result)){
        $cat_name_array = [];
        foreach ($cat_result as $c_res):
            $trm = get_term_by('id', $c_res,'product_cat');
            $cat_name_array[] = $trm->name;
        endforeach;
    }

    $all_brands = get_terms( 'brand', array(
        'orderby'    => 'count',
        'hide_empty' => 1,
    ) );

    if(!empty($all_brands)){
        $brand_name_array = [];
        foreach ($all_brands as $b_res):
            $brand_name_array[] = $b_res->name;
        endforeach;
    }
    $cat_brnd_array = [];
    if(!empty($cat_name_array) || !empty($brand_name_array)){
        $cat_brnd_array = array_merge($cat_name_array,$brand_name_array);
    }

    $card_delete_nonce = wp_create_nonce( 'wc-authorize-net-cim-token-action' );

    wp_localize_script( 'figbros-functions-js', 'js_var', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'homeurl' => trailingslashit(home_url()), 'availableTerms' => $cat_brnd_array, 'card_delete_nonce' => $card_delete_nonce ) );
}
add_action( 'wp_enqueue_scripts', 'figbros_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom taxonomy for woo.
 */
require get_template_directory() . '/inc/custom_tax_add.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Register Custom Navigation Walker
if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
    // file does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    // file exists... require it.
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'               => 'Advanced Custom Fields', // The plugin name.
            'slug'               => 'advanced-custom-fields', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/lib/plugins/advanced-custom-fields.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

    );

    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}

require_once(dirname(__FILE__) . '/acf/options.php');

// ACF Option Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Header Settings',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Home Page',
        'menu_title'	=> 'Home Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'About Us Page',
        'menu_title'	=> 'About Us Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Product Category Page',
        'menu_title'	=> 'Product Category Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Product Development Page',
        'menu_title'	=> 'Product Development Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Private Label Page',
        'menu_title'	=> 'Private Label Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Contact Us Page',
        'menu_title'	=> 'Contact Us Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Registration Page',
        'menu_title'	=> 'Registration Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Login Page',
        'menu_title'	=> 'Login Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Forgot Password Page',
        'menu_title'	=> 'Forgot Password Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'WooCommerce Settings',
        'menu_title'	=> 'WooCommerce Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> '404 Page Settings',
        'menu_title'	=> '404 Page Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));
}

function remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'advanced-custom-fields/acf.php' ] );
    }

    return $value;
}
add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );

add_action( 'init', 'custom_taxonomy_Brand' );
function custom_taxonomy_Brand()  {
    $labels = array(
        'name'                       => 'Brands',
        'singular_name'              => 'Brand',
        'menu_name'                  => 'Brand',
        'all_items'                  => 'All Brands',
        'parent_item'                => 'Parent Brand',
        'parent_item_colon'          => 'Parent Brand:',
        'new_item_name'              => 'New Brand Name',
        'add_new_item'               => 'Add New Brand',
        'edit_item'                  => 'Edit Brand',
        'update_item'                => 'Update Brand',
        'separate_items_with_commas' => 'Separate Brand with commas',
        'search_items'               => 'Search Brand',
        'add_or_remove_items'        => 'Add or remove Brand',
        'choose_from_most_used'      => 'Choose from the most used Brands',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'rewrite'           =>  array('slug' => 'brand', 'with_front' => false),
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'brand', 'product', $args );
    register_taxonomy_for_object_type( 'brand', 'product' );
}


function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'News', 'Post Type General Name', 'figbros' ),
        'singular_name'       => _x( 'News', 'Post Type Singular Name', 'figbros' ),
        'menu_name'           => __( 'News', 'figbros' ),
        'parent_item_colon'   => __( 'Parent News', 'figbros' ),
        'all_items'           => __( 'All News', 'figbros' ),
        'view_item'           => __( 'View News', 'figbros' ),
        'add_new_item'        => __( 'Add New News', 'figbros' ),
        'add_new'             => __( 'Add New', 'figbros' ),
        'edit_item'           => __( 'Edit News', 'figbros' ),
        'update_item'         => __( 'Update News', 'figbros' ),
        'search_items'        => __( 'Search News', 'figbros' ),
        'not_found'           => __( 'Not Found', 'figbros' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'figbros' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'News', 'figbros' ),
        'description'         => __( 'News info and reviews', 'figbros' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    // Registering your Custom Post Type
    register_post_type( 'news', $args );

}

add_action( 'init', 'custom_post_type', 0 );

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


add_filter('woocommerce_get_price_html', 'show_price_logged');

function show_price_logged($price){
    if(is_user_logged_in() ){
        return $price;
    }else{
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        return '<a href="' . get_permalink(wc_get_page_id('myaccount')) . '" class="loginReq">Login to See Prices</a>';
    }
}

add_action( 'woocommerce_product_query', 'all_products_query' );

function all_products_query( $q ){
    $q->set( 'posts_per_page', -1 );
}


function get_products_brands($products){
    $brands = [];
    if(!empty($products)){
        foreach ($products as $product):
            $terms = get_the_terms($product,'brand');
            if(!empty($terms)):
                foreach ($terms as $term):
                    if(!in_array($term->term_id,$brands)):
                        $brands[] = $term->term_id;
                    endif;
                endforeach;
            endif;
        endforeach;
    }
    return $brands;
}

add_action('wp_ajax_nopriv_load_more_by_category_and_brand', 'load_more_by_category_and_brand');
add_action('wp_ajax_load_more_by_category_and_brand', 'load_more_by_category_and_brand');

function load_more_by_category_and_brand() {
    $catid = $_POST['catid'];
    $brand_id = $_POST['brand_id'];
    $curpageid = $_POST['curpageid'];
    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => '4',
        'offset' => $curpageid * 4,
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id',
                'terms'         => $catid,
                'operator'      => 'IN'
            ),
            array(
                'taxonomy'      => 'brand',
                'field'         => 'term_id',
                'terms'         => $brand_id,
                'operator'      => 'IN'
            )
        )
    );
    $products = new WP_Query($args);
    //echo '<pre>';
    //print_r($products);
    //echo '</pre>';
    $output = '';
    $nomoretoload = 0;
    if ( $products->have_posts() ) :
        while ( $products->have_posts() ) : $products->the_post(); global $product;
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
            $output .= '<li class="entry product type-product post-'.$product->get_id().' status-publish first '.$product->get_stock_status().' has-post-thumbnail shipping-taxable purchasable product-type-'.$product->get_type().'">
                                <a href="'.$product->get_permalink().'" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
                                    if(!empty($image[0])):
                                        $output .= '<img width="113" height="300" src="'.$image[0].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw">';
                                    endif;
            $output .= '<h2 class="woocommerce-loop-product__title">'.$product->get_name().'</h2>
                                    <span class="price">'.$product->get_price_html().'</span>
                                </a>
                                <a href="'.$product->add_to_cart_url().'" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.$product->get_id().'" data-product_sku="" aria-label="Add “test product” to your cart" rel="nofollow">Add to cart</a>
                            </li>';
        endwhile;
        if($products->post_count < 4){
            $nomoretoload = 1;
        }
        $curpageid++;
    endif;
    echo json_encode(array('output' => $output, 'curpageid' => $curpageid, 'nomoretoload' => $nomoretoload));
    exit();
}

function get_products_categories($products){
    $categories = [];
    $parent_categories = [];
    if(!empty($products)){
        foreach ($products as $product):
            $terms = get_the_terms($product,'product_cat');
            if(!empty($terms)):
                foreach ($terms as $term):
                    if(!in_array($term->term_id,$categories)):
                        $categories[] = $term->term_id;
                    endif;
                    if($term->parent) {
                        if (!in_array($term->parent, $parent_categories)):
                            $parent_categories[] = $term->parent;
                        endif;
                    }
                endforeach;
            endif;
        endforeach;
    }

    $result = array_diff($categories,$parent_categories);
    sort($result);

    return $result;
}

function check_authentication(){
    $logname = sanitize_text_field($_POST['logname']);
    $pwd = sanitize_text_field($_POST['pwd']);

    $user = get_user_by( 'login', $logname );

    if(!empty($user) && wp_check_password($pwd, $user->data->user_pass, $user->ID)) {
        echo json_encode(array('status' => 1));
    }else{
        echo json_encode(array('status' => 2));
    }
    exit();
}

add_action('wp_ajax_nopriv_check_authentication', 'check_authentication');

function admin_default_page($redirect_to, $request, $user) {
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('subscriber', $user->roles)) {
            $redirect_to =  get_bloginfo('url').'/my-account';
        }
    }
    return $redirect_to;
}

add_filter('login_redirect', 'admin_default_page', 10, 3);

add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
    wp_redirect( home_url().'/login' );
    exit();
}
function save_registration_data(){
    $user_login = sanitize_text_field($_POST['user_login']);
    $user_email = sanitize_text_field($_POST['user_email']);
    $pwd = sanitize_text_field($_POST['pwd']);
    if (!empty($user_login))
        $user_name = preg_replace('/\s+/', '', $user_email);

    $user_id = username_exists($user_name);
    if (!$user_id && email_exists($user_email) == false) {
        $userdata = array(
            'user_pass' => $pwd,
            'user_login' => $user_name,
            'user_email' => $user_email,
            'display_name' => $user_login,
            'role' => 'subscriber'
        );
        $user_id = wp_insert_user($userdata);
        if ($user_id) {
            update_user_meta($user_id, 'full_name', $user_login);
            echo json_encode(array('status' => 1));
            exit();
        }else{
            echo json_encode(array('status' => 2));
            exit();
        }
    }else {
        echo json_encode(array('status' => 3));
        exit();
    }
}
add_action('wp_ajax_nopriv_save_registration_data', 'save_registration_data');

add_filter('body_class', 'filter_body_classes');

function filter_body_classes($classes) {
    if(is_woocommerce() && is_product()){
        $classes[] = 'default-page';
    }
    if(is_cart() || is_checkout() || is_account_page()){
        $classes[] = 'default-page cart-page';
    }

    if ( is_404() ) {
        $classes[] = 'default-page';
    }
    return $classes;
}

add_action( 'after_setup_theme', 'setup_gallery' );

function setup_gallery() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}

add_action('pre_get_posts','shop_filter_cat');

function shop_filter_cat($query) {
    if (!is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query() && isset($_GET['cat_search']) && isset($_GET['s_terms'])) {
        $query->set( 'posts_per_page', 12 );
        $query->set('tax_query', array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'name',
                    'terms'    => $_GET['s_terms']
                ),
                array(
                    'taxonomy' => 'brand',
                    'field'    => 'name',
                    'terms'    => $_GET['s_terms']
                ),
            )
        );
    }
}

add_action('wp_ajax_nopriv_load_more_ajax_by_category_and_brand', 'load_more_ajax_by_category_and_brand');
add_action('wp_ajax_load_more_ajax_by_category_and_brand', 'load_more_ajax_by_category_and_brand');

function load_more_ajax_by_category_and_brand() {
    $catname = $_POST['catname'];
    $brand_name = $_POST['brand_name'];
    $curpageid = $_POST['curpageid'];
    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => '12',
        'offset' => $curpageid * 12,
        'tax_query'             => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'name',
                'terms'    => $catname
            ),
            array(
                'taxonomy' => 'brand',
                'field'    => 'name',
                'terms'    => $brand_name
            ),
        )
    );
    $products = new WP_Query($args);
    //echo '<pre>';
    //print_r($products);
    //echo '</pre>';
    $output = '';
    $nomoretoload = 0;
    if ( $products->have_posts() ) :
        while ( $products->have_posts() ) : $products->the_post(); global $product;
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
            $output .= '<li class="entry product type-product post-'.$product->get_id().' status-publish first '.$product->get_stock_status().' has-post-thumbnail shipping-taxable purchasable product-type-'.$product->get_type().'">
                                <a href="'.$product->get_permalink().'" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
            if(!empty($image[0])):
                $output .= '<img width="113" height="300" src="'.$image[0].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw">';
            endif;
            $output .= '<h2 class="woocommerce-loop-product__title">'.$product->get_name().'</h2>
                                    <span class="price">'.$product->get_price_html().'</span>
                                </a>
                                <a href="'.$product->add_to_cart_url().'" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.$product->get_id().'" data-product_sku="" aria-label="Add “test product” to your cart" rel="nofollow">Add to cart</a>
                            </li>';
        endwhile;
        if($products->post_count < 12){
            $nomoretoload = 1;
        }
        $curpageid++;
    endif;
    echo json_encode(array('output' => $output, 'curpageid' => $curpageid, 'nomoretoload' => $nomoretoload));
    exit();
}
function custom_remove_woo_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_email']);
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );

function wc_cart_totals_shipping_html2() {
    $packages           = WC()->shipping()->get_packages();
    $first              = true;

    foreach ( $packages as $i => $package ) {
        $chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
        $product_names = array();

        if ( count( $packages ) > 1 ) {
            foreach ( $package['contents'] as $item_id => $values ) {
                $product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
            }
            $product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
        }

        wc_get_template(
            'cart/cart-shipping2.php',
            array(
                'package'                  => $package,
                'available_methods'        => $package['rates'],
                'show_package_details'     => count( $packages ) > 1,
                'show_shipping_calculator' => is_cart() && $first,
                'package_details'          => implode( ', ', $product_names ),
                /* translators: %d: shipping package number */
                'package_name'             => apply_filters( 'woocommerce_shipping_package_name', ( ( $i + 1 ) > 1 ) ? sprintf( _x( 'Shipping %d', 'shipping packages', 'woocommerce' ), ( $i + 1 ) ) : _x( 'Shipping', 'shipping packages', 'woocommerce' ), $i, $package ),
                'index'                    => $i,
                'chosen_method'            => $chosen_method,
                'formatted_destination'    => WC()->countries->get_formatted_address( $package['destination'], ', ' ),
                'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),
            )
        );

        $first = false;
    }
}

add_filter( 'woocommerce_account_menu_items', 'add_my_menu_items', 99, 1 );

function add_my_menu_items( $items ) {
    //echo '<pre>';
    //print_r($items);
    //echo '</pre>';
    $items['orders'] = 'My Order';
    $items['dashboard'] = 'My Profile';
    $items['payment-methods'] = 'Manage Payment';
    $items['edit-address'] = 'Manage Address';
    $items['edit-account'] = 'Manage Account';
    $items['customer-logout'] = 'Sign out';
    unset($items['downloads']);
    return $items;
}

add_action('wp_ajax_update_user_information', 'update_user_information');

function update_user_information() {
    $current_user_id = get_current_user_id();
    if($_POST['field_name'] == 'user_email' || $_POST['field_name'] == 'user_pass'){

        if($_POST['field_name'] == 'user_email'){
            $user_id = wp_update_user( array( 'ID' => $current_user_id, 'user_email' => $_POST['field_value'] ) );

            if ( is_wp_error( $user_id ) ) {
                echo json_encode(array('success' => 0));
            } else {
                echo json_encode(array('success' => 1, 'new_val' => $_POST['field_value'], 'field_name' => $_POST['field_name']));
            }
        }else{
            wp_set_password( $_POST['field_value'], $current_user_id );
        }

    }else{
        if(update_user_meta($current_user_id,$_POST['field_name'],$_POST['field_value'])){
            if($_POST['field_name'] == 'user_birth_date'){
                $_POST['field_value'] = date('d-M-Y',strtotime($_POST['field_value']));
            }
            echo json_encode(array('success' => 1, 'new_val' => $_POST['field_value'], 'field_name' => $_POST['field_name']));
        }else{
            echo json_encode(array('success' => 0));
        }
    }
    exit();
}
add_filter( 'woocommerce_my_account_my_orders_query', 'custom_my_account_orders_query', 20, 1 );
function custom_my_account_orders_query( $args ) {
    $args['limit'] = -1;

    return $args;
}

add_action('wp_ajax_change_default_card', 'change_default_card');

function change_default_card() {
    $current_user_id = get_current_user_id();
    if(!empty($_POST['token_id'])){
        //$environment = 'production';
        $environment = 'test';
        $meta_key = '_wc_authorize_net_cim_credit_card_payment_tokens_'.$environment;
        $_wc_authorize_net_cim_credit_card_payment_tokens_test = get_user_meta($current_user_id,$meta_key,true);
        //echo '<pre>';
        //print_r($_wc_authorize_net_cim_credit_card_payment_tokens_test);
        //echo '</pre>';
        if(!empty($_wc_authorize_net_cim_credit_card_payment_tokens_test)):
            $_wc_authorize_net_cim_credit_card_payment_tokens_test2 = [];

            foreach ($_wc_authorize_net_cim_credit_card_payment_tokens_test as $key => $value):
                foreach ($value as $indx => $val):
                    if($key == $_POST['token_id']){
                        if($indx == 'payment_hash') {
                            $_wc_authorize_net_cim_credit_card_payment_tokens_test2[$key][$indx] = $val;
                            $_wc_authorize_net_cim_credit_card_payment_tokens_test2[$key]['default'] = 1;
                        }else{
                            $_wc_authorize_net_cim_credit_card_payment_tokens_test2[$key][$indx] = $val;
                        }
                    }elseif($indx == 'default'){
                        continue;
                    }else{
                        $_wc_authorize_net_cim_credit_card_payment_tokens_test2[$key][$indx] = $val;
                    }
                endforeach;
                /*if($key == $_POST['token_id']){
                    $array['default'] = 1;
                    array_push($_wc_authorize_net_cim_credit_card_payment_tokens_test[$key]['default'],$array);
                }else{
                    unset($_wc_authorize_net_cim_credit_card_payment_tokens_test[$key]['default']);
                }*/
            endforeach;
            //echo '<pre>';
            //print_r($_wc_authorize_net_cim_credit_card_payment_tokens_test2);
            //echo '</pre>';
            if(update_user_meta( $current_user_id, $meta_key, $_wc_authorize_net_cim_credit_card_payment_tokens_test2)){
                echo json_encode(array('updated' => 1));
            }else{
                echo json_encode(array('updated' => 0));
            }
        endif;
    }else{
        echo json_encode(array('updated' => 0));
    }
    exit();
}

function change_default_address() {
    $current_user_id = get_current_user_id();
    if(!empty($_POST['order_id'])){
        $order = wc_get_order( $_POST['order_id'] );
        update_user_meta($current_user_id,'billing_first_name',$order->get_billing_first_name());
        update_user_meta($current_user_id,'billing_last_name',$order->get_billing_last_name());
        update_user_meta($current_user_id,'billing_address_1',$order->get_billing_address_1());
        update_user_meta($current_user_id,'billing_city',$order->get_billing_city());
        update_user_meta($current_user_id,'billing_postcode',$order->get_billing_postcode());
        update_user_meta($current_user_id,'billing_country',$order->get_billing_country());
        update_user_meta($current_user_id,'billing_state',$order->get_billing_state());
        echo json_encode(array('updated' => 1));
    }else{
        echo json_encode(array('updated' => 0));
    }
    exit();
}

add_action('wp_ajax_change_default_address', 'change_default_address');

function remove_address() {
    if(!empty($_POST['order_id'])){
        update_post_meta( $_POST['order_id'], 'remove_address', 1 );
        if(!empty($_POST['related_addr_ids'])){
            $ids_array = explode(',',$_POST['related_addr_ids']);
            foreach ($ids_array as $key => $value):
                update_post_meta( $value, 'remove_address', 1 );
            endforeach;
        }
        echo json_encode(array('updated' => 1));
    }else{
        echo json_encode(array('updated' => 0));
    }
    exit();
}

add_action('wp_ajax_remove_address', 'remove_address');

function edit_address() {
    if(!empty($_POST['order_id'])){
        $order = wc_get_order( $_POST['order_id'] );
        echo json_encode(array('updated' => 1, 'billing_first_name' => $order->get_billing_first_name(), 'billing_last_name' => $order->get_billing_last_name(), 'billing_address_1' => $order->get_billing_address_1(), 'billing_city' => $order->get_billing_city(), 'billing_postcode' => $order->get_billing_postcode(), 'billing_country' => $order->get_billing_country(), 'billing_state' => $order->get_billing_state()));
    }else{
        echo json_encode(array('updated' => 0));
    }
    exit();
}

add_action('wp_ajax_edit_address', 'edit_address');


function edit_address_fields() {
    $current_user_id = get_current_user_id();
    if(!empty($_POST['frm_values'])){
        $params = array();
        parse_str($_POST['frm_values'], $params);
        $order_id = $params['order_id'];
        $related_order_id = $params['related_order_id'];
        $default_order = $params['default_order'];
        unset($params['order_id']);
        unset($params['related_order_id']);
        unset($params['default_order']);
        if($default_order){
            foreach($params as $key => $val):
                update_user_meta($current_user_id,$key,$val);
                update_post_meta( $order_id, '_'.$key, $val );
            endforeach;
        }else{
            foreach($params as $key => $val):
                update_post_meta( $order_id, '_'.$key, $val );
            endforeach;
        }

        if(!empty($related_order_id)){
            $ids_array = explode(',',$related_order_id);
            foreach ($ids_array as $key => $value):
                foreach($params as $key => $val):
                    update_post_meta( $value, '_'.$key, $val );
                endforeach;
            endforeach;
        }
        echo json_encode(array('updated' => 1));
    }else{
        echo json_encode(array('updated' => 0));
    }
    exit();
}

add_action('wp_ajax_edit_address_fields', 'edit_address_fields');

/*function wc_authorize_net_cim_my_payment_methods_table_head_html_cus_func($html,$obj){
    $html = '<thead><tr>';
    foreach ( $obj->get_table_headers() as $key => $title ) {
        $html .= sprintf( '<th class="nn sv-wc-payment-gateway-my-payment-method-table-header sv-wc-payment-gateway-payment-method-header-%1$s wc-%2$s-payment-method-%1$s"><span class="nobr">%3$s</span></th>', sanitize_html_class( $key ), sanitize_html_class( $obj->get_plugin()->get_id_dasherized() ), esc_html( $title ) );
    }
    $html .= '</tr></thead>';
    return $html;
}
add_filter('wc_authorize_net_cim_my_payment_methods_table_head_html','wc_authorize_net_cim_my_payment_methods_table_head_html_cus_func',10,2);*/

//add_filter('wc_authorize_net_cim_credit_card_payment_form_payment_method_html','',10,3);


add_action( 'wp_ajax_checkout_update_value', 'figbros_checkout_update_value' );
add_action( 'wp_ajax_nopriv_checkout_update_value', 'figbros_checkout_update_value' );
function figbros_checkout_update_value(){
	$cart = WC()->cart;
	$data = array(
		'shipping_value' => $cart->get_cart_shipping_total(),
		'total' => $cart->get_total(),
	);
	wp_send_json($data);
}
/*function cus_fun_woocommerce_prevent_admin_access(){
    return false;
}
add_filter('woocommerce_prevent_admin_access','cus_fun_woocommerce_prevent_admin_access',10);

add_filter('woocommerce_disable_admin_bar', 'cus_fun_woocommerce_disable_admin_bar', 10);

function cus_fun_woocommerce_disable_admin_bar() {
    return false;
}*/