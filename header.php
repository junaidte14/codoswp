<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package codoswp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	
	<div class="top-bar">
		<div class="codoswp-container">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'top-menu',
				'depth'             => 1,
				'container'         => 'div',
				'container_class'   => 'navbar-nav navbar-expand-lg pr-lg-4',
				'menu_class'        => 'nav navbar-nav float-left ml-auto',
				'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				'walker'            => new wp_bootstrap_navwalker())
			);
			?>
		</div>
	</div>
	<header id="masthead" class="site-header">
		<nav class="navbar navbar-expand-lg" role="navigation">
			<div class="codoswp-container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					
						<?php
							if( function_exists( 'the_custom_logo' ) ) {
								if(has_custom_logo()) {
								?>
								<div class="site-branding custom-logo">
									<?php
										the_custom_logo();
									?>
								</div>
								<?php
								} else {
								?>
									<div class="site-branding">
										<?php
											if ( is_front_page() && is_home() ) :
												?>
												<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<?php
											else :
												?>
												<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<?php
											endif;
											$codoswp_description = get_bloginfo( 'description', 'display' );
											if ( $codoswp_description || is_customize_preview() ) :
												?>
												<p class="site-description d-none d-lg-block"><?php echo $codoswp_description;?></p>
											<?php 
											endif;
										?>
									</div>
									<?php
								}
							} 
						?>
					<button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
						menu
					</button>
				</div>


				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'depth'             => 2,
					'container'         => 'div',
					'container_class'   => 'collapse navbar-collapse',
					'container_id'      => 'bs-example-navbar-collapse-1',
					'menu_class'        => 'nav navbar-nav float-left ml-auto',
					'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					'walker'            => new wp_bootstrap_navwalker())
				);
				?>
			</div><!-- /.codoswp-container -->
		</nav>
	</header><!-- #masthead -->
