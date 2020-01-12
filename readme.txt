=== Garfunkel ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.4
Tested up to: 5.0
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Installation ==

1. Upload the theme
2. Activate the theme

All theme specific options are handled through the WordPress Customizer.


== Licenses ==

Fira Sans
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Fira+Sans

Crimson Text
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Crimson+Text

Playfai Display
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Playfair+Display

Genericon font icon set
License: GNU GPL 2.0
Source: http://genericons.com

Standard header image
License: CC0 Public Domain 
Source: http://www.unsplash.com

Flexslider jQuery Slider
License: GNU GPL 2.0
Source: http://flexslider.woothemes.com


== Frequently Asked Questions ==


== Display the social menu in the navigation bar

1. Go to Admin > Appearance > Menus.
2. Create a new menu.
3. Click the "Links" dropdown in the left sidebar, and enter the URL and title of the social link you wish to include. The menu will automatically select the appropriate icon based on the domain name entered in the URL field.
4. Click "Add to Menu" to add it to the menu. Repeat for each link you wish to include.
5. Scroll down to "Menu Settings", and next to "Theme locations", select "Social Menu". Click save.
6. The menu will now be displayed on the site.

For a list of all social icons supported, visit http://genericons.com/.


== Use the gallery post format

1. Go to Admin > Posts > Add New.
2. Select the "Gallery" post format in the Post Attributes box.
3. Click "Add Media" and upload the images you wish to display in the gallery.
4. Close the Media window and publish/update the post.
5. The images you uploaded should now be displayed in the post gallery.


== Link Format

1. Create a new post.
2. Select "Link" in the Format window to the right.
3. In the post content, enter the title of your link within a paragraph element, and the link to the page in a link element.
4. Directly after the two elements, add the <!--more--> tag followed by the rest of the content. Example:

<p>[title]</p>
<a href="[url]">[website]</a>
<!--more-->
The rest of the content...

5. Publish.
6. The link title and link will now be displayed in a separate section from the content of your post.


== Quote Format

1. Create a new post.
2. Select "Quote" in the Format window to the right.
3. In the post content, enter the quote content within a blockquote element, and the quote attribution within a cite element.
4. Directly after the two elements, add the <!--more--> tag followed by the rest of the content. Example:

<blockquote>[quote content]
<cite>[quote attribution]</cite>
</blockquote>
<!--more-->
The rest of the content...

5. Publish.
6. The quote will now be displayed in a separate section from the content of your post.


== Video Format

1. Create a new post.
2. Select "Video" in the Format window to the right.
3. In the post content, enter the full url to the video you want to include.
4. Directly after the url, add the <!--more--> tag followed by the rest of the content. Example:

https://www.youtube.com/watch?v=iszwuX1AK6A
<!--more-->
The rest of the content...

5. Publish.
6. The video will now be displayed in a separate section from the content of your post.


== Changelog ==

Version 1.19 (2019-04-07)
-------------------------
- Added the new wp_body_open() function, along with a function_exists check

Version 1.18 (2019-01-24)
-------------------------
- Fixed the date output on the archive page template

Version 1.17 (2018-12-07)
-------------------------
- Fixed Gutenberg style changes required due to changes in the block editor CSS and classes
- Fixed the Classic Block TinyMCE buttons being set to the wrong font
- Adjusted color palette and custom Gutenberg font sizes 

Version 1.16 (2018-11-30)
-------------------------
- Fixed Gutenberg editor styles font being overwritten

Version 1.15 (2018-10-14)
-------------------------
- Fixed accent color for links in the Gutenberg editor styles

Version 1.14 (2018-10-14)
-------------------------
- Updated with Gutenberg support
	- Gutenberg editor styles
	- Styling of Gutenberg blocks
	- Custom Garfunkel Gutenberg palette
	- Custom Garfunkel Gutenberg typography styles
- Added option to disable Google Fonts with a translateable string
- Updated theme description
- Improved compatibility with < PHP 5.5
- Fixed incorrect Google Fonts kit being included for the editor styles
- Replaced minified Flexslider file with non-minified version
- Removed theme version of imagesLoaded and enqueued the bundled WP version instead
- Cleaned out some old vendor specific CSS

Version 1.13 (2018-05-24)
-------------------------
- Fixed styling of cookie checkbox in comments

Version 1.12 (2017-12-03)
-------------------------
- Updated author description on single to work with new wrapping paragraph

Version 1.11 (2017-11-26)
-------------------------
- Updated to the new readme.txt format, with changelog.txt incorporated into it
- Added a demo link to the stylesheet theme description
- Removed specific post types for add_theme_support( 'post-thumbnails' );
- Added a deliberate dependency order to the stylesheet enqueueing
- Made all functions in functions.php pluggable
- Replaced a query_posts() in widgets/recent-posts.php with a get_posts()
- Fixed notices when adding values to dribble-widget.php for the first time
- Same for scripts enqueues
- Fixed genericons path
- Simplified author role output in single.php and made it support other roles than the default WP ones
- Fixed notice in comments.php
- Fixed notice in single.php
- Improved output of author recent comments in the single.php post meta section
- Changed closing element comment structure
- General code cleanup, improvements in readability
- Removed duplicate comment-reply enqueueing from the header (already in functions)
- SEO improvements (title structure, mostly)
- Better handling of edge cases (missing title, missing content)
- Added word-break to titles on the archive template
- Restructured query on the archive page template

Version 1.10 (2016-06-28)
-------------------------
- Added the new theme directory tags

Version 1.09 (2016-03-12)
-------------------------
- Fixed respond input margins

Version 1.08 (2016-03-12)
-------------------------
- Removed the wp_title() function from header (replaced with title_tag())

Version 1.07 (2015-08-25)
-------------------------
- Fixed an issue with overflowing images
- Added the .screen-reader-text class

Version 1.06 (2015-08-20)
-------------------------
- Fixed the display of videos on single posts with the video post format

Version 1.05 (2015-08-11)
-------------------------
- Fixed the display of post excerpts in the quote post format

Version 1.04 (2015-08-11)
-------------------------
- Actually generated the new Swedish translation (important part)

Version 1.03 (2015-08-11)
-------------------------
- Replaced custom title function with title-tag support
- The widgets now use __construct()
- Fixed missing index notice for widget variables
- Removed post meta fields from functions.php
- Removed a shortcode function from functions.php
- Removed a function used for getting titles from URLs (no longer needed due to changes in format-video/-quote/-link)
- Added a sanitize callback for custom accent color and custom logo
- Stored the post meta element as a function in functions.php
- Modified how the post formats video, quote and link are edited and presented
- Updated readme.txt to reflect those changes
- Optimized translation strings
- Updated the Swedish translation
- Improved the presentation of the infinite scroll button

Version 1.02 (2014-09-26)
-------------------------
- Fixed a misplaced the_title() function call that caused links to break in the post meta

Version 1.01 (2014-08-25)
-------------------------
- Moved enqueue of comment-reply to functions.php

Version 1.0 (2014-07-XX)
-------------------------
