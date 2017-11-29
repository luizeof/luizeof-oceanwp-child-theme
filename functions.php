<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: powertic_oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

 /**
 * Add Lead Class to First Paragraph
 */


include "landing-pages-custom-post-type.php";

include "thankyou-pages-custom-post-type.php";

function powertic_oceanwp_first_paragraph( $content ) {
	return preg_replace( '/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1 );
}
add_filter( 'the_content', 'powertic_oceanwp_first_paragraph' );


 /**
 * Add Tags for Attachments
 */
function powertic_oceanwp_add_tags_for_attachments() {
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'powertic_oceanwp_add_tags_for_attachments' );


 /**
 * Add Categories for Attachments
 */
function powertic_oceanwp_add_categories_for_attachments() {
	register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'powertic_oceanwp_add_categories_for_attachments' );


 /**
  * Add the OceanWP Settings metabox in your CPT by Powertic
  */
 function powertic_oceanwp_metabox( $types ) {
  foreach ( get_post_types( '', 'names' ) as $post_type ) {
    $types[] = $post_type;
  }
	$types[] = "landing-pages";
	$types[] = "thankyou-pages";
 	// Return
 	return $types;
 }
 add_filter( 'ocean_main_metaboxes_post_types', 'powertic_oceanwp_metabox', 20 );


/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
    // If RTL, uncomment this line
    /*if ( is_rtl() ) {
		wp_enqueue_style( 'oceanwp-rtl', get_template_directory_uri() . '/rtl.css', array(), $version );
	}*/

}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );


require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/powerticmkt/powertic-oceanwp-child-theme/',
	__FILE__,
	'powertic-oceanwp-child-theme'
);

//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
