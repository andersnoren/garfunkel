<div class="post-container">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="featured-media">
		
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
	
				<?php				
				$attachment_parent = get_the_ID();

				$image_args = array(
					'numberposts'    => 1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'post_parent'    => $attachment_parent,
					'post_type'      => 'attachment',
					'post_status'    => null,
					'post_mime_type' => 'image',
				);

				$images = get_posts( $image_args );
			
				if ( $images ) {
				
					foreach( $images as $image ) {

						$attimg = wp_get_attachment_image( $image->ID, 'post-thumbnail' );
						echo $attimg;
						
					}

				} ?>
									
			</a>
							
		</div><!-- .featured-media -->
		
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
			
			<?php endif; ?>

			<?php the_excerpt(); ?>
		
			<?php garfunkel_meta(); ?>
		
		</div><!-- .post-inner -->
	
	</div>

</div>