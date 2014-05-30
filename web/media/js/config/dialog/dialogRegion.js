/**
 * ****DESCRIPTION OF FILE****
 *
 * @package    Sortex
 * @author     Sortex Systems Development Ltd.
 * @copyright  (c) 2011-2013 Sortex
 * @license    BSD
 * @link       http://www.sortex.co.il
 */
define([
	'app',
	'stache!config/dialog/templates/_dialog'
], function(App, TplDialog){


	var dialogButtons = {
		form: function(view) {
			return {
				"click": function(){
					view.$el.find('form').trigger('submit');
				},
				"class": 'danger',
				text: 'Save'
			}
		}
	};

	var DialogRegion = Backbone.Marionette.Region.extend({
		onShow: function(view){

			var options = $.extend({
					resizable: false,
					modal: true,
					position:['middle', 150],
					width: '40%',
					buttons: this.getButtoms(view)
				}, view.dialog);

			view.$el.dialog(options);
		},

		getButtoms: function(view){
			var btns = [],
				_this = this;
			if(view.dialog) {
				$.each((view.dialog.dialogBtns || {}), function(inx, val){
					if(dialogButtons[val]) {
						btns.push(dialogButtons[val](view));
						return;
					}

					btns.push({
						"click": function(){
							if(val.click) { val.click() }
							if(val.close) { view.$el.dialog("close"); }
						},
						"class": 'danger',
						text: val.label
					})
				});
			}
			btns.push({
				click: function(){
					view.$el.dialog("close");
				},
				text: "Close"
			});

			return btns;
		},
		isDialog: true
	});

	return DialogRegion;
});