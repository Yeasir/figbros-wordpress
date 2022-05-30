<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wp_query;
if($wp_query->queried_object->parent === 0){
    $children = get_terms( $wp_query->queried_object->taxonomy, array(
        'parent'    => $wp_query->queried_object->term_id,
        'hide_empty' => false
    ) );
    if($children) {
        wc_get_template( 'archive-parent_cat.php' );
    }else{
        wc_get_template( 'archive-category_listing.php' );
    }
}else{
    wc_get_template( 'archive-category_listing.php' );
}
