<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

	if( ! is_page_template( 'templates/template-home.php' ) ) { 
    	echo '</div><!-- .mt-container -->';
	}
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php 
			$footer_widget_option = get_theme_mod( 'footer_widget_option', 'show' );
			if( $footer_widget_option == 'show' ) {
				get_sidebar( 'footer' );
			}
		?>
		<div class="site-info">
			<div class="mt-container">
				<div class="owner-copyright-wrapper">
					<?php $owner_copyright_text = get_theme_mod( 'owner_copyright_text', __( 'Owner', 'owner' ) ); ?>
					<span class="owner-copyright"><?php echo wp_kses_post( $owner_copyright_text ); ?></span>
					<span class="sep"> | </span>
					<?php printf( esc_html__( '%1$s by %2$s.', 'owner' ), 'Owner Theme', '<a href="'. esc_url( 'https://mysterythemes.com/' ).'" rel="designer">Mystery Themes</a>' ); ?>
				</div>
                <nav id="site-footer-navigation" class="footer-navigation" role="navigation">
			         <?php wp_nav_menu( array( 'theme_location' => 'owner_footer_menu', 'menu_id' => 'footer-menu' ) ); ?>
	           </nav><!-- #site-navigation -->
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div id="mt-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>