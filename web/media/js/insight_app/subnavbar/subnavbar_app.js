/**
 * Main Navbar App file
 */
define(['app', 'insight_app/subnavbar/controller'], function(App, subNavbarController){

	var subNavbarApp = {};
	subNavbarApp.showSubNavbar = function(options){
		return new subNavbarController(options);
	};

	App.commands.setHandler('show:sub:navbar', function(options){
		subNavbarApp.showSubNavbar(options);
	});

	return subNavbarApp;
});