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

			this.listenTo(navbarView, 'show', function(){
				// Show tools region
				var toolsView = new NavbarView.ToolsView();
				navbarView.toolsRegion.show(toolsView);
			});

			App.navbarRegion.show(navbarView);
		}
	});

	return navbarController;
});