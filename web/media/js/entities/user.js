/**
 * User Entity
 */
define([
	'app',
	'config/collection',
	'config/model'
], function(App, Collection, Model){

	var User = {};

	User.Model = Model.extend({
		urlRoot: '/api/v1/users'
	});

	User.Collection = Collection.extend({
		url: '/api/v1/users'
	});

	var API = {
		getUser: function(id, callback) {
			var entity = new User.Model({ id: id});
			entity.fetchCall(callback);
		},
		getUsers: function(callback) {
			var entities = new User.Collection();
			entities.fetchList({}, {}, callback);
		}

	};

	App.commands.setHandler('get:user:entity', function(id, callback){
		API.getUser(id, callback);
	});

	App.commands.setHandler('get:user:entities', function(callback){
		API.getUsers(callback);
	});

	App.reqres.setHandler('get:active:user', function(id){
		return Server.userInfo || {};
	});

	return API;
});