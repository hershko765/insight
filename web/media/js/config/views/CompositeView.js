/**
 * ****DESCRIPTION OF FILE****
 *
 * @package    Sortex
 * @author     Sortex Systems Development Ltd.
 * @copyright  (c) 2011-2013 Sortex
 * @license    BSD
 * @link       http://www.sortex.co.il
 */
define(['app', 'backboneBabysitter'], function(App){
	var CollectionView = Marionette.CompositeView.extend({
		initialize: function(){
			this.onCompositeCollectionRendered = function(){
				var opt = this;
				var childViews = new Backbone.ChildViewContainer();
				this.children.each(function(val){
					childViews.add(val, val.model.get('id'))
				});
				this.childViews = childViews;
				this.onAfterCollectionRender();
			}
		}
	});

	return CollectionView;
});