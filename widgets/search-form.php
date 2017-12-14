<?php 

class garfunkel_search_form extends WP_Widget {

	function __construct() {
        $widget_ops = array( 
			'classname' 	=> 'garfunkel_search_widget', 
			'description' 	=> __( 'Displays a search form.', 'garfunkel' ) 
		);
        parent::__construct( 'garfunkel_search_widget', __( 'Search Form', 'garfunkel' ), $widget_ops );
    }
	
	function widget( $args, $instance ) {
	
		// Outputs the content of the widget
		extract( $args ); // Make before_widget, etc available.
		
		$widget_title = apply_filters( 'widget_title', $instance['widget_title'] );
		
		echo $before_widget;
		
		if ( ! empty( $widget_title ) ) {
		
			echo $before_title . $widget_title . $after_title;
			
		} 
		
		get_search_form();
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
	
		// Update and save the widget
		return $new_instance;
		
	}
	
	function form( $instance ) {
		
		// Set defaults
		if ( ! isset( $instance["widget_title"] ) ) $instance["widget_title"] = '';
			
		// Get the options into variables, escaping html characters on the way
		$widget_title = $instance['widget_title'];
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php _e( 'Title', 'garfunkel' ); ?>:
			<input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" class="widefat" value="<?php echo $widget_title; ?>" /></label>
		</p>

		<?php
	}
}
register_widget( 'garfunkel_search_form' ); ?>