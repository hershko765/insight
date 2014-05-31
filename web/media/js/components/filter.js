define(['marionette'], function(Marionette){

	var FilterManager;
	FilterManager = Marionette.Controller.extend({
		initialize: function() {
			this.filters = {};
		},

		add: function(name, value) {
			this.filters[name] = value
		},

		remove: function(name) {
			delete this.filters[name];
		},

		getAll: function() {
			return this.filters;
		},

		reset: function() {
			this.filters = {};
		}
	});

	return FilterManager;
});