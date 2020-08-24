<?php get_header(); ?>

<div class="wrapper">

	<?php $wrapper_width = ! is_page_template( 'template-fullwidth.php' ) ? ' thin' : ''; ?>
										
	<div class="wrapper-inner section-inner group<?php echo esc_attr( $wrapper_width ); ?>">
	
		<div class="content">
												        
			<?php 
			
			if ( have_posts() ) : 
			
				while ( have_posts() ) : 
				
					the_post(); 
				
					$format = get_post_format() ? get_post_format() : 'standard';

					// Used by the video, quote and link post formats
					$content = get_post_field( 'post_content', get_the_ID() );
					$content_parts = get_extended( $content );
					$main_content = $content_parts['main'];

					?>
							
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

						<?php if ( $format == 'video' ) : ?> 

							<figure class="featured-media">
								<?php echo wp_oembed_get( $main_content ); ?>
							</figure><!-- .featured-media -->

						<?php elseif ( $format == 'quote' ) : ?> 

							<div class="post-quote">
								<?php echo $main_content; ?>
							</div><!-- .post-quote -->
							
						<?php elseif ( $format == 'link' ) : ?> 
						
							<div class="post-link">
								<?php echo $main_content; ?>
							</div><!-- .post-link -->
							
						<?php elseif ( $format == 'gallery' ) : ?> 
						
							<figure class="featured-media">
								<?php garfunkel_flexslider( 'post-thumbnail' ); ?>
							</figure><!-- .featured-media -->
					
						<?php elseif ( has_post_thumbnail() ) : ?>
						
							<figure class="featured-media">
							
								<?php 
									
								the_post_thumbnail();

								$image_caption = get_the_post_thumbnail_caption();
								
								if ( $image_caption ) : ?>
												
									<div class="media-caption-container">
										<p class="media-caption"><?php echo $image_caption; ?></p>
									</div>
									
								<?php endif; ?>
										
							</figure><!-- .featured-media -->
						
						<?php endif; ?>
						
						<div class="post-inner">
						
							<div class="post-header">

								<?php if ( ! is_page() ) : ?>
									<p class="post-date"><?php the_time( get_option( 'date_format' ) ); ?><?php edit_post_link( __( 'Edit','garfunkel' ), '<span class="sep">/</span>' ); ?></p>
								<?php endif; ?>
								
								<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
								
							</div><!-- .post-header -->
																										
							<div class="post-content entry-content">

								<?php 
								if ( in_array( $format, array( 'link', 'quote', 'video' ) ) ) { 
									echo apply_filters( 'the_content', $content_parts['extended'] );
								} else {
									the_content();
								}

								if ( is_page() ) echo edit_post_link( null, '<p>', '</p>' );

								// Output archive lists on the archive template
								if ( is_page_template( 'template-archives.php' ) ) {
									get_template_part( 'inc/parts/archive-lists' );
								}

								?>
													
							</div><!-- .post-content -->
							
							<?php 
							wp_link_pages( array(
								'before'           => '<p class="page-links"><span class="title">' . __( 'Pages:','garfunkel' ) . '</span>',
								'after'            => '</p>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'separator'        => '',
								'pagelink'         => '%',
								'echo'             => 1
							) ); 
							?>
							
						</div><!-- .post-inner -->

						<?php 

						$post_types_with_post_meta = apply_filters( 'garfunkel_post_types_with_post_meta', array( 'post' ) );
						
						if ( in_array( get_post_type(), $post_types_with_post_meta ) ) : ?>
														
							<div class="post-meta bottom">
							
								<div class="tab-selector">
									
									<ul class="group">

										<?php 
										
										$show_comments = ( ! post_password_required() && ( get_comments_number() || comments_open() ) );

										if ( $show_comments ) :
											?>

											<li>
												<a class="tab-comments-toggle active" href="#" data-target=".tab-comments">
													<div class="genericon genericon-comment"></div>
													<span><?php _e( 'Comments', 'garfunkel' ); ?></span>
												</a>
											</li>

											<?php
										endif;
										?>
										
										<li>
											<a class="tab-post-meta-toggle<?php if ( ! $show_comments ) echo ' active'; ?>" href="#" data-target=".tab-post-meta">
												<div class="genericon genericon-summary"></div>
												<span><?php _e( 'Post Info', 'garfunkel' ); ?></span>
											</a>
										</li>
										<li>
											<a class="tab-author-meta-toggle" href="#" data-target=".tab-author-meta">
												<div class="genericon genericon-user"></div>
												<span><?php _e( 'Author Info', 'garfunkel' ); ?></span>
											</a>
										</li>
										
									</ul>
									
								</div><!-- .tab-selector -->
								
								<div class="post-meta-tabs">
								
									<div class="post-meta-tabs-inner">

										<?php if ( $show_comments ) : ?>
										
											<div class="tab-comments tab active">
												<?php comments_template( '', true ); ?>
											</div><!-- .tab-comments -->

										<?php endif; ?>
										
										<div class="tab-post-meta tab group<?php if ( ! $show_comments ) echo ' active'; ?>">
										
											<ul class="post-info-items fright">
												<li>
													<div class="genericon genericon-user"></div>
													<?php the_author_posts_link(); ?>
												</li>
												<li>
													<div class="genericon genericon-time"></div>
													<a href="<?php the_permalink(); ?>">
														<?php the_time( get_option( 'date_format' ) ); ?>
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
											
												<?php if ( $prev_post = get_previous_post() ) : ?>
													<a class="post-nav-prev" href="<?php the_permalink( $prev_post->ID ); ?>">
														<p><?php _e( 'Previous post', 'garfunkel' ); ?></p>
														<h4><?php echo get_the_title( $prev_post ); ?></h4>
													</a>
												<?php endif; ?>
												
												<?php if ( $next_post = get_next_post() ) : ?>
													<a class="post-nav-next" href="<?php the_permalink( $next_post->ID ); ?>">
														<p><?php _e( 'Next post', 'garfunkel' ); ?></p>
														<h4><?php echo get_the_title( $next_post ); ?></h4>
													</a>
												<?php endif; ?>
											
											</div><!-- .post-nav -->
										
										</div><!-- .tab-post-meta -->
										
										<div class="tab-author-meta tab">

											<?php $author_id = get_the_author_meta( 'ID' ); ?>
										
											<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="author-avatar">
												<?php echo get_avatar( get_the_author_meta( 'email' ), '256' ); ?>
											</a>
										
											<div class="author-meta-inner">
											
												<h3 class="author-name"><?php the_author_posts_link(); ?></h3>
						
												<?php

												$user_info = get_userdata( get_the_author_meta( 'ID' ) );
												$user_role = isset( $user_info->roles[0] ) ? $user_info->roles[0] : '';

												if ( $user_role ) :
													global $wp_roles;
													$user_role_translated = isset( $wp_roles->roles[$user_role] ) ? translate_user_role( $wp_roles->roles[$user_role]['name'] ) : '';
													if ( $user_role_translated ) :
														?>
														<p class="author-position"><?php echo $user_role_translated; ?></p>
														<?php
													endif;
												endif;
												?>
												
												<?php if ( get_the_author_meta( 'description' ) ) : ?>
													<div class="author-description">
														<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
													</div>
												<?php endif; ?>
											
											</div><!-- .author-meta-inner -->
																				
											<div class="author-content group">
											
												<div class="one-half author-posts">
											
													<h4 class="content-by"><?php printf( __( 'Posts by %s', 'garfunkel' ), get_the_author_meta( 'display_name' ) ); ?></h4>
												
													<ul>
												
														<?php
														
														$author_posts = get_posts( array( 
															'author' 			=> $author_id,
															'post__not_in'		=> array( $post->ID ),
															'post_status'		=> 'publish',
															'posts_per_page' 	=> 5, 
														) );

														global $post;
														
														foreach ( $author_posts as $post ) : 
															setup_postdata( $post ); 
															?>

															<li <?php if ( has_post_thumbnail() ) echo 'class="has-thumb"'; ?>>
																<a href="<?php the_permalink(); ?>" class="group">
																
																	<div class="post-icon">
																		<?php 
																		if ( has_post_thumbnail() ) {
																			the_post_thumbnail( 'thumbnail' );
																		} else {
																			$author_post_format = get_post_format() ? get_post_format() : 'standard';
																			echo '<div class="genericon genericon-' . $author_post_format . '"></div>';
																		}
																		?>
																	</div>
																	
																	<h5 class="title"><?php the_title(); ?></h5>
																	<p class="meta"><?php the_time( get_option( 'date_format' ) ); ?></p>
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

														$comments = get_comments( 'user_id=' . $author_id . '&number=5' );

														foreach ( $comments as $comment ) : ?>
														
															<li>
																<a href="<?php the_permalink( $comment->ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
																	<div class="post-icon">
																		<?php echo get_the_post_thumbnail( $comment->comment_post_ID, 'thumbnail' ) ? get_the_post_thumbnail( $comment->comment_post_ID, 'thumbnail' ) : '<div class="genericon genericon-comment"></div>'; ?>
																	</div>
																	<h5 class="title"><?php echo get_the_title( $comment->comment_post_ID ); ?></h5>
																	<p class="excerpt"><?php echo garfunkel_get_comment_excerpt( $comment->ID, 10 ); ?></p>
																</a>
															</li>
															
														<?php endforeach; ?>
													
													</ul>
												
												</div><!-- .author-comments -->
												
											</div><!-- .author-content -->
										
										</div><!-- .tab-author-meta -->
									
									</div><!-- .post-meta-tabs-inner -->
								
								</div><!-- .post-meta-tabs -->
									
							</div><!-- .post-meta.bottom -->
							
							<div class="post-nav-fixed">
										
								<?php if ( $prev_post = get_previous_post() ) : ?>
									<a class="post-nav-prev" href="<?php the_permalink( $prev_post->ID ); ?>">
										<span class="hidden"><?php _e( 'Previous post', 'garfunkel' ); ?></span>
										<span class="arrow">&laquo;</span>
									</a>
								<?php endif; ?>
								
								<?php if ( $next_post = get_next_post() ) : ?>
									<a class="post-nav-next" href="<?php the_permalink( $next_post->ID ); ?>">
										<span class="hidden"><?php _e( 'Next post', 'garfunkel' ); ?></span>
										<span class="arrow">&raquo;</span>
									</a>
								<?php endif; ?>

							</div><!-- .post-nav -->

						<?php elseif ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) : ?>
						
							<div class="comments-page-container">
								<div class="comments-page-container-inner">
									<?php comments_template( '', true ); ?>
								</div><!-- .comments-page-container-inner -->
							</div><!-- .comments-page-container -->

						<?php endif; // Post type check ?>

						<?php get_sidebar(); ?>

					</article><!-- .post -->
																			
					<?php 

				endwhile; // have_posts()
			endif;
			
			?>
		
		</div><!-- .content -->
		
	</div><!-- .wrapper-inner -->

</div><!-- .wrapper -->
		
<?php get_footer(); ?>