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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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

	$color_1 = '#0C87CC';
	$color_2 = '#00C0D4';
	$color_3 = '#545454';
	$color_4 = '#737373';
	$color_5 = '#0E90AC';
	$color_6 = '#FFFFFF';
	$color_7 = '#000000';

	$txtcolors[] = array(
		'slug'=>'codoswp_primary_color', 
		'default' => $color_1,
		'label' => 'Primary Color'
	);

	$txtcolors[] = array(
		'slug'=>'codoswp_secondary_color', 
		'default' => $color_2,
		'label' => 'Secondary Color'
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

	$topbarcolors[] = array(
		'slug'=>'codoswp_topbar_bg_color', 
		'default' => $color_1,
		'label' => 'BG Color'
	);

	$topbarcolors[] = array(
		'slug'=>'codoswp_topbar_text_color', 
		'default' => $color_6,
		'label' => 'Text Color'
	);

	$topbarcolors[] = array(
		'slug'=>'codoswp_topbar_Link_color', 
		'default' => $color_6,
		'label' => 'Link Color'
	);

	$topbarcolors[] = array(
		'slug'=>'codoswp_topbar_Link_bg_color', 
		'default' => $color_2,
		'label' => 'Link BG Color'
	);

	// add the settings and controls for each color
	foreach( $topbarcolors as $txtcolor ) {
	
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
				'section' => 'topbar',
				'settings' => $txtcolor['slug'])
			)
		);
		
	}

	/*******************************************
	Header Section
	********************************************/
	
	// add the section to contain the settings
	$wp_customize->add_section( 'headersection' , array(
		'title' =>  'Header Section',
	) );

	$headercolors[] = array(
		'slug'=>'codoswp_header_bg_color', 
		'default' => $color_6,
		'label' => 'Header BG Color'
	);

	$headercolors[] = array(
		'slug'=>'codoswp_header_title_color', 
		'default' => $color_2,
		'label' => 'Title Color'
	);

	$headercolors[] = array(
		'slug'=>'codoswp_header_desc_color', 
		'default' => $color_3,
		'label' => 'Description Color'
	);

	$headercolors[] = array(
		'slug'=>'codoswp_menu_color', 
		'default' => $color_3,
		'label' => 'Menu Text Color'
	);

	$headercolors[] = array(
		'slug'=>'codoswp_menu_hover_color', 
		'default' => $color_3,
		'label' => 'Menu Text Hover Color'
	);

	// add the settings and controls for each color
	foreach( $headercolors as $txtcolor ) {
	
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
				'section' => 'headersection',
				'settings' => $txtcolor['slug'])
			)
		);
		
	}

	/*******************************************
	Footer Section
	********************************************/
	
	// add the section to contain the settings
	$wp_customize->add_section( 'footersection' , array(
		'title' =>  'Footer Section',
	) );

	$footercolors[] = array(
		'slug'=>'codoswp_footer_bg_color', 
		'default' => $color_6,
		'label' => 'Footer BG Color'
	);

	$footercolors[] = array(
		'slug'=>'codoswp_footer_text_color', 
		'default' => $color_3,
		'label' => 'Footer Text Color'
	);

	$footercolors[] = array(
		'slug'=>'codoswp_footer_link_color', 
		'default' => $color_3,
		'label' => 'Footer Link Color'
	);

	// add the settings and controls for each color
	foreach( $footercolors as $txtcolor ) {
	
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
				'section' => 'footersection',
				'settings' => $txtcolor['slug'])
			)
		);
		
	}

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

	$color_1 = '#0C87CC';
	$color_2 = '#00C0D4';
	$color_3 = '#545454';
	$color_4 = '#737373';
	$color_5 = '#0E90AC';
	$color_6 = '#FFFFFF';
	$color_7 = '#000000';

	$codoswp_primary_color = get_theme_mod( 'codoswp_primary_color', $color_1);
	$codoswp_secondary_color = get_theme_mod( 'codoswp_secondary_color', $color_2);

	$codoswp_topbar_bg_color = get_theme_mod('codoswp_topbar_bg_color', $color_1);
	$codoswp_topbar_text_color = get_theme_mod('codoswp_topbar_text_color', $color_6);
	$codoswp_topbar_Link_color = get_theme_mod('codoswp_topbar_Link_color', $color_6);
	$codoswp_topbar_Link_bg_color = get_theme_mod('codoswp_topbar_Link_bg_color', $color_2);

	$codoswp_header_bg_color = get_theme_mod( 'codoswp_header_bg_color', $color_6);
	$codoswp_header_title_color = get_theme_mod( 'codoswp_header_title_color', $color_2);
	$codoswp_header_desc_color = get_theme_mod('codoswp_header_desc_color', $color_3);
	$codoswp_menu_color = get_theme_mod('codoswp_menu_color', $color_3);
	$codoswp_menu_hover_color = get_theme_mod('codoswp_menu_hover_color', $color_3);

	$codoswp_footer_bg_color = get_theme_mod('codoswp_footer_bg_color', $color_6);
	$codoswp_footer_text_color = get_theme_mod('codoswp_footer_text_color', $color_3);
	$codoswp_footer_link_color = get_theme_mod('codoswp_footer_link_color', $color_3);
    ?>
		.top-bar{
			background-color: <?php echo $codoswp_topbar_bg_color; ?>;
			color: <?php echo $codoswp_topbar_text_color; ?>;
		}
		.top-bar .navbar-nav li a,
		.top-bar .navbar-nav li a:hover{
			color: <?php echo $codoswp_topbar_Link_color; ?>;
		}
		.top-bar ul li:nth-child(2) a{
			background-color: <?php echo $codoswp_topbar_Link_bg_color; ?>;
		}
		.site-header{
			background-color: <?php echo $codoswp_header_bg_color; ?>;
		}
		.site-title a,
		.site-title a:visited{
			color: <?php echo $codoswp_header_title_color; ?>;
		}
		.page article header{
			background-color: <?php echo $color_1; ?>;
			color: #ffffff;
		}
		.site-footer{
			background-color: <?php echo $codoswp_footer_bg_color; ?>;
		}
		.navbar-nav li a,
		.navbar-nav .fa-search{
			color: <?php echo $codoswp_menu_color; ?>;
		}
		.navbar-nav li a:hover,
		.navbar-nav li a:active,
		.navbar-nav li a:focus,
		.navbar-nav .fa-search:hover{
			color: <?php echo $codoswp_menu_hover_color; ?>;
		}
		.navbar-nav>.active>a>span{
			border-bottom-color: <?php echo $codoswp_secondary_color; ?>;
		}
		h1, h2, h4, h6,{
			color: <?php echo $codoswp_primary_color; ?>;
		}
		.site-description{
			color: <?php echo $codoswp_header_desc_color; ?>;
		}
		.site-footer{
			background-color: <?php echo $codoswp_footer_bg_color; ?>;
			color: <?php echo $codoswp_footer_text_color; ?>;
		}
		.site-footer .site-info a{
			color: <?php echo $codoswp_footer_link_color; ?>;
		}
		.site-footer a:hover{
			color: <?php echo $codoswp_footer_text_color; ?>;
		}
		a, a:visited{
			color: <?php echo $codoswp_secondary_color; ?>;
		}
		a:hover{
			color: <?php echo $codoswp_primary_color; ?>;
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
