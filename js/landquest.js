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
	
	map.on('click', function() {
		marker.openPopup();
	});
	
	marker.on('mouseover mouseout', function() {
		marker.openPopup();
	});
	
}