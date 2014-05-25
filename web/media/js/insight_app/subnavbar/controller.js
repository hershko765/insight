/**
 * Navbar Controller
 */
define([
	'app',
	'marionette',
	'./view'
], function(App, Marionette, SubNavbarView){
	var subNavbarController = {};
	subNavbarController = Marionette.Controller.extend({
		// Show Navbar
		initialize: function(){
			var subNavbarView = new SubNavbarView.MainView();
			App.subNavbarRegion.show(subNavbarView);
		}
	});

	return subNavbarController;
});