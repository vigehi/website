<?php
/**
 * A child theme for Owner
 *
 * @package Mystery Themes
 * @subpackage Architect Lite
 * @since 1.0.0
 */

/*-------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'architect_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function architect_lite_setup() {

    $architect_lite_theme_info = wp_get_theme();
    $GLOBALS['architect_lite_version'] = $architect_lite_theme_info->get( 'Version' );
}
endif;

add_action( 'after_setup_theme', 'architect_lite_setup' );

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for Editorial News.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'architect_lite_fonts_url' ) ) :
    function architect_lite_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'architect-lite' ) ) {
            $font_families[] = 'Roboto:300,400,400i,500,700';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue child theme styles and scripts
 *
 * @since 1.0.0
 */
add_action( 'wp_enqueue_scripts', 'architect_lite_scripts', 20 );

function architect_lite_scripts() {

    global $architect_lite_version;

	wp_dequeue_style( 'google-font' );

	wp_enqueue_style( 'architect-lite-google-font', architect_lite_fonts_url(), array(), null );

	wp_dequeue_style( 'owner-style' );

    wp_dequeue_style( 'owner-responsive-style' );

    wp_enqueue_style( 'owner-parent-style', get_template_directory_uri() . '/style.css', array(), esc_attr( $architect_lite_version ) );

    wp_enqueue_style( 'owner-parent-responsive', get_template_directory_uri() . '/assets/css/owner-responsive.css', array(), esc_attr( $architect_lite_version ) );

	wp_enqueue_style( 'architect-lite-style', get_stylesheet_uri(), array(), esc_attr( $architect_lite_version ) );

    $architect_lite_theme_skin_color = esc_attr( get_theme_mod( 'owner_theme_skin_color', '#f9ab03' ) );
    $architect_lite_title_option     = get_theme_mod( 'owner_title_option', true );
    $architect_lite_title_color      = get_theme_mod( 'owner_title_color', '#F9AB03' );

    $output_css = '';

    $output_css .=" a,a:hover,a:focus,a:active,.entry-footer a:hover,.comment-author .fn .url:hover,.commentmetadata .comment-edit-link,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.social-icons-holder a:hover,#site-navigation ul li.current-menu-item > a, #site-navigation ul li:hover > a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.owner_grid_layout .post-title a:hover,.team-title-wrapper .post-title a:hover,.testimonial-content::before,.owner_testimonials .client-name ,.latest-posts-wrapper .byline a:hover, .latest-posts-wrapper .posted-on a:hover,.latest-posts-wrapper .news-title a:hover,.entry-title a:hover,.post-readmore a:hover,.site-info a:hover,.grid-archive-layout .entry-title a:hover,#top-footer .widget_archive a:hover, #top-footer .widget_categories a:hover, #top-footer .widget_recent_entries a:hover, #top-footer .widget_meta a:hover, #top-footer .widget_recent_comments li, #top-footer .widget_rss li, #top-footer .widget_pages li a:hover, #top-footer .widget_nav_menu li a:hover, .site-info a:hover,.menu-toggle:hover {
                    color:". esc_attr( $architect_lite_theme_skin_color ) .";
                }\n";
                
    $output_css .=".navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.edit-link .post-edit-link,.reply .comment-reply-link,.header-search-wrapper .search-main:hover,.header-search-wrapper .search-submit ,.mt-slider-btn-wrap .slider-btn:hover,.owner-slider-wrapper .lSAction > a:hover,.widget_search .search-submit,.widget_search .search-submit,.cta-btn-wrap a:hover,.owner_portfolio .single-post-wrapper .portfolio-title-wrapper .portfolio-link,.team-wrapper .team-desc,.owner_testimonials  .lSSlideOuter .lSPager.lSpg > li:hover a,.owner_testimonials  .lSSlideOuter .lSPager.lSpg > li.active a,#mt-scrollup,.error404 .page-title,.top-header-holder,#site-navigation ul li > a::before{
            background:". esc_attr( $architect_lite_theme_skin_color ) .";
        }\n";
        
    $output_css .=".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.header-search-wrapper .search-main:hover,.mt-slider-btn-wrap .slider-btn:hover,.widget_search .search-submit,.cta-btn-wrap a:hover{
            border-color:". esc_attr( $architect_lite_theme_skin_color ) .";
        }\n";
        
    $output_css .=".comment-list .comment-body{
            border-top-color:". esc_attr( $architect_lite_theme_skin_color ) .";
        }\n";
        
    $output_css .=".owner-slider-wrapper .slide-title::after, .owner-slider-wrapper .slide-title::before,.widget .widget-title,.widget .owner-widget-wrapper .widget-title{
            border-left-color:". esc_attr( $architect_lite_theme_skin_color ) .";
        }\n";
        
    $output_css .=".widget .owner-widget-wrapper .widget-title{
            border-right-color:". esc_attr( $architect_lite_theme_skin_color ) .";
        }\n";

    $output_css .=".owner_call_to_action .section-wrapper::before, .owner_testimonials .section-wrapper::before,.owner_portfolio .single-post-wrapper .portfolio-title-wrapper{
            background-color:". esc_attr( architect_lite_get_hex2rgba( $architect_lite_theme_skin_color, '0.8' ) ) .";
        }\n";

    if ( $architect_lite_title_option === true ) {
        $output_css .=".site-title a, .site-description {
            color:". esc_attr( $architect_lite_title_color ) .";
        }\n";
    } else {
        $output_css .=".site-title, .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }\n";
    }

    wp_add_inline_style( 'architect-lite-style', $output_css );
}

/*------------------------------------------------------------------------------------------------------------------------*/
/**
 * Get rgba color from hex
 *
 * @since 1.0.0
 */
function architect_lite_get_hex2rgba( $color, $opacity ) {
    if ( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    $rgb =  array_map( 'hexdec', $hex );
    $output = 'rgba( '.implode( ",", $rgb ).','.$opacity.' )';
    return $output;
}

/*-------------------------------------------------------------------------------------------------------------------*/
/**
 * Define pages for dropdown
 *
 * @return array();
 */
if( !function_exists( 'owner_pages_dropdown' ) ):
    function owner_pages_dropdown() {
        $owner_pages = get_pages();
        $owner_pages_dropdown['0'] = __( 'Select Pages', 'architect-lite' );
        foreach ( $owner_pages as $owner_page ) {
            $owner_pages_dropdown[$owner_page->ID] = $owner_page->post_title;
        }
        return $owner_pages_dropdown;
    }
endif;

/*---------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed widgets
 *
 * @since 1.0.0
 */
require get_stylesheet_directory() . '/widgets/architect-about-us.php';