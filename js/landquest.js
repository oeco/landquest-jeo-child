/*
 * Lock marker popup on single posts
 */
jeo.markersReady(function(map) {

	if(landquest_site.is_single) {

		lockMarkerPopup(map, map._markers[0]);
		
	}
	
});

function lockMarkerPopup(map, marker) {

	marker.openPopup();
	
	var openPopup = function() {
		marker.openPopup();
	};
	
	map.on('click', openPopup);
	marker.on('mouseover mouseout', openPopup);

	marker._forcedPopup = true;

	map.on('dragstart', function() {

		if(marker._forcedPopup) {
			marker._forcedPopup = false;
			map.off('click', openPopup);
			marker.off('mouseover mouseout', openPopup);
			marker.closePopup();
		}

	});

}