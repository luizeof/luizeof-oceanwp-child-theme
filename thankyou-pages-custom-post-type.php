<?php

/**
 * Post Type: Agradecimentos.
 */
function powertic_oceanwp_register_cpts_thankyou_pages() {

	$labels = array(
		"name" => __( "Agradecimentos", "powertic_oceanwp" ),
		"singular_name" => __( "Agradecimento", "powertic_oceanwp" ),
	);

	$args = array(
		"label" => __( "Agradecimentos", "powertic_oceanwp" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "page",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "obrigado", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 8,
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats" ),
	);

	register_post_type( "thankyou_pages", $args );
}

add_action( 'init', 'powertic_oceanwp_register_cpts_thankyou_pages' );
