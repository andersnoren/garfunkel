<?php 

if ( ! class_exists( 'garfunkel_recent_comments' ) ) :
	class garfunkel_recent_comments extends WP_Widget {

		function __construct() {
			parent::__construct( 'widget_garfunkel_recent_comments', __( 'Recent Comments', 'garfunkel' ),array( 
				'classname' 	=> 'widget_garfunkel_recent_comments', 
				'description' 	=> __( 'Displays recent comments with user avatars.', 'garfunkel' ),
			) );
		}
		
		function widget( $args, $instance ) {
		
			// Outputs the content of the widget
			extract( $args ); // Make before_widget, etc available.
			
			$widget_title 		= isset( $instance['widget_title'] ) ? apply_filters( 'widget_title', $instance['widget_title'] ) : '';
			$number_of_comments = isset( $instance['number_of_comments'] ) ? $instance['number_of_comments'] : 5;
			
			echo $before_widget;
			
			if ( $widget_title ) {
				echo $before_title . $widget_title . $after_title;
			} 
			
			?>
			
			<ul>
				
				<?php
				
				global $comment;
				
				// The query
				$comments_query = new WP_Comment_Query;
				$comments = $comments_query->query( array(
					'number'	=> $number_of_comments,
					'orderby'	=> 'date',
					'status'	=> 'approve'
				) );
				
				// Comment loop
				if ( $comments ) :
					foreach ( $comments as $comment ) : 
					
						?>
					
						<li>
							
							<a href="<?php the_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo esc_attr( $comment->comment_ID ); ?>">
								
								<div class="post-icon">
									<?php echo get_avatar( get_comment_author_email( $comment->comment_ID ), '100' ); ?>
								</div>
								
								<div class="inner">
									<p class="title"><span><?php comment_author(); ?></span></p>
									<p class="excerpt">&ldquo;<?php echo garfunkel_get_comment_excerpt( $comment->comment_ID, 13 ); ?>&rdquo;</p>
								</div>
				
							</a>
							
						</li>
						
						<?php 

					endforeach;
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
			$number_of_comments = isset( $instance['number_of_comments'] ) ? $instance['number_of_comments'] : 5;

			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php  _e( 'Title:', 'garfunkel' ); ?>
				<input id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $widget_title ); ?>" /></label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>"><?php _e( 'Number of comments to display:', 'garfunkel' ); ?>
				<input id="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_comments' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $number_of_comments ); ?>" /></label>
				<small>(<?php _e( 'Defaults to 5 if empty', 'garfunkel' ); ?>)</small>
			</p>

			<?php
		}

	}
endif;