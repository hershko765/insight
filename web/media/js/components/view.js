/**
 * Base View object
 */
define(['app', 'marionette'], function(App, Marionette){
	var View = {};
	var customView = {
		onBeforeRender: function(){
			var helpers = this.templateHelpers ? this.templateHelpers() : {};
			this.templateHelpers = function() {
				return $.extend(
					helpers, {
					user: {
						'username': 'roee123',
						'full_name': 'Roee Hershko'
					}
				});
			}
		}
	};

	// Extend all types of view
	View.Layout         = Marionette.Layout.extend(customView);
	View.ItemView       = Marionette.ItemView.extend(customView);
	View.CompositeView  = Marionette.CompositeView.extend(customView);
	View.CollectionView = Marionette.CollectionView.extend(customView);

	return View;
});