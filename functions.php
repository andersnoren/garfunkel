<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_setup' ) ) :
	function garfunkel_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		// Set content-width
		global $content_width;
		$content_width = 700;
			
		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1140, 9999 );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'quote', 'video' ) );

		// Custom header
		add_theme_support( 'custom-header', array(
			'width'         => 1440,
			'height'        => 960,
			'default-image' => get_template_directory_uri() . '/assets/images/bg.jpg',
			'uploads'       => true,
			'header-text'  	=> false
		) );

		// Custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
		
		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'type' 			=> 'scroll',
			'container'		=> 'posts',
			'footer' 		=> false,
		) );
		
		// Add support for title tag
		add_theme_support( 'title-tag' );

		// HTML5 semantic markup
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );

		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'garfunkel' ) );
		register_nav_menu( 'social', __( 'Social Menu', 'garfunkel' ) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'garfunkel', get_template_directory() . '/languages' );
		
	}
	add_action( 'after_setup_theme', 'garfunkel_setup' );
endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_load_javascript_files' ) ) :
	function garfunkel_load_javascript_files() {

		$theme_version = wp_get_theme( 'garfunkel' )->get( 'Version' );

		wp_register_script( 'garfunkel_flexslider', get_template_directory_uri() . '/assets/js/flexslider.js' );

		wp_enqueue_script( 'garfunkel_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'imagesloaded', 'masonry', 'garfunkel_flexslider' ), $theme_version, true );
		
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'garfunkel_load_javascript_files' );
endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_load_style' ) ) :
	function garfunkel_load_style() {

		if ( is_admin() ) return;

		$dependencies = array();
		$theme_version = wp_get_theme( 'garfunkel' )->get( 'Version' );

		wp_register_style( 'garfunkel_googleFonts', get_theme_file_uri( '/assets/css/fonts.css' ) );
		$dependencies[] = 'garfunkel_googleFonts';

		wp_register_style( 'garfunkel_genericons', get_template_directory_uri() . '/assets/css/genericons.min.css' );
		$dependencies[] = 'garfunkel_genericons';

		wp_enqueue_style( 'garfunkel_style', get_stylesheet_uri(), $dependencies, $theme_version );

	}
	add_action( 'wp_print_styles', 'garfunkel_load_style' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_add_editor_styles' ) ) :
	function garfunkel_add_editor_styles() {

		add_editor_style( array( 'assets/css/garfunkel-classic-editor-styles.css', 'assets/css/fonts.css' ) );

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
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>'
		)) ;	

		register_sidebar( array(
			'name' 			=> __( 'Footer B', 'garfunkel' ),
			'id' 			=> 'footer-b',
			'description' 	=> __( 'Widgets in this area will be shown in the middle column in the footer  of single posts and pages.', 'garfunkel' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>'
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer C', 'garfunkel' ),
			'id' 			=> 'footer-c',
			'description' 	=> __( 'Widgets in this area will be shown in the right column in the footer  of single posts and pages.', 'garfunkel' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>'
		) );

	}
	add_action( 'widgets_init', 'garfunkel_sidebar_registration' ); 
endif;


/* ---------------------------------------------------------------------------------------------
   INCLUDE REQUIRED FILES
   --------------------------------------------------------------------------------------------- */

// Customizer class
require_once( get_template_directory() . '/inc/classes/class-garfunkel-customize.php' );

// Widgets
require_once( get_template_directory() . '/inc/widgets/recent-comments.php' );
require_once( get_template_directory() . '/inc/widgets/recent-posts.php' );
require_once( get_template_directory() . '/inc/widgets/search-form.php' );


/* ---------------------------------------------------------------------------------------------
   REGISTER AND DEREGISTER WIDGETS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_widgets_init' ) ) :
	function garfunkel_widgets_init() {

		register_widget( 'garfunkel_search_form' );
		register_widget( 'garfunkel_recent_comments' );
		register_widget( 'garfunkel_recent_posts' );

		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_Recent_Posts' );
		unregister_widget( 'WP_Widget_Search' );

	}
	add_action( 'widgets_init', 'garfunkel_widgets_init' );
endif;


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

if ( ! function_exists( 'garfunkel_next_posts_link_attributes' ) ) :
	function garfunkel_next_posts_link_attributes() {

		return 'class="post-nav-older fleft"';

	}
	add_filter( 'next_posts_link_attributes', 'garfunkel_next_posts_link_attributes' );
endif;


if ( ! function_exists( 'garfunkel_previous_posts_link_attributes' ) ) :
	function garfunkel_previous_posts_link_attributes() {

		return 'class="post-nav-newer fright"';

	}
	add_filter( 'previous_posts_link_attributes', 'garfunkel_previous_posts_link_attributes' );
endif;


/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE TITLE
	Any changes to the archive title for different CPTs (like custom descriptions set in ACF)
	should be made in this function, since they then carry over to breadcrumbs, title/meta tag, etc.

	@param	$title string	The initial title
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_filter_archive_title' ) ) : 
	function garfunkel_filter_archive_title( $title ) {

		// Search: Show the search query
		if ( is_search() ) {
			/* Translators: %s = The search query */
			$title = sprintf( _x( 'Search Results: %s', '%s = The search query', 'garfunkel' ), '&ldquo;' . get_search_query() . '&rdquo;' );
		}

		// No title on home
		else if ( is_home() ) {
			$title = '';
		}

		return $title;
		
	}
	add_filter( 'get_the_archive_title', 'garfunkel_filter_archive_title' );
endif;


/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE DESCRIPTION
	Any changes to the archive description for different CPTs (like custom descriptions set in 
	ACF) should be made in this function, since they then carry over to breadcrumbs, meta tags etc.

	@param	$description string		The initial description
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_filter_archive_description' ) ) : 
	function garfunkel_filter_archive_description( $description ) {

		// Search: Show the search query
		if ( is_search() ) {
			global $wp_query;
			if ( $wp_query->found_posts ) {
				/* Translators: %s = Number of results */
				$description = sprintf( _x( 'We found %s results for your search.', $wp_query->found_posts, '%s = Number of results', 'garfunkel' ), $wp_query->found_posts );
			} else {
				$description = __( 'We could not find any results for your search.', 'garfunkel' );
			}
		}

		return $description;
		
	}
	add_filter( 'get_the_archive_description', 'garfunkel_filter_archive_description' );
endif;


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_body_classes' ) ) :
	function garfunkel_body_classes( $classes ) {

		// Has post thumbnail
		$classes[] = has_post_thumbnail() ? 'has-featured-image' : 'no-featured-image';

		// First page of home
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
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
   GARFUNKEL META FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_meta' ) ) :
	function garfunkel_meta() { 
		
		?>

		<div class="post-meta">

			<a class="post-meta-date" href="<?php the_permalink(); ?>">
				<div class="genericon genericon-time"></div>
				<span class="meta-text"><?php the_time( get_option( 'date_format' ) ); ?></span>
			</a>

			<?php if ( comments_open() ) : ?>
				<a class="post-meta-comments" href="<?php the_permalink(); ?>#comments">
					<div class="genericon genericon-comment"></div>
					<span class="meta-text"><?php comments_number( '0', '1', '%' ); ?></span>
				</a>
			<?php endif; ?>

		</div><!-- .post-meta -->
		
		<?php

	}
endif;


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER FUNCTION FOR FORMAT GALLERY
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_flexslider' ) ) :
	function garfunkel_flexslider( $size = 'thumbnail' ) {

		$attachment_parent = get_the_ID();

		$images = get_posts( array(
			'numberposts'    => -1, // show all
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => $attachment_parent,
			'post_type'      => 'attachment',
			'post_status'    => null,
			'post_mime_type' => 'image',
		) );

		if ( $images ) : ?>
		
			<div class="flexslider">
			
				<ul class="slides">
		
					<?php foreach ( $images as $image ) :

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
												
						<h3><?php comment_author_link(); ?></h3>
						
						<p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . '<span> &mdash; ' . get_comment_time() . '</span>'; ?></a></p>
											
					</div><!-- .comment-header -->

					<div class="comment-content post-content">
					
						<?php comment_text(); ?>
						
						<?php if ( 0 == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Awaiting moderation', 'garfunkel' ); ?></p>
						<?php endif; ?>
						
					</div><!-- .comment-content -->

					<?php

					$edit_comment_link = current_user_can( 'edit_comment', $comment->comment_ID ) ? '<a class="comment-edit-link" href="' . esc_url( get_edit_comment_link( $comment ) ) . '">' . __( 'Edit', 'garfunkel' ) . '</a>' : '';

					$reply_link = get_comment_reply_link( array_merge( $args, array( 
						'depth' 		=> $depth, 
						'max_depth' 	=> $args['max_depth'],
						'reply_text' 	=> __( 'Reply', 'garfunkel' ), 
					) ) );

					if ( $edit_comment_link || $reply_link ) : ?>
					
						<div class="comment-actions">
						
							<?php 
							echo $edit_comment_link . $reply_link;
							?>
												
						</div><!-- .comment-actions -->

					<?php endif; ?>
					
				</div><!-- .comment-inner -->

			</div><!-- .comment-## -->
		<?php
			break;
		endswitch;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY BLOCK EDITOR SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'garfunkel_block_editor_features' ) ) :
	function garfunkel_block_editor_features() {

		/* Block Editor Features ------------- */

		add_theme_support( 'align-wide' );

		/* Block Editor Palette -------------- */

		$accent_color = get_theme_mod( 'accent_color', '#ca2017' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Gutenberg palette', 'garfunkel' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'garfunkel' ),
				'slug' 	=> 'black',
				'color' => '#222',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Gutenberg palette', 'garfunkel' ),
				'slug' 	=> 'dark-gray',
				'color' => '#444',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Gutenberg palette', 'garfunkel' ),
				'slug' 	=> 'medium-gray',
				'color' => '#666',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Gutenberg palette', 'garfunkel' ),
				'slug' 	=> 'light-gray',
				'color' => '#888',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'garfunkel' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Block Editor Font Sizes ----------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Gutenberg', 'garfunkel' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'garfunkel' ),
				'size' 		=> 18,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the normal font size in Gutenberg', 'garfunkel' ),
				'shortName' => _x( 'N', 'Short name of the normal font size in the Gutenberg editor.', 'garfunkel' ),
				'size' 		=> 21,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Gutenberg', 'garfunkel' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'garfunkel' ),
				'size' 		=> 25,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Gutenberg', 'garfunkel' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'garfunkel' ),
				'size' 		=> 30,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'garfunkel_block_editor_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_block_editor_styles' ) ) :
	function garfunkel_block_editor_styles() {

		$theme_version = wp_get_theme( 'garfunkel' )->get( 'Version' );

		wp_register_style( 'garfunkel-block-editor-styles-font', get_theme_file_uri( '/assets/css/fonts.css' ) );
		wp_enqueue_style( 'garfunkel-block-editor-styles', get_theme_file_uri( '/assets/css/garfunkel-block-editor-styles.css' ), array( 'garfunkel-block-editor-styles-font' ), $theme_version, 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'garfunkel_block_editor_styles', 1 );
endif;
