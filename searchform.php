<?php

$unique_form_id = uniqid( 'search-form-' );
$unique_field_id = uniqid( 'search-field-' );

?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="<?php echo esc_attr( $unique_form_id ); ?>">
	<label for="search-field" class="genericon genericon-search" for="<?php echo esc_attr( $unique_field_id ); ?>">
		<span class="screen-reader-text"><?php _e( 'Search for:', 'garfunkel' ); ?></span>
	</label>
	<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php _e( 'Search form', 'garfunkel' ); ?>" name="s" class="search-field" id="<?php echo esc_attr( $unique_field_id ); ?>" /> 
</form>