<?php get_header(); ?>

<div class="wrapper">

	<div class="wrapper-inner section-inner">

		<?php
	
		$archive_title = get_the_archive_title();
		$archive_description = get_the_archive_description( '<div>', '</div>' ); 
		
		if ( $archive_title || $archive_description ) : ?>
			
			<header class="archive-header">

				<?php if ( $archive_title ) : ?>
					<h1 class="archive-title"><?php echo $archive_title; ?></h1>
				<?php endif; ?>

				<?php if ( $archive_description ) : ?>
					<div class="archive-description"><?php echo wpautop( $archive_description ); ?></div>
				<?php endif; ?>
				
			</header><!-- .archive-header -->

		<?php endif; ?>
		
		<div class="content">
		
			<?php if ( have_posts() ) : ?>
		
				<div class="posts">
				
					<?php while ( have_posts() ) : the_post(); ?>
					
						<?php get_template_part( 'content', get_post_format() ); ?>							
						
					<?php endwhile; ?>
								
				</div><!-- .posts -->
							
				<?php get_template_part( 'pagination' ); ?>
						
			<?php endif; ?>
		
		</div><!-- .content -->
	
	</div><!-- .wrapper-inner -->

</div><!-- .wrapper -->

<?php get_footer(); ?>