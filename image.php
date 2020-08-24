<?php get_header(); ?>

<div class="wrapper">

	<div class="wrapper-inner section-inner thin group">

		<div class="content">
												        
			<?php 
			
			if ( have_posts() ) : 
				while ( have_posts() ) : 
				
					the_post(); 
					
					?>
				
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
															
						<figure class="featured-media">
						
							<?php $image_array = wp_get_attachment_image_src( $post->ID, 'full', false ); ?>
						
							<a href="<?php echo esc_url( $image_array[0] ); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, 'post-thumbnail' ); ?></a>
						
						</figure><!-- .featured-media -->
						
						<div class="post-inner">
							
							<header class="post-header">
								
								<p class="post-date">
									<?php the_time( get_option( 'date_format' ) ); ?>
									<span class="sep">/</span>
									<?php echo $image_array[1] . '<span style="text-transform: lowercase;">x</span>' . $image_array[2] . ' px'; ?>
								</p>
							
								<h2 class="post-title"><?php echo basename( get_attached_file( $post->ID ) ); ?></h2>
							
							</header><!-- .post-header -->
																			
							<div class="post-content">
								<p><?php the_excerpt(); ?></p>
							</div><!-- .post-content -->
						
						</div><!-- .post-inner -->

						<?php get_sidebar(); ?>

					</article><!-- .post -->
																							
					<?php 

				endwhile;
			endif; 
			
			?>
				
		</div><!-- .content -->
	
	</div><!-- .section-inner -->

</div><!-- .wrapper -->
		
<?php get_footer(); ?>