/**
 * Navbar View
 */
define([
	'app',
	'marionette',
	'components/view',
	'text!./templates/layout.twig',
	'text!./templates/_row.twig'
], function(App, Marionette, View, tplLayout, tplRow){

	var AddonView = {};

	AddonView.MainView = View.Layout.extend({
		template: tplLayout,
		regions: {
			addonListRegion: '#addons-list'
		}
	});

	AddonView.RowView = View.ItemView.extend({
		template: tplRow
	});

	AddonView.AddonsListView = View.CollectionView.extend({
		itemView: AddonView.RowView
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