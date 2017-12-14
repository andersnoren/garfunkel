<div class="post-container">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php if ( $pos = strpos( $post->post_content, '<!--more-->' ) ) : ?>

			<div class="featured-media">
			
				<?php
						
				// Fetch post content
				$content = get_post_field( 'post_content', get_the_ID() );
				
				// Get content parts
				$content_parts = get_extended( $content );
				
				// oEmbed part before <!--more--> tag
				$embed_code = wp_oembed_get($content_parts['main']); 
				
				echo $embed_code;
				
				?>
			
			</div><!-- .featured-media -->
		
		<?php endif; ?>
		
		<?php if ( is_sticky() ) : ?>
				
			<div class="is-sticky">
				<div class="genericon genericon-pinned"></div>
			</div>
		
		<?php endif; ?>
		
		<div class="post-inner">
		
			<?php if ( get_the_title() ) : ?>
		
				<div class="post-header">
					
				    <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				    	    
				</div><!-- .post-header -->
			
			<?php endif; 
			
			if ( $pos = strpos( $post->post_content, '<!--more-->' ) ) {
				echo '<p class="post-excerpt">' . mb_strimwidth( $content_parts['extended'], 0, 200, '...' ) . '</p>';
			} else {
				the_excerpt();
			}
			
			garfunkel_meta(); ?>
		
		</div><!-- .post-inner -->
	
	</div>

</div>