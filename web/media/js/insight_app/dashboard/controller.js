/**
 * Navbar Controller
 */
define([
	'app',
	'marionette',
	'./view'
], function(App, Marionette, NavbarView){
	var navbarController = {};
	navbarController = Marionette.Controller.extend({
		// Show Navbar
		initialize: function(){

			var navbarView = new NavbarView.MainView();
			App.mainRegion.show(navbarView);
		}
	});

	return navbarController;
});