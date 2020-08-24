<?php 

if ( ! class_exists( 'garfunkel_search_form' ) ) :
	class garfunkel_search_form extends WP_Widget {

		function __construct() {
			parent::__construct( 'garfunkel_search_widget', __( 'Search Form', 'garfunkel' ), array( 
				'classname' 	=> 'garfunkel_search_widget', 
				'description' 	=> __( 'Displays a search form.', 'garfunkel' ) 
			) );
		}
		
		function widget( $args, $instance ) {
		
			extract( $args ); // Make before_widget, etc available.
			
			$widget_title = isset( $instance['widget_title'] ) ? apply_filters( 'widget_title', $instance['widget_title'] ) : '';
			
			echo $before_widget;
			
			if ( $widget_title ) {
				echo $before_title . $widget_title . $after_title;
			}
			
			get_search_form();
			
			echo $after_widget;
		}
		
		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}
		
		function form( $instance ) {

			$widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';

			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php _e( 'Title', 'garfunkel' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $widget_title ); ?>" /></label>
			</p>

			<?php

		}

	}
endif;