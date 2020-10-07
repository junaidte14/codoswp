<?php
/**
 * Template Name: Full-width layout
 * The template for displaying full-width pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package codoswp
 */

get_header();
$extra_class = (get_post_meta( $post->ID, '_codo_show_hide_title', true ))? 'codo-hide-title': '';
?>
    <div class="codo-full-page <?php echo $extra_class;?>">
        <main id="primary" class="site-main">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
    </div><!-- .codo-full-page -->
<?php
get_footer();
