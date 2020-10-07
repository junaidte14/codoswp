<?php

/** 
 * Adding WordPress search icon after navigation menu
*/

add_filter( 'wp_nav_menu_items', 'codo_add_search_form', 10, 2 );
/**
* Add search box to nav menu.
*/
function codo_add_search_form( $items, $args ) {
    if ( $args->theme_location == 'menu-1' ) { // affect only Primary Navigation Menu.
		$items .= '<li class="menu-item search">
			<form role="search" method="get" class="search-form" action="'.home_url( '/' ).'">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<!--<i class="fas fa-search"></i>--><img src="'.get_template_directory_uri() . '/images/search-icon.png'.'" width="24"/>
					<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:" />
				</label>
				<!--<input type="submit" class="search-submit" value="Search" />-->
			</form>
		</li>';
    }
    return $items;
}