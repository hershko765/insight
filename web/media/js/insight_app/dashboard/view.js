/**
 * Navbar View
 */
define([
	'app',
	'marionette',
	'components/view',
	'text!./templates/layout.twig'
], function(App, Marionette, View, tplLayout){

	var dashboardViews = {};
	dashboardViews.MainView = View.Layout.extend({
		template: tplLayout
	});

	return dashboardViews;
});