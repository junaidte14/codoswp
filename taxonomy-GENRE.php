<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">
<?php
$termid = get_queried_object()->term_id;
$args = array(
    'post_type' => 'event',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'genre',
            'field'    => 'ID',
            'terms'    => array($termid)
             )
        ),
     );// end args

     $myposts = get_posts($args);
     ?>
<?php  if ($myposts): {
        foreach ($myposts as $post) :
            setup_postdata($post); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php
        endforeach;
        wp_reset_postdata();
    }?>
<?php else:  ?>
	<div class="post">
		<h3><?php _e('No City Found', 'cmeasytheme'); ?></h3>
	</div>
<?php endif; ?>
    

</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>
