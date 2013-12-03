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
		$this->register_field_group();
		$this->register_relationship_field_group();
		add_filter('jeo_marker_icon', array($this, 'marker_icon'), 10, 2);
		add_filter('post_type_link', array($this, 'post_link'), 10, 2);
		
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
			'has_archive' => true,
			'menu_position' => 4,
			'query_var' => 'lq_author',
			'rewrite' => array('slug' => 'authors', 'with_front' => false)
		);
		
		register_post_type('author', $args);

	}
	
	function register_field_group() {

		if(function_exists("register_field_group")) {
			register_field_group(array (
				'id' => 'acf_author-settings',
				'title' => __('Author settings', 'landquest'),
				'fields' => array (
					array (
						'key' => 'field_author_main_activity',
						'label' => __('Main activity', 'landquest'),
						'name' => 'author_activity',
						'type' => 'text',
						'instructions' => __('E.g.: Journalist, blogger, developer', 'landquest'),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_author_website',
						'label' => __('Website', 'landquest'),
						'name' => 'author_url',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'author',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
		}
	}
	
	function register_relationship_field_group() {
		if(function_exists("register_field_group")) {
			register_field_group(array (
				'id' => 'acf_post-author',
				'title' => __('Post author', 'landquest'),
				'fields' => array (
					array (
						'key' => 'field_post_author',
						'label' => __('Post author', 'landquest'),
						'name' => 'post_author',
						'type' => 'post_object',
						'required' => 0,
						'post_type' => array (
							0 => 'author',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'allow_null' => 1,
						'multiple' => 0,
						'instructions' => sprintf(__('<a href="%s" target="_blank">Click here to create a new author</a>', 'landquest'), admin_url('post-new.php?post_type=author'))
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
		}

	}

	function post_link($permalink, $post) {
			if(get_post_type($post->ID) == 'author') {
					$permalink = get_field('author_url', $post->ID);
			}
			return $permalink;
	}

	
	function marker_icon($icon, $post) {
		if(get_post_type($post->ID) == 'author') {
			$icon = array(
				'iconUrl' => get_stylesheet_directory_uri() . '/img/icons/author-icon-small.png',
				'iconSize' => array(32, 32),
				'iconAnchor' => array(16, 16),
				'popupAnchor' => array(0, -20)
			);
		}
		return $icon;
	}
	
	function get_post_author($post_id = false) {

		global $post;
		$post_id = $post_id ? $post_id : $post->ID;
		
		return get_field('post_author', $post_id);

	}
	
}

$GLOBALS['landquest_author'] = new LandQuest_Author();

function landquest_get_author($post_id = false) {
	return $GLOBALS['landquest_author']->get_post_author($post_id);
}