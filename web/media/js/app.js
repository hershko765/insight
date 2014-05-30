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

	return App;
});
// Region inside top navbar that change if the user is logged or not
// Regions custom show animations