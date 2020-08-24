<?php if ( is_active_sidebar( 'footer-a' ) || is_active_sidebar( 'footer-b' ) || is_active_sidebar( 'footer-c' ) ) : ?>

	<div class="widget-area group">
	
		<?php if ( is_active_sidebar( 'footer-a' ) ) : ?>
			<div class="column column-1 one-third" role="complementary">
				<?php dynamic_sidebar( 'footer-a' ); ?>
			</div><!-- .column-1 -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'footer-b' ) ) : ?>
			<div class="column column-2 one-third" role="complementary">
				<?php dynamic_sidebar( 'footer-b' ); ?>
			</div><!-- .column-2 -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'footer-c' ) ) : ?>
			<div class="column column-3 one-third" role="complementary">
				<?php dynamic_sidebar( 'footer-c' ); ?>
			</div><!-- .column-3 -->
		<?php endif; ?>
	
	</div><!-- .widget-area -->

<?php endif; ?>