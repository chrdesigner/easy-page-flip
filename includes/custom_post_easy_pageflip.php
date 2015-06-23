<?php
// Registers the new post type and taxonomy
add_action( 'init', 'custom_post_easy_pageflip' );
function custom_post_easy_pageflip() {
	register_post_type( 'pageflip',
		array(
			'labels' => array(
				'name' => __( 'Magazines' , 'easy-page-flip' ),
				'singular_name' => __( 'Magazine' , 'easy-page-flip'  ),
				'add_new' => __( 'Add New' , 'easy-page-flip'  ),
				'add_new_item' => __( 'Add New Magazine' , 'easy-page-flip'  ),
				'edit_item' => __( 'Edit Magazine' , 'easy-page-flip'  ),
				'new_item' => __( 'Add New Magazine' , 'easy-page-flip'  ),
				'view_item' => __( 'View Magazine' , 'easy-page-flip'  ),
				'search_items' => __( 'Search Magazines' , 'easy-page-flip'  ),
				'not_found' => __( 'Not found' , 'easy-page-flip'  ),
				'not_found_in_trash' => __( 'Not found in Trash' , 'easy-page-flip'  )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail'),
			'capability_type' => 'post',
			'menu_icon' => '',
			'menu_position' => 5,
			'register_meta_box_cb' => 'pageflip_meta_box',
            'has_archive' => true
		)
	);
}