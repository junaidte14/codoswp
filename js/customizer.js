/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'codoswp-color-1', function( value ) {
		value.bind( function( to ) {
			$( '.page article header, .has-codoswp-color-1-background-color' ).css( {
				backgroundColor: to,
			} );
			$( 'h1, h2, h4, h6, a:hover, .has-codoswp-color-1-color' ).css( {
				color: to,
			} );
		} );
	} );
}( jQuery ) );
