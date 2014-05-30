/**
 * Region Manager
 */
define(['app'], function(App){
	var RegionManager = {};
	RegionManager.showAll = function() {

		// Show Top navbar
		if ( ! App.navbarRegion.currentView) {
			App.execute('show:navbar');
		}

		// Show Main Menu navbar
		if ( ! App.subNavbarRegion.currentView) {

			App.execute('show:sub:navbar');
		}

		// Show Footer
		if ( ! App.footerRegion.currentView) {
			App.execute('show:footer');
		}
	};

	RegionManager.hideSubNavbar = function(){
		// Show Top navbar
		if ( ! App.navbarRegion.currentView) {
			App.execute('show:navbar');
		}

		// Show Footer
		if ( ! App.footerRegion.currentView) {
			App.execute('show:footer');
		}

		App.subNavbarRegion.reset();
	};

	return RegionManager;
});