<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MiNNaK
 */

?>
	<div class="content-wrapper">
	
		<div class="article-wrapper">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php	if ( has_post_thumbnail() && ! post_password_required() ) { ?>
						<div class="img-frame">
							<?php minnak_post_thumbnail(); ?>
						</div>
				<?php } ?>	
				<?php	if ( ! has_post_thumbnail() && ! post_password_required() ) { ?>
					<?php if ( has_post_format( 'audio' ) ) { ?>
						<div class="img-frame">
							<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/audio-default-thumbnail.png" alt="Audio Default Thumbnail">
							</a>
						</div>
					<?php } ?>
					<?php if ( has_post_format( 'video' ) ) { ?>
						<div class="img-frame">
							<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/video-default-thumbnail.png" alt="Video Default Thumbnail">
							</a>
						</div>
					<?php } ?>
				<?php } ?>
				<div class="article-content">
					<header class="entry-header">
						<?php
							the_title( '<h1 class="entry-title">', '</h1>' );
							if ( 'post' === get_post_type() ) :
								?>
								<div class="entry-meta">
									
								</div>
								<?php
							
						endif;
							?>
					</header>
					<div class="entry-content">
						<?php
							the_content(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'minnak' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								)
							);
					
						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minnak' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>
					<?php if ( ! is_home() && ! is_archive() && ! is_search() ) : ?>
						<footer class="entry-footer d-flex align-self-center justify-content-between">
							<?php minnak_entry_footer(); ?>
						</footer>
					<?php endif; ?>

					<?php if ( is_single() ) : ?>
						<?php if ( ! empty( get_theme_mod( 'show_author_bio', false ) ) ) { ?>
							<div id="author-info" class="author-info">
								<div class="author-avatar">
									<?php echo get_avatar( get_the_author_meta( 'user_email' ), '80', '' ); ?>
								</div>
								<div class="author-description">
									<p class="author-name"><?php echo '<span>' . esc_html__( 'Author:', 'minnak' ) . ' </span>' . esc_html( get_the_author_meta( 'display_name', $post->post_author ) ); ?></p>
									<p class="author-links">
										<span class="author-url">
											<?php
											if ( ! empty( get_the_author_meta( 'url', $post->post_author ) ) ) :
												echo '<a href=' . esc_url( get_the_author_meta( 'url', $post->post_author ) ) . ' target="_blank" rel="nofollow">' . esc_html__( 'Website', 'minnak' ) . '</a> | ';
											endif;
											?>
										</span>
										<span class="author-posts-link">
											<?php
												echo '<a href=' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) ) . ' rel="nofollow">' . esc_html__( 'All posts', 'minnak' ) . '</a>';
											?>
										</span>
									</p>
									<p class="author-bio"><?php the_author_meta( 'description' ); ?></p>
								</div>
							</div>
						<?php } ?>	
					<?php endif; ?>

				</div>
			</article><!-- #post-<?php the_ID(); ?> -->
		</div>
	</div>
