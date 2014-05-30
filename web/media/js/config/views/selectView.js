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
	var SelectView = {};

	SelectView.OptionView = Marionette.ItemView.extend({
		tagName: 'option',
		template: _.template('<%=title%>'),
		attributes: function(){
			var view = this;
			var attr = {
				value : this.model.get( view.options.IDField || 'id') || null
			};

			if(parseInt(this.options.selected) == this.model.get(view.options.IDField || 'id')){
				attr.selected = 'selected'
			}
			return attr;
		}
	});

	SelectView.Wrapper = Marionette.CollectionView.extend({
		tagName: 'optgroup',
		attributes: {
			label: 'Select'
		},
		itemView: SelectView.OptionView
	});

	App.reqres.setHandler('select:view', function(collection, options){
		var emptyLabel = {
			title : '- None -'
		};
		emptyLabel[options.IDField || 'id'] = 'null';
		collection.unshift(emptyLabel);

		return new SelectView.Wrapper({
			collection: collection,
			itemViewOptions: options || {}
		});
	});
});