<?php

/*
 * LandQuest
 * Custom partner system
 */

class LandQuest_Partner {

	function __construct() {

		add_action('init', array($this, 'init'));
		
	}
	
	function init() {

		$this->register_post_type();
		$this->register_field_group();
		
		add_filter('post_type_link', array($this, 'post_link'), 10, 2);
		
	}

	
	function register_post_type() {


		$labels = array( 
			'name' => __('Partners', 'landquest'),
			'singular_name' => __('Partner', 'landquest'),
			'add_new' => __('Add partner', 'landquest'),
			'add_new_item' => __('Add new partner', 'landquest'),
			'edit_item' => __('Edit partner', 'landquest'),
			'new_item' => __('New partner', 'landquest'),
			'view_item' => __('View partner', 'landquest'),
			'search_items' => __('Search partner', 'landquest'),
			'not_found' => __('No partner found', 'landquest'),
			'not_found_in_trash' => __('No partner found in the trash', 'landquest'),
			'menu_name' => __('Partners', 'landquest')
		);
		
		$args = array( 
			'labels' => $labels,
			'hierarchical' => true,
			'description' => __('LandQuest authors', 'landquest'),
			'supports' => array('title', 'thumbnail', 'page-attributes'),
			'public' => false,
			'show_ui' => true,
			'has_archive' => false,
			'menu_position' => 4,
			'query_var' => 'lq_partner',
			'rewrite' => false
		);

		register_post_type('partner', $args);

	}
	
	function register_field_group() {

		if(function_exists("register_field_group")) {
			register_field_group(array (
				'id' => 'acf_partner-settings',
				'title' => __('Partner settings', 'landquest'),
				'fields' => array (
					array (
						'key' => 'field_partner_website',
						'label' => __('Website', 'landquest'),
						'name' => 'partner_url',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array(
						'key' => 'field_partner_is_creator',
						'label' => __('Creator', 'landquest'),
						'message' => __('This is a creator', 'landquest'),
						'name' => 'parner_is_creator',
						'type' => 'true_false',
						'default_value' => 0,
						'instructions' => __('Check this to add this organization to the list of creators ("by" section on the footer)', 'landquest')
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'partner',
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
			if(get_post_type($post->ID) == 'partner') {
					$permalink = get_field('partner_url', $post->ID);
			}
			return $permalink;
	}
	
}

$GLOBALS['landquest_partner'] = new LandQuest_Partner();