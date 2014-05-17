/**
 * Initialize App
 */
define(['backbone', 'marionette'], function(Backbone, Marionette){
	// Initialize App
	var App = new Marionette.Application();

	// Add top level regions
	App.addRegions({
		helloRegion: '#hello-region'
	});

	return App;
});