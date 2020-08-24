<div class="post-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php

		$post_format = get_post_format() ? get_post_format() : 'standard';

		// Get the part before the <!--more--> tag in the post content
		$has_more = strpos( $post->post_content, '<!--more-->' );
		if ( $has_more ) {
			$content = get_post_field( 'post_content', get_the_ID() );
			$content_parts = get_extended( $content );
			$main_content = $content_parts['main'];
		}

		if ( $post_format == 'link' && $has_more ) : ?>

			<div class="post-link">
				<?php echo $main_content; ?>
			</div><!-- .post-link -->

		<?php elseif ( $post_format == 'quote' && $has_more ) : ?>

			<div class="post-quote">
				<?php echo $main_content; ?>
			</div><!-- .post-quote -->

		<?php elseif ( $post_format == 'video' && $has_more ) : ?>

			<figure class="featured_media">
				<?php echo wp_oembed_get( $main_content ); ?>
			</figure><!-- .featured-media -->

		<?php elseif ( $post_format == 'gallery' ) : ?>

			<figure class="featured-media">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php
					$images = get_posts( array(
						'numberposts'    => 1,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'post_parent'    => get_the_ID(),
						'post_type'      => 'attachment',
						'post_status'    => null,
						'post_mime_type' => 'image',
					) );
				
					if ( $images ) :
						foreach ( $images as $image ) :
							echo wp_get_attachment_image( $image->ID, 'post-thumbnail' );
						endforeach;
					endif;
					?>
				</a>
			</figure><!-- .featured-media -->

			<?php
		elseif ( in_array( $post_format, array( 'image', 'standard' ) ) && has_post_thumbnail() ) : 
			?>
		
			<figure class="featured-media">

				<?php if ( $post_format == 'image' && is_sticky() ) : ?>
					<span class="sticky-post"><?php _e( 'Sticky post', 'garfunkel' ); ?></span>
				<?php endif; ?>

				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail(); ?>
				</a>

			</figure><!-- .featured-media -->
				
			<?php 
		endif;
		
		if ( is_sticky() ) : ?>
				
			<div class="is-sticky">
				<div class="genericon genericon-pinned"></div>
			</div>
		
		<?php endif; ?>
		
		<div class="post-inner">
		
			<?php 
			if ( $post_format !== 'aside' && get_the_title() ) : 
				?>
		
				<header class="post-header">
				    <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</header><!-- .post-header -->
			
				<?php 
			endif;

			if ( in_array( $post_format, array( 'link', 'quote', 'video' ) ) && $has_more ) {
				echo '<p class="post-excerpt">' . mb_strimwidth( $content_parts['extended'], 0, 200, '...' ) . '</p>';
			} else {
				the_excerpt();
			}
		
			garfunkel_meta();

			?>
		
		</div><!-- .post-inner -->
	
	</article><!-- .post -->

</div><!-- .post-container -->