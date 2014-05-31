/**
 * Navbar View
 */
define([
	'app',
	'marionette',
	'components/view',
	'text!./templates/layout.twig',
	'text!./templates/_row.twig',
	'text!./templates/_filters.twig'
], function(App, Marionette, View, tplLayout, tplRow, TplCats){

	var AddonView = {};

	AddonView.MainView = View.Layout.extend({
		template: tplLayout,
		regions: {
			addonListRegion: '#addons-list',
			filtersRegion: '#categories-region'
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

	AddonView.FiltersView = View.Layout.extend({
		template: TplCats,
		events: {
			'click a': function(e) {
				var removeFilter, catID,
					$target = $(e.currentTarget);

				if ($target.hasClass('avatar-selected')) {
					removeFilter = true;
					$target.removeClass('avatar-selected');
				} else {
					this.$el.find('.avatar-selected').removeClass('avatar-selected');
					catID = $target.addClass('avatar-selected').data('category');
				}
				
				this.trigger('filter:category', removeFilter ? null : catID);
				e.preventDefault();
			},
			'textInput #search': 'filterSearch',
			'change #search': 'filterSearch',
			'paste #search': 'filterSearch',
			'input #search': 'filterSearch'
		},
		filterSearch: function(e) {
			var _this = this;
			if (this.delaySearch) { clearTimeout(_this.delaySearch); }
			this.delaySearch = setTimeout(function(){
				_this.delaySearch = false;
				_this.trigger('filter:search', $(e.currentTarget).val());
			}, 500);
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