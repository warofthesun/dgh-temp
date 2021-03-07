<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<!-- content page -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_front_page() ) : ?>
		<header class="entry-header alignwide">
			<?php get_template_part( 'template-parts/header/entry-header' ); ?>
			<?php twenty_twenty_one_post_thumbnail(); ?>
		</header>
	<?php elseif ( has_post_thumbnail() ) : ?>
		<header class="entry-header alignwide">
			<?php twenty_twenty_one_post_thumbnail(); ?>
		</header>
	<?php endif; ?>

	<div class="entry-content">
		
		<?php
		the_content();
		
		if( have_rows('link_list') ): ?>
		<ul class="links-list">
			<?php	// Loop through rows.
				while( have_rows('link_list') ) : the_row(); ?>
		<?php 
		$link = get_sub_field('album_link');
		if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
					<li>
						<div class="cover-art">
							<?php 
							$image = get_sub_field('cover_art');
							$size = 'large'; // (or thumbnail, or medium, or custom, the Image ID sizes are your oyster)
							
								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								}
							?>
						</div>
						<div class="album-details">
							<div>
								
										<h6><?php the_sub_field('album_artists'); ?></h6>
										<h2><?php echo esc_html( $link_title ); ?></h2>
								
							</div>
						</div>
					</li>
					</a>
		<?php endif; ?>
				<?php  endwhile; ?>
		</ul>
				
		<?php endif; ?>
<?php
		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
				'after'    => '</nav>',
				/* translators: %: page number. */
				'pagelink' => esc_html__( 'Page %', 'twentytwentyone' ),
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer default-max-width">
			<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					esc_html__( 'Edit %s', 'twentytwentyone' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
