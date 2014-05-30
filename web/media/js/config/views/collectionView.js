/**
 * ****DESCRIPTION OF FILE****
 *
 * @package    Sortex
 * @author     Sortex Systems Development Ltd.
 * @copyright  (c) 2011-2013 Sortex
 * @license    BSD
 * @link       http://www.sortex.co.il
 */
define(['app'], function(App){
	var CollectionView = Marionette.CollectionView.extend({
		initialize: function(){

			this.onRender = function(opt){

				var childViews = new Backbone.ChildViewContainer();
				this.children.each(function(val){
					childViews.add(val, val.model.get(opt.viewIndex))
				});

				this.childViews = childViews;
			}
		}
	});

	return CollectionView;
});