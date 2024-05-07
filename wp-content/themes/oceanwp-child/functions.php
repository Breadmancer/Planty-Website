<?php
/**
 * OceanWP Child Theme Functions
 *
 * When running a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions will be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );



/**
 * Hide admin link from non-admin users
 * Likely not an optimal way to do it, but I couldn't get an admin link to inject in the second position of the navigation menu.
 */
function hide_admin_link_from_nonadmin() {
	// Only hide the admin link from non-admin users.
	if ( ! current_user_can( 'administrator' ) ) {
		// Hide the admin link by injecting CSS using echo.
		echo '<style type="text/css"> .admin-link { display: none; } </style>';
	}
}

add_action( 'wp_head', 'hide_admin_link_from_nonadmin' );