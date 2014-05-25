/**
 * Navbar View
 */
define([
	'app',
	'marionette',
	'components/view',
	'text!./templates/main.twig',
	'text!./templates/tools.twig'
], function(App, Marionette, View, tplMain, tplTools){

	var navbarViews = {};
	navbarViews.MainView = View.Layout.extend({
		template: tplMain,
		regions: {
			toolsRegion: '#tools-region'
		}
	});

	navbarViews.ToolsView = View.ItemView.extend({
		template: tplTools,
		onShow: function() {
			$('.diff').show({effect:"slide", direction: "left"});
		}
	});

	return navbarViews;
});