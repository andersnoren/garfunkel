<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div class="archive-nav group">
		<?php echo get_next_posts_link( '&laquo; ' . __( 'Older posts', 'garfunkel' ) ); ?>
		<?php echo get_previous_posts_link( __( 'Newer posts', 'garfunkel' ) . ' &raquo;' ); ?>
	</div><!-- .archive-nav -->
<?php endif; ?>