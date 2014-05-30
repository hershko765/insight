define([
	'underscore',
	'backbone',
	'marionette',
	'text!./templates/layout.twig',
	'text!./templates/_table.twig',
	'text!./templates/_raw.twig'
], function(_, Backbone, Marionette, TplLayout, TplTable, TplRaw){
	var InjectView = {};
	InjectView.InjectLayout = Marionette.Layout.extend({
		template: TplLayout,
		regions: {
			gridRegion: '#grid-region',
			pagingRegion: '#paging-region'
		}
	});

	InjectView.RawView = Marionette.ItemView.extend({
		template: TplRaw,
		tagName: 'tr',
		templateHelpers: function(){
			var model = this.model, rawData = [];
			$.each(this.options.config.headers, function(idx, val){
				rawData.push({
					title: model.get(val[0])
				})
			});
			return {
				rawData: rawData
			};
		}
	});

	InjectView.ContainerView = Marionette.CompositeView.extend({
		template: TplTable,
		itemViewContainer: 'tbody',
		itemView: InjectView.RawView,
		itemViewOptions: function() {
			return { config: this.options.itemViewVars }
		}
	});

	return InjectView;
});