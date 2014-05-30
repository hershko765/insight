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
	var ConfirmDialog =  Marionette.Layout.extend({
		initialize: function(){
			this.options.region.show(this)
		},
		onShow: function(){
			var _this = this;
			var options = $.extend({
					height: 180,
                    width: 300
				},
				_this.options, {
					buttons: [
						{
							"click": function(){
								_this.options.onConfirm();
								_this.options.region.close();
							},
							text: 'Confirm'
						},
						{
							"click": function(){
								_this.options.region.close();
							},
							text: 'Cancel'
						}
					]
				}
			);

			this.$el.css('line-height',3).dialog(options);
		},
		templateHelpers: function(){
			return {
				message: this.options.message
			}
		},
		defaultOptions: {
			resizable: false,
			modal: true
		},
		template: TplDialog,
		id: 'dialog-confirm',
		attributes: {
			title: 'Dialog Title'
		}
	});

	return ConfirmDialog
});