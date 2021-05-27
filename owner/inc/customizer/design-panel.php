<?php
/**
 * Owner Theme Customizer panel for Design Layout.
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

add_action( 'customize_register', 'owner_design_panel_register' );

if( ! function_exists( 'owner_design_panel_register' ) ):
	function owner_design_panel_register( $wp_customize ) {

		// Register the radio image control class as a JS control type.
    	$wp_customize->register_control_type( 'Owner_Customize_Control_Radio_Image' );

		/**
		 * Design Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'owner_design_settings_panel', 
        	array(
        		'priority'       => 20,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'Design Settings', 'owner' ),
            )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Archive Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'archive_settings_section',
	        array(
	            'title'		=> esc_html__( 'Archive Settings', 'owner' ),
	            'panel'     => 'owner_design_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Field for Archive Sidebar images
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'owner_archive_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );
	    $wp_customize->add_control( new Owner_Customize_Control_Radio_Image(
	        $wp_customize,
	        'owner_archive_sidebar',
	            array(
	                'label'    => esc_html__( 'Archive Sidebars', 'owner' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'owner' ),
	                'section'  => 'archive_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'owner' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

	    /**
	     * Radio button for archive layouts
	     *
	     * @since 1.0.0
	     */
		$wp_customize->add_setting(
	        'owner_archive_layout',
	        array(
	            'default'           => 'classic',
	            'sanitize_callback' => 'owner_sanitize_archive_layout_option',
	        )
	    );
	    $wp_customize->add_control(
	        'owner_archive_layout',
	        array(
	            'type' 			=> 'radio',
	            'priority'    	=> 10,
	            'label' 		=> __( 'Archive Layout', 'owner' ),
	            'description' 	=> esc_html__( 'Choose layout from available layouts.', 'owner' ),
	            'section' 		=> 'archive_settings_section',
	            'choices' => array(
	                'classic' => __( 'Classic Layout', 'owner' ),
	                'grid' => __( 'Grid Layout', 'owner' )
	            ),
	        )
	    );

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Page Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'page_settings_section',
	        array(
	            'title'		=> esc_html__( 'Page Settings', 'owner' ),
	            'panel'     => 'owner_design_settings_panel',
	            'priority'  => 10,
	        )
	    );

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'owner_default_page_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new Owner_Customize_Control_Radio_Image(
	        $wp_customize,
	        'owner_default_page_sidebar',
	            array(
	                'label'    => esc_html__( 'Page Sidebars', 'owner' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'owner' ),
	                'section'  => 'page_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'owner' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Post Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'post_settings_section',
	        array(
	            'title'		=> esc_html__( 'Post Settings', 'owner' ),
	            'panel'     => 'owner_design_settings_panel',
	            'priority'  => 15,
	        )
	    );

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'owner_default_post_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new Owner_Customize_Control_Radio_Image(
	        $wp_customize,
	        'owner_default_post_sidebar',
	            array(
	                'label'    => esc_html__( 'Post Sidebars', 'owner' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'owner' ),
	                'section'  => 'post_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'owner' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'owner' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

	}// close function
endif;