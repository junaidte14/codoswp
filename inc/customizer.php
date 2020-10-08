<?php
/**
 * codoswp Theme Customizer
 *
 * @package codoswp
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function codoswp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'codoswp_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'codoswp_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_control('background_color');

	/**
	 * custom sections
	 */
	require get_template_directory() . '/inc/customizer-includes/custom-sections.php';

}
add_action( 'customize_register', 'codoswp_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function codoswp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function codoswp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function codoswp_customize_preview_js() {
	wp_enqueue_script( 'codoswp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _CODOSWP_VERSION, true );
}
add_action( 'customize_preview_init', 'codoswp_customize_preview_js' );

function codoswp_get_customizer_css() {
    ob_start();

	$color_1 = get_theme_mod( 'codoswp-color-1', '#0C87CC');
	$color_2 = get_theme_mod( 'codoswp-color-2', '#00C0D4');
	$color_3 = get_theme_mod( 'codoswp-color-3', '#545454');
	$color_4 = get_theme_mod( 'codoswp-color-4', '#FFFFFF');

	/**
	 * populate base custom colors from color scheme.
	 */
	require get_template_directory() . '/inc/customizer-includes/base-custom-colors.php';

    $css = ob_get_clean();
    return $css;
}

// Modify our styles registration like so:

function codoswp_customizer_enqueue_styles() {
	$custom_css = codoswp_get_customizer_css();
	wp_add_inline_style( 'codoswp-style', $custom_css );
}
	
add_action( 'wp_enqueue_scripts', 'codoswp_customizer_enqueue_styles' );
