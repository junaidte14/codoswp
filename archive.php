<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package codoswp
 */

get_header();
?>
<div class="codoswp-container">
	<div class="row">
		<main id="primary" class="site-main col-sm-12 col-md-8">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<div class="codoswp-container">
						<div class="page-title">
							<?php
							the_archive_title( '<h1>', '</h1>' );
							?>
						</div>
						<?php
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</div>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
		<?php
		get_sidebar();
		?>
	</div><!-- .row -->
</div><!-- .codoswp-container -->

<?php
get_footer();
