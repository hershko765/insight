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

			App.vent.on('show:tools', function(){
				// Show tools region
				var toolsView = new NavbarView.ToolsView();
				navbarView.toolsRegion.show(toolsView);

				// Disable event
				App.vent.off('show:tools');
			});

			this.listenTo(navbarView, 'show', function(){
				// Show tools if user is logged in
//				App.vent.trigger('show:tools');
			});

			App.navbarRegion.show(navbarView);
		}
	});

	return navbarController;
});