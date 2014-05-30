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
		template: tplRow
	});

	AddonView.AddonsListView = View.CollectionView.extend({
		itemView: AddonView.RowView
	});

	AddonView.CategoriesView = View.Layout.extend({
		template: TplCats,
		onShow: function() {
			this.$el.find('.pre-load').each(function(key, el){
				var $el = $(el),
				    src = $(el).css('background-image').replace('url(', '').replace(')', '');
				$('<img/>').attr('src', src).load(function() {
					$el.animate({
						opacity: 1
					});
					$(this).remove(); // prevent memory leaks
				});
			});
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