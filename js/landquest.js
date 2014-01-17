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
	jeo.markersReady(function(map) {
		
		var container = $('#lq-slider');
		var items = container.find('.slider-content > ul > li');

		var sly;
		
		var origNav = [];
		
		$.each(container.find('.slider-navigation li'), function() {
			origNav.push($(this).clone());
		});
		
		if(container.length) {

			var options = {
				horizontal: 1,
				itemNav: 'basic',
				itemSelector: items,
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
			
			sly = new Sly(container.find('.slider-content'), options);
			
			var fixSizes = function() {
				container.find('.slider-content > ul > li').width(container.find('.slider-content').width());
				sly.reload();
			};
			
			$(window).resize(fixSizes).resize();
			
			sly.init();

			container.find('.slider-navigation li').on('click', function() {
				setTimeout(function() {
					var index = sly.rel.activePage;
					var postID = $(items.get(index)).attr('data-postid');
					//console.log(map._markers[0]);
					var marker = _.find(map._markers, function(m) { return m.feature.properties.postID == postID; });
					var scrollTop = map.$.offset().top;
					$('html,body').animate({scrollTop: scrollTop}, '200', 'swing', function() {
						map.setView(marker.getLatLng(), 10);
					});
				}, 300);
			});

		}

	});
	
})(jQuery);