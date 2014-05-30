/**
 * Navbar Controller
 */
define([
	'app',
	'marionette',
	'./view'
], function(App, Marionette, DashboardView){
	var navbarController;

	navbarController = Marionette.Controller.extend({
		// Show Navbar
		initialize: function(){
			var _this = this,
			   dashboardView = new DashboardView.MainView();

			dashboardView.on('show', function(){
				_this.showStats(dashboardView);
				_this.showShortcuts(dashboardView);
			});

			App.mainRegion.show(dashboardView);
		},
		showStats: function(dashboardView) {
			var statsView = new DashboardView.StatsView({});

			dashboardView.statsRegion.show(statsView);

		},
		showShortcuts: function(dashboardView) {
			var shortcutsView = new DashboardView.ShortcutsView({});

			dashboardView.shortcutsRegion.show(shortcutsView);
		}
	});

	return navbarController;
});