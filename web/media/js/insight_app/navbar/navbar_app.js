/**
 * Main Navbar App file
 */
define(['app', 'insight_app/navbar/controller'], function(App, navbarController){

	var navbarApp = {};
	navbarApp.showNavbar = function(options){
		return new navbarController(options);
	};

	App.commands.setHandler('show:navbar', function(options){
		navbarApp.showNavbar(options);
	});

	return navbarApp;
});