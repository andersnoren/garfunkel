<div class="post-container">			    	

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php if ( is_sticky() ) : ?>
				
			<div class="is-sticky">
				<div class="genericon genericon-pinned"></div>
			</div>
		
		<?php endif; ?>
	
		<div class="post-inner">
		
			<?php the_excerpt(); ?>
		
			<?php garfunkel_meta(); ?>
		
		</div><!-- .post-inner -->
	
	</div><!-- .post -->

</div>