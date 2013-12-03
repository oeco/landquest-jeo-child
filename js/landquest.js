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

(function($) {

	/*
	 * Slider
	 */
	$(document).ready(function() {
		
		var container = $('#lq-slider');
		
		var origNav = [];
		
		$.each(container.find('.slider-navigation li'), function() {
			origNav.push($(this).clone());
		});
		
		if(container.length) {

			var options = {
				horizontal: 1,
				itemNav: 'basic',
				itemSelector: container.find('.slider-content > ul > li'),
				smart: 1,
				activateOn: 'click',
				mouseDragging: 0,
				touchDragging: 1,
				pagesBar: container.find('.slider-navigation'),
				pageBuilder: function(index) {
					return '<li>' + origNav[index].html() + '</li>';
				},
				activatePageOn: 'click',
				releaseSwing: 1,
				startAt: 0,
				scrollBy: 0,
				speed: 300,
				keyboardNavBy: null,
				prev: container.find('.slider-arrows .previous'),
				next: container.find('.slider-arrows .next')
			};
			
			var sly = new Sly(container.find('.slider-content'), options);
			
			var fixSizes = function() {
				container.find('.slider-content > ul > li').width(container.find('.slider-content').width());
				sly.reload();
			};
			
			$(window).resize(fixSizes).resize();
			
			sly.init();

		}

	});
	
})(jQuery);