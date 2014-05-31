/**
 * Navbar View
 */
define([
	'app',
	'marionette',
	'components/view',
	'text!./templates/layout.twig',
	'text!./templates/_row.twig',
	'text!./templates/_categories.twig'
], function(App, Marionette, View, tplLayout, tplRow, TplCats){

	var AddonView = {};

	AddonView.MainView = View.Layout.extend({
		template: tplLayout,
		regions: {
			addonListRegion: '#addons-list',
			categoriesRegion: '#categories-region'
		}
	});

	AddonView.RowView = View.ItemView.extend({
		template: tplRow,
		onShow: function() {
			App.imageLoader(this.$el);
		}
	});

	AddonView.AddonsListView = View.CollectionView.extend({
		itemView: AddonView.RowView
	});

	AddonView.CategoriesView = View.Layout.extend({
		template: TplCats,
		events: {
			'click a': function(e) {
				this.$el.find('.avatar-selected').removeClass('avatar-selected');
				var catID = $(e.currentTarget).addClass('avatar-selected').data('category');
				this.trigger('filter:category', catID);
				e.preventDefault();
			}
		},
		onShow: function() {
			App.imageLoader(this.$el);
		}
	});
/*
	AddonView.InjectViewConfig = {
		headers: [
			[ 'title', 'Title' , 50 ],
			[ 'last_release',  'Last Release',   50 ],
			[ 'version', 'Version',      50 ],
			[ 'phone',     'Phone',      50 ]
		],
		fetchURL: 'api/v1/addons'
	};
*/

	return AddonView;
});