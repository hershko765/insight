define([
	'app',
	'underscore',
	'backbone',
	'marionette',
	'vendor/datagrid/datagridView',
	'vendor/datagrid/tplVars',
	'vendor/datagrid/mergeRecursive',
	'vendor/datagrid/datagridEntity',
	'vendor/datagrid/config'
], function(App, _, Backbone, Marionette, InjectView, tplVars, merge, Entity, config){

	var Inject = Marionette.Controller.extend({
		initialize: function(options) {
			var _this = this, injectLayout, region;

			this.region = region = options[0];
			this.options = options[1];
			this.injectLayout = injectLayout = new InjectView.InjectLayout({});

			injectLayout.on('show', function() {
				_this.showGrid(injectLayout, _this.options);
			});

			region.show(injectLayout);
		},

		showGrid: function(layoutView, options) {
			var _this = this, injectTable;
			this.inejctTable = injectTable = new InjectView.ContainerView({
				templateHelpers: function() {
					return tplVars.containerVars(options)
				},
				itemViewVars: options
			});

			injectTable.on('show', function(){
				var entity = Entity.createEntity({
					url: _this.options.fetchURL
				}), entityCollection;
				_this.collection = entityCollection = new entity.Collection();
				_this.renderRaws({
					limit: config.fetch.perPage,
					offset: 0
				});
			});

			layoutView.gridRegion.show(injectTable);
		},

		renderRaws: function(options) {
			var _this = this;
			this.collection.fetchList((options || {}), function(){
				_this.inejctTable.collection = _this.collection;
				_this.inejctTable.render()
			});
		},

		flushConfig: function(config) {
			this.options = merge(this.options, config);

			this.region.show(this.injectLayout);
		}
	});

	Marionette.InjectGrid = Inject;
});