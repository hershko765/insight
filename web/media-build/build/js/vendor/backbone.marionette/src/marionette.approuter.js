Marionette.AppRouter=Backbone.Router.extend({constructor:function(e){Backbone.Router.prototype.constructor.apply(this,arguments),this.options=e||{};var t=Marionette.getOption(this,"appRoutes"),n=this._getController();this.processAppRoutes(n,t),this.on("route",this._processOnRoute,this)},appRoute:function(e,t){var n=this._getController();this._addAppRoute(n,e,t)},_processOnRoute:function(e,t){var n=_.invert(this.appRoutes)[e];_.isFunction(this.onRoute)&&this.onRoute(e,n,t)},processAppRoutes:function(e,t){if(!t)return;var n=_.keys(t).reverse();_.each(n,function(n){this._addAppRoute(e,n,t[n])},this)},_getController:function(){return Marionette.getOption(this,"controller")},_addAppRoute:function(e,t,n){var r=e[n];r||throwError("Method '"+n+"' was not found on the controller"),this.route(t,n,_.bind(r,e))}});