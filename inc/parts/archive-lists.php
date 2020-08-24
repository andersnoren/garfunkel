<div class="archive-box group">
						
	<h3><?php _e( 'All Posts', 'garfunkel' ); ?></h3>
				
	<ul>
		<?php 
		
		$posts_archive = get_posts( array(
			'posts_per_page'	=> -1,
		) );

		foreach ( $posts_archive as $archive_post ) : ?>
			<li>
				<a href="<?php the_permalink( $archive_post->ID ); ?>">
					<?php echo get_the_title( $archive_post->ID );?> 
					<span><?php echo get_the_time( get_option( 'date_format' ), $archive_post->ID ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	
	<h3><?php _e( 'Archives by Categories', 'garfunkel' ); ?></h3>
	
	<ul>
		<?php wp_list_categories( 'title_li=', 'garfunkel' ); ?>
	</ul>
	
	<h3><?php _e( 'Archives by Tags', 'garfunkel' ); ?></h3>
	
	<ul>
		<?php 
		
		$tags = get_tags();
		
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li> ';
			}
		}
		?>
	</ul>

	<h3><?php _e( 'Contributors', 'garfunkel' ); ?></h3>
	
	<ul>
		<?php wp_list_authors(); ?> 
	</ul>
	
	<h3><?php _e( 'Archives by Year', 'garfunkel' ); ?></h3>
	
	<ul>
		<?php wp_get_archives( 'type=yearly'); ?>
	</ul>
	
	<h3><?php _e( 'Archives by Month', 'garfunkel' ); ?></h3>
	
	<ul>
		<?php wp_get_archives( 'type=monthly'); ?>
	</ul>

	<h3><?php _e( 'Archives by Day', 'garfunkel' ); ?></h3>
	
	<ul>
		<?php wp_get_archives( 'type=daily'); ?>
	</ul>

</div><!-- .archive-box -->