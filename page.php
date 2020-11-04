<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package codoswp
 */

get_header();
?>
<div class="codoswp-container">
	<div class="row">
		<main id="primary" class="site-main col-sm-12 col-md-12">
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
		<?php
		//get_sidebar();
		?>
	</div><!-- .row -->
</div><!-- .codoswp-container -->
<?php
get_footer();
