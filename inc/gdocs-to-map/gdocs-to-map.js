(function($) {
	
	var	map,
		data = landquest.data,
		baseUrl = landquest.base_url,
		layers = {},
		currentLayer;
	
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
						html: '<span>' + cluster.getChildCount() + '</span>',
						className: 'landquest-icon ' + cluster._group._key,
						iconSize: [31,31]
					});
				}
			});
			
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