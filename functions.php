<?php
/**
 * Full Scale Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Full Scale
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_FULL_SCALE_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	// create my own version codes
    $fs_css_ver 		= date("ymd-Gis", filemtime( get_stylesheet_directory() . '/style.css' ));
	$fs_script_ver  	= date("ymd-Gis", filemtime( get_stylesheet_directory() . '/js/scripts.js' ));

	$fs_slick_css_ver 			= date("ymd-Gis", filemtime( get_stylesheet_directory() . '/css/slick.css' ));
	$fs_slick_js_ver  			= date("ymd-Gis", filemtime( get_stylesheet_directory() . '/js/slick.min.js' ));
	$fs_slick_carousel_js_ver  	= date("ymd-Gis", filemtime( get_stylesheet_directory() . '/js/slick.min.js' ));
	
	global $post;

	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'talents') ) {
		wp_enqueue_style( 'fullscale-slick-css', get_stylesheet_directory_uri() . '/css/slick.css', [], $fs_slick_css_ver, 'all' );
		
		wp_enqueue_script( 'fullscale-slick-script', get_stylesheet_directory_uri() . '/js/slick.min.js', [], $fs_slick_js_ver, true );
		wp_enqueue_script( 'fullscale-slick-carousel-script', get_stylesheet_directory_uri() . '/js/slick-carousel.js', [], $fs_slick_carousel_js_ver, true );
	}

	wp_enqueue_style( 'fullscale-style-css', get_stylesheet_directory_uri() . '/style.css', ['astra-theme-css'], $fs_css_ver, 'all' );
	wp_enqueue_script( 'fullscale-script-script', get_stylesheet_directory_uri() . '/js/scripts.js', [], $fs_script_ver, true );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

/**
 * 
 * Added by: JJ
 */
 
/**
 * Filter to change the schema data.
 */
add_filter( "rank_math/snippet/rich_snippet_article_entity", function ( $entity ) {
	if ( isset( $entity['author'] ) ) {
		unset( $entity['author'] );

		return $entity;
	}

	return $entity;
} );

/**
 * Allows user to change the OpenGraph type of the page.
 * @param string $type The OpenGraph type string.
 */
add_filter( 'rank_math/opengraph/type', function( $type ) {
	if ( is_page( array( 'investments', 'getting-started', 'startup-hustle', 'contact-us', 'careers', 'sitemap', 'privacy-policy', 'why-cebu-city' ) ) ) {
		return "website";
	}
	
	return $type;
});


/**
 * 
 * Added by: rsutana@fullscale.io
 * 17-08-2022
 */

/**
 * Load additional theme custom functions
 */
require get_stylesheet_directory() . '/inc/fs-functions.php';
 
/**
 * Load Filters file for this theme.
 */
require get_stylesheet_directory() . '/inc/post-types.php';
 
/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Load Shortocde file for this theme
 */
require get_stylesheet_directory() . '/inc/shortcodes.php';

/**
 * Load AJAX file for this theme
 */
require get_stylesheet_directory() . '/inc/ajax.php';

/**
 * Load Actions file for this theme.
 */
require get_stylesheet_directory() . '/inc/actions.php';