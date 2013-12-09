<?php

/*
 * LandQuest
 *
 * Loads GDocs data to main map
 * 
 */

class LandQuest_GDocsToMap {
    
    var $gdocs_key = '0AudTRqkrNLbcdDh2XzdYeEExamFXUnNYN3k0N25iakE';
    
    function __construct() {
        
        add_action('init', array($this, 'init'));
        
    }
    
    function init() {
        
        add_action('wp_enqueue_scripts', array($this, 'scripts'));
        add_action('admin_bar_menu', array($this, 'cache_button'), 201);
        $this->cache_button_action();
        
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
                    'title' => __('Flowers Councils', 'landquest'),
                    'icon' => $base_url . '/img/icons/1.png',
                    'popupTemplateHeader' => __('Flowers Council', 'landquest'),
                    'popupTemplateFields' => array(__('Company', 'landquest'), __('Place', 'landquest'))
                ),
                'mow_irrigation' => array(
                    'title' => __('MoW Irrigation Programmes', 'landquest'),
                    'icon' => $base_url . '/img/icons/2.png',
                    'popupTemplateHeader' => __('MoW Irrigation Project', 'landquest'),
                    'popupTemplateFields' => array(__('Name', 'landquest'), __('Irrigation Area', 'landquest'), __('Project', 'landquest'))
                ),
                'mow_boreholes' => array(
                    'title' => __('MoW Boreholes', 'landquest'),
                    'icon' => $base_url . '/img/icons/3.png',
                    'popupTemplateHeader' => __('MoW Boreholes', 'landquest'),
                    'popupTemplateFields' => array( __('Name Of Water Source/Point', 'landquest'), __('Operational status', 'landquest'), __('Human population served', 'landquest'), __('Animal population served', 'landquest'), __('System management', 'landquest'))
                ),
                'oxfam_sand_dams' => array(
                    'title' => __('OXFAM Sand Dams', 'landquest'),
                    'icon' => $base_url . '/img/icons/4.png',
                    'popupTemplateHeader' => __('OXFAM Sand Dam', 'landquest'),
                    'popupTemplateFields' => array( __('Division', 'landquest'), __('Operational status', 'landquest'), __('Human population served', 'landquest'), __('System management', 'landquest'))
                ),
                'oxfam_boreholes' => array(
                    'title' => __('OXFAM Boreholes', 'landquest'),
                    'icon' => $base_url . '/img/icons/5.png',
                    'popupTemplateHeader' => __('OXFAM Boreholes', 'landquest'),
                    'popupTemplateFields' => array( __('Name Of Water Point', 'landquest'), __('Number of settlements served', 'landquest'), __('Functioning', 'landquest'), __('System management', 'landquest'))
                ),
                'oxfam_lakes' => array(
                    'title' => __('OXFAM Lakes', 'landquest'),
                    'icon' => $base_url . '/img/icons/6.png',
                    'popupTemplateHeader' => __('OXFAM Lake', 'landquest'),
                    'popupTemplateFields' => array( __('Division', 'landquest'), __('Name of water source', 'landquest'), __('Operational status', 'landquest'), __('Water quality', 'landquest'), __('Human population served', 'landquest'))
                ),
                'oxfam_rivers' => array(
                    'title' => __('OXFAM Rivers', 'landquest'),
                    'icon' => $base_url . '/img/icons/7.png',
                    'popupTemplateHeader' => __('OXFAM River', 'landquest'),
                    'popupTemplateFields' => array( __('Name', 'landquest'), __('Operational status', 'landquest'), __('Human population served', 'landquest'), __('System management', 'landquest'))
                ),
                'oxfam_rock_catchments' => array(
                    'title' => __('OXFAM Rock Catchments', 'landquest'),
                    'icon' => $base_url . '/img/icons/8.png',
                    'popupTemplateHeader' => __('OXFAM Rock Catchment', 'landquest'),
                    'popupTemplateFields' => array( __('Name', 'landquest'), __('Reservoir capacity (m3)', 'landquest'))
                ),
                'oxfam_springs' => array(
                    'title' => __('OXFAM Springs', 'landquest'),
                    'icon' => $base_url . '/img/icons/9.png',
                    'popupTemplateHeader' => __('OXFAM Spring', 'landquest'),
                    'popupTemplateFields' => array( __('Name', 'landquest'), __('Operational status', 'landquest'), __('Human population served', 'landquest'), __('System management', 'landquest'))
                ),
                'oxfam_wells' => array(
                    'title' => __('OXFAM Hand Dug Wells', 'landquest'),
                    'icon' => $base_url . '/img/icons/10.png',
                    'popupTemplateHeader' => __('OXFAM Hand Dug Well', 'landquest'),
                    'popupTemplateFields' => array( __('Name', 'landquest'), __('Functioning', 'landquest'))
                ),
                'oxfam_earthpan' => array(
                    'title' => __('OXFAM Earthpan', 'landquest'),
                    'icon' => $base_url . '/img/icons/11.png',
                    'popupTemplateHeader' => __('OXFAM Earthpan', 'landquest'),
                    'popupTemplateFields' => array( __('Name', 'landquest'), __('Reservoir capacity (LxWxDx2/3) (m3)', 'landquest'))
                )
            )
        ));
        
    }
    
    function get_sources() {
        
        return array(
            'flowers' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=0&output=csv',
            'mow_irrigation' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=1&output=csv',
            'mow_boreholes' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=2&output=csv',
            'oxfam_sand_dams' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=3&output=csv',
            'oxfam_boreholes' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=4&output=csv',
            'oxfam_lakes' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=5&output=csv',
            'oxfam_rivers' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=6&output=csv',
            'oxfam_rock_catchments' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=7&output=csv',
            'oxfam_springs' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=8&output=csv',
            'oxfam_wells' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=9&output=csv',
            'oxfam_earthpan' => 'https://docs.google.com/spreadsheet/pub?key='.$this->gdocs_key.'&single=true&gid=10&output=csv'
        );
    }
    
    function update_data($key, $csv) {
        
        // initialize data array
        $data = array();
        
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
        
        $data = $content;	
        
        update_option($key, $data);
        
        return $data;
        
    }
    
    function get_data() {
        
        // read sources urls
        $sources = $this->get_sources();
        
        $data = array();
        
        foreach($sources as $key => $csv) {
            
            $data[$key] = get_option($key);
            
            if(!$data[$key])
                $data[$key] = $this->update_data($key, $csv);
            
        }
        
        return $data;
        
    }
    
    function cache_button() {
        global $wp_admin_bar;
        
        if ( !is_super_admin() || !is_admin_bar_showing() )
            return;
        
        $wp_admin_bar->add_menu( array(
            'id' => 'lq_update_date',
            'title' => __('Update data from Google Docs', 'landquest'),
            'href' => add_query_arg(array('lq_update_data' => 1))
        ));
    }
    
    function cache_button_action() {
        if(isset($_REQUEST['lq_update_data']) && is_super_admin()) {
            $sources = $this->get_sources();
            foreach($sources as $key => $csv) {
                $this->update_data($key, $csv);
            }
            add_action('admin_notices', array($this, 'cache_clean_message'));
        }
    }
    
    function cache_clean_message() {
        echo '<div class="updated fade"><p>' . __('<strong>Google Data has been updated.</strong>', 'landquest') . '</p></div>';
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