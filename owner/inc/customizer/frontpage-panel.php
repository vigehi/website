<?php
/**
 * Theme Customizer for FrontPage Settings Panel.
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

add_action( 'customize_register', 'owner_frontpage_panel_register' );

if( ! function_exists( 'owner_frontpage_panel_register' ) ):
	function owner_frontpage_panel_register( $wp_customize ) {

		/**
		 * Frontpage Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'owner_frontpage_settings_panel', 
        	array(
        		'priority'       => 15,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'FrontPage Settings', 'owner' ),
            )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
	    /**
	     * Slider section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_section(
	        'owner_slider_section',
	        array(
	            'title'     => __( 'Slider Settings', 'owner' ),
	            'panel'     => 'owner_frontpage_settings_panel',
	            'priority'  => 5
	        )
	    );

	    /** 
	     * Slider Category
	     * 
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'owner_slider_category',
	        array(
	            'default' => '0',
	            'capability' => 'edit_theme_options',
	            'sanitize_callback' => 'absint'
	        )
	    );
	    $wp_customize->add_control( new Owner_Customize_Category_Control(
	        $wp_customize,
	        'owner_slider_category', 
	        array(
	            'label' 		=> __( 'Slider Category', 'owner' ),
	            'description' 	=> __( 'Select category slider for only in homepage.', 'owner' ),
	            'section' 		=> 'owner_slider_section',
	            'priority' 		=> 5
	            )
	        )
	    );
	}
endif;