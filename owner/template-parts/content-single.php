<?php
/**
 * Template part for displaying post content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
        <div class="single-post-image">
            <figure><?php the_post_thumbnail( 'owner-blog-large' ); ?></figure>
        </div>
		<?php if ( 'post' === get_post_type() ) { ?>
			<div class="entry-meta">
				<?php owner_posted_on(); ?>
				<?php owner_entry_footer(); ?>
			</div><!-- .entry-meta -->
		<?php } ?>
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'owner' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'owner' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
