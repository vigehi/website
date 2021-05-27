<?php
/**
 * Expand some functions related to widgets
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 *
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function owner_widgets_init() {
	
	/**
	 * Register Right Sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'owner' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'owner' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register Left Sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'owner' ),
		'id'            => 'owner_sidebar_left',
		'description'   => esc_html__( 'Add widgets here.', 'owner' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register Homepage Fullwidth area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Section Area', 'owner' ),
		'id'            => 'owner_home_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'owner' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register 4 different Footer Area 
	 *
	 * @since 1.0.0
	 */
	register_sidebars( 4 , array(
		'name'          => esc_html__( 'Footer Area %d', 'owner' ),
		'id'            => 'owner_footer_sidebar',
		'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'owner' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'owner_widgets_init' );


if( ! function_exists( 'owner_register_widgets' ) ) :
	
	/**
	 * function to register custom widgets
	 */
	function owner_register_widgets() {

		// register call to action widget
		register_widget( 'Owner_Call_To_Action' );

		// register grid layout widget
		register_widget( 'Owner_Grid_Layout' );

		// register latest blog widget
		register_widget( 'Owner_Latest_Blog' );

		// register portfolio widget
		register_widget( 'Owner_Portfolio' );

		// register sponsors widget
		register_widget( 'Owner_Sponsors' );

		// register team widget
		register_widget( 'Owner_Team' );

		// register testimonials widget
		register_widget( 'Owner_Testimonials' );



	}

endif;

add_action( 'widgets_init', 'owner_register_widgets' );

/**
 * Load important files for widget and it's related
 */

require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-widget-fields.php' );

require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-grid-layout.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-call-to-action.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-portfolio-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-team-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-testimonials-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-latest-blog-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-sponsors-widget.php' );