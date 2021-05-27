<?php
/**
 * Add or expand custom function related to the owner theme.
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

/*============================================================================================================*/
/**
 * Enqueue Scripts and styles for admin
 *
 * @since 1.0.0
 */
function owner_admin_scripts_style( $hook ) {

    if( 'widgets.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

    wp_enqueue_script( 'jquery-ui-button' );

    wp_enqueue_script( 'owner-admin-script', get_template_directory_uri() .'/assets/js/admin-scripts.js', array('jquery'), '1.0.0', true );

    wp_enqueue_style( 'owner-admin-style', get_template_directory_uri() .'/assets/css/admin-styles.css', '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'owner_admin_scripts_style' );

/*============================================================================================================*/
/**
 * Enqueue scripts and styles.
 */
function owner_scripts() {

    global $owner_version;
	
	wp_enqueue_script( 'jquery-lightslider', get_template_directory_uri() . '/assets/library/lightslider/js/lightslider.min.js', array('jquery'), '20170605', true );

    $header_sticky_option = get_theme_mod( 'header_sticky_option', 'show' );
    if( $header_sticky_option != 'hide' ) {
        wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() .'/assets/library/sticky/jquery.sticky.js', array( 'jquery' ), '1.0.2', true );
        wp_enqueue_script( 'owner-sticky-setting', get_template_directory_uri() .'/assets/library/sticky/sticky-setting.js', array( 'jquery-sticky' ), esc_attr( $owner_version ), true );
    }

	wp_enqueue_script( 'owner-custom-script', get_template_directory_uri(). '/assets/js/custom-script.js', array( 'jquery' ), esc_attr( $owner_version ) );

    wp_enqueue_script( 'owner-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20191111', true );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );

	$owner_font_args = array(
        'family' => 'Montserrat:400,700',
    ); 
    wp_enqueue_style( 'google-font', add_query_arg( $owner_font_args, "//fonts.googleapis.com/css" ) );

    wp_enqueue_style( 'lightslider-style', get_template_directory_uri() .'/assets/library/lightslider/css/lightslider.min.css', array(), '1.1.5' );

	wp_enqueue_style( 'owner-style', get_stylesheet_uri(), array(), esc_attr( $owner_version ) );

    wp_enqueue_style( 'owner-responsive-style', get_template_directory_uri() .'/assets/css/owner-responsive.css', array(), esc_attr( $owner_version ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'owner_scripts' );

/*==========================================================================================================*/
/**
 * Define categories for dropdown
 *
 * @return array();
 */
if( !function_exists( 'owner_category_dropdown' ) ):
    function owner_category_dropdown() {
        $owner_categories = get_categories( array( 'hide_empty' => 0 ) );
        $owner_category_dropdown['0'] = __( 'Select Category', 'owner' );
        foreach ( $owner_categories as $owner_category ) {
            $owner_category_dropdown[$owner_category->term_id] = $owner_category->cat_name;
        }
        return $owner_category_dropdown;
    }
endif;


/**
 * owner category list
 *
 * @return array();
 */
if( !function_exists( 'owner_categories_lists' ) ):
    function owner_categories_lists() {
        $owner_cat_args = array(
            'type'       => 'post',
            'child_of'   => 0,
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'taxonomy'   => 'category',
        );
        $owner_categories = get_categories( $owner_cat_args );
        $owner_categories_lists = array();
        foreach( $owner_categories as $category ) {
            $owner_categories_lists[$category->term_id] = $category->name;
        }
        return $owner_categories_lists;
    }
endif;


/*===================================================================================================*/
/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if( ! function_exists( 'owner_get_sidebar' ) ):
function owner_get_sidebar() {
    global $post;

    if( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_post_sidebar', true );
    }

    if( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_page_sidebar', true );
    }
     
    if( is_home() ) {
        $set_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $set_id, 'single_page_sidebar', true );
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
                get_sidebar();
            } elseif( $post_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( is_page() ) {
            if( $page_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $page_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( $archive_sidebar == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $archive_sidebar == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        get_sidebar();
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        get_sidebar( 'left' );
    }
}
endif;

/*========================================================================================================*/
/**
 * Owner homepage excerpt
 */
if( ! function_exists( 'owner_get_excerpt' ) ):
function owner_get_excerpt( $content, $limit ) {
    $striped_content = strip_tags( $content );
    $striped_content = strip_shortcodes( $striped_content );
    $limit_content = mb_substr( $striped_content, 0 , $limit );
    if( $limit_content < $content ){
        $limit_content .= "..."; 
    }
    return $limit_content;
}
endif;

/**
 * Function to get excerpt content according to define length
 */
if( ! function_exists( 'owner_archive_excerpt' ) ):
    function owner_archive_excerpt( $content, $limit ) {
        $content = strip_tags( $content );
        $content = strip_shortcodes( $content );
        $words = explode( ' ', $content );    
        return implode( ' ', array_slice( $words, 0, $limit ) );
    }
endif;

/*========================================================================================================*/
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function owner_css_strip_whitespace( $css ){
    $replace = array(
        "#/\*.*?\*/#s" => "",  // Strip C style comments.
        "#\s\s+#"      => " ", // Strip excess whitespace.
    );
    $search = array_keys( $replace );
    $css = preg_replace( $search, $replace, $css );

    $replace = array(
        ": "  => ":",
        "; "  => ";",
        " {"  => "{",
        " }"  => "}",
        ", "  => ",",
        "{ "  => "{",
        ";}"  => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} "  => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css = str_replace( $search, $replace, $css );

    return trim( $css );
}