<?php
//////////////////////////////////////////////////////////////////
// Set Content Width
//////////////////////////////////////////////////////////////////
if ( ! isset( $content_width ) )
	$content_width = 1170;
	
//////////////////////////////////////////////////////////////////
// Theme set up
//////////////////////////////////////////////////////////////////
add_action( 'after_setup_theme', 'themewagon_theme_setup' );

if ( !function_exists('themewagon_theme_setup') ) {

	function themewagon_theme_setup() {
	
		// Register navigation menu
		register_nav_menus(
			array(
				'main-menu' => 'Primary Menu',
			)
		);
		
		// Localization support
		load_theme_textdomain('forkspoon', get_template_directory() . '/lang');


		//Title Tag
		add_theme_support( 'title-tag' );

		if ( ! function_exists( '_wp_render_title_tag' ) ) {
			function theme_slug_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
			}
			add_action( 'wp_head', 'theme_slug_render_title' );
		}


		
		// Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
		
		// Featured image
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'full-thumb', 1100, 1550, true );
		
		// Feed Links
		add_theme_support( 'automatic-feed-links' );
	
	}

}

//////////////////////////////////////////////////////////////////
// Register & enqueue styles/scripts
//////////////////////////////////////////////////////////////////

add_action( 'wp_enqueue_scripts','themewagon_load_scripts' );

function themewagon_load_scripts() {

	// Register scripts and styles
	wp_register_style('bootstrap', get_stylesheet_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css');
	wp_register_style('fs_style', get_stylesheet_directory_uri() . '/style.css');
	wp_register_style('fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_register_style('bxslider-css', get_template_directory_uri() . '/css/jquery.bxslider.css');
	wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css');
	
	wp_register_script('slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', 'jquery', '', true);
	wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', 'jquery', '', true);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/fitvids.js', 'jquery', '', true);
	wp_register_script('fs_scripts', get_template_directory_uri() . '/js/main.js', 'jquery', '', true);
	
	// Enqueue scripts and styles
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('fs_style');
	wp_enqueue_style('fontawesome-css');
	wp_enqueue_style('bxslider-css');
	
	// Fonts
	wp_enqueue_style('default_body_font', 'http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin,latin-ext');
	wp_enqueue_style('default_heading_font', 'https://fonts.googleapis.com/css?family=Playfair+Display:700,700italic');
	
	// JS
	wp_enqueue_script('jquery');
	wp_enqueue_script('slicknav');
	wp_enqueue_script('bxslider');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('fs_scripts');
	
	if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');
	
}

//////////////////////////////////////////////////////////////////
// Include files
//////////////////////////////////////////////////////////////////

// Theme Options
include('functions/customizer/fs_custom_controller.php');
include('functions/customizer/fs_customizer_settings.php');
include('functions/customizer/fs_customizer_style.php');

// Widgets
include("inc/widgets/about_widget.php");
include("inc/widgets/banner_widget.php");
include("inc/widgets/social_widget.php");
include("inc/widgets/post_widget.php");
include("inc/widgets/facebook_widget.php");


//////////////////////////////////////////////////////////////////
// Register widgets
//////////////////////////////////////////////////////////////////
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Instagram Footer',
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="instagram-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="instagram-title">',
		'after_title' => '</h4>',
		'description' => 'Use the "Instagram" widget here. IMPORTANT: For best result set number of photos to 8.',
	));
}


//////////////////////////////////////////////////////////////////
// COMMENTS LAYOUT
//////////////////////////////////////////////////////////////////

	function themewagon_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			
			<div class="thecomment">
						
				<div class="author-img">
					<?php echo get_avatar($comment,$args['avatar_size']); ?>
				</div>
				
				<div class="comment-text">
					<span class="reply">
						<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'forkspoon'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
						<?php edit_comment_link(__('Edit', 'forkspoon')); ?>
					</span>
					<h6 class="author"><?php echo get_comment_author_link(); ?></h6>
					<span class="date"><?php printf(__('%1$s at %2$s', 'forkspoon'), get_comment_date(),  get_comment_time()) ?></span>
					<?php if ($comment->comment_approved == '0') : ?>
						<em><i class="icon-info-sign"></i> <?php _e('Comment awaiting approval', 'forkspoon'); ?></em>
						<br />
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>
						
			</div>
			
			
		</li>

		<?php 
	}
	
//////////////////////////////////////////////////////////////////
// PAGINATION
//////////////////////////////////////////////////////////////////
function themewagon_pagination() {
	
	?>
	
	<div class="pagination">

		<div class="older"><?php next_posts_link(__( '<i class="fa fa-angle-double-left"></i>', 'forkspoon')); ?></div>
		<div class="newer"><?php previous_posts_link(__( '<i class="fa fa-angle-double-right"></i>', 'forkspoon')); ?></div>
		
	</div>
					
	<?php
	
}

//////////////////////////////////////////////////////////////////
// PREVENT SCROLL ON READ MORE LINK
//////////////////////////////////////////////////////////////////
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


//////////////////////////////////////////////////////////////////
// AUTHOR SOCIAL LINKS
//////////////////////////////////////////////////////////////////
function themewagon_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = 'Twitter Username';
	$contactmethods['facebook']  = 'Facebook Username';
	$contactmethods['google']    = 'Google Plus Username';
	$contactmethods['tumblr']    = 'Tumblr Username';
	$contactmethods['instagram'] = 'Instagram Username';
	$contactmethods['pinterest'] = 'Pinterest Username';

	return $contactmethods;
}
add_filter('user_contactmethods','themewagon_contactmethods',10,1);


//////////////////////////////////////////////////////////////////
// TITLE TAG
//////////////////////////////////////////////////////////////////
function themewagon_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'forkspoon' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'themewagon_wp_title', 10, 2 );

//////////////////////////////////////////////////////////////////
// TWITTER AMPERSAND ENTITY DECODE
//////////////////////////////////////////////////////////////////
function themewagon_social_title( $title ) {
    $title = html_entity_decode( $title );
    $title = urlencode( $title );
    return $title;
}

//////////////////////////////////////////////////////////////////
// THE EXCERPT
//////////////////////////////////////////////////////////////////
function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function fs_string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	
	if(count($words) > $word_limit) {
		array_pop($words);
	}
	
	return implode(' ', $words);
}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.4.1
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Vafpress Post Formats UI', // The plugin name
			'slug'     				=> 'vafpress-post-formats-ui', // The plugin slug (typically the folder name)
			'source'   				=> 'https://github.com/vafour/vafpress-post-formats-ui/archive/1.3.1.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'WP Instagram Widget', // The plugin name
			'slug'     				=> 'wp-instagram-widget', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Responsive Lightbox by dFactory', // The plugin name
			'slug'     				=> 'responsive-lightbox', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Mailchimp for wordpress', // The plugin name
			'slug'     				=> 'mailchimp-for-wp', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)

	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'forkspoon',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'forkspoon' ),
			'menu_title'                       			=> __( 'Install Plugins', 'forkspoon' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'forkspoon' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'forkspoon' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'forkspoon'), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'forkspoon' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'forkspoon' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'forkspoon' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'forkspoon' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'forkspoon' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'forkspoon'), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'forkspoon' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'forkspoon' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'forkspoon' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'forkspoon' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'forkspoon' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'forkspoon' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}



//Demo only functions
if (isset($_GET['sidebar'])) {
	set_theme_mod('fs_sidebar_homepage', true);
	set_theme_mod('fs_sidebar_post', true);
}
else{
	set_theme_mod('fs_sidebar_homepage', false);
	set_theme_mod('fs_sidebar_post', false);
}

if (isset($_GET['home_layout'])) {
	set_theme_mod('fs_home_layout', $_GET['home_layout']);
}
else{
	set_theme_mod('fs_home_layout', 'full_grid');
}