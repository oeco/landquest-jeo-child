<?php

/*
 * LandQuest
 * Custom author system
 */

class LandQuest_Author {

	function __construct() {

		add_action('init', array($this, 'init'));
		
	}
	
	function init() {

		$this->register_post_type();
		
	}

	
	function register_post_type() {


		$labels = array( 
			'name' => __('Authors', 'landquest'),
			'singular_name' => __('Author', 'landquest'),
			'add_new' => __('Add author', 'landquest'),
			'add_new_item' => __('Add new author', 'landquest'),
			'edit_item' => __('Edit author', 'landquest'),
			'new_item' => __('New author', 'landquest'),
			'view_item' => __('View author', 'landquest'),
			'search_items' => __('Search author', 'landquest'),
			'not_found' => __('No author found', 'landquest'),
			'not_found_in_trash' => __('No author found in the trash', 'landquest'),
			'menu_name' => __('Authors', 'landquest')
		);
		
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('LandQuest authors', 'landquest'),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => false,
			'menu_position' => 4,
			'taxonomies' => array('post_tag', 'category'),
			'rewrite' => array('slug' => 'authors', 'with_front' => false)
		);
		
		register_post_type('authors', $args);
		
	}
	
}

new LandQuest_Author();