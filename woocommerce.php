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
 * @package codoswp
 */

get_header();
?>
<div class="codoswp-container">
	<div class="row">
		<main id="primary" class="site-main col-sm-12 col-md-12">
			<?php woocommerce_content(); ?>
		</main><!-- #main -->
		<?php
		//get_sidebar();
		?>
	</div><!-- .row -->
</div><!-- .codoswp-container -->
<?php
get_footer();
