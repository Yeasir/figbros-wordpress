<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="woocommerce-notices-wrapper"></div><div id="product-<?php echo $product->get_id();?>" class="entry product type-product post-<?php echo $product->get_id();?> status-publish first <?php echo $product->get_stock_status();?> product_cat-merida has-post-thumbnail shipping-taxable purchasable product-type-<?php echo $product->get_type();?>">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-details-box">
                    <?php
                    $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
                    $post_thumbnail_id = $product->get_image_id();
                    $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
                        'woocommerce-product-gallery',
                        'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
                        'woocommerce-product-gallery--columns-' . absint( $columns ),
                        'images',
                    ) );
                    ?>
                    <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
                        <figure class="woocommerce-product-gallery__wrapper">
                            <?php
                            if ( $product->get_image_id() ) {
                                $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
                            } else {
                                $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                                $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
                                $html .= '</div>';
                            }

                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

                            do_action( 'woocommerce_product_thumbnails' );
                            ?>
                        </figure>
                    </div>

                    <div class="summary entry-summary">
                        <h1 class="product_title entry-title">
                            <?php
                            $product_name = $product->get_name();
                            //$product_name_length = strlen($product_name);
                            //if($product_name_length > 27){
                                //$product_name = substr($product_name,0,27).'...';
                            //}
                            echo $product_name.'<br/>';
                            $catIds = $product->get_category_ids();
                            $category_name = [];
                            if (!empty($catIds)) {
                                foreach ($catIds as $cat_id) {
                                    $trm = get_term_by('id', $cat_id, 'product_cat');
                                    if($trm->parent != 0) {
                                        $category_name[] = $trm->name;
                                        break;
                                    }
                                }
                            }
                            echo implode(', ', $category_name);
                            ?>
                        </h1>
                        <p class="price"><?php echo $product->get_price_html();?></p>
                        <?php
                        $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
                        if ( $short_description ) {
                            ?>
                            <div class="woocommerce-product-details__short-description">
                                <p><?php echo $short_description;?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        $terms = wp_get_post_terms( $product->get_id(), 'product_cat' );
                        $term_slugs = wp_list_pluck( $terms, 'slug' );
                        $heat_level = get_field( "heat_level", $product->get_id() );
                        if(empty($heat_level)){
                            $heat_level = 0;
                        }
                        if(in_array('wholesale-sauces',$term_slugs)):
                        ?>
                        <!-- /.heat-level start -->
                        <div class="heat-level">
                            <ul class="list-inline d-flex align-items-end">
                                <li class="list-inline-item heat-level-heading text-uppercase">
                                    <span>heat LeveL</span>
                                </li>
                                <?php for($i = 1;$i <= 4; $i++){
                                    if($i > $heat_level){
                                        $image_url = get_bloginfo('template_url').'/images/heat-level-inactive.png';
                                    }else{
                                        $image_url = get_bloginfo('template_url').'/images/heat-level-active.png';
                                    }
                                    ?>
                                <li class="list-inline-item">
                                    <img src="<?php echo $image_url;?>" class="img-fluid" alt="">
                                </li>
                                <?php };?>
                            </ul>
                        </div>
                        <!-- /.heat-level end -->
                        <?php
                        endif;
                        echo wc_get_stock_html( $product ); // WPCS: XSS ok.

                        if ( $product->is_in_stock() ) : ?>

                            <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

                            <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                                <?php
                                do_action( 'woocommerce_before_add_to_cart_quantity' );

                                woocommerce_quantity_input( array(
                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                ) );

                                do_action( 'woocommerce_after_add_to_cart_quantity' );
                                ?>

                                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt ajax_add_to_cart"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

                                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                            </form>

                            <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.additional-info start -->
    <div class="additional-info">
        <div class="container">
            <div class="row">
                <div class="col-12 heading text-uppercase">
                    <h3>Additional information</h3>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <!-- /.short-description start -->
                <div class="col-lg-5 col-sm-12 col-12 short-description pr-lg-5">
                    <?php
                    if(in_array('wholesale-sauces',$term_slugs)):
                    ?>
                    <div class="heat-level-fix">
                        <ul class="list-inline d-flex align-items-end mb-0">
                            <?php
                            $heat_level = get_field( "heat_level", $product->get_id() );
                            if(empty($heat_level)){
                                $heat_level = 0;
                            }
                            for($i = 1;$i <= 4; $i++){
                                if($i > $heat_level){
                                    $image_url = get_bloginfo('template_url').'/images/heat-level-inactive.png';
                                }else{
                                    $image_url = get_bloginfo('template_url').'/images/heat-level-active.png';
                                }
                                ?>
                                <li class="list-inline-item">
                                    <img src="<?php echo $image_url;?>" class="img-fluid" alt="">
                                </li>
                            <?php };?>
                        </ul>
                    </div>
                    <?php
                    endif;
                    ?>
                    <?php echo $product->get_description();?>
                </div>
                <!-- /.short-description end -->
                <?php
                    $ingredients = get_field( "ingredients", $product->get_id() );
                    if(!empty($ingredients)):
                        $ingredients_array = explode(',',$ingredients);
               ?>
                <!-- /.ingredients start -->
                <div class="col-lg-3 col-sm-12 col-12 offset-lg-1 ingredients">
                    <h6 class="mb-0">INGREDIENTS</h6>
                    <p><?php echo $ingredients;?></p>
                </div>
                <?php endif;?>
                <!-- /.ingredients end -->
                <?php
                $nutrition_facts = get_field( "nutrition_facts", $product->get_id() );
                if(!empty($nutrition_facts)):
                ?>
                <!-- /.nutrition-facts start -->
                <div class="col-lg-3 col-sm-12 col-12 nutrition-facts">
                    <h6 class="mb-0">NUTRITION FACTS</h6>
                    <ul class="list-group list-group-flush mb-0">
                        <?php foreach ($nutrition_facts as $nutrition_fact):?>
                        <li class="list-group-item d-flex justify-content-between align-items-center pl-0 pr-0  border-0">
                            <?php echo $nutrition_fact['title'];?>
                            <span><?php echo $nutrition_fact['amount'];?></span>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <!-- /.nutrition-facts end -->
                <?php endif;?>
            </div>
        </div>
        <?php
        $product_specifications = get_field( "product_specifications", $product->get_id() );
        if(!empty($product_specifications)):
            $counter = 1;
        ?>
        <!-- /.product-specification start -->
        <div class="product-specification">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="pro-tab-slider">
                            <div class="pro-tab-slider-row">
                                <?php foreach ($product_specifications as $product_specification):?>
                                <div class="col <?php if($counter == 1){?>active<?php };?> text-center">
                                    <img src="<?php echo $product_specification['specification_image'];?>" class="img-fluid">
                                    <p><?php echo $product_specification['heading'];?></p>
                                </div>
                                <?php $counter++;endforeach;?>
                            </div>
                        </div>
                        <div class="pro-tab-slider-content">
                            <?php foreach ($product_specifications as $product_specification):?>
                                <div class="slider-content-details">
                                    <?php echo $product_specification['details'];?>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.product-specification end -->
        <?php endif;?>
    </div>
    <!-- /.additional-info end -->

    <div class="clearfix"></div>

    <section class="related products product-listing-cat-wrap product-sub-cat product-branding-wrap">
        <?php echo do_shortcode('[related_products limit="4"]');?>
    </section>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
