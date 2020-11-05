<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package codoswp
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="codoswp-container">
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<?php
						if( function_exists( 'the_custom_logo' ) ) {
							if(has_custom_logo()) {
								the_custom_logo();
							} else {
								?>
								<h1 class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php bloginfo( 'name' ); ?>
									</a>
								</h1>
								<?php
							}
						} 
					?>
				</div>
				<div class="col-sm-12 col-md-8">
					<p class="text-right">
						<?php
						printf( esc_html__( '&copy; Copyright %s. All rights reserved.', CODOSWP ), date("Y") );
						?>
					</p>
				</div>
			</div>
			<div class="footer-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-3',
					'menu_id'        => 'footer-menu',
					'depth'             => 1,
					'container'         => 'div',
					'container_class'   => 'navbar-nav navbar-expand-lg',
					'menu_class'        => 'nav navbar-nav float-left',
					'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					'walker'            => new wp_bootstrap_navwalker())
				);
				?>
			</div>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', CODOSWP ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', CODOSWP ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s developed by %2$s', CODOSWP ), CODOSWP, '<a href="https://codoplex.com">CODOPLEX.</a>' );
					?>
			</div><!-- .site-info -->
		</div><!-- .codoswp-container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
