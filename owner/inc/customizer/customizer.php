<?php
/**
 * Owner Theme Customizer.
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
function owner_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 
        'blogname', 
        array(
            'selector' => '.site-title a',
            'render_callback' => 'owner_customize_partial_blogname',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blogdescription', 
        array(
            'selector' => '.site-description',
            'render_callback' => 'owner_customize_partial_blogdescription',
        )
    );

    /**
     * Register custom section types.
     *
     * @since 1.1.2
     */
    $wp_customize->register_section_type( 'Owner_Customize_Section_Upsell' );

    /**
     * Register theme upsell sections.
     *
     * @since 1.1.2
     */
    $wp_customize->add_section( new Owner_Customize_Section_Upsell(
        $wp_customize,
            'theme_upsell',
            array(
                'title'    => esc_html__( 'Owner Pro', 'owner' ),
                'pro_text' => esc_html__( 'Buy Pro', 'owner' ),
                'pro_url'  => 'https://mysterythemes.com/wp-themes/owner-pro/',
                'priority'  => 1,
            )
        )
    );

}
add_action( 'customize_register', 'owner_customize_register' );

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function owner_customize_preview_js() {
	wp_enqueue_script( 'owner_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'owner_customize_preview_js' );

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 */
function owner_customize_backend_scripts() {
    global $owner_version;

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
    
    wp_enqueue_style( 'owner_admin_customizer_style', get_template_directory_uri() . '/assets/css/customizer-style.css', array(), esc_attr( $owner_version ) );
    
    wp_enqueue_script( 'owner_admin_customizer', get_template_directory_uri() . '/assets/js/customizer-control.js', array( 'jquery', 'customize-controls' ), '20160918', true );
}
add_action( 'customize_controls_enqueue_scripts', 'owner_customize_backend_scripts', 10 );

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Load section files
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/general-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/header-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/frontpage-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/design-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/additional-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/footer-panel.php' );
