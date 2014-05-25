/**
 * Navbar View
 */
define([
	'app',
	'marionette',
	'components/view',
	'text!./templates/main.twig'
], function(App, Marionette, View, tplMain){

	var subNavbarViews = {};
	subNavbarViews.MainView = View.Layout.extend({
		template: tplMain
	});

	return subNavbarViews;
});