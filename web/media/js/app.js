/**
 * Initialize App
 */
define(['backbone', 'marionette', 'jquery', 'components/animatedRegion'], function(Backbone, Marionette, $, animatedRegion){
	// Initialize App
	var App = new Marionette.Application();
	// Add top level regions
	App.addRegions({
		navbarRegion: '#navbar-region',
		mainRegion: '#main-region',
		footerRegion: '#footer-region'
	});

	App.subNavbarRegion = new animatedRegion();

	App.subNavbarRegion.on('show', function(view){
		view.$el.hide();
		view.$el.slideDown();
	});

	return App;
});
// Region inside top navbar that change if the user is logged or not
// Regions custom show animations