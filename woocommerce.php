<?php
/**
 * The template for displaying woocommerce pages
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
