<?php

// ----------------------------------------------------------------------------------
//	Register Front-End Styles And Scripts
// ----------------------------------------------------------------------------------

function grow_thinkup_child_frontscripts() {

	wp_enqueue_style( 'thinkup-style', get_template_directory_uri() . '/style.css', array( 'thinkup-bootstrap' ) );
	wp_enqueue_style( 'grow-thinkup-style-business', get_stylesheet_directory_uri() . '/style.css', array( 'thinkup-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'grow_thinkup_child_frontscripts' );


// ----------------------------------------------------------------------------------
//	Update Options Array With Child Theme Color Values
// ----------------------------------------------------------------------------------

// Add child theme color values to options array
function grow_thinkup_updateoption_child_settings() {

	// Set theme name combinations
	$name_theme_upper = 'Grow';
	$name_theme_lower = strtolower( $name_theme_upper );

	// Set possible options names
	$name_options_free  = 'thinkup_redux_variables';
	$name_child_color   = $name_theme_lower . '_thinkup_child_color_business';

	// Get options values (theme options)
	$options_free = get_option( $name_options_free );

	// Get child color values
	$options_child_settings = get_option( $name_child_color );

	if( ! empty( $options_free ) ) {

		// Only set child color values if not already set 
		if ( $options_child_settings != 1 ) {

			$options_free['thinkup_styles_skinswitch'] = '1';
			$options_free['thinkup_styles_skin']       = 'business';

			// Add child color to theme options array
			update_option( $name_options_free, $options_free );

		}
	}

	// Set the child color flag
	update_option( $options_child_settings, 1 );

}
add_action( 'init', 'grow_thinkup_updateoption_child_settings', 999 );

