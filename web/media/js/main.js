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
		jqueryUI: 'vendor/jquery-ui-1.10.0.custom.min',
		bootstrap: 'vendor/bootstrap.min',
		baseAdmin: '../theme/js/Application',
		app: 'app',
		text: 'vendor/text'
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
		jqueryUI: {
			deps: [ 'jquery' ]
		},
		bootstrap: {
			deps: [
				'jquery'
			]
		},
		baseAdmin: {
			deps: [
				'jquery',
				'jqueryUI',
				'bootstrap'
			],
			exports: 'Application'
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

require([
	'app',
	'insight_app/routes',
	'insight_app/navbar/navbar_app',
	'insight_app/subnavbar/subnavbar_app',
	'jquery',
	'bootstrap',
	'jqueryUI',
	'baseAdmin'
], function(App){
	// Change underscore template syntax to match twig
	_.templateSettings = { interpolate: /\{\{(.+?)\}\}/g, evaluate: /\{\{=(.+?)\}\}/g };

	// Start the app
	App.start();
});