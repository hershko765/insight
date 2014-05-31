/**
 * Initialize App
 */
define([
	'backbone',
	'marionette',
	'jquery'
], function(Backbone, Marionette, $){
	// Initialize App
	var App = new Marionette.Application();
	// Add top level regions
	App.addRegions({
		navbarRegion: '#navbar-region',
		mainRegion: '#main-region',
		footerRegion: '#footer-region',
		subNavbarRegion: '#subnavbar-region'
	});

	App.imageLoader = function($el) {
		$el.find('.pre-load').each(function(key, el){
			var $el = $(el),
				src = $(el).css('background-image').replace('url(', '').replace(')', '');
			$('<img/>').attr('src', src).load(function() {
				setTimeout(function(){
					$el.animate({opacity: 1});
				}, (Math.random() * 200));
				$(this).remove(); // prevent memory leaks
			});
		});
	};

	return App;
});
// Region inside top navbar that change if the user is logged or not
// Regions custom show animations