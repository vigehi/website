<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
	        <div class="single-post-image">
	            <figure>
	            	<?php
	            		$owner_archive_layout = get_theme_mod( 'owner_archive_layout', 'classic' );
	            		if( $owner_archive_layout == 'classic' ) {
	            			the_post_thumbnail( 'owner-blog-large' );
	            		} else {
	            			the_post_thumbnail( 'owner-blog-medium' );
	            		}
	            	?>
	            </figure>
	        </div>
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php owner_posted_on(); ?>
				<?php owner_entry_footer(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'owner' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-## -->
