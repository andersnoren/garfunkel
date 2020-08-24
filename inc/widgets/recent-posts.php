<?php 

if ( ! class_exists( 'garfunkel_recent_posts' ) ) :
	class garfunkel_recent_posts extends WP_Widget {

		function __construct() {
			parent::__construct( 'widget_garfunkel_recent_posts', __( 'Recent Posts', 'garfunkel' ), array( 
				'classname' 	=> 'widget_garfunkel_recent_posts', 
				'description' 	=> __( 'Displays recent blog entries.', 'garfunkel' ) 
			) );
		}
		
		function widget( $args, $instance ) {
		
			extract( $args ); // Make before_widget, etc available.
			
			$widget_title 		= isset( $instance['widget_title'] ) ? apply_filters( 'widget_title', $instance['widget_title'] ) : '';
			$number_of_posts 	= isset( $instance['number_of_posts'] ) ?  $instance['number_of_posts'] : 5;
			
			echo $before_widget;
			
			if ( $widget_title ) {
				echo $before_title . $widget_title . $after_title;
			}

			?>
			
			<ul>
				
				<?php
				
				$not_in = array();

				global $post;

				if ( $post ) {
					$not_in[] = $post->ID;
				}
				
				$sticky = get_option( 'sticky_posts' );

				if ( $sticky ) {
					$not_in = array_merge( $not_in, $sticky );
				}
				
				$posts = get_posts( array(
					'post_type' 		=> 'post',
					'post__not_in' 		=> $not_in, 
					'posts_per_page' 	=> $number_of_posts,
					'post_status' 		=> 'publish'
				) );
				
				if ( $posts ) : 

					foreach ( $posts as $post ) :

						setup_postdata( $post );

						?>
				
						<li>
						
							<a href="<?php the_permalink(); ?>">
									
								<div class="post-icon">
								
									<?php 
									$post_format = get_post_format() ? get_post_format() : 'standard'; 
									
									if ( $post_format == 'gallery' ) {

										$images = get_posts( array(
											'numberposts'    => 1,
											'orderby'        => 'menu_order',
											'order'          => 'ASC',
											'post_mime_type' => 'image',
											'post_parent'    => get_the_ID(),
											'post_status'    => null,
											'post_type'      => 'attachment',
										) );

										if ( $images ) echo wp_get_attachment_image( $image[0]->ID, 'thumbnail' );

									} elseif ( has_post_thumbnail() ) {
										the_post_thumbnail( 'thumbnail' );
									} else { 
										echo '<div class="genericon genericon-' . $post_format . '"></div>';
									}

									?>
									
								</div>
								
								<div class="inner">
									<p class="title"><?php the_title(); ?></p>
									<p class="meta"><?php the_time( get_option( 'date_format' ) ); ?></p>
								</div><!-- .inner -->

							</a>
							
						</li>
			
						<?php 

					endforeach; 

					wp_reset_postdata();

				endif;

				?>
			
			</ul>
						
			<?php 

			echo $after_widget; 

		}

		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}
		
		function form( $instance ) {
		
			$widget_title 		= isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
			$number_of_posts 	= isset( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : 5;

			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php  _e( 'Title', 'garfunkel' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $widget_title ); ?>" /></label>
			</p>
							
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php _e( 'Number of posts to display:', 'garfunkel' ); ?>
				<input id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $number_of_posts ); ?>" /></label>
				<small>(<?php _e( 'Defaults to 5 if empty', 'garfunkel' ); ?>)</small>
			</p>
			
			<?php
		}

	}
endif;