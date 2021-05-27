<?php
/**
 * Owner Theme Customizer panel for header.
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

add_action( 'customize_register', 'owner_header_panel_register' );

if( ! function_exists( 'owner_header_panel_register' ) ):
	function owner_header_panel_register( $wp_customize ) {

		/**
		 * Header Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'owner_header_settings_panel', 
        	array(
        		'priority'       => 10,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'Header Settings', 'owner' ),
            )
	    );

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Top Header Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'top_header_section',
	        array(
	            'title'		=> esc_html__( 'Top Header Settings', 'owner' ),
	            'panel'     => 'owner_header_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Switch option for Top Header Section
	     *
	     * @since 1.1.3
	     */
	    $wp_customize->add_setting(
	        'top_header_option',
	        array(
	            'default' => 'show',
	            'sanitize_callback' => 'owner_sanitize_switch_option',
	        )
	    );
	    $wp_customize->add_control( new Owner_Customize_Switch_Control(
	        $wp_customize, 
	            'top_header_option', 
	            array(
	                'type' 			=> 'switch',
	                'label' 		=> esc_html__( 'Top Header Option', 'owner' ),
	                'description' 	=> esc_html__( 'Show/hide option for top header section.', 'owner' ),
	                'section' 		=> 'top_header_section',
	                'priority'  	=> 5,
	                'choices'   	=> array(
	                    'show' 		=> esc_html__( 'Show', 'owner' ),
	                    'hide' 		=> esc_html__( 'Hide', 'owner' )
	                )
	            )
	        )
	    );

	    /**
	     * Field for Address
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'header_address', 
            array(
                'default' 			=> '',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
	       	)
	    );
	    $wp_customize->add_control(
	        'header_address',
            array(
	            'type' 		=> 'text',
	            'label' 	=> esc_html__( 'Header Address', 'owner' ),
	            'section' 	=> 'top_header_section',
	            'priority' 	=> 10
            )
	    );

	    /**
	     * Field for email
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'header_email', 
            array(
                'default' 	=> '',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
	       	)
	    );
	    $wp_customize->add_control(
	        'header_email',
            array(
	            'type' 		=> 'text',
	            'label' 	=> esc_html__( 'Header E-mail', 'owner' ),
	            'section' 	=> 'top_header_section',
	            'priority' 	=> 15
            )
	    );

	    /**
	     * Field for phone
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'header_phone', 
            array(
                'default' 		=> '',
                'transport' 	=> 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
	       	)
	    );
	    $wp_customize->add_control(
	        'header_phone',
            array(
	            'type' 		=> 'text',
	            'label' 	=> esc_html__( 'Header Phone', 'owner' ),
	            'section' 	=> 'top_header_section',
	            'priority' 	=> 20
            )
	    );

	    /**
	     * Switch option for Top Header social icon section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'top_social_option',
	        array(
	            'default' 		=> 'show',
	            'sanitize_callback' => 'owner_sanitize_switch_option',
	        )
	    );
	    $wp_customize->add_control( new Owner_Customize_Switch_Control(
	        $wp_customize, 
	            'top_social_option', 
	            array(
	                'type' 			=> 'switch',
	                'label' 		=> esc_html__( 'Top Social Icons', 'owner' ),
	                'description' 	=> esc_html__( 'Show/hide option for Social Icons at top.', 'owner' ),
	                'section' 		=> 'top_header_section',
	                'priority'  	=> 25,
	                'choices'   	=> array(
	                    'show' 	=> esc_html__( 'Show', 'owner' ),
	                    'hide' 	=> esc_html__( 'Hide', 'owner' )
	                )
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Additional Header settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'additional_header_section',
	        array(
	            'title'		=> esc_html__( 'Additional Header Settings', 'owner' ),
	            'panel'     => 'owner_header_settings_panel',
	            'priority'  => 10,
	        )
	    );

	    /**
	     * Switch option for sticky menu
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'header_sticky_option',
	        array(
	            'default' => 'show',
	            'sanitize_callback' => 'owner_sanitize_switch_option',
	        )
	    );
	    $wp_customize->add_control( new Owner_Customize_Switch_Control(
	        $wp_customize, 
	            'header_sticky_option', 
	            array(
	                'type' 			=> 'switch',
	                'label' 		=> esc_html__( 'Header Sticky', 'owner' ),
	                'description' 	=> esc_html__( 'Enable/Disable header sticky option.', 'owner' ),
	                'section' 		=> 'additional_header_section',
	                'priority'  	=> 5,
	                'choices'   	=> array(
	                    'show' 	=> esc_html__( 'Enable', 'owner' ),
	                    'hide' 	=> esc_html__( 'Disable', 'owner' )
	                )
	            )
	        )
	    );

	    /**
	     * Switch option for search icon at primary section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'menu_search_option',
	        array(
	            'default' => 'show',
	            'sanitize_callback' => 'owner_sanitize_switch_option',
	        )
	    );
	    $wp_customize->add_control( new Owner_Customize_Switch_Control(
	        $wp_customize, 
	            'menu_search_option', 
	            array(
	                'type' 			=> 'switch',
	                'label' 		=> esc_html__( 'Search Icon', 'owner' ),
	                'description' 	=> esc_html__( 'show/hide search icon at primary menu section.', 'owner' ),
	                'section' 		=> 'additional_header_section',
	                'priority'  	=> 10,
	                'choices'   	=> array(
	                    'show' 	=> esc_html__( 'Show', 'owner' ),
	                    'hide' 	=> esc_html__( 'Hide', 'owner' )
	                )
	            )
	        )
	    );

	}
endif;