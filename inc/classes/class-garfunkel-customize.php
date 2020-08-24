<?php

/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER SETTINGS
   --------------------------------------------------------------------------------------------- */

if ( ! class_exists( 'Garfunkel_Customize' ) ) : 
	class Garfunkel_Customize {

		public static function register( $wp_customize ) {

			/* Accent Color ------------------ */
			
			$wp_customize->add_setting( 'accent_color', array(
				'default' 			=> '#ca2017', 
				'type' 				=> 'theme_mod', 
				'capability' 		=> 'edit_theme_options', 
				'sanitize_callback' => 'sanitize_hex_color'
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'garfunkel_accent_color', array(
				'label' 	=> __( 'Accent Color', 'garfunkel' ), 
				'section' 	=> 'colors', 
				'settings' 	=> 'accent_color', 
				'priority' 	=> 10, 
			) ) );

			/* Custom Logo ------------------- */

			// Only display the Customizer section for the garfunkel_logo setting if it already has a value.
			// This means that site owners with existing logos can remove them, but new site owners can't add them.
			// Since v2.0.0, the core custom_logo setting (in the Site Identity Customizer panel) should be used instead.
			if ( get_theme_mod( 'garfunkel_logo' ) ) {

				$wp_customize->add_section( 'garfunkel_logo_section' , array(
					'title'       => __( 'Logo', 'garfunkel' ),
					'priority'    => 40,
					'description' => 'Upload a logo to replace the default site name and description in the header',
				) );
				
				$wp_customize->add_setting( 'garfunkel_logo', array( 
					'sanitize_callback' => 'esc_url_raw'
				) );

				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'garfunkel_logo', array(
					'label'   	=> __( 'Logo', 'garfunkel' ),
					'section' 	=> 'garfunkel_logo_section',
					'settings'	=> 'garfunkel_logo',
				) ) );

			}

		}

		public static function header_output() {

			$accent_default = '#ca2017';
			$accent = get_theme_mod( 'accent_color', $accent_default );

			// Only output Custom CSS if it differs from the default
			if ( $accent == $accent_default ) return;
		
			echo '<!--Customizer CSS-->';
			echo '<style type="text/css">';

			self::generate_css( 'body a', 'color', $accent );
			self::generate_css( 'body a:hover', 'color', $accent );

			self::generate_css( '.blog-title a:hover', 'color', $accent );
			self::generate_css( '.menu-social a:hover', 'background-color', $accent );
			self::generate_css( '.sticky.post .is-sticky', 'background-color', $accent );
			self::generate_css( '.sticky.post .is-sticky:before', 'border-top-color', $accent );
			self::generate_css( '.sticky.post .is-sticky:before', 'border-left-color', $accent );
			self::generate_css( '.sticky.post .is-sticky:after', 'border-top-color', $accent );
			self::generate_css( '.sticky.post .is-sticky:after', 'border-right-color', $accent );
			self::generate_css( '.post-title a:hover', 'color', $accent );
			self::generate_css( '.post-quote', 'background', $accent );
			self::generate_css( '.post-link', 'background', $accent );

			self::generate_css( '.post-content a', 'color', $accent );
			self::generate_css( '.post-content a:hover', 'color', $accent );
			self::generate_css( '.post-content fieldset legend', 'background', $accent );
			self::generate_css( '.post-content input[type="button"]:hover', 'background', $accent );
			self::generate_css( '.post-content input[type="reset"]:hover', 'background', $accent );
			self::generate_css( '.post-content input[type="submit"]:hover', 'background', $accent );

			self::generate_css( '.post-content .has-accent-color', 'color', $accent );
			self::generate_css( '.post-content .has-accent-background-color', 'background-color', $accent );

			self::generate_css( '.post-nav-fixed a:hover', 'background', $accent );
			self::generate_css( '.tab-post-meta .post-nav a:hover h4', 'color', $accent );
			self::generate_css( '.post-info-items a:hover', 'color', $accent );
			self::generate_css( '.page-links a', 'color', $accent );
			self::generate_css( '.page-links a:hover', 'background', $accent );
			self::generate_css( '.author-name a:hover', 'color', $accent );
			self::generate_css( '.content-by', 'color', $accent );
			self::generate_css( '.author-content a:hover .title', 'color', $accent );
			self::generate_css( '.author-content a:hover .post-icon', 'background', $accent );
			self::generate_css( '.comment-notes a', 'color', $accent );
			self::generate_css( '.comment-notes a:hover', 'color', $accent );
			self::generate_css( '.content #respond input[type="submit"]', 'background-color', $accent );
			self::generate_css( '.comment-header h4 a', 'color', $accent );
			self::generate_css( '.bypostauthor > .comment:before', 'background', $accent );
			self::generate_css( '.comment-actions a:hover', 'color', $accent );
			self::generate_css( '#cancel-comment-reply-link', 'color', $accent );
			self::generate_css( '#cancel-comment-reply-link:hover', 'color', $accent );
			self::generate_css( '.comments-nav a:hover', 'color', $accent );

			self::generate_css( '.widget-title a', 'color', $accent );
			self::generate_css( '.widget-title a:hover', 'color', $accent );
			self::generate_css( '.widget_text a', 'color', $accent );
			self::generate_css( '.widget_text a:hover', 'color', $accent );
			self::generate_css( '.widget_rss li a:hover', 'color', $accent );
			self::generate_css( '.widget_archive li a:hover', 'color', $accent );
			self::generate_css( '.widget_meta li a:hover', 'color', $accent );
			self::generate_css( '.widget_pages li a:hover', 'color', $accent );
			self::generate_css( '.widget_links li a:hover', 'color', $accent );
			self::generate_css( '.widget_categories li a:hover', 'color', $accent );
			self::generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', $accent );
			self::generate_css( '#wp-calendar a', 'color', $accent );
			self::generate_css( '#wp-calendar a:hover', 'color', $accent );
			self::generate_css( '#wp-calendar thead', 'color', $accent );
			self::generate_css( '#wp-calendar tfoot a:hover', 'color', $accent );
			self::generate_css( '.tagcloud a:hover', 'background', $accent );
			self::generate_css( '.widget_garfunkel_recent_posts a:hover .title', 'color', $accent );
			self::generate_css( '.widget_garfunkel_recent_posts a:hover .post-icon', 'background', $accent );
			self::generate_css( '.widget_garfunkel_recent_comments a:hover .title', 'color', $accent );
			self::generate_css( '.widget_garfunkel_recent_comments a:hover .post-icon', 'background', $accent );
			self::generate_css( '.mobile-menu a:hover', 'background', $accent );
			self::generate_css( '.mobile-menu-container .menu-social a:hover', 'background', $accent );

			echo '</style>';
			echo '<!--/Customizer CSS-->';
			
		}

		public static function generate_css( $selector, $style, $value, $prefix = '', $postfix = '', $echo = true ) {
			$return = '';
			if ( ! empty( $value ) ) {
				$return = sprintf( '%s { %s:%s; }', $selector, $style, $prefix . $value . $postfix );
				if ( $echo ) echo $return;
			}
			return $return;
		}

	}
	add_action( 'customize_register', array( 'Garfunkel_Customize', 'register' ) );
	add_action( 'wp_head', array( 'Garfunkel_Customize', 'header_output' ) );
endif;