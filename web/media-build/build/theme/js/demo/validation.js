$(function(){var e={rules:{name:{minlength:2,required:!0},email:{required:!0,email:!0},subject:{minlength:2,required:!0},message:{minlength:2,required:!0},validateSelect:{required:!0},validateCheckbox:{required:!0,minlength:2},validateRadio:{required:!0}}},t=$.extend(e,Application.validationRules);$("#validation-form").validate(t)});