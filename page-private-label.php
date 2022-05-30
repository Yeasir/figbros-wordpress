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
$msg = '';
if(isset($_POST['submit_form']) && $_POST['submit_form'] == 1){
    $contact_us_recipient_email_address = get_field('contact_us_recipient_email_address', 'option');
    $subject = 'Figbros Contact Information';
    $headers = "From: " . strip_tags($_POST['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['user_name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
    $message .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($_POST['user_phone']) . "</td></tr>";
    $comment = $_POST['comment'];
    if (($comment) != '') {
        $message .= "<tr><td><strong>Comment:</strong> </td><td>" . htmlentities($comment) . "</td></tr>";
    }
    $message .= "</table>";
    $message .= "</body></html>";

    if(wp_mail( $contact_us_recipient_email_address, $subject, $message, $headers )){
        $msg = 'Email send successfully!';
    }else{
        $msg = 'Failed to send email!';
    }
}
get_header();
global $post;
$private_label_banner_image = get_field('private_label_banner_image', 'option');
$private_label_page_button_text = get_field('private_label_page_button_text', 'option');
$private_label_button_url = get_field('private_label_button_url', 'option');
$private_label_gallery_heading = get_field('private_label_gallery_heading', 'option');
$private_label_gallery_images = get_field('private_label_gallery_images', 'option');
$private_label_get_in_touch_section_heading = get_field('private_label_get_in_touch_section_heading', 'option');
$private_label_get_in_touch_submit_button_text = get_field('private_label_get_in_touch_submit_button_text', 'option');
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- /.inner-banner start  -->
    <section class="inner-banner" style="background-image: url('<?php echo $private_label_banner_image;?>')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col text-left">
                    <h1 class="white-text"><?php the_title();?></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- /.inner-banner end  -->
    <!-- /.cat-content-box start  -->
    <section class="cat-content-box cat-content-box-fix product-development-box-fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12 col-sm-12  ml-auto p-lr ">
                    <div class="img-box">
                        <img src="<?php echo get_the_post_thumbnail_url($post,'full');?>" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 m-auto">
                    <div class="content-box">
                        <?php echo get_the_content();?>
                        <a href="<?php echo $private_label_button_url;?>" class="custom-btn"><?php echo $private_label_page_button_text;?></a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.cat-content-box end  -->
    <?php endwhile; endif; ?>

    <!-- /.gallery start -->
    <section class="gallery">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <!--                    <h2 class="yellow-text text-shadow-2 text-uppercase">--><?php //echo $product_development_gallery_heading;?><!--</h2>-->

                </div>
                <div class="gallery-wrap ">
                    <div class="masnory-grid">
                        <div class="grid-sizer"></div>

                        <?php
                        if(!empty($private_label_gallery_images)):
                            $counter = 1;
                            foreach ($private_label_gallery_images as $private_label_gallery_image):
                                $extra_class = '';
                                if($counter == 1){
                                    $extra_class = 'h-500 w-800';
                                }elseif($counter == 6){
                                    $extra_class = 'w-544 h-500';
                                }elseif($counter == 7){
                                    $extra_class = 'w-355';
                                }elseif($counter == 8){
                                    $extra_class = 'w-614 h-500';
                                }elseif($counter == 9){
                                    $extra_class = 'w-355';
                                }
                                ?>

                                <a class="gallery-item <?php echo $extra_class;?> "  href="<?php echo $private_label_gallery_image['url'];?>" data-lightbox="example-set" data-title=" "  style="background-image: url('<?php echo $private_label_gallery_image['url'];?>')">

                                </a>
                                <?php
                                $counter++;
                            endforeach;
                        endif;?>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- /.gallery end -->


    <!-- /.get-in-touch start -->
    <section class="get-in-touch">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-form-wrap">
                        <h2 class="form-title text-center"><?php echo $private_label_get_in_touch_section_heading;?></h2>
                        <div class="contact-form">
                            <?php if(!empty($msg)):?>
                                <p style="text-align: center"><?php echo $msg;?></p>
                            <?php endif;?>
                            <form action="#btn-sub" method="post" id="contactFrm">
                                <div class="form-row mb-0 p-0">
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <input type="text" name="user_name" class="form-control" placeholder="NAME">
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <input type="email" name="email" class="form-control" placeholder="EMAIL">
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-12">
                                        <input type="tel" name="user_phone" class="form-control" placeholder="PHONE">
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <textarea name="comment" id="comment" cols="10" rows="4" class="form-control" placeholder="YOUR MESSAGE"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-12 text-center submit-btn">
                                        <button type="submit" class="custom-btn text-uppercase" id="btn-sub"><?php echo $private_label_get_in_touch_submit_button_text;?></button>
                                        <input type="hidden" name="submit_form"  value="1">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.get-in-touch end -->

<?php
get_footer();
