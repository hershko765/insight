define([
	'app',
	'admin/page/form/view',
	'toastr',
	'serializeForm',
	'jqueryForm'
], function(App, View, Notices){
	var FormController =  Marionette.Controller.extend({

		initForm: function(formView, pageEntity, options){
			var _this = this;
			var values = formView.$el.find('form').serializeForm();

			this.formView = formView;
			this.options = options;
			if(pageEntity.get('id')) {
				values['id'] = pageEntity.get('id');
			}

			$.each(values, function(idx, val){
				if(val == 'null') {
					values[idx] = null;
				}
			});

			// Add checkbox'es
			formView.$el.find('input[type=checkbox]').each(function(idx, val){
				values[$(val).prop('name')] = $(val).is(':checked');
			});
			

			values = $.extend(pageEntity.toJSON() || {}, values);
			
			// Bind "this" object
			_.bindAll(this, 'onValidationError');
			_.bindAll(this, 'onSuccess');

			options.fileForm && ! pageEntity.get('id')
				? formView.$el.find('form').ajaxUpload({
					url: formView.$el.find('form').prop('action'),
					success: _this.onSuccess,
					error: function(response){
						var responseNew = {};
						responseNew.responseJSON = JSON.parse(response.responseText);
						_this.onValidationError('', responseNew)
					}
				})
				: App.request(options.trigger, values, {
				success: _this.onSuccess,
				error:   _this.onValidationError
			});

			return false;
		},

		onValidationError: function(model, response){
			// Add a global notice to inform that the form contain errors
			Notices.error(lang('Form contain errors, please review the marked fields'));
			// Get form element
			var form = this.formView.$el.find('form');

			// Clear old errors
			form.find('.parsley-error-list').remove();

			// Add errors
			$.each(response.responseJSON.payload, function(inx, val){
				form.find('[name='+inx+']:input').after(
					$('<div></div>', { 'class': 'parsley-error-list' }).html(lang(val))
				);
			});

		},

		onSuccess: function(response){
			Notices.success(lang(this.options.success));
			if(this.options.event) { App.vent.trigger(this.options.event) }
			if(this.options.redirect) { App.navigate(this.options.redirect, { trigger: true }); }
		},

		onClose: function(){}
	});

	return FormController;
});