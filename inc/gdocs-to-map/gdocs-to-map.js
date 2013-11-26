(function($) {
	
	var	map,
		data = landquest.data,
		baseUrl = landquest.base_url,
		language = landquest.language,
		layers = {},
		currentLayer,
		layersAdditionalInfo = {
			'flowers': {
				'icon': '/img/icons/1.png',
				'title': {
					'en': 'Flowers',
					'es': 'Flores'
				}
			},
			'mow_irrigation': {
				'icon': '/img/icons/2.png',
				'title': {				
					'en': 'MoW Irrigations',
					'es': 'MoW Irrigations (Translate)'
				}
			},
			'mow_boreholes': {
				'icon': '/img/icons/3.png',
				'title': {				
					'en': 'MoW Boreholes',
					'es': 'MoW Boreholes (Translate)'
				}
			},
			'oxfam_sand_dams': {
				'icon': '/img/icons/4.png',
				'title': {				
					'en': 'OXFAM Sand Dams',
					'es': 'OXFAM Sand Dams (Translate)'
				}
			},
			'oxfam_boreholes': {
				'icon': '/img/icons/5.png',
				'title': {				
					'en': 'OXFAM Boreholes',
					'es': 'OXFAM Boreholes'
				}
			},
			'oxfam_lakes': {
				'icon': '/img/icons/6.png',
				'title': {				
					'en': 'OXFAM Lakes',
					'es': 'OXFAM Lakes (Translate)'
				}
			},
			'oxfam_rivers': {
				'icon': '/img/icons/7.png',
				'title': {				
					'en': 'OXFAM Rivers',
					'es': 'OXFAM Rivers (Translate)'
				}
			},
			'oxfam_rock_catchments': {
				'icon': '/img/icons/8.png',
				'title': {				
					'en': 'OXFAM Rock Catchments',
					'es': 'OXFAM Rock Catchments (Translate)'
				}
			},
			'oxfam_springs': {
				'icon': '/img/icons/9.png',
				'title': {				
					'en': 'OXFAM Springs',
					'es': 'OXFAM Springs (Translate)'
				}
			},
			'oxfam_wells': {
				'icon': '/img/icons/10.png',
				'title': {				
					'en': 'OXFAM Wells',
					'es': 'OXFAM Wells (Translate)'
				}
			},
			'oxfam_earthpan': {
				'icon': '/img/icons/11.png',
				'title': {				
					'en': 'OXFAM Earth Pan',
					'es': 'OXFAM Earth Pan (Translate)'
				}
			}
		};
	
	jeo.mapReady(function(m) {
		
		map = m;
		
		// div to be used in Map Legend Control
		legendDiv = "<div class='lq-map-legend'>\n<ul>\n"
		
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
			layers[key]._markerClusterTitle = layersAdditionalInfo[key]['title'][language];
			layers[key]._key = key;
						
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
			
			// add layer to legend div
			legendDiv = legendDiv + "<li class='"+ key +" lq-map-legend-item'>\n"
						+ "<img src='"+baseUrl+layersAdditionalInfo[key]['icon']+"'></img>\n"
						+ "<span>"+layersAdditionalInfo[key]['title'][language]+"</span>\n";
			
			layers[key].addTo(map);
		}
		
		legendDiv = legendDiv + '</div>\n'
		
		map.legendControl.addLegend(legendDiv);
		
	});
		
	
	function buildMarker(m) {
		
		var iconUrl = baseUrl + layersAdditionalInfo[m.marker_class]['icon'];
		
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