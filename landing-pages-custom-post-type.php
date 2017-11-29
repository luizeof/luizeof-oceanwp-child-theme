<?php

/**
 * Post Type: Landing Pages.
 */
function powertic_oceanwp_register_cpts_landing_pages() {

	$labels = array(
		"name" => __( "Landing Pages", "powertic_oceanwp" ),
		"singular_name" => __( "Landing Page", "powertic_oceanwp" ),
	);

	$args = array(
		"label" => __( "Landing Pages", "powertic_oceanwp" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "page",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "landing-pages", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 7,
		"menu_icon" => "dashicons-welcome-add-page",
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats" ),
	);

	register_post_type( "landing_pages", $args );
}

add_action( 'init', 'powertic_oceanwp_register_cpts_landing_pages' );
