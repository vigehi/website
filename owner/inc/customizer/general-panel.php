<?php
/**
 * Theme Customizer for General Settings Panel.
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

add_action( 'customize_register', 'owner_general_panel_register' );

if( ! function_exists( 'owner_general_panel_register' ) ):
	function owner_general_panel_register( $wp_customize ) {

		$wp_customize->get_section( 'title_tagline' )->panel 		= 'owner_general_settings_panel';
	    $wp_customize->get_section( 'title_tagline' )->priority 	= 5;
	    $wp_customize->get_section( 'title_tagline' )->title 		= esc_html__( 'Site Logo/Title/Favicon', 'owner' );
	    $wp_customize->get_section( 'colors' )->panel 				= 'owner_general_settings_panel';
	    $wp_customize->get_section( 'colors' )->priority 			= 10;
	    $wp_customize->get_section( 'background_image' )->panel 	= 'owner_general_settings_panel';
	    $wp_customize->get_section( 'background_image' )->priority 	= 15;
	    $wp_customize->get_section( 'static_front_page' )->panel 	= 'owner_general_settings_panel';
	    $wp_customize->get_section( 'static_front_page' )->priority = 20;


    	/**
		 * General Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'owner_general_settings_panel', 
        	array(
        		'priority'       => 5,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'General Settings', 'owner' ),
            )
	    );

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Website Layout
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'website_layout_section',
	        array(
	            'title'		=> esc_html__( 'Website Layout', 'owner' ),
	            'panel'     => 'owner_general_settings_panel',
	            'priority'  => 35,
	        )
	    );

		/**
		 * Select options for website layout option
		 *
		 * @since 1.0.0
		 */
	    $wp_customize->add_setting(
	        'site_layout_option',
	        array(
	            'default'           => 'wide_layout',
	            'sanitize_callback' => 'owner_sanitize_site_layout',
	        )       
	    );
	    $wp_customize->add_control(
	        'site_layout_option',
	        array(
	            'type' 			=> 'select',
	            'priority'    	=> 5,
	            'label' 		=> __( 'Site Layout', 'owner' ),
	            'description' 	=> esc_html__( 'Select the website layout.', 'owner' ),
	            'section' 		=> 'website_layout_section',
	            'choices' 		=> array(
	                'wide_layout' 	=> __( 'Wide Layout', 'owner' ),
	                'boxed_layout' 	=> __( 'Boxed Layout', 'owner' )
	            ),
	        )
	    );
	    
/*------------------------------------------------------------------------------------------*/
	    /**
	     * Theme Color
	     * Field for Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'owner_theme_skin_color',
	        array(
	            'default'           => '#f9ab03',
	            'sanitize_callback' => 'sanitize_hex_color',
	        )
	    );
	    $wp_customize->add_control( new owner_Customize_Control_Radio_Image(
	        $wp_customize,
	        'owner_theme_skin_color',
	            array(
	                'label'    		=> esc_html__( 'Theme Skin Color', 'owner' ),
	                'description' 	=> esc_html__( 'Choose website skin color from available options.', 'owner' ),
	                'section'  		=> 'colors',
	                'choices'  		=> array(
		                    '#f9ab03' => array(
		                        'label' => esc_html__( 'Skin 1', 'owner' ),
		                        'url'   => '%s/assets/images/skin_color_1.jpg'
		                    ),
		                    '#f82510' => array(
		                        'label' => esc_html__( 'Skin 2', 'owner' ),
		                        'url'   => '%s/assets/images/skin_color_2.jpg'
		                    ),
		                    '#105cf8' => array(
		                        'label' => esc_html__( 'Skin 3', 'owner' ),
		                        'url'   => '%s/assets/images/skin_color_3.jpg'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

	    /**
	     * Title Color
	     *
	     * @since 1.0.0
	     */

	    $wp_customize->add_setting(
	        'owner_title_color',
	        array(
	            'default'     	=> '#F9AB03',
	            'transport' 	=> 'postMessage',
	            'sanitize_callback' => 'sanitize_hex_color',
	        )
	    );
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control(
	            $wp_customize,
	            'owner_title_color',
	            array(
	                'label'      => __( 'Header Text Color', 'owner' ),
	                'section'    => 'colors',
	                'priority' 	 => 5
	            )
	        )
	    );

/*------------------------------------------------------------------------------------------*/
	    /**
	     * Title and tagline checkbox
	     *
	     * @since 1.0.5
	     */
	    $wp_customize->add_setting( 
            'owner_title_option', 
            array(
                'default' 		=> true,
                'sanitize_callback' => 'owner_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( 
            'owner_title_option', 
            array(
                'label' 	=> esc_html__( 'Display Site Title and Tagline', 'owner' ),
                'section' 	=> 'title_tagline',
                'type' 		=> 'checkbox'
            )
        );

	}
endif;