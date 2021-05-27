<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function owner_body_classes( $classes ) {

    wp_reset_postdata();
    
    global $post;

    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of boxed-layout for whole site
    $owner_site_layout = get_theme_mod( 'site_layout_option', 'wide_layout' );
    if( $owner_site_layout == 'boxed_layout' ) {
        $classes[] = 'boxed-layout';
    }

    //Adds a archive layout class
    $owner_archive_layout = get_theme_mod( 'owner_archive_layout', 'classic' );
    if( is_archive() || is_home() ) {
        $classes[] = $owner_archive_layout.'-archive-layout';
    }

    /**
     * Sidebar option for post/page/archive
     */
    if( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_post_sidebar', true );
    }

    if( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_page_sidebar', true );
    }
     
    if( is_home() ) {
        $home_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $home_id, 'single_page_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    $archive_sidebar = get_theme_mod( 'owner_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar = get_theme_mod( 'owner_default_post_sidebar', 'right_sidebar' );
    $page_default_sidebar = get_theme_mod( 'owner_default_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $post_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $post_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( is_page() && !is_page_template( 'templates/template-home.php' ) ) {
            if( $page_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $page_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( $archive_sidebar == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif( $archive_sidebar == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar' ) {
            $classes[] = 'no-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar_center' ) {
            $classes[] = 'no-sidebar-center';
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar' ) {
        $classes[] = 'no-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar_center' ) {
        $classes[] = 'no-sidebar-center';
    }

    return $classes;
}
add_filter( 'body_class', 'owner_body_classes' );

/**
 * Dynamic theme color option
 *
 * @since 1.0.0
 */
if( ! function_exists( 'owner_dynamic_styles' ) ):
    
    function owner_dynamic_styles() {

        $owner_theme_skin_color = get_theme_mod( 'owner_theme_skin_color', '#F9AB03' );
        $owner_title_option     = get_theme_mod( 'owner_title_option', true );
        $owner_title_color      = get_theme_mod( 'owner_title_color', '#F9AB03' );
        
        $output_css = '';
        $output_css .=" a,a:hover,a:focus,a:active,.entry-footer a:hover,.comment-author .fn .url:hover,.commentmetadata .comment-edit-link,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.social-icons-holder a:hover,#site-navigation ul li.current-menu-item > a, #site-navigation ul li:hover > a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.owner_grid_layout .post-title a:hover,.team-title-wrapper .post-title a:hover,.testimonial-content::before,.owner_testimonials .client-name ,.latest-posts-wrapper .byline a:hover, .latest-posts-wrapper .posted-on a:hover,.latest-posts-wrapper .news-title a:hover,.entry-title a:hover,.post-readmore a:hover,.site-info a:hover,.grid-archive-layout .entry-title a:hover,.entry-meta span a:hover {
                color:". esc_attr( $owner_theme_skin_color ) .";
            }\n";
            
        $output_css .=".navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.edit-link .post-edit-link,.reply .comment-reply-link,.header-search-wrapper .search-main:hover,.header-search-wrapper .search-submit ,.mt-slider-btn-wrap .slider-btn:hover,.owner-slider-wrapper .lSAction > a:hover,.widget_search .search-submit,.widget_search .search-submit,.cta-btn-wrap a:hover,.owner_portfolio .single-post-wrapper .portfolio-title-wrapper .portfolio-link,.team-wrapper .team-desc,.owner_testimonials  .lSSlideOuter .lSPager.lSpg > li:hover a,.owner_testimonials  .lSSlideOuter .lSPager.lSpg > li.active a,#mt-scrollup,.error404 .page-title{
                background:". esc_attr( $owner_theme_skin_color ) .";
            }\n";
            
        $output_css .=".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.header-search-wrapper .search-main:hover,.mt-slider-btn-wrap .slider-btn:hover,.widget_search .search-submit,.cta-btn-wrap a:hover{
                border-color:". esc_attr( $owner_theme_skin_color ) .";
            }\n";
            
        $output_css .=".comment-list .comment-body{
                border-top-color:". esc_attr( $owner_theme_skin_color ) .";
            }\n";
            
        $output_css .=".owner-slider-wrapper .slide-title::after, .owner-slider-wrapper .slide-title::before,.widget .widget-title,.widget .owner-widget-wrapper .widget-title{
                border-left-color:". esc_attr( $owner_theme_skin_color ) .";
            }\n";
            
        $output_css .=".widget .owner-widget-wrapper .widget-title{
                border-right-color:". esc_attr( $owner_theme_skin_color ) .";
            }\n";

        if ( $owner_title_option === true ) {
            $output_css .=".site-title a, .site-description {
                color:". esc_attr( $owner_title_color ) .";
            }\n";
        } else {
            $output_css .=".site-title, .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }\n";
        }

        $refine_output_css = owner_css_strip_whitespace( $output_css );

        wp_add_inline_style( 'owner-style', $refine_output_css );
    }

endif;
add_action( 'wp_enqueue_scripts', 'owner_dynamic_styles' );