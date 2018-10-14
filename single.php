<?php get_header(); ?>

<div class="wrapper">
										
	<div class="wrapper-inner section-inner thin">
	
		<div class="content">
												        
			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); 
			
				$format = get_post_format();
				?>
						
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( $format == 'video' ) : ?> 
					
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
					
					<?php elseif ( $format == 'quote' ) : ?> 
											
						<div class="post-quote">
							
							<?php
								
							// Fetch post content
							$content = get_post_field( 'post_content', get_the_ID() );
							
							// Get content parts
							$content_parts = get_extended( $content );
							
							// Output part before <!--more--> tag
							echo $content_parts['main'];
							
							?>
						
						</div><!-- .post-quote -->
						
					<?php elseif ( $format == 'link' ) : ?> 
					
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
						
					<?php elseif ( $format == 'gallery' ) : ?> 
					
						<div class="featured-media">

							<?php garfunkel_flexslider( 'post-image' ); ?>
											
						</div><!-- .featured-media -->
				
					<?php elseif ( has_post_thumbnail() ) : ?>
					
						<div class="featured-media">
						
							<?php 
								
							the_post_thumbnail( 'post-image' );

							$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
							
							if ( $image_caption ) : ?>
											
								<div class="media-caption-container">
								
									<p class="media-caption"><?php echo $image_caption; ?></p>
									
								</div>
								
							<?php endif; ?>
									
						</div><!-- .featured-media -->
					
					<?php endif; ?>
					
					<div class="post-inner">
					
						<div class="post-header">
						
							<p class="post-date"><?php the_time( get_option( 'date_format' ) ); ?><?php edit_post_link( __( 'Edit','garfunkel' ), '<span class="sep">/</span>' ); ?></p>
							
						    <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
						    
						</div><!-- .post-header -->
														                                    	    
						<div class="post-content">

							<?php 
							if ( $format == 'link' || $format == 'quote' || $format == 'video') { 
								$content = $content_parts['extended'];
								$content = apply_filters( 'the_content', $content );
								echo $content;
							} else {
								the_content();
							}
							?>
							
							<div class="clear"></div>
										        
						</div><!-- .post-content -->
						
						<?php 
						$args = array(
							'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:','garfunkel' ) . '</span>',
							'after'            => '</p>',
							'link_before'      => '<span>',
							'link_after'       => '</span>',
							'separator'        => '',
							'pagelink'         => '%',
							'echo'             => 1
						);
					
						wp_link_pages( $args ); 
						?>
						
					</div><!-- .post-inner -->
					            					
					<div class="post-meta bottom">
					
						<div class="tab-selector">
							
							<ul>
			
								<li>
									<a class="active tab-comments-toggle" href="#">
										<div class="genericon genericon-comment"></div>
										<span><?php _e( 'Comments', 'garfunkel' ); ?></span>
									</a>
								</li>
								<li>
									<a class="tab-post-meta-toggle" href="#">
										<div class="genericon genericon-summary"></div>
										<span><?php _e( 'Post info', 'garfunkel' ); ?></span>
									</a>
								</li>
								<li>
									<a class="tab-author-meta-toggle" href="#">
										<div class="genericon genericon-user"></div>
										<span><?php _e( 'Author info', 'garfunkel' ); ?></span>
									</a>
								</li>
								
								<div class="clear"></div>
								
							</ul>
							
						</div>
						
						<div class="post-meta-tabs">
						
							<div class="post-meta-tabs-inner">
								
								<div class="tab-post-meta tab">
								
									<ul class="post-info-items fright">
										<li>
											<div class="genericon genericon-user"></div>
											<?php the_author_posts_link(); ?>
										</li>
										<li>
											<div class="genericon genericon-time"></div>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_date( get_option('date-format') ); ?>
											</a>
										</li>
										<li>
											<div class="genericon genericon-category"></div>
											<?php the_category(', '); ?>
										</li>
										<?php if ( has_tag() ) : ?>
											<li>
												<div class="genericon genericon-tag"></div>
												<?php the_tags('', ', '); ?>
											</li>
										<?php endif; ?>
									</ul>
								
									<div class="post-nav fleft">
									
										<?php
										$prev_post = get_previous_post();
										if ( ! empty( $prev_post ) ) : ?>
										
											<a class="post-nav-prev" title="<?php printf( __( 'Previous post: "%s"', 'garfunkel' ), esc_attr( get_the_title( $prev_post ) ) ); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
												<p><?php _e( 'Previous post', 'garfunkel' ); ?></p>
												<h4><?php echo get_the_title( $prev_post ); ?></h4>
											</a>
									
										<?php endif;
										
										$next_post = get_next_post();
										if ( ! empty( $next_post ) ) : ?>
											
											<a class="post-nav-next" title="<?php printf( __( 'Next post: "%s"', 'garfunkel' ), esc_attr( get_the_title( $next_post ) ) ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
												<p><?php _e( 'Next post', 'garfunkel' ); ?></p>
												<h4><?php echo get_the_title( $next_post ); ?></h4>
											</a>
									
										<?php endif; ?>
									
									</div>
									
									<div class="clear"></div>
								
								</div><!-- .tab-post-meta -->
								
								<div class="tab-author-meta tab">

									<?php $user_id = get_the_author_meta( 'ID' ); ?>
								
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'email' ), '256' ); ?></a>
								
									<div class="author-meta-inner">
									
										<h3 class="author-name"><?php the_author_posts_link(); ?></h3>
										
										<p class="author-position">
				
											<?php
											$user_info = get_userdata( $user_id );
											$user_role = ucfirst( implode( ', ', $user_info->roles ) );

											echo $user_role;
											?>
											
										</p>
										
										<?php if ( get_the_author_meta( 'description' ) ) : ?>
											<div class="author-description">
												<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
											</div>
										<?php endif; ?>
									
									</div><!-- .author-meta-inner -->
																		
									<div class="author-content">
									
										<div class="one-half author-posts">
									
											<h4 class="content-by"><?php printf( __( 'Posts by %s', 'garfunkel' ), get_the_author_meta( 'display_name' ) ); ?></h4>
										
											<ul>
										
												<?php
		
												$args = array( 
													'author' 			=> $user_id,
													'post__not_in'		=> array( $post->ID ),
													'post_status'		=> 'publish',
													'posts_per_page' 	=> 5, 
												);
												
												$myposts = get_posts( $args );
												
												foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
													<li <?php if ( has_post_thumbnail() ) echo 'class="has-thumb"'; ?>>
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														
															<div class="post-icon">
																<?php 
																if ( has_post_thumbnail() ) {
																	the_post_thumbnail( 'thumbnail' );
																} else {
																	$post_format = get_post_format();
																	if ( empty( $post_format ) ) $post_format = 'standard';
																	echo '<div class="genericon genericon-' . $post_format . '"></div>';
																}
																?>
															</div>
															
															<h5 class="title"><?php the_title(); ?></h5>
															
															<p class="meta"><?php the_time( get_option( 'date_format' ) ); ?></p>
															
															<div class="clear"></div>
															
														</a>
													</li>
													<?php 
												
												endforeach; 
												
												wp_reset_postdata(); 
												?>
												
											</ul>
										
										</div><!-- .author-posts -->
										
										<div class="one-half author-comments">
										
											<h4 class="content-by"><?php printf( __( 'Comments by %s', 'garfunkel' ), get_the_author_meta( 'display_name' ) ); ?></h4>
											
											<ul>
		
												<?php 

												$comments = get_comments( 'user_id=' . $user_id . '&number=5' );

												foreach( $comments as $comment ) :
												
													$comment_excerpt = $comment->comment_content; 
																
													if ( strlen( $comment_excerpt ) > 60 ) { 
														$comment_excerpt = substr( $comment_excerpt, 0, 60 ); 
														$comment_excerpt = substr( $comment_excerpt, 0, strrpos( $comment_excerpt, ' ' ) );
														$comment_excerpt = rtrim( $comment_excerpt, '.' );
														$comment_excerpt = '"' . $comment_excerpt . '..."';
													} else {
														$comment_excerpt = '"' . $comment_excerpt . '"';
													}

													?>
												
													<li>
														<a href="<?php echo get_permalink( $comment->ID ); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php printf( _x( 'Posted on %1$s to %2$s', 'Variables: date and post title', 'garfunkel' ), get_comment_date( get_option( 'date_format' ), $comment->comment_ID ), the_title_attribute( array( 'echo' => false, 'post' => $comment->comment_post_ID ) ) ); ?>">
															<div class="post-icon">
																<?php echo get_the_post_thumbnail( $comment->comment_post_ID, 'thumbnail' ) ? get_the_post_thumbnail( $comment->comment_post_ID, 'thumbnail' ) : '<div class="genericon genericon-comment"></div>'; ?>
															</div>
															<h5 class="title"><?php echo get_the_title( $comment->comment_post_ID ); ?></h5>
															<p class="excerpt"><?php echo $comment_excerpt; ?></p>
														</a>
													</li>
													
												<?php endforeach; ?>
											
											</ul>
										
										</div><!-- .author-comments -->
										
										<div class="clear"></div>
										
									</div><!-- .author-content -->
								
								</div><!-- .tab-author-meta -->
								
								<div class="tab-comments tab">
								
									<?php comments_template( '', true ); ?>
								
								</div><!-- .tab-comments -->
							
							</div><!-- .post-meta-tabs-inner -->
						
						</div><!-- .post-meta-tabs -->
							
					</div><!-- .post-meta.bottom -->
					
					<div class="post-nav-fixed">
								
						<?php
						$prev_post = get_previous_post();
						if ( ! empty( $prev_post ) ) : ?>
						
							<a class="post-nav-prev" title="<?php printf( __( 'Previous post: "%s"', 'garfunkel' ), the_title_attribute( array( 'post' => $prev_post->ID ) ) ); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
								<span class="hidden"><?php _e( 'Previous post', 'garfunkel' ); ?></span>
								<span class="arrow">&laquo;</span>
							</a>
					
						<?php endif;
						
						$next_post = get_next_post();
						if ( ! empty( $next_post ) ) : ?>
							
							<a class="post-nav-next" title="<?php printf( __( 'Next post: "%s"', 'garfunkel' ), the_title_attribute( array( 'post' => $next_post->ID ) ) ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
								<span class="hidden"><?php _e( 'Next post', 'garfunkel' ); ?></span>
								<span class="arrow">&raquo;</span>
							</a>
					
						<?php endif; ?>
															
						<div class="clear"></div>
					
					</div><!-- .post-nav -->
												                        
			   	<?php endwhile; else: ?>
			
					<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "garfunkel" ); ?></p>
				
				<?php endif; ?>    
				
				<?php get_sidebar(); ?>
						
			</div><!-- .post -->
		
		</div><!-- .content -->
		
		<div class="clear"></div>
		
	</div><!-- .wrapper-inner -->

</div><!-- .wrapper -->
		
<?php get_footer(); ?>