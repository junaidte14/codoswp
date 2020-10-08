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

	/*******************************************
	Color scheme
	********************************************/
	
	// add the section to contain the settings
	$wp_customize->add_section( 'Color Scheme' , array(
		'title' =>  'Colors',
	) );

	$color_1 = get_theme_mod( 'codoswp-color-1', '#0C87CC');
	$color_2 = get_theme_mod( 'codoswp-color-2', '#00C0D4');
	$color_3 = get_theme_mod( 'codoswp-color-3', '#545454');
	$color_4 = get_theme_mod( 'codoswp-color-4', '#FFFFFF');

	$txtcolors[] = array(
		'slug'=>'codoswp-color-1', 
		'default' => $color_1,
		'label' => 'Color 1'
	);

	$txtcolors[] = array(
		'slug'=>'codoswp-color-2', 
		'default' => $color_2,
		'label' => 'Color 2'
	);

	$txtcolors[] = array(
		'slug'=>'codoswp-color-3', 
		'default' => $color_3,
		'label' => 'Color 3'
	);

	$txtcolors[] = array(
		'slug'=>'codoswp-color-4', 
		'default' => $color_4,
		'label' => 'Color 4'
	);

	// add the settings and controls for each color
	foreach( $txtcolors as $txtcolor ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$txtcolor['slug'], array(
				'default' => $txtcolor['default'],
				'sanitize_callback' => 'sanitize_hex_color', 
				'capability' =>  'edit_theme_options'
			)
		);

		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$txtcolor['slug'], 
				array('label' => $txtcolor['label'], 
				'section' => 'colors',
				'settings' => $txtcolor['slug'])
			)
		);
		
	}


	/*******************************************
	Top Bar Section
	********************************************/
	
	// add the section to contain the settings
	$wp_customize->add_section( 'topbar' , array(
		'title' =>  'Top Bar',
	) );

	/*******************************************
	Header Section
	********************************************/
	
	// add the section to contain the settings
	$wp_customize->add_section( 'headersection' , array(
		'title' =>  'Header Section',
	) );

	/*******************************************
	Footer Section
	********************************************/
	
	// add the section to contain the settings
	$wp_customize->add_section( 'footersection' , array(
		'title' =>  'Footer Section',
	) );

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

    ?>
		.top-bar,
		.page article header,
		.has-codoswp-color-1-background-color{
			background-color: <?php echo $color_1; ?>;
		}
		h1, h2, h4, h6,
		a, a:visited,
		.has-codoswp-color-1-color{
			color: <?php echo $color_1; ?>;
		}
		.wp-block-quote{
			border-color: <?php echo $color_1; ?>;
		}
		.top-bar ul li:nth-child(2) a,
		.has-codoswp-color-2-background-color,
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"]{
			background-color: <?php echo $color_2; ?>;
		}
		a:hover, a:focus, a:active,
		.site-title a,
		.site-title a:visited,
		.has-codoswp-color-2-color{
			color: <?php echo $color_2; ?>;
		}
		.navbar-nav>.active>a>span{
			border-bottom-color: <?php echo $color_2; ?>;
		}
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"]{
			border-color: <?php echo $color_2; ?>;
		}
		.navbar-nav li a,
		.navbar-nav .fa-search,
		.navbar-nav li a:hover,
		.navbar-nav li a:active,
		.navbar-nav li a:focus,
		.navbar-nav .fa-search:hover,
		.site-description,
		.site-footer,
		.site-footer .site-info a,
		.site-footer a:hover,
		.has-codoswp-color-3-color,
		body, button, input, select, optgroup, textarea,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea{
			color: <?php echo $color_3; ?>;
		}
		.has-codoswp-color-3-background-color,
		hr, pre, mark, ins {
			background-color: <?php echo $color_3; ?>;
		}
		abbr,
		acronym,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea, select, .widget-area .widget ul li {
			border-color: <?php echo $color_3; ?>;
		}
		.top-bar,
		.top-bar .navbar-nav li a,
		.top-bar .navbar-nav li a:hover,
		.page article header,
		.has-codoswp-color-4-color,
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"], pre, mark, ins{
			color: <?php echo $color_4; ?>;
		}
		body,
		.site-header,
		.site-footer,
		.has-codoswp-color-4-background-color{
			background-color: <?php echo $color_4; ?>;
		}	
		<?php
    $css = ob_get_clean();
    return $css;
}

// Modify our styles registration like so:

function codoswp_customizer_enqueue_styles() {
	$custom_css = codoswp_get_customizer_css();
	wp_add_inline_style( 'codoswp-style', $custom_css );
}
	
add_action( 'wp_enqueue_scripts', 'codoswp_customizer_enqueue_styles' );
