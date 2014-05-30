define([
	'app',
	'backbone',
	'insight_app/regionManager'
], function(App, Backbone, regionManager){
	var Routes = Backbone.Router.extend({
		routes: {
			'': 'showDashboard',
			'dashboard': 'showDashboard',
			'addons': 'showAddons'
		},
		showDashboard: function(){
			regionManager.showAll();
			require(['insight_app/dashboard/dashboard_app'],function(){
				App.execute('show:dashboard');
			});
		},
		showAddons: function(){
			regionManager.showAll();
			require(['insight_app/addon/addon_app'],function(){
				App.execute('show:addon');
			});
		}
	});

	
	App.addInitializer(function () {
		App.Routes = new Routes({});


		App.Routes.on('route', function(route, params){ });
	});
	
	App.on('initialize:after', function () {
		App.getCurrentRoute = function(){
			return Backbone.history.fragment
		};

		if (Backbone.history) {
			Backbone.history.start();
		}
	});

	return Routes;
});