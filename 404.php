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

get_header('shop');
$error_page_content = get_field('404_page_content', 'option');
$error_page_left_image = get_field('404_page_left_image', 'option');
$error_page_right_image = get_field('404_page_right_image', 'option');
?>
    <section class="error-box" style="background-image: url('<?php echo $error_page_left_image;?>'), url('<?php echo $error_page_right_image;?>');">
        <div class="container">
            <div class="row">
                <div class="col m-auto text-center">
                    <?php echo $error_page_content;?>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
