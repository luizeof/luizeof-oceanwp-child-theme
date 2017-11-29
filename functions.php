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
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

 /**
 * Add Lead Class to First Paragraph
 */


require_once "landing-pages-custom-post-type.php";

require_once "thankyou-pages-custom-post-type.php";

function first_paragraph( $content ) {
	return preg_replace( '/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1 );
}
add_filter( 'the_content', 'first_paragraph' );

 /**
 * Excluding pages from search
 */
function exclude_pages_from_search() {
	global $wp_post_types;
	$wp_post_types['page']->exclude_from_search = true;
}
add_action( 'init', 'exclude_pages_from_search' );


 /**
 * Add Custom Excerpt to Pages
 */
function add_page_excerpt() {
	add_post_type_support( 'page', array( 'excerpt' ) );
}
add_action( 'init', 'add_page_excerpt' );


 /**
 * Add Tags for Attachments
 */
function add_tags_for_attachments() {
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'add_tags_for_attachments' );


 /**
 * Add Categories for Attachments
 */
function add_categories_for_attachments() {
	register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'add_categories_for_attachments' );

 /**
 * Remove All Dashboard Widgets
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts'] );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

 /**
 * Hide WordPress Update Nag to All But Admins
 */
function hide_update_notice_to_all_but_admin() {
	if ( !current_user_can( 'update_core' ) ) {
		remove_action( 'admin_notices', 'update_nag', 3 );
	}
}
add_action( 'admin_head', 'hide_update_notice_to_all_but_admin', 1 );


 /**
  * Add the OceanWP Settings metabox in your CPT by Powertic
  */
 function powertic_oceanwp_metabox( $types ) {


  foreach ( get_post_types( '', 'names' ) as $post_type ) {
    $types[] = $post_type;
  }

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
