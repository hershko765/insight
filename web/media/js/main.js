/*
* Main Configuration
*/
requirejs.config({
	paths: {
		jquery: 'vendor/jquery/dist/jquery',
		underscore: 'vendor/underscore/underscore',
		backbone: 'vendor/backbone/backbone',
		'backbone.babysitter': 'vendor/backbone.babysitter/lib/backbone.babysitter',
		'backbone.wreqr': 'vendor/backbone.wreqr/lib/backbone.wreqr',
		marionette: 'vendor/backbone.marionette/lib/core/amd/backbone.marionette',
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
				'backbone.babysitter',
				'backbone.wreqr'
			],
			exports: 'Marionette'
		}
	}
});

require(['app'], function(App){

	// Start the app
	App.start();
});