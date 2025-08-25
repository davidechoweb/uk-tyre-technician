<?php
/**********************************************************
 *
 * File:         Custom Post Types
 * Description:  Register the custom post types
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:
 *
 **********************************************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action( 'init', function() {
	register_post_type( 'echo_reviews', array(
		'labels' => array(
			'name' => 'Reviews',
			'singular_name' => 'Review',
			'menu_name' => 'Reviews',
			'all_items' => 'All Reviews',
			'edit_item' => 'Edit Review',
			'view_item' => 'View Review',
			'view_items' => 'View Reviews',
			'add_new_item' => 'Add New Review',
			'new_item' => 'New Review',
			'parent_item_colon' => 'Parent Review:',
			'search_items' => 'Search Reviews',
			'not_found' => 'No Reviews found',
			'not_found_in_trash' => 'No Reviews found in the bin',
			'archives' => 'Review Archives',
			'attributes' => 'Review Attributes',
			'insert_into_item' => 'Insert into Review',
			'uploaded_to_this_item' => 'Uploaded to this Review',
			'filter_items_list' => 'Filter Reviews list',
			'filter_by_date' => 'Filter Reviews by date',
			'items_list_navigation' => 'Reviews list navigation',
			'items_list' => 'Reviews list',
			'item_published' => 'Review published.',
			'item_published_privately' => 'Review published privately.',
			'item_reverted_to_draft' => 'Review reverted to draft.',
			'item_scheduled' => 'Review scheduled.',
			'item_updated' => 'Review updated.',
			'item_link' => 'Review Link',
			'item_link_description' => 'A link to a Review.',
		),
		'public' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-editor-quote',
		'supports' => array(
			0 => 'title',
			1 => 'excerpt',
		),
		'has_archive' => 'Reviews',
		'rewrite' => array(
			'slug' => 'reviews',
			'with_front' => false,
			'pages' => false,
		),
		'can_export' => false,
		'delete_with_user' => false,
	) );

	register_post_type( 'echo_case_studies', array(
		'labels' => array(
			'name' => 'Case Studies',
			'singular_name' => 'Case Study',
			'menu_name' => 'Case Studies',
			'all_items' => 'All Case Studies',
			'edit_item' => 'Edit Case Study',
			'view_item' => 'View Case Study',
			'view_items' => 'View Case Studies',
			'add_new_item' => 'Add New Case Study',
			'new_item' => 'New Case Study',
			'parent_item_colon' => 'Parent Case Study:',
			'search_items' => 'Search Case Studies',
			'not_found' => 'No Case Studies found',
			'not_found_in_trash' => 'No Case Studies found in the bin',
			'archives' => 'Case Study Archives',
			'attributes' => 'Case Study Attributes',
			'insert_into_item' => 'Insert into Case Study',
			'uploaded_to_this_item' => 'Uploaded to this Case Study',
			'filter_items_list' => 'Filter Case Studies list',
			'filter_by_date' => 'Filter Case Studies by date',
			'items_list_navigation' => 'Case Studies list navigation',
			'items_list' => 'Case Studies list',
			'item_published' => 'Case Study published.',
			'item_published_privately' => 'Case Study published privately.',
			'item_reverted_to_draft' => 'Case Study reverted to draft.',
			'item_scheduled' => 'Case Study scheduled.',
			'item_updated' => 'Case Study updated.',
			'item_link' => 'Case Study Link',
			'item_link_description' => 'A link to a Case Study.',
		),
		'public' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-editor-quote',
		'supports' => array(
			0 => 'title',
			1 => 'excerpt',
		),
		'has_archive' => 'Case Studies',
		'rewrite' => array(
			'slug' => 'case-studies',
			'with_front' => false,
			'pages' => false,
		),
		'can_export' => false,
		'delete_with_user' => false,
	) );


	register_post_type( 'echo_teams', array(
		'labels' => array(
			'name' => 'Team Members',
			'singular_name' => 'Team Member',
			'menu_name' => 'Team Members',
			'all_items' => 'All Team Members',
			'edit_item' => 'Edit Team Member',
			'view_item' => 'View Team Member',
			'view_items' => 'View Team Members',
			'add_new_item' => 'Add New Team Member',
			'new_item' => 'New Team Member',
			'parent_item_colon' => 'Parent Team Member:',
			'search_items' => 'Search Team Members',
			'not_found' => 'No Team Members found',
			'not_found_in_trash' => 'No Team Members found in the bin',
			'archives' => 'Team Member Archives',
			'attributes' => 'Team Member Attributes',
			'insert_into_item' => 'Insert into Team Member',
			'uploaded_to_this_item' => 'Uploaded to this Team Member',
			'filter_items_list' => 'Filter Team Members list',
			'filter_by_date' => 'Filter Team Members by date',
			'items_list_navigation' => 'Team Members list navigation',
			'items_list' => 'Team Members list',
			'item_published' => 'Team Member published.',
			'item_published_privately' => 'Team Member published privately.',
			'item_reverted_to_draft' => 'Team Member reverted to draft.',
			'item_scheduled' => 'Team Member scheduled.',
			'item_updated' => 'Team Member updated.',
			'item_link' => 'Team Member Link',
			'item_link_description' => 'A link to a Team Member.',
		),
		'public' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-editor-quote',
		'supports' => array(
			0 => 'title',
			1 => 'excerpt',
		),
		'has_archive' => 'teams',
		'rewrite' => array(
			'slug' => 'teams',
			'with_front' => false,
			'pages' => false,
		),
		'can_export' => false,
		'delete_with_user' => false,
	) );

} );

