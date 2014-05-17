Marionette.Layout=Marionette.ItemView.extend({regionType:Marionette.Region,constructor:function(e){e=e||{},this._firstRender=!0,this._initializeRegions(e),Marionette.ItemView.prototype.constructor.call(this,e)},render:function(){return this.isClosed&&this._initializeRegions(),this._firstRender?this._firstRender=!1:this.isClosed||this._reInitializeRegions(),Marionette.ItemView.prototype.render.apply(this,arguments)},close:function(){if(this.isClosed)return;this.regionManager.close(),Marionette.ItemView.prototype.close.apply(this,arguments)},addRegion:function(e,t){var n={};return n[e]=t,this._buildRegions(n)[e]},addRegions:function(e){return this.regions=_.extend({},this.regions,e),this._buildRegions(e)},removeRegion:function(e){return delete this.regions[e],this.regionManager.removeRegion(e)},getRegion:function(e){return this.regionManager.get(e)},_buildRegions:function(e){var t=this,n={regionType:Marionette.getOption(this,"regionType"),parentEl:function(){return t.$el}};return this.regionManager.addRegions(e,n)},_initializeRegions:function(e){var t;this._initRegionManager(),_.isFunction(this.regions)?t=this.regions(e):t=this.regions||{},this.addRegions(t)},_reInitializeRegions:function(){this.regionManager.closeRegions(),this.regionManager.each(function(e){e.reset()})},_initRegionManager:function(){this.regionManager=new Marionette.RegionManager,this.listenTo(this.regionManager,"region:add",function(e,t){this[e]=t,this.trigger("region:add",e,t)}),this.listenTo(this.regionManager,"region:remove",function(e,t){delete this[e],this.trigger("region:remove",e,t)})}});