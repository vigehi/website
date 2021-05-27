<?php
/**
 * Owner Theme Customizer panel for Footer Settings.
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

add_action( 'customize_register', 'owner_footer_panel_register' );

if( ! function_exists( 'owner_footer_panel_register' ) ):
	function owner_footer_panel_register( $wp_customize ) {

		/**
		 * Footer Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'owner_footer_settings_panel', 
        	array(
        		'priority'       => 30,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'Footer Settings', 'owner' ),
            )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Footer Widget Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'footer_widget_section',
	        array(
	            'title'		=> esc_html__( 'Footer Widget Settings', 'owner' ),
	            'panel'     => 'owner_footer_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Switch option for footer widget area
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'footer_widget_option',
	        array(
            	'default' => 'show',
            	'sanitize_callback' => 'owner_sanitize_switch_option',
            )
	    );
	    $wp_customize->add_control( new Owner_Customize_Switch_Control(
	        $wp_customize, 
	            'footer_widget_option', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Footer Widget Option', 'owner' ),
	                'description' 	=> esc_html__( 'Show/hide option for widget area located in footer section.', 'owner' ),
	                'section' 	=> 'footer_widget_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'owner' ),
	                    'hide' 	=> esc_html__( 'Hide', 'owner' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    /**
	     * Field for Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'footer_widget_layout',
	        array(
	            'default'           => 'column_three',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );
	    $wp_customize->add_control( new owner_Customize_Control_Radio_Image(
	        $wp_customize,
	        'footer_widget_layout',
	            array(
	                'label'    => esc_html__( 'Footer Widget Layout', 'owner' ),
	                'description' => esc_html__( 'Choose layout from available layouts', 'owner' ),
	                'section'  => 'footer_widget_section',
	                'choices'  => array(
		                    'column_four' => array(
		                        'label' => esc_html__( 'Columns Four', 'owner' ),
		                        'url'   => '%s/assets/images/footer-4.png'
		                    ),
		                    'column_three' => array(
		                        'label' => esc_html__( 'Columns Three', 'owner' ),
		                        'url'   => '%s/assets/images/footer-3.png'
		                    ),
		                    'column_two' => array(
		                        'label' => esc_html__( 'Columns Two', 'owner' ),
		                        'url'   => '%s/assets/images/footer-2.png'
		                    ),
		                    'column_one' => array(
		                        'label' => esc_html__( 'Column One', 'owner' ),
		                        'url'   => '%s/assets/images/footer-1.png'
		                    )
		            ),
		            'priority' => 10
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		
		/**
		 * Footer Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'bottom_footer_section',
	        array(
	            'title'		=> esc_html__( 'Bottom Footer Settings', 'owner' ),
	            'panel'     => 'owner_footer_settings_panel',
	            'priority'  => 10,
	        )
	    );

	    /**
	     * Field for Archive read more button text
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'owner_copyright_text', 
            array(
                'default' => esc_html__( 'Owner', 'owner' ),
                'sanitize_callback' => 'wp_kses_post',
                'transport' => 'postMessage'
	       	)
	    );
	    $wp_customize->add_control(
	        'owner_copyright_text',
            array(
	            'type' => 'textarea',
	            'label' => esc_html__( 'Copyright Text', 'owner' ),
	            'section' => 'bottom_footer_section',
	            'priority' => 5
            )
	    );

	}// cose function
endif;