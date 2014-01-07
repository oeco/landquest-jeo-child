(function($) {
	
	var	map,
		data = landquest.data,
		baseUrl = landquest.base_url,
		language = landquest.language,
		layersInfo = landquest.layersInfo,
		layersCategories = landquest.layersCategories,
		layers = {};
	
	jeo.mapReady(function(m) {
		
		map = m;
		
		initializePopupTemplatesFunctions();

		// Open legend div
		var legendDiv = "<div class='lq-map-legend'><ul>";

		for(var category in layersCategories){

			// add category to legend
			legendDiv += "<li class='" + category + "'>"
				+ "<img src='"+layersCategories[category].icon+"'></img>"
				+ "<span>"+layersCategories[category].title+"</span></li>";

			// get child layers
			var child_layers = layersCategories[category]['layers']

			// create marker cluster group
			layers[category] = new L.MarkerClusterGroup({
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
			layers[category]._markerClusterTitle = layersCategories[category].title;
			layers[category]._key = category;						
			layers[category]._markers = [];


			// adds child layer data to marker cluster group
			for (var i=0; i < child_layers.length; i++) {

				// get layer id
				var layer_id = child_layers[i];
				
				// get layer data
				var layerData = $.extend(data[layer_id], []);

				// load data				
				$.each(layerData, function(i, m) {
					if(m.latitude && m.longitude && (typeof m.marker_class !== 'undefined')) {
						
						marker = buildMarker(m);
						
						m._marker = marker;
						
						layers[category]._markers.push(marker);
						
						marker.addTo(layers[category]);
						
					}
				});

			}

			// add layer to map
			layers[category].addTo(map);


	        
			// create legend interaction to this layer
            $('.map-container').on('click', '.' + category, function() {
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
		
		legendDiv += '</ul></div>';

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
			
		return marker;
		
	}
	
})(jQuery);