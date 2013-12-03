<?php

/*
 * LandQuest
 * Datasets
 */

class LandQuest_DataSets {

	function __construct() {

		add_action('init', array($this, 'register_taxonomies'));
		add_action('init', array($this, 'register_post_type'));
		add_filter('upload_mimes', array($this, 'upload_mimes'));
		add_action('init', array($this, 'register_field_groups'));

	}

	function register_post_type() {

		$labels = array( 
			'name' => __('Datasets', 'landquest'),
			'singular_name' => __('Dataset', 'landquest'),
			'add_new' => __('Add dataset', 'landquest'),
			'add_new_item' => __('Add new dataset', 'landquest'),
			'edit_item' => __('Edit dataset', 'landquest'),
			'new_item' => __('New dataset', 'landquest'),
			'view_item' => __('View dataset', 'landquest'),
			'search_items' => __('Search dataset', 'landquest'),
			'not_found' => __('No dataset found', 'landquest'),
			'not_found_in_trash' => __('No dataset found in the trash', 'landquest'),
			'menu_name' => __('Datasets', 'landquest')
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('landquest Datasets', 'landquest'),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'menu_position' => 4,
			'rewrite' => array('slug' => 'datasets', 'with_front' => false)
		);

		register_post_type('dataset', $args);

	}

	function register_taxonomies() {

		$labels = array(
			'name' => _x('Licenses', 'License general name', 'landquest'),
			'singular_name' => _x('License', 'License singular name', 'landquest'),
			'all_items' => __('All licenses', 'landquest'),
			'edit_item' => __('Edit license', 'landquest'),
			'view_item' => __('View license', 'landquest'),
			'update_item' => __('Update license', 'landquest'),
			'add_new_item' => __('Add new license', 'landquest'),
			'new_item_name' => __('New license name', 'landquest'),
			'parent_item' => __('Parent license', 'landquest'),
			'parent_item_colon' => __('Parent license:', 'landquest'),
			'search_items' => __('Search licenses', 'landquest'),
			'popular_items' => __('Popular licenses', 'landquest'),
			'separate_items_with_commas' => __('Separate licenses with commas', 'landquest'),
			'add_or_remove_items' => __('Add or remove licenses', 'landquest'),
			'choose_from_most_used' => __('Choose from most used licenses', 'landquest'),
			'not_found' => __('No licenses found', 'landquest')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'query_var' => 'license',
			'rewrite' => array('slug' => 'datasets/licenses', 'with_front' => false)
		);

		register_taxonomy('license', 'dataset', $args);

		$labels = array(
			'name' => _x('Sources', 'Source general name', 'landquest'),
			'singular_name' => _x('Source', 'Source singular name', 'landquest'),
			'all_items' => __('All sources', 'landquest'),
			'edit_item' => __('Edit source', 'landquest'),
			'view_item' => __('View source', 'landquest'),
			'update_item' => __('Update source', 'landquest'),
			'add_new_item' => __('Add new source', 'landquest'),
			'new_item_name' => __('New source name', 'landquest'),
			'parent_item' => __('Parent source', 'landquest'),
			'parent_item_colon' => __('Parent source:', 'landquest'),
			'search_items' => __('Search sources', 'landquest'),
			'popular_items' => __('Popular sources', 'landquest'),
			'separate_items_with_commas' => __('Separate sources with commas', 'landquest'),
			'add_or_remove_items' => __('Add or remove sources', 'landquest'),
			'choose_from_most_used' => __('Choose from most used sources', 'landquest'),
			'not_found' => __('No sources found', 'landquest')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'query_var' => 'source',
			'rewrite' => array('slug' => 'datasets/sources', 'with_front' => false)
		);

		register_taxonomy('source', 'dataset', $args);

	}

	function upload_mimes($mimes = array()) {

		$mimes['csv'] = 'text/csv';
		$mimes['geojson'] = 'application/json';
		$mimes['json'] = 'application/json';

		return $mimes;
	}

	function register_field_groups() {
		if(function_exists("register_field_group"))
		{
			register_field_group(array (
				'id' => 'acf_dataset',
				'title' => 'Dataset',
				'fields' => array (
					array (
						'key' => 'field_5266b2be18b56',
						'label' => 'Full download',
						'name' => 'full_download',
						'type' => 'file',
						'instructions' => 'Upload the dataset file',
						'save_format' => 'url',
						'library' => 'all',
					),
					array (
						'key' => 'field_url_source',
						'label' => 'Source url',
						'name' => 'source_url',
						'type' => 'text',
						'instructions' => 'URL for download from source.',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					/*
					array (
						'key' => 'field_5266b48018b57',
						'label' => 'Preview url',
						'name' => 'preview_url',
						'type' => 'text',
						'instructions' => 'URL to embed a preview of the file. Can be a public spreadsheet URL from Google Docs, for example.',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					*/
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'dataset',
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
			register_field_group(array (
				'id' => 'acf_term-url',
				'title' => 'Term url',
				'fields' => array (
					array (
						'key' => 'field_5266b848de720',
						'label' => 'URL',
						'name' => 'url',
						'type' => 'text',
						'instructions' => '',
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
							'param' => 'ef_taxonomy',
							'operator' => '==',
							'value' => 'license',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
					array (
						array (
							'param' => 'ef_taxonomy',
							'operator' => '==',
							'value' => 'source',
							'order_no' => 0,
							'group_no' => 1,
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

}

$GLOBALS['landquest_datasets'] = new LandQuest_DataSets();
