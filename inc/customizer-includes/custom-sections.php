<?php

/*******************************************
Color scheme
********************************************/

// add the section to contain the settings
$wp_customize->add_section( 'Color Scheme' , array(
    'title' =>  'Colors',
) );

$color_1 = get_theme_mod( 'codoswp-color-1', '#253b80');
$color_2 = get_theme_mod( 'codoswp-color-2', '#179bd7');
$color_3 = get_theme_mod( 'codoswp-color-3', '#545454');
$color_4 = get_theme_mod( 'codoswp-color-4', '#ffffff');
$color_5 = get_theme_mod( 'codoswp-color-5', '#ff6000');

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

$txtcolors[] = array(
    'slug'=>'codoswp-color-5', 
    'default' => $color_5,
    'label' => 'Color 5'
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