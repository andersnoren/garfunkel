<div class="post-container">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="post-link">
			
			<?php
				
			// Fetch post content
			$content = get_post_field( 'post_content', get_the_ID() );
			
			// Get content parts
			$content_parts = get_extended( $content );
			
			// Output part before <!--more--> tag
			echo $content_parts['main'];
			
			?>
		
		</div><!-- .post-link -->
		
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