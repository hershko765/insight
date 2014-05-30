/**
 * Navbar View
 */
define([
	'app',
	'marionette',
	'components/view',
	'text!./templates/layout.twig',
	'text!./templates/_stats.twig',
	'text!./templates/_shortcuts.twig'
], function(App, Marionette, View, tplLayout, tplStats, tplShortcuts){

	var dashboardViews = {};

	dashboardViews.MainView = View.Layout.extend({
		template: tplLayout,
		regions: {
			statsRegion: '#stats-region',
			shortcutsRegion: '#shortcuts-region'
		}
	});

	dashboardViews.StatsView = View.ItemView.extend({
		template: tplStats
	});

	dashboardViews.ShortcutsView = View.ItemView.extend({
		template: tplShortcuts
	});

	return dashboardViews;
});