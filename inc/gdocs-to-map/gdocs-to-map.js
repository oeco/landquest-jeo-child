(function($) {
	
	var	map,
		data = landquest.data,
		baseUrl = landquest.base_url,
		language = landquest.language,
		layersInfo = landquest.layersInfo,
		layers = {};
	
	jeo.mapReady(function(m) {
		
		map = m;
		
		// div to be used in Map Legend Control
		legendDiv = "<div class='lq-map-legend'>\n<ul>\n"
		
		initializePopupTemplatesFunctions();
		
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
			layers[key]._markerClusterTitle = layersInfo[key]['title'];
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
			legendDiv = legendDiv + "<li class='" + key + "'>\n"
						+ "<img src='"+layersInfo[key]['icon']+"'></img>\n"
						+ "<span>"+layersInfo[key]['title']+"</span>\n";

			layers[key].addTo(map);
            
            $('.map-container').on('click', '.' + key, function() {
                
                var clicked = $(this).data('layer');
                if(!clicked) {
                    clicked = $(this).attr('class');
                    $(this).data('layer', clicked);
                }

                if(layers[clicked]._map) {
                    map.removeLayer(layers[clicked]);
                    $(this).addClass('disabled');
                } else {
                    layers[clicked].addTo(map);
                    $(this).removeClass('disabled');
                }

            });
            
		}
		
		legendDiv = legendDiv + '</div>\n';
		
		map.legendControl.addLegend(legendDiv);
		
	});
	
	function initializePopupTemplatesFunctions(){
		$.each(layersInfo, function(i, aLayer) {
			var moustacheTemplate = "<div class='lq-map-legend-item'>"
			
			// add header to template
			if (layersInfo[i].popupTemplateHeader) {
				moustacheTemplate += "<h4>" + layersInfo[i].popupTemplateHeader + "</h4>";
			}
			
			// add point properties to template
			if (layersInfo[i].popupTemplateFields) {
				// open table div
				moustacheTemplate += "<table>";
				_.each(layersInfo[i].popupTemplateFields, function(field){
					moustacheTemplate += 
						"<tr>" +
							"<th>" + field + "</th>" +
							"<td><%= item['" + field + "'] %></td>"+
						"</tr>";
				})
				// closes table
				moustacheTemplate += "</table>";				
			}
			
			moustacheTemplate += "</div>";
			
			layersInfo[i].popupTemplateFunction = _.template(moustacheTemplate)
		});
	}
	
	function popupHtml(item) {
		return layersInfo[item.marker_class].popupTemplateFunction ({item: item});
	}
		
	
	function buildMarker(m) {
		
		var iconUrl = layersInfo[m.marker_class]['icon'];
		
		var marker = L.marker([parseFloat(m.latitude), parseFloat(m.longitude)], {
			icon: L.icon({iconUrl: iconUrl, iconSize: [21,21], popupAnchor: [0,-10]})
		});
		
		marker._data = m;
		
		marker.on('mouseover', function(e) {
			if (!e.target.popupLoaded) {
				marker.bindPopup(popupHtml(m));
				e.target.popupLoaded = true;
			}
			e.target.previousOffset = e.target.options.zIndexOffset;
			e.target.setZIndexOffset(1500);
			e.target.openPopup();
		});
		
		marker.on('mouseout', function(e) {
			e.target.setZIndexOffset(e.target.previousOffset);
			e.target.closePopup();
		});
		marker.on('click', function(e) {
			markers.openMarker(e.target, false);
			return false;
		});
		
		
		return marker;
		
	}
	
})(jQuery);