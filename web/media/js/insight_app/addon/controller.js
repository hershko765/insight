/**
 * Navbar Controller
 */
define([
	'app',
	'marionette',
	'./view',
	'datagrid',
	'components/filter'
], function(App, Marionette, AddonView, dg, FilterManager){
	var navbarController;

	navbarController = Marionette.Controller.extend({
		// Show Navbar
		initialize: function(){
			var _this = this,
			   addonView = new AddonView.MainView();

			addonView.on('show', function(){
				_this.showAddons(addonView);
				_this.showFilters(addonView);
			});

			App.mainRegion.show(addonView);
		},

		showAddons: function(addonView) {
			var addonListView = new AddonView.AddonsListView({
				collection: new Backbone.Collection()
			});

			App.execute('get:addon:entities', { limit: 7 }, function(collection){
				addonListView.collection.reset(collection.toJSON());
			});
			this.addonListView = addonListView;
			addonView.addonListRegion.show(addonListView);
		},

		showFilters: function(addonView) {
			var filtersView = new AddonView.FiltersView({}),
				filterManager = new FilterManager();
			filterManager.add('limit', 7);

			filtersView.on('show', function(){
				filtersView.$el.hide().fadeIn();
			});

			this.listenTo(filtersView, 'filter:category', function(catID){
				var _this = this;
				filterManager.add('category', catID);
				App.execute('get:addon:entities', filterManager.getAll(), function(collection){
					_this.addonListView.collection.reset(collection.toJSON());
				});
			});

			this.listenTo(filtersView, 'filter:search', function(search){
				var _this = this;
				filterManager.add('search', search);
				App.execute('get:addon:entities', filterManager.getAll(), function(collection){
					_this.addonListView.collection.reset(collection.toJSON());
				});
			});

			addonView.filtersRegion.show(filtersView);
		}
	});

	return navbarController;
});