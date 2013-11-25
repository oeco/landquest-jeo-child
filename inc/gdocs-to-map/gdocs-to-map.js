(function($) {
	
	var	map,
		data = landquest.data,
		baseUrl = landquest.base_url,
		language = landquest.language,
		layers = {},
		currentLayer,
		markerClusterTitles = {
			'flowers': {
				'en': 'Flowers',
				'es': 'Flores'
			},
			'mow_irrigation': {
				'en': 'MoW Irrigations',
				'es': 'MoW Irrigations (Translate)'
			},
			'mow_boreholes': {
				'en': 'MoW Boreholes',
				'es': 'MoW Boreholes (Translate)'
			},
			'oxfam_sand_dams': {
				'en': 'OXFAM Sand Dams',
				'es': 'OXFAM Sand Dams (Translate)'
			},
			'oxfam_boreholes': {
				'en': 'OXFAM Boreholes',
				'es': 'OXFAM Boreholes'
			},
			'oxfam_lakes': {
				'en': 'OXFAM Lakes',
				'es': 'OXFAM Lakes (Translate)'
			},
			'oxfam_rivers': {
				'en': 'OXFAM Rivers',
				'es': 'OXFAM Rivers (Translate)'
			},
			'oxfam_rock_catchments': {
				'en': 'OXFAM Rock Catchments',
				'es': 'OXFAM Rock Catchments (Translate)'
			},
			'oxfam_springs': {
				'en': 'OXFAM Springs',
				'es': 'OXFAM Springs (Translate)'
			},
			'oxfam_wells': {
				'en': 'OXFAM Wells',
				'es': 'OXFAM Wells (Translate)'
			},
			'oxfam_earthpan': {
				'en': 'OXFAM Earth Pan',
				'es': 'OXFAM Earth Pan (Translate)'
			}
		};
	
	jeo.mapReady(function(m) {
		
		map = m;
		
		/*
		 * Layers
		 */
		
		for(var key in data) {
			
			var layerData = $.extend(data[key], []);

			layers[key] = new L.MarkerClusterGroup({
				iconCreateFunction: function(cluster) {
					return new L.DivIcon({
						html: '<span>' + cluster._group._markerClusterTitle + ': '
									+ cluster.getChildCount() + '</span>',
						className: 'landquest-icon ' + cluster._group._key,
						iconSize: [31,31]
					});
				}
			});
			
			// set info needed by marker cluster
			layers[key]._markerClusterTitle = markerClusterTitles[key][language];
			layers[key]._key = key;
			
			/*
			layers[key] = new L.FeatureGroup();
			*/
			
			layers[key]._data = layerData;
			layers[key]._markers = [];
			
			$.each(layerData, function(i, m) {
				
				if(m.latitude && m.longitude && (typeof m.marker_class !== 'undefined')) {
					
					marker = buildMarker(m);
					
					m._marker = marker;
					
					layers[key]._markers.push(marker);
					
					marker.addTo(layers[key]);
					
				}
			});
			
			layers[key].addTo(map);
		}
		
	});
	
	function buildMarker(m) {
		
		var iconUrl;
		
		switch (m.marker_class) {
			case 'flowers':
				iconUrl = baseUrl + '/img/icons/1.png';
				break;
			case 'mow_irrigation':
				iconUrl = baseUrl + '/img/icons/2.png';
				break;  
			case 'mow_boreholes':
				iconUrl = baseUrl + '/img/icons/3.png';
				break;
			case 'oxfam_sand_dams':
				iconUrl = baseUrl + '/img/icons/4.png';
				break;	  
			case 'oxfam_boreholes':
				iconUrl = baseUrl + '/img/icons/5.png';
				break;
			case 'oxfam_lakes':
				iconUrl = baseUrl + '/img/icons/6.png';
				break;	  
			case 'oxfam_rivers':
				iconUrl = baseUrl + '/img/icons/7.png';
				break;
			case 'oxfam_rock_catchments':
				iconUrl = baseUrl + '/img/icons/8.png';
				break;	  
			case 'oxfam_springs':
				iconUrl = baseUrl + '/img/icons/9.png';
				break;	  
			case 'oxfam_wells':
				iconUrl = baseUrl + '/img/icons/10.png';
				break;	  
			case 'oxfam_earthpan':
				iconUrl = baseUrl + '/img/icons/11.png';
				break;
		}
		
		var marker = L.marker([parseFloat(m.latitude), parseFloat(m.longitude)], {
			icon: L.icon({iconUrl: iconUrl})
		});
		
		marker._data = m;
		
		marker.on('mouseover', function() {
			console.log(marker._data);
		});
		
		return marker;
		
	}
	

	
})(jQuery);