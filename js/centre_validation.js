$(document).ready(function(){
			$('#centreform_validation').formValidation({
					message: 'This value is not valid',
					icon: {
						valid: 'fa fa-check',
						invalid: 'fa fa-times',
						validating: 'fa fa-refresh'
					},
		
					fields: {
						centre_name: {
							validators: {
								notEmpty: {
									message: 'Name required'
								},
								stringLength: {
									min: 1,
									max: 30,
									message: 'Name no more than 30 characters'
								},
								regexp: {
									//regexp:/^[a-zA-Z0-9\-_\s]+$/,
									//similar to: (though, \w supports other Unicode characters)
									regexp: /^[\w\-\s]+$/,
									message: 'Name can only contain letters, numbers, hyphens, and underscore'
								},
							},
						},
					}
			});
		});