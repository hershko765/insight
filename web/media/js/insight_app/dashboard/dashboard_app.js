/**
 * Main Navbar App file
 */
define(['app', 'insight_app/dashboard/controller'], function(App, dashboardController){

	var navbarApp = {};
	navbarApp.showDashboard = function(options){
		return new dashboardController(options);
	};

	App.commands.setHandler('show:dashboard', function(options){
		navbarApp.showDashboard(options);
	});

	return navbarApp;
});