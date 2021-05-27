<?php
/**
 * Owner Theme Customizer panel for Additional Settings.
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

add_action( 'customize_register', 'owner_additional_panel_register' );

if( ! function_exists( 'owner_additional_panel_register' ) ):
	function owner_additional_panel_register( $wp_customize ) {

		/**
		 * Additional Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'owner_additional_settings_panel', 
        	array(
        		'priority'       => 25,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'Additional Settings', 'owner' ),
            )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Social Icons Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'social_icons_section',
	        array(
	            'title'		=> esc_html__( 'Social Icons', 'owner' ),
	            'panel'     => 'owner_additional_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Social icons field
	     *
	     * @since 1.0.0
	     */
	    $ap_social_icons_name = array( 
			'fb_link' => esc_html__( 'Facebook', 'owner' ),
			'tw_link' => esc_html__( 'Twitter', 'owner' ),
			'ln_link' => esc_html__( 'Linkedin', 'owner' ),
			'pin_link' => esc_html__( 'Pinterest', 'owner' ),
			'gp_link' => esc_html__( 'Google Plus', 'owner' ),
			'yt_link' => esc_html__( 'Youtube', 'owner' ),
		);
	    $count = 3;
	    foreach ( $ap_social_icons_name as $icon_key => $icon_name ) {
	    	$wp_customize->add_setting(
		        $icon_key,
	            array(
	                'default' => '',
	                'sanitize_callback' => 'esc_url_raw'
		        )
		    );    
		    $wp_customize->add_control(
		        $icon_key,
	            array(
		            'type' => 'text',
		            'label' => $icon_name,
		            'section' => 'social_icons_section',
		            'priority' => $count
	            )
		    );
		    $count++;
	    }

	}// close function
endif;