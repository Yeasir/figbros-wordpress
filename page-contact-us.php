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
    $contact_form_heading = get_field('contact_form_heading', 'option');
    $contact_form_button_text = get_field('contact_form_button_text', 'option');
    $contact_informations = get_field('contact_informations', 'option');
    $contact_us_social_heading = get_field('contact_us_social_heading', 'option');
    $facebook_url = get_field('facebook_url', 'option');
    $twitter_url = get_field('twitter_url', 'option');
    $linkedin_url = get_field('linkedin_url', 'option');
    $youtube_url = get_field('youtube_url', 'option');

?>
    <!-- /.inner-banner start  -->
    <section class="inner-banner" style="background-image: url('<?php echo get_the_post_thumbnail_url($post,'full');?>')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col text-left">
                    <h1 class="white-text"><?php the_title();?> </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- /.inner-banner end  -->

    <!-- /.the-team start  -->
    <!-- /.the-team start  -->
    <section class="page-contact-box">
        <div class="container">
            <div class="row">
                <!--/.single-team-->
                <div class="col-11 contact-box m-auto">

                    <div class="row ">
                        <div class="col-lg-7 col-md-6 col-sm-12 box yellow-bg">
                            <h3 class="black-text"><?php echo $contact_form_heading;?></h3>
                            <?php if(!empty($msg)):?>
                            <p><?php echo $msg;?></p>
                            <?php endif;?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_name"  placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_phone"  placeholder="Phone" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Your Message"></textarea>
                                </div>
                                <button type="submit" class="btn sub-btn"><?php echo $contact_form_button_text;?></button>
                                <input type="hidden" name="submit_form"  value="1">
                            </form>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12 box white-bg">
                            <div class="contact-info">
                                <?php echo $contact_informations;?>
                            </div>

                            <div class="follow-box">
                                <h3><?php echo $contact_us_social_heading;?></h3>
                                <ul class="list-inline social">
                                    <li class="list-inline-item"><a href="<?php echo $facebook_url;?>"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="<?php echo $twitter_url;?>"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="<?php echo $linkedin_url;?>"><i class="zmdi zmdi-linkedin"></i></a></li>
                                    <li class="list-inline-item"><a href="<?php echo $youtube_url;?>"><i class="zmdi zmdi-youtube-play"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/.single-team-->
            </div>
        </div>

    </section>
<?php
get_footer();
