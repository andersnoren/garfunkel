<div class="post-container">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php if ( has_post_thumbnail() ) : ?>
		
			<div class="featured-media">
			
				<?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'garfunkel' ) . '</span>'; ?>
			
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				
					<?php the_post_thumbnail( 'post-thumbnail' ); ?>
					
				</a>
						
			</div><!-- .featured-media -->
				
		<?php endif; ?>
		
		<?php if ( is_sticky() ) : ?>
				
			<div class="is-sticky">
				<div class="genericon genericon-pinned"></div>
			</div>
		
		<?php endif; ?>
		
		<div class="post-inner">
		
			<?php the_excerpt(); ?>
		
			<?php garfunkel_meta(); ?>
		
		</div><!-- .post-inner -->
	
	</div>

</div>