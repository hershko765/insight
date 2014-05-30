/**
 * ****DESCRIPTION OF FILE****
 *
 * @package    Sortex
 * @author     Sortex Systems Development Ltd.
 * @copyright  (c) 2011-2013 Sortex
 * @license    BSD
 * @link       http://www.sortex.co.il
 */
define(['backbone','app'], function(Backbone, App){

	var Collection = Backbone.Collection.extend({
		fetchList: function(options, callback){
			this.fetch({
				success: function(collection, response){
					if (callback) { callback(collection) }
				},
				data: $.extend(options.filters, options.settings, options)
			});
		}
	});

	return Collection
});