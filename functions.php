<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_setup' ) ) :

	function garfunkel_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
			
		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'post-image', 1140, 9999 );
		add_image_size( 'post-thumbnail', 552, 9999 );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'quote', 'video' ) );

		// Custom header
		$args = array(
			'width'         => 1440,
			'height'        => 960,
			'default-image' => get_template_directory_uri() . '/images/bg.jpg',
			'uploads'       => true,
			'header-text'  	=> false
			
		);
		add_theme_support( 'custom-header', $args );
		
		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'type' 			=> 'scroll',
			'container'		=> 'posts',
			'footer' 		=> false,
		) );
		
		// Add support for title tag
		add_theme_support( 'title-tag' );

		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'garfunkel' ) );
		register_nav_menu( 'social', __( 'Social Menu', 'garfunkel' ) );
		
		// Make the theme translation ready
		load_theme_textdomain('garfunkel', get_template_directory() . '/languages');
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		
	}
	add_action( 'after_setup_theme', 'garfunkel_setup' );

endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_load_javascript_files' ) ) :

	function garfunkel_load_javascript_files() {

		if ( ! is_admin() ) {
			wp_register_script( 'garfunkel_imagesloaded', get_template_directory_uri().'/js/imagesloaded.pkgd.js', array('jquery'), '', true );
			wp_register_script( 'garfunkel_flexslider', get_template_directory_uri().'/js/flexslider.min.js', array('jquery'), '', true );

			wp_enqueue_script( 'garfunkel_global', get_template_directory_uri() . '/js/global.js', array( 'jquery', 'garfunkel_imagesloaded', 'masonry', 'garfunkel_flexslider' ), '', true );
			
			if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'garfunkel_load_javascript_files' );

endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_load_style' ) ) :

	function garfunkel_load_style() {
		if ( ! is_admin() ) {
			wp_register_style( 'garfunkel_googleFonts', '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,700italic|Playfair+Display:400,900|Crimson+Text:700,400italic,700italic,400' );
			wp_register_style( 'garfunkel_genericons', get_template_directory_uri() . '/genericons/genericons.css' );

			wp_enqueue_style( 'garfunkel_style', get_stylesheet_uri(), array( 'garfunkel_googleFonts', 'garfunkel_genericons' ) );
		}
	}
	add_action( 'wp_print_styles', 'garfunkel_load_style' );

endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_add_editor_styles' ) ) :

	function garfunkel_add_editor_styles() {
		add_editor_style( 'garfunkel-editor-style.css' );
		$font_url = '//fonts.googleapis.com/css?family=Roboto+Slab:400,700|Roboto:400,400italic,700,700italic,300';
		add_editor_style( str_replace( ',', '%2C', $font_url ) );
	}
	add_action( 'init', 'garfunkel_add_editor_styles' );

endif;


/* ---------------------------------------------------------------------------------------------
   ADD WIDGET AREAS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_sidebar_registration' ) ) :

	function garfunkel_sidebar_registration() {

		register_sidebar( array(
			'name' 			=> __( 'Footer A', 'garfunkel' ),
			'id' 			=> 'footer-a',
			'description' 	=> __( 'Widgets in this area will be shown in the left column in the footer of single posts and pages.', 'garfunkel' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		)) ;	

		register_sidebar( array(
			'name' 			=> __( 'Footer B', 'garfunkel' ),
			'id' 			=> 'footer-b',
			'description' 	=> __( 'Widgets in this area will be shown in the middle column in the footer  of single posts and pages.', 'garfunkel' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer C', 'garfunkel' ),
			'id' 			=> 'footer-c',
			'description' 	=> __( 'Widgets in this area will be shown in the right column in the footer  of single posts and pages.', 'garfunkel' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		) );

	}
	add_action( 'widgets_init', 'garfunkel_sidebar_registration' ); 

endif;


/* ---------------------------------------------------------------------------------------------
   ADD THEME WIDGETS
   --------------------------------------------------------------------------------------------- */


require_once( get_template_directory() . '/widgets/dribbble-widget.php' );
require_once( get_template_directory() . '/widgets/flickr-widget.php' );
require_once( get_template_directory() . '/widgets/recent-comments.php' );
require_once( get_template_directory() . '/widgets/recent-posts.php' );
require_once( get_template_directory() . '/widgets/search-form.php' );


/* ---------------------------------------------------------------------------------------------
   DELIST DEFAULT WIDGETS REPLACED BY OUR OWN
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_unregister_default_widgets' ) ) :

	function garfunkel_unregister_default_widgets() {
		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_Recent_Posts' );
		unregister_widget( 'WP_Widget_Search' );
	}
	add_action( 'widgets_init', 'garfunkel_unregister_default_widgets', 11 );

endif;


/* ---------------------------------------------------------------------------------------------
   SET CONTENT WIDTH
   --------------------------------------------------------------------------------------------- */


if ( ! isset( $content_width ) ) $content_width = 700;


/* ---------------------------------------------------------------------------------------------
   CHECK JAVASCRIPT SUPPORT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_html_js_class' ) ) :

	function garfunkel_html_js_class() {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'garfunkel_html_js_class', 1 );

endif;


/* ---------------------------------------------------------------------------------------------
   ADD PAGINATION CLASSES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_posts_link_attributes_1' ) ) :

	function garfunkel_posts_link_attributes_1() {
		return 'class="post-nav-older fleft"';
	}
	add_filter( 'next_posts_link_attributes', 'garfunkel_posts_link_attributes_1' );

endif;


if ( ! function_exists( 'garfunkel_posts_link_attributes_2' ) ) :

	function garfunkel_posts_link_attributes_2() {
		return 'class="post-nav-newer fright"';
	}
	add_filter( 'previous_posts_link_attributes', 'garfunkel_posts_link_attributes_2' );

endif;


/* ---------------------------------------------------------------------------------------------
   MOBILE MENU WALKER
   --------------------------------------------------------------------------------------------- */


class garfunkel_nav_walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
            $element->classes[] = 'has-children';
        }
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_body_classes' ) ) :

	function garfunkel_body_classes( $classes ) {

		// Has post thumbnail
		$classes[] = has_post_thumbnail() ? 'has-featured-image' : 'no-featured-image';

		// First page of home
		$paged = get_query_var( 'paged' ) ?: 1;
		if ( is_home() && ( $paged == 1 ) ) {
			$classes[] = 'home-first-page';
		}
		
		// Check for mobile
		if ( wp_is_mobile() ) {
			$classes[] = 'is_mobile';
		}

		// Add class for singular
		if ( is_singular() || is_404() ) {
			$classes[] = 'single-post';
		}

		return $classes;
	}
	add_action( 'body_class', 'garfunkel_body_classes' );

endif;


/* ---------------------------------------------------------------------------------------------
   CHANGE EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_custom_excerpt_length' ) ) :

	function garfunkel_custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'garfunkel_custom_excerpt_length', 999 );

endif;


/* ---------------------------------------------------------------------------------------------
   CHANGE EXCERPT SUFFIX
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_new_excerpt' ) ) :

	function garfunkel_new_excerpt( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'garfunkel_new_excerpt' );

endif;


/* ---------------------------------------------------------------------------------------------
   ADD CLASS TO EXCERPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_add_class_to_excerpt' ) ) :

	function garfunkel_add_class_to_excerpt( $excerpt ) {
		return str_replace( '<p', '<p class="post-excerpt"', $excerpt );
	}
	add_filter( 'the_excerpt', 'garfunkel_add_class_to_excerpt' );

endif;


/* ---------------------------------------------------------------------------------------------
   GET COMMENT EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_get_comment_excerpt' ) ) :

	function garfunkel_get_comment_excerpt( $comment_ID = 0, $num_words = 20 ) {
		$comment = get_comment( $comment_ID );
		$comment_text = strip_tags( $comment->comment_content );
		$blah = explode( ' ', $comment_text );
		if ( count( $blah ) > $num_words ) {
			$k = $num_words;
			$use_dotdotdot = 1;
		} else {
			$k = count( $blah );
			$use_dotdotdot = 0;
		}
		$excerpt = '';
		for ( $i = 0; $i < $k; $i++ ) {
			$excerpt .= $blah[$i] . ' ';
		}
		$excerpt .= ( $use_dotdotdot ) ? '...' : '';
		return apply_filters( 'get_comment_excerpt', $excerpt );
	}

endif;


/* ---------------------------------------------------------------------------------------------
   ADMIN CSS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_admin_css' ) ) :

	function garfunkel_admin_css() {
	echo '<style type="text/css">
	
	#postimagediv #set-post-thumbnail img {
		max-width: 100%;
		height: auto;
	}

			</style>';
	}

	add_action( 'admin_head', 'garfunkel_admin_css' );

endif;


/* ---------------------------------------------------------------------------------------------
   GARFUNKEL META FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_meta' ) ) :

	function garfunkel_meta() { ?>

		<div class="post-meta">

			<a class="post-meta-date" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<div class="genericon genericon-time"></div>
				<?php the_time( get_option( 'date_format' ) ); ?>
			</a>

			<?php if ( comments_open() ) : ?>
				<a class="post-meta-comments" href="<?php the_permalink(); ?>#comments" title="<?php printf( __( '%s comments to %s', 'garfunkel' ), get_comments_number(), the_title_attribute( array( 'echo' => false ) ) ); ?>">
					<div class="genericon genericon-comment"></div>
					<?php comments_number( '0', '1', '%'); ?>
				</a>
			<?php endif; ?>

			<div class="clear"></div>

		</div><!-- .post-meta -->
		
		<?php
	}

endif;


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER FUNCTION FOR FORMAT GALLERY
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_flexslider' ) ) :

	function garfunkel_flexslider( $size = 'thumbnail' ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		$image_args = array(
			'numberposts'    => -1, // show all
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => $attachment_parent,
			'post_type'      => 'attachment',
			'post_status'    => null,
			'post_mime_type' => 'image',
		);

		$images = get_posts( $image_args );

		if ( $images ) : ?>
		
			<div class="flexslider">
			
				<ul class="slides">
		
					<?php foreach( $images as $image ) :

						$attimg = wp_get_attachment_image( $image->ID, $size ); ?>
						
						<li>
							<?php 
							echo $attimg;
							if ( ! empty( $image->post_excerpt ) && is_single() ) : ?>
								<div class="media-caption-container">
									<p class="media-caption"><?php echo $image->post_excerpt; ?></p>
								</div>
							<?php endif; ?>
						</li>
						
					<?php endforeach; ?>
			
				</ul>
				
			</div>
			
			<?php
			
		endif;
	}

endif;


/* ---------------------------------------------------------------------------------------------
   GARFUNKEL COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_comment' ) ) :

	function garfunkel_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'garfunkel' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'garfunkel' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
			
				<?php echo get_avatar( $comment, 80 ); ?>
			
				<div class="comment-inner">

					<div class="comment-header">
												
						<h4><?php comment_author_link(); ?></h4>
						
						<p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . '<span> &mdash; ' . get_comment_time() . '</span>'; ?></a></p>
											
					</div><!-- .comment-header -->

					<div class="comment-content post-content">
					
						<?php comment_text(); ?>
						
						<?php if ( 0 == $comment->comment_approved ) : ?>
						
							<p class="comment-awaiting-moderation"><?php _e( 'Awaiting moderation', 'garfunkel' ); ?></p>
							
						<?php endif; ?>
						
					</div><!-- .comment-content -->
					
					<div class="comment-actions">
					
						<?php 
						
						edit_comment_link( __( 'Edit', 'garfunkel' ), '', '' );
						
						comment_reply_link( array_merge( 
							$args, 
							array( 
								'depth' 		=> $depth, 
								'max_depth' 	=> $args['max_depth'],
								'reply_text' 	=> __( 'Reply', 'garfunkel' ), 
							) 
						) ); 
						
						?>
						
						<div class="clear"></div>
					
					</div><!-- .comment-actions -->
					
				</div><!-- .comment-inner -->

			</div><!-- .comment-## -->
		<?php
			break;
		endswitch;
	}
endif;


/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER SETTINGS
   --------------------------------------------------------------------------------------------- */


class Garfunkel_Customize {

   public static function register ( $wp_customize ) {
   
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'garfunkel_options', 
         array(
            'title' 		=> __( 'Garfunkel Options', 'garfunkel' ), //Visible title of section
            'priority' 		=> 35, //Determines what order this appears in
            'capability' 	=> 'edit_theme_options', //Capability needed to tweak
            'description' 	=> __('Allows you to customize settings for Garfunkel.', 'garfunkel'), //Descriptive tooltip
         ) 
      );
      
      $wp_customize->add_section( 'garfunkel_logo_section' , array(
		    'title'       => __( 'Logo', 'garfunkel' ),
		    'priority'    => 40,
		    'description' => 'Upload a logo to replace the default site name and description in the header',
		) );
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'accent_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' 			=> '#ca2017', //Default setting/value to save
            'type' 				=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' 		=> 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' 		=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      		'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );
      
      // Add logo setting and sanitize it
      $wp_customize->add_setting( 'garfunkel_logo', 
      	array( 
      		'sanitize_callback' => 'esc_url_raw'
      	) 
      );
                  
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'garfunkel_accent_color', //Set a unique ID for the control
         array(
            'label' 	=> __( 'Accent Color', 'garfunkel' ), //Admin-visible name of the control
            'section' 	=> 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' 	=> 'accent_color', //Which setting to load and manipulate (serialized is okay)
            'priority' 	=> 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'garfunkel_logo', array(
		    'label'   	=> __( 'Logo', 'garfunkel' ),
		    'section' 	=> 'garfunkel_logo_section',
		    'settings'	=> 'garfunkel_logo',
		) ) );
      
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
   }

   public static function header_output() {
      ?>
      
	      <!--Customizer CSS--> 
	      
	      <style type="text/css">
	           <?php self::generate_css('body a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('body a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.blog-title a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.menu-social a:hover', 'background-color', 'accent_color'); ?>
	           <?php self::generate_css('.sticky.post .is-sticky', 'background-color', 'accent_color'); ?>
	           <?php self::generate_css('.sticky.post .is-sticky:before', 'border-top-color', 'accent_color'); ?>
	           <?php self::generate_css('.sticky.post .is-sticky:before', 'border-left-color', 'accent_color'); ?>
	           <?php self::generate_css('.sticky.post .is-sticky:after', 'border-top-color', 'accent_color'); ?>
	           <?php self::generate_css('.sticky.post .is-sticky:after', 'border-right-color', 'accent_color'); ?>
	           <?php self::generate_css('.post-title a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.post-quote', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.post-link', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.post-content a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.post-content a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.post-content fieldset legend', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.post-content input[type="button"]:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.post-content input[type="reset"]:hover', 'background', 'accent_color'); ?>	           
	           <?php self::generate_css('.post-content input[type="submit"]:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.post-nav-fixed a:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.tab-post-meta .post-nav a:hover h4', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.post-info-items a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.page-links a', 'color', 'accent_color'); ?>	           
	           <?php self::generate_css('.page-links a:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.author-name a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.content-by', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.author-content a:hover .title', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.author-content a:hover .post-icon', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.comment-notes a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.comment-notes a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.content #respond input[type="submit"]', 'background-color', 'accent_color'); ?>
	           <?php self::generate_css('.comment-header h4 a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.bypostauthor > .comment:before', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.comment-actions a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('#cancel-comment-reply-link', 'color', 'accent_color'); ?>
	           <?php self::generate_css('#cancel-comment-reply-link:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.comments-nav a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget-title a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget-title a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_text a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_text a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_rss li a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_archive li a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_meta li a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_pages li a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_links li a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_categories li a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_rss .widget-content ul a.rsswidget:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('#wp-calendar a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('#wp-calendar a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('#wp-calendar thead', 'color', 'accent_color'); ?>
	           <?php self::generate_css('#wp-calendar tfoot a:hover', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.tagcloud a:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.widget_garfunkel_recent_posts a:hover .title', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_garfunkel_recent_posts a:hover .post-icon', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.widget_garfunkel_recent_comments a:hover .title', 'color', 'accent_color'); ?>
	           <?php self::generate_css('.widget_garfunkel_recent_comments a:hover .post-icon', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.mobile-menu a:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('.mobile-menu-container .menu-social a:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('body#tinymce.wp-editor a', 'color', 'accent_color'); ?>
	           <?php self::generate_css('body#tinymce.wp-editor fieldset legend', 'background', 'accent_color'); ?>
	           <?php self::generate_css('body#tinymce.wp-editor input[type="submit"]:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('body#tinymce.wp-editor input[type="reset"]:hover', 'background', 'accent_color'); ?>
	           <?php self::generate_css('body#tinymce.wp-editor input[type="button"]:hover', 'background', 'accent_color'); ?>
	      </style> 
	      
	      <!--/Customizer CSS-->
	      
      <?php
   }
   
   public static function live_preview() {
      wp_enqueue_script( 'garfunkel_themecustomizer', get_template_directory_uri() . '/js/theme-customizer.js', array(  'jquery', 'customize-preview' ), '', true );
   }

   public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Garfunkel_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'Garfunkel_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Garfunkel_Customize' , 'live_preview' ) );

?>