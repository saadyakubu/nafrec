$(document).ready(function(){
			$('#lgaform_validation').formValidation({
					message: 'This value is not valid',
					icon: {
						valid: 'fa fa-check',
						invalid: 'fa fa-times',
						validating: 'fa fa-refresh'
					},
		
					fields: {
						lga_name: {
							validators: {
								notEmpty: {
									message: 'LGA Name required'
								},
								stringLength: {
									min: 1,
									max: 40,
									message: 'Name no more than 40 characters'
								},
								regexp: {
									//regexp:/^[a-zA-Z0-9\-_\s]+$/,
									//similar to: (though, \w supports other Unicode characters)
									//regexp: /^[\w\-\s]+$/,				
									//message: 'Name can only contain letters, numbers, hyphens, and underscore'
									regexp: /^[\w\-\s]+$/,
									message: 'Name can only contain letters, underscore and hyphens'
								},
							},
						},
					}
			});
		});