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
 * Text Domain: luizeof_oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

 /**
 * Add Lead Class to First Paragraph
 */
function luizeof_oceanwp_first_paragraph( $content ) {
	return preg_replace( '/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1 );
}
add_filter( 'the_content', 'luizeof_oceanwp_first_paragraph' );


 /**
 * Add Tags for Attachments
 */
function luizeof_oceanwp_add_tags_for_attachments() {
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'luizeof_oceanwp_add_tags_for_attachments' );


 /**
 * Add Categories for Attachments
 */
function luizeof_oceanwp_add_categories_for_attachments() {
	register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'luizeof_oceanwp_add_categories_for_attachments' );


 /**
  * Add the OceanWP Settings metabox in all your CPT
  */
 function luizeof_oceanwp_metabox( $types ) {
  foreach ( get_post_types( '', 'names' ) as $post_type ) {
    $types[] = $post_type;
  }
	return $types;
 }
 add_filter( 'ocean_main_metaboxes_post_types', 'luizeof_oceanwp_metabox', 20 );


/**
 * Load the parent style.css file
 */
function oceanwp_child_enqueue_parent_style() {
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

