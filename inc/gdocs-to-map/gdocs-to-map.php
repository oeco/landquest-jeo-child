<?php

/*
 * LandQuest
 *
 * Loads GDocs data to main map
 * 
 */

class LandQuest_GDocsToMap {

	function __construct() {

		add_action('init', array($this, 'init'));

	}

	function init() {

		add_action('wp_enqueue_scripts', array($this, 'scripts'));

	}
	
	function getLanguage() {
		
		$language = qtrans_getLanguage();
		
		if (!$language) $language = 'en';
		
		return $language;
	}

	function scripts() {

		wp_enqueue_style('landquest-gdocs-to-map', get_stylesheet_directory_uri() . '/inc/gdocs-to-map/gdocs-to-map.css', array('leaflet-markerclusterer'));
		wp_enqueue_script('landquest-gdocs-to-map', get_stylesheet_directory_uri() . '/inc/gdocs-to-map/gdocs-to-map.js', array('jeo', 'underscore', 'leaflet-markerclusterer'), '0.1.0');
		
		// Layers info for Leaftet
		$base_url = get_stylesheet_directory_uri();
		wp_localize_script('landquest-gdocs-to-map', 'landquest', array(
			'data' => $this->get_data(),
			'base_url' => get_stylesheet_directory_uri(),
			'language' => $this->getLanguage(),
			'layersInfo' => array(
				'flowers' => array(
						'title' => __('Flowers', 'landquest'),
						'icon' => $base_url . '/img/icons/1.png'
				),
				'mow_irrigation' => array(
						'title' => __('MoW Irrigation', 'landquest'),
						'icon' => $base_url . '/img/icons/2.png'
				),
				'mow_boreholes' => array(
						'title' => __('MoW Boreholes', 'landquest'),
						'icon' => $base_url . '/img/icons/3.png'
				),
				'oxfam_sand_dams' => array(
						'title' => __('OXFAM Sand Dams', 'landquest'),
						'icon' => $base_url . '/img/icons/4.png'
				),
				'oxfam_boreholes' => array(
						'title' => __('OXFAM Boreholes', 'landquest'),
						'icon' => $base_url . '/img/icons/5.png'
				),
				'oxfam_lakes' => array(
						'title' => __('OXFAM Lakes', 'landquest'),
						'icon' => $base_url . '/img/icons/6.png'
				),
				'oxfam_rivers' => array(
						'title' => __('OXFAM Rivers', 'landquest'),
						'icon' => $base_url . '/img/icons/7.png'
				),
				'oxfam_rock_catchments' => array(
						'title' => __('OXFAM Rock Catchments', 'landquest'),
						'icon' => $base_url . '/img/icons/8.png'
				),
				'oxfam_springs' => array(
						'title' => __('OXFAM Springs', 'landquest'),
						'icon' => $base_url . '/img/icons/9.png'
				),
				'oxfam_wells' => array(
						'title' => __('OXFAM Wells', 'landquest'),
						'icon' => $base_url . '/img/icons/10.png'
				),
				'oxfam_earthpan' => array(
						'title' => __('OXGFAM Earthpan', 'landquest'),
						'icon' => $base_url . '/img/icons/11.png'
				)
			)
			// 'layers_info' => array(
			// 	'flowers' => array(
			// 			'title' => __('Flowers', 'landquest'),
			// 			'template' => "<div class='lq-map-legend-item'>" .
			// 											"<div class='title'>" . __('Flowers', 'landquest') . "</span>" .
			// 											"<div class='title'>".__('Company', 'landquest').": <%= item.".__('Company', 'landquest')." %></div>".
			// 									  "</div>"
			// 	),
			// 	'mow_irrigation' => array(
			// 			'title' => __('MoW Irrigation', 'landquest'),
			// 			'template' => "<div class='lq-map-legend-item'>".
			// 											"<div class='title'>" . __('Flowers', 'landquest') . "</span>".
			// 											"<div class='title'>Company: <%= item.Company %></div>".
			// 									  "</div>"
			// 	),
			// 	'mow_boreholes' => array(
			// 			'title' => __('MoW Boreholes', 'landquest'),
			// 			'template' => "<div class='lq-map-legend-item'>".
			// 											"<div class='title'>" . __('Flowers', 'landquest') . "</span>".
			// 											"<div class='title'>Company: <%= item.Company %></div>".
			// 									  "</div>"
			// 	)
			// )
		));

	}

	function get_sources() {

		return array(
			'flowers' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=0&output=csv',
			'mow_irrigation' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=1&output=csv',
			'mow_boreholes' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=2&output=csv',
			'oxfam_sand_dams' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=3&output=csv',
			'oxfam_boreholes' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=4&output=csv',
			'oxfam_lakes' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=5&output=csv',
			'oxfam_rivers' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=6&output=csv',
			'oxfam_rock_catchments' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=7&output=csv',
			'oxfam_springs' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=8&output=csv',
			'oxfam_wells' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=9&output=csv',
			'oxfam_earthpan' => 'https://docs.google.com/spreadsheet/pub?key=0AtAM3LpAmlqCdEtxRlYxalRiWlNpcTE4bFY3OU5Wb3c&single=true&gid=10&output=csv'
		);
	}

	function get_data() {
		
		// read sources urls
		$sources = $this->get_sources();

		$data = array();

		foreach($sources as $key => $csv) {

			// uncomment this if you need to fetch from google docs every time
//			delete_transient($key);

			// fetch transient data
			$data[$key] = get_transient($key);

			// if not available, retrieve it from google docs
			if(!$data[$key]) {
				
				// initialize data array
				$data[$key] = array();
				
				// open gdocs csv
				$csv = fopen($csv, 'r');
				if(!$csv)
					continue;
					
				$headers = $arr = $content = array();
				
				$i = 0;
				while(($lineArray = fgetcsv($csv, 4000)) !== false) {
					if(!is_array($data[$i]))
						$arr[$i] = array();
					for($j = 0; $j < count($lineArray); $j++) {
						$arr[$i][$j] = $lineArray[$j];
					}
					$i++;
				}
				
				$headers = $arr[0];
				unset($arr[0]);
				
				$i = 0;
				foreach($arr as $line) {
					$j = 0;
					foreach($line as $item) {
						$content[$i][$headers[$j]] = $item;
						$content[$i]['marker_class'] = $key;
						$j++;
					}
					$i++;
				}
	
				fclose($csv);
				
				$data[$key] = $content;	
				
				set_transient($key, $data[$key], 60*60*24);
			}
		}
		
		return $data;

	}

	function get_data_json() {
		return json_encode($this->get_data());
	}

	function json() {
		header('Content-Type: application/json');
		echo $this->get_data_json();
		exit;
	}

}

$GLOBALS['LandQuest_GDocsToMap'] = new LandQuest_GDocsToMap();