<?php /* Template Name: Blog Template */ ?>

<?php get_header('account'); ?>

<!-- /.blog-grid start -->
<section class="section-blog pt-0">
    <div class="container">
        <div class="row">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type'   => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 12,
                'paged' => $paged
            );
            $loop = new WP_Query( $args );
            if( $loop->have_posts() ) :
            ?>
            <!-- /.blog-heading start -->
            <div class="col-12 blog-heading text-center">
                <h2 class="black-text"><?php the_title();?></h2>
            </div>
            <!-- /.blog-heading end -->
            <?php
              while( $loop->have_posts() ) :$loop->the_post();
                    global $post;
                    $post_image = get_the_post_thumbnail_url($post,'blog-thumbnail');
                ?>
                    <!-- /.blog-boxes start -->
                    <div class="col-lg-4 col-sm-6 col-12 blog-items">
                        <div class="blog-boxes blog-thumbs-has">
                            <div class="blog-thumbs text-center">
                                <a href="<?php echo get_permalink($post);?>">
                                    <img src="<?php echo $post_image;?>" class="img-fluid" alt="<?php echo $post->post_title;?>">
                                </a>
                            </div>
                            <div class="blog-contents">
                                <h4 class="blog-title">
                                    <a href="<?php echo get_permalink($post);?>"><?php echo $post->post_title;?></a>
                                </h4>
                                <p><?php echo $post->post_excerpt;?></p>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo get_permalink($post);?>" class="btn read-more"><?php echo 'Read More';?></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.blog-boxes end -->
                 <?php
                endwhile;
                ?>
                <div class="col-12 text-center mt-4">
                    <?php
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $loop->max_num_pages
                    ) );
                    ?>
                </div>
                <?php
                wp_reset_postdata();
                ?>
            <?php
            else :
                echo '<p>No post found!</p>';
            endif;
            ?>
        </div>
    </div>
</section>
<!-- /.blog-grid end -->

<?php get_footer(); ?>
