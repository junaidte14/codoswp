<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package codoswp
 */

get_header();
?>
<div class="codoswp-container">
	<div class="row">
		<main id="primary" class="site-main col-sm-12 col-md-12">
			<section class="error-404 not-found">
				<header class="page-header alignwide">
					<div class="codoswp-container">
						<div class="page-title">
							<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', CODOSWP ); ?></h1>
						</div>
					</div>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'codoswp' ); ?></p>

						<?php
						get_search_form();

						the_widget( 'WP_Widget_Recent_Posts' );
						?>

						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'codoswp' ); ?></h2>
							<ul>
								<?php
								wp_list_categories(
									array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									)
								);
								?>
							</ul>
						</div><!-- .widget -->

						<?php
						/* translators: %1$s: smiley */
						$codoswp_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'codoswp' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$codoswp_archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
						?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
		<?php
		//get_sidebar();
		?>
	</div><!-- .row -->
</div><!-- .codoswp-container -->
<?php
get_footer();
