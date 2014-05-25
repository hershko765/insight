define(['marionette'], function(Marionette){

	var animatedRegion =  Backbone.Marionette.Region.extend({
		el: "#subnavbar-region",

		initialize: function(options){
			// your init code, here
		},
		close: function(){
			var view = this.currentView;
			var _this = this;
			if (!view || view.isClosed){ return; }

			if(this.beforeClose) { this.beforeClose(view); }
			this.on('continue:close', function(){
				// call 'close' or 'remove', depending on which is found
				if (view.close) { view.close(); }
				else if (view.remove) { view.remove(); }
				Marionette.triggerMethod.call(_this, "close", view);
				delete _this.currentView;
			});
		},
		beforeClose: function(view) {
			var _this = this;
			view.$el.slideUp(function(){
				_this.trigger('continue:close')
			});
		}
	});

	return animatedRegion;
});