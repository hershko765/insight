/**
 * Addon Entity
 */
define([
	'app',
	'config/collection',
	'config/model'
], function(App, Collection, Model){

	var Addon = {};

	Addon.Model = Model.extend({
		urlRoot: '/api/v1/addons'
	});

	Addon.Collection = Collection.extend({
		url: '/api/v1/addons'
	});

	var API = {
		getAddon: function(id, callback) {
			var entity = new Addon.Model({ id: id});
			entity.fetchCall(callback);
		},
		getAddons: function(options, callback) {
			var entities = new Addon.Collection();
			entities.fetchList((options || {}), callback);
		}

	};

	App.commands.setHandler('get:addon:entity', function(id, callback){
		API.getAddon(id, callback);
	});

	App.commands.setHandler('get:addon:entities', function(options, callback){
		API.getAddons(options, callback);
	});

	App.reqres.setHandler('get:active:addon', function(id){
		return Server.addonInfo || {};
	});

	return API;
});