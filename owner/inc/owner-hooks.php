<?php
/**
 * File to define the custom hook functions 
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 *
 */
/*========================================================================================================*/
/**
 * function for top header section wrapper start
 */
if( ! function_exists( 'owner_top_header_wrapper_start' ) ):
	function owner_top_header_wrapper_start() {
		echo '<div class="top-header-holder clearfix"> <div class="mt-container">';
	}
endif;

/**
 * function for top header info section
 */
if( ! function_exists( 'owner_top_header_info' ) ):
	function owner_top_header_info() {
		$top_header_address = get_theme_mod( 'header_address', '' );
		$top_header_email = get_theme_mod( 'header_email', '' );
		$top_header_phone = get_theme_mod( 'header_phone', '' );

		echo '<div class="top-left-holder">';
		if( !empty( $top_header_address ) ) {
			echo '<span class="top-address top-info">'. esc_html( $top_header_address ) .'</span>';
		}
		if( !empty( $top_header_email ) ) {
			echo '<span class="top-email top-info">'. antispambot( $top_header_email ).'</span>';
		}
		if( !empty( $top_header_phone ) ) {
			echo '<span class="top-phone top-info">'. esc_html( $top_header_phone ) .'</span>';
		}
		echo '</div><!--. top-left-holder -->';
	}
endif;

/**
 * function for top header social icons
 */
if( !function_exists( 'owner_social_icons' ) ):
	function owner_social_icons() {
		$top_social_option = get_theme_mod( 'top_social_option', 'show' );
		if( $top_social_option == 'hide' ) {
			return;
		}
		$fb_link  = get_theme_mod( 'fb_link', '' );
		$tw_link  = get_theme_mod( 'tw_link', '' );
		$ln_link  = get_theme_mod( 'ln_link', '' );
		$pin_link = get_theme_mod( 'pin_link', '' );
		$gp_link  = get_theme_mod( 'gp_link', '' );
		$yt_link  = get_theme_mod( 'yt_link', '' );

		echo '<div class="social-icons-holder">';
			if( !empty( $fb_link ) ) {
				echo '<a href="'. esc_url( $fb_link ) .'"><span class="mt-social-icon fa fa-facebook"></span></a>';
			}
			if( !empty( $tw_link ) ) {
				echo '<a href="'. esc_url( $tw_link ) .'"><span class="mt-social-icon fa fa-twitter"></span></a>';
			}
			if( !empty( $ln_link ) ) {
				echo '<a href="'. esc_url( $ln_link ) .'"><span class="mt-social-icon fa fa-linkedin"></span></a>';
			}
			if( !empty( $pin_link ) ) {
				echo '<a href="'. esc_url( $pin_link ) .'"><span class="mt-social-icon fa fa-pinterest"></span></a>';
			}
			if( !empty( $gp_link ) ) {
				echo '<a href="'. esc_url( $gp_link ) .'"><span class="mt-social-icon fa fa-google-plus"></span></a>';
			}
			if( !empty( $yt_link ) ) {
				echo '<a href="'. esc_url( $yt_link ) .'"><span class="mt-social-icon fa fa-youtube"></span></a>';
			}
		echo '</div><!-- .social-icons-holder -->';
	}
endif;

/**
 * function for top header section wrapper end
 */
if( ! function_exists( 'owner_top_header_wrapper_end' ) ):
	function owner_top_header_wrapper_end() {
		echo '</div></div><!-- .top-header-holder -->';
	}
endif;

/**
 * managed functions for top header section
 */
$top_header_address = get_theme_mod( 'header_address', '' );
$top_header_email = get_theme_mod( 'header_email', '' );
$top_header_phone = get_theme_mod( 'header_phone', '' );
$fb_link  = get_theme_mod( 'fb_link', '' );
$tw_link  = get_theme_mod( 'tw_link', '' );
$ln_link  = get_theme_mod( 'ln_link', '' );
$pin_link = get_theme_mod( 'pin_link', '' );
$gp_link  = get_theme_mod( 'gp_link', '' );
$yt_link  = get_theme_mod( 'yt_link', '' );
if( !empty( $top_header_address ) || !empty( $top_header_email ) || !empty( $top_header_phone ) || !empty( $fb_link ) || !empty( $tw_link ) || !empty( $ln_link ) || !empty( $pin_link ) || !empty( $gp_link ) || !empty( $yt_link ) ){
	add_action( 'owner_top_header', 'owner_top_header_wrapper_start', 5 );
	add_action( 'owner_top_header', 'owner_top_header_info', 10 );
	add_action( 'owner_top_header', 'owner_social_icons', 15 );
	add_action( 'owner_top_header', 'owner_top_header_wrapper_end', 25 );
}
/*=============================================================================================================*/
/**
 * function for skip link content
 */
if( ! function_exists( 'owner_skip_link' ) ):
	function owner_skip_link() {
		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'owner' ); ?></a>
	<?php
	}
endif;
/**
 * function for header section start
 */
if( ! function_exists( 'owner_header_section_start' ) ):
	function owner_header_section_start() {
		echo '<header id="masthead" class="site-header" role="banner">';
		echo '<div class="logo-ads-wrapper clearfix">';
		echo '<div class="mt-container">';
	}
endif;

/**
 * function for site branding
 */
if( ! function_exists( 'owner_site_branding' ) ):
	function owner_site_branding() {
?>
		<div class="site-branding">
			<?php if ( the_custom_logo() ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div><!-- .site-logo -->
			<?php } ?>
			<?php 
				$site_title_option = get_theme_mod( 'owner_title_option', true );
				if( $site_title_option === true ) {
			?>
				<div class="site-title-wrapper">
					<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif; ?>
				</div><!-- .site-title-wrapper -->
			<?php 
				}
			?>
		</div><!-- .site-branding -->
<?php
	}
endif;

/**
 * function for primary menu
 */
if( ! function_exists( 'owner_primary_menu_section' ) ):
	function owner_primary_menu_section() {
?>
		<div class="menu-search-wrapper">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="menu-toggle hide"> <i class="fa fa-navicon"> </i> </div>
				<?php 
					wp_nav_menu( array( 
						'theme_location' => 'owner_primary_menu',
						'menu_id' => 'primary-menu',
						'menu_class' => 'nav-menu'  
					));
				?>
			</nav><!-- #site-navigation -->

			<?php 
				if( get_theme_mod( 'menu_search_option', 'show' ) == 'show' ) { ?>
				<div class="header-search-wrapper">
	                <span class="search-main"><i class="fa fa-search"></i></span>
	                <div class="search-form-main clearfix">
						<div class="mt-container">
		                	<?php get_search_form(); ?>
		                </div>
		            </div>
	            </div><!-- .header-search-wrapper -->
            <?php } ?>
        </div><!-- .menu-search-wrapper -->
<?php
	}
endif;

/**
 * function for header section end
 */
if( ! function_exists( 'owner_header_section_end' ) ):
	function owner_header_section_end() {
		echo '</div><!-- .mt-container -->';
		echo '</div><!-- .logo-ads-wrapper -->';
		echo '</header><!-- #masthead -->';
	}
endif;

/**
 * managed function for header section
 *
 * @since 1.1.0
 */
add_action( 'owner_header_section', 'owner_header_section_start', 5 );
add_action( 'owner_header_section', 'owner_site_branding', 10 );
add_action( 'owner_header_section', 'owner_primary_menu_section', 15 );
add_action( 'owner_header_section', 'owner_header_section_end', 25 );

/*
/**
 * managed function for skip link content
 *
 * @since 1.1.7
 */
add_action( 'owner_skip_link_section', 'owner_skip_link', 5 );

/*============================================================================================================*/
/**
 * function for slider wrapper start
 */
if( ! function_exists( 'owner_slider_wrapper_start' ) ):
	function owner_slider_wrapper_start() {
		echo '<div class="owner-slider-wrapper">';
	}
endif;

/**
 * function for slider content
 */
if( ! function_exists( 'owner_slider_content' ) ):
	function owner_slider_content() {
		$slider_cat_id = get_theme_mod( 'owner_slider_category', 0 );
		if( empty( $slider_cat_id ) ) {
			return;
		}
		$slider_args = array(
			'post_type' 	=> 'post',
			'category__in'	=> absint( $slider_cat_id )
		);
		$slider_query = new WP_Query( $slider_args );
		if( $slider_query->have_posts() ) {
			echo '<ul class="homepage-slider cS-hidden">';
			while ( $slider_query->have_posts() ) {
				$slider_query->the_post();
				if( has_post_thumbnail() ) {
	?>
					<li>
						<div class="single-slide">
							<div class="slider-overlay"> </div>
							<div class="slide-thumb">
								<?php the_post_thumbnail( 'full' ); ?>
							</div>
							<div class="slider-content-wrapper">
								<div class="mt-container">
									<div class="slider-title-desc-wrap">
										<h2 class="slide-title"><?php the_title(); ?></h2>
										<div class="slide-content"><?php the_content(); ?></div>
									</div><!-- .slider-title-desc-wrap -->
								</div>
							</div><!-- .slider-content-wrapper -->
						</div><!-- .single-slide -->
					</li>
	<?php
				}
			}
			echo '</ul>';
		}
		wp_reset_postdata();
	}
endif;

/**
 * function for slider wrapper end
 */
if( ! function_exists( 'owner_slider_wrapper_end' ) ):
	function owner_slider_wrapper_end() {
		echo '</div><!-- .owner-slider-wrapper -->';
	}
endif;

if( ! function_exists( 'owner_body_open_hook' ) ):
/**
* Triggered after the opening <body> tag.
* 
* @since 1.0.0   
*/
    function owner_body_open_hook() {
        wp_body_open();
    }
endif;

/**
 * managed function for owner body open hook
 */
add_action('body_open_hook','owner_body_open_hook',5); 
/*================================================================================================================*/
/**
 * managed function for slider section
 */
add_action( 'owner_slider_section', 'owner_slider_wrapper_start', 5 );
add_action( 'owner_slider_section', 'owner_slider_content', 10 );
add_action( 'owner_slider_section', 'owner_slider_wrapper_end', 15 );