/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Header text color.
	wp.customize( 'owner_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a, .site-description' ).css( {
				'color': to
			} );
		} );
	} );

	wp.customize( 'owner_copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '.owner-copyright' ).text( to );
		} );
	} );

	wp.customize( 'header_address', function( value ) {
		value.bind( function( to ) {
			$( '.top-address' ).text( to );
		} );
	} );

	wp.customize( 'header_email', function( value ) {
		value.bind( function( to ) {
			$( '.top-email' ).text( to );
		} );
	} );

	wp.customize( 'header_phone', function( value ) {
		value.bind( function( to ) {
			$( '.top-phone' ).text( to );
		} );
	} );
	

} )( jQuery );
