/*
* Main Configuration
*/
requirejs.config({
	paths: {
		jquery: 'vendor/jquery/dist/jquery',
		underscore: 'vendor/underscore/underscore',
		backbone: 'vendor/backbone/backbone',
		backboneBabysitter: 'vendor/backbone.babysitter/lib/backbone.babysitter',
		backboneWreqer: 'vendor/backbone.wreqr/lib/backbone.wreqr',
		marionette: 'vendor/backbone.marionette/lib/backbone.marionette',
		app: 'app'
	},
	shim: {
		underscore: {
			exports: '_'
		},
		backbone: {
			deps: [
				'underscore',
				'jquery'
			],
			exports: 'Backbone'
		},
		marionette: {
			deps: [
				'backbone',
				'backboneBabysitter',
				'backboneWreqer'
			],
			exports: 'Marionette'
		}
	}
});

require(['app'], function(App){

	// Start the app
	App.start();
});