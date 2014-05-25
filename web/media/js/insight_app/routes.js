define([
	'app',
	'backbone',
	'insight_app/regionManager'
], function(App, Backbone, regionManager){
	var Routes = Backbone.Router.extend({
		routes: {
			'': 'showDashboard',
			'dashboard': 'showDashboard',
			'login': 'showLogin'
		},
		showDashboard: function(){
			regionManager.showAll();
			require(['insight_app/dashboard/dashboard_app'],function(){
				App.execute('show:dashboard');
			});
		},
		showLogin: function(){
			regionManager.hideSubNavbar();
			require(['insight_app/login/login_app'],function(){
				App.execute('show:login');
			});
		}
	});

	App.addInitializer(function () {
		App.Routes = new Routes({});

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