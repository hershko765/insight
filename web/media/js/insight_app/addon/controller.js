/**
 * Navbar Controller
 */
define([
	'app',
	'marionette',
	'./view',
	'datagrid'
], function(App, Marionette, AddonView){
	var navbarController;

	navbarController = Marionette.Controller.extend({
		// Show Navbar
		initialize: function(){
			var _this = this,
			   addonView = new AddonView.MainView();

			addonView.on('show', function(){
				_this.showAddons(addonView);
			});

			App.mainRegion.show(addonView);
		},
		showAddons: function(addonView) {
			var addonListView = new AddonView.AddonsListView({
				collection: new Backbone.Collection()
			});

			App.execute('get:addon:entities', { limit: 20 }, function(collection){
				addonListView.collection.reset(collection.toJSON());
			});

			addonView.addonListRegion.show(addonListView);
		}
	});

	return navbarController;
});