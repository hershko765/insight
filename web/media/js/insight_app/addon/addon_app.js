/**
 * Main Navbar App file
 */
define(['app', 'insight_app/addon/controller'], function(App, addonController){

	var navbarApp = {};
	navbarApp.showAddon = function(options){
		return new addonController(options);
	};

	App.commands.setHandler('show:addon', function(options){
		navbarApp.showAddon(options);
	});

	return navbarApp;
});