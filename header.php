<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

	<head>
		
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="author" content="<?php bloginfo( 'name' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        
        <link rel="profile" href="http://gmpg.org/xfn/11">
		 
		<?php wp_head(); ?>
	
	</head>
    
    <body <?php body_class(); ?>>

		<?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>
	
		<div class="navigation">
		
			<div class="section-inner">
				
				<ul class="main-menu">
				
					<?php 
					
					if ( has_nav_menu( 'primary' ) ) {
						$nav_menu = wp_nav_menu( array( 
							'container' 		=> '', 
							'echo'				=> false,
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'primary', 
						) ); 
					} else {
						$nav_menu = wp_list_pages( array(
							'container'	=> '',
							'echo'		=> false,
							'title_li'	=> ''
						) );
					} 
					
					echo $nav_menu;
					
					?>
											
				</ul><!-- .main-menu -->

				<div class="menu-social-desktop">
					<?php get_template_part( 'menu', 'social' ); ?>
				</div><!-- .menu-social-desktop -->
			 
			</div><!-- .section-inner -->
			
			<div class="mobile-menu-container">
			
				<ul class="mobile-menu">
					<?php echo $nav_menu; ?>
				</ul><!-- .mobile-menu -->
				
				<div class="menu-social-mobile">
					<?php get_template_part( 'menu', 'social' ); ?>
				</div><!-- .menu-social-mobile -->
										
			</div><!-- .mobile-menu-container -->
				 			
		</div><!-- .navigation -->
		
		<header class="title-section">

			<?php $header_image_url = get_header_image() ? get_header_image() : get_template_directory_uri() . '/assets/images/bg.jpg'; ?>
			
			<div class="bg-image master" style="background-image: url( <?php echo esc_url( $header_image_url ); ?> );"></div>
			
			<div class="bg-shader master"></div>
		
			<div class="section-inner">
			
				<div class="toggle-container">
			
					<a class="nav-toggle group" href="#">
				
						<div class="bars">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
						
						<p>
							<span class="menu"><?php _e( 'Menu', 'garfunkel' ); ?></span>
							<span class="close"><?php _e( 'Close', 'garfunkel' ); ?></span>
						</p>
					
					</a>
				
				</div><!-- .toggle-container -->

				<?php 

				$custom_logo_id 	= get_theme_mod( 'custom_logo' );
				$legacy_logo_url 	= get_theme_mod( 'garfunkel_logo' );
				$blog_title_elem 	= ( ( is_front_page() || is_home() ) && ! is_page() ) ? 'h1' : 'div';
				$blog_title_class 	= $custom_logo_id ? 'blog-logo' : 'blog-title';

				$blog_title 		= get_bloginfo( 'title' );
				$blog_description 	= get_bloginfo( 'description' );

				if ( $custom_logo_id  || $legacy_logo_url ) : 

					$custom_logo_url = $legacy_logo_url ? $legacy_logo_url : wp_get_attachment_image_url( $custom_logo_id, 'full' );
				
					?>

					<<?php echo $blog_title_elem; ?> class="<?php echo esc_attr( $blog_title_class ); ?>">
						<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo esc_url( $custom_logo_url ); ?>">
							<span class="screen-reader-text"><?php echo $blog_title; ?></span>
						</a>
					</<?php echo $blog_title_elem; ?>>
		
				<?php elseif ( $blog_description || $blog_title ) : ?>

					<<?php echo $blog_title_elem; ?> class="<?php echo esc_attr( $blog_title_class ); ?>">
						<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php echo $blog_title; ?></a>
					</<?php echo $blog_title_elem; ?>>
				
					<?php if ( $blog_description ) : ?>
						<h3 class="blog-subtitle"><?php echo $blog_description; ?></h3>
					<?php endif; ?>
				
				<?php endif; ?>
			
			</div><!-- .section-inner -->
		
		</header><!-- .title-section -->