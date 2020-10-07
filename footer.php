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
				<div class="col-sm-12 col-md-8">
					<div class="row" style="border-bottom: 1px dotted;">
						<div class="col-sm-12 col-md-2">
							<img src="/rppm/wp-content/uploads/2020/09/Logo-1.png" />
						</div>
						<div class="col-sm-12 col-md-10">
							<p class="mb-1">© American Association of State Highway and Transportation Officials. All rights reserved.</p>
							<p class="mb-1">555 12th Street NW, Suite 1000 | Washington, DC | 20004</p>
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
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<img src="/rppm/wp-content/uploads/2020/09/Logo-2.png" />
						</div>
						<div class="col-sm-12 col-md-6">
							<img src="/rppm/wp-content/uploads/2020/09/Logo-3.png" />
						</div>
					</div>
				</div>
			</div>
			<div class="site-info" style="display: none">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', CODOSWP ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', CODOSWP ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s', CODOSWP ), CODOSWP, '<a href="#">iENGINEERING.</a>' );
					?>
			</div><!-- .site-info -->
		</div><!-- .codoswp-container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
