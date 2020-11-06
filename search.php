<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package codoswp
 */

get_header();
?>
<div class="codoswp-container">
	<div class="row">
		<main id="primary" class="site-main col-sm-12 col-md-12">

			<?php if ( have_posts() ) : ?>

				<header class="page-header alignwide">
					<div class="codoswp-container">
						<div class="page-title">
							<h1>
								<?php 
									printf( esc_html__( 'Search Results for: %s', 'codoswp' ), '<span>' . get_search_query() . '</span>' ); 
								?>
							</h1>
						</div>
					</div>
				</header>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->

		<?php
		//get_sidebar();
		?>
	</div><!-- .row -->
</div><!-- .codoswp-container -->
<?php
get_footer();
