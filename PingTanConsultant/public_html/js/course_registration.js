(function(){
	var cookie = new Cookie();
	var TriggerForm = {
		init : function(){
			this.btnEnrollment = $('.btn-enrollment');
			this.bindEvent();
		},

		bindEvent : function(){
			this.btnEnrollment.on('click', this.renderRegistrationForm);
		},

		renderRegistrationForm: function(){
			this.userType = cookie.getCookie('userType');
			console.log(this.userType);
			$('#error-msg').find('h5').remove();
			if(this.userType === 'student'){
				$('#register_individual_modal').modal('show');

			}else if(this.userType === 'company'){

				window.location('./register_course_company.php');
				
			}
		}
	};

	var Registration = {

		init : function(){
			this.btnIndividualRegister = $('.btn-individual-register');
			this.btnCompanyRegister = $('.btn-company-register');
			this.bindEvent();
		},

		bindEvent : function(){
			this.btnIndividualRegister.on('click', this.register);
			this.btnCompanyRegister.on('click', this.register);
		},

		register : function(){
			var type = $(this).hasClass('btn-individual-register') ? 'individual' : 'company',
				baseUrl = type === 'individual' ? './process_course_registration_individual.php' : 
										"./process_course_registration_company.php",
				postData = {}, data, xhr, index,
				formData = new FormData(),
				validation = new Validation(),
				fileList = [],
				validationStatus = true;

				//Registration.formData = new FormData();
				// Register as individual student
				if(type === 'individual'){
				// construct POST request parameters
					$('input.input-prerequisite').each(function(){
						var file = $(this).get(0).files[0];
						
						formData.append($(this).data('file'), file, file.name);
					});
					
					formData.append('courseID', $('.hidden-courseID').val());
					formData.append('sessionID', $('.hidden-sessionID').val());
					formData.append('courseType', $('.select-course-type option:selected').val());
					formData.append('time', $('.parameter-dateTime span').text());
					formData.append('language', $('.select-languages option:selected').val());
					formData.append('startDate', $('.select-start-date option:selected').val());
					formData.append('nric', $('.input-nric').val());
					formData.append('nationality', $('.input-nationality').val());
					formData.append('contactNum', $('.input-contactNum').val());
					formData.append('dob', $('.input-dob').val());
					formData.append('occupation', $('.input-occupation').val());
					//Front End Validation
					validation.addTest('individual_registration', checkDOB($('.input-dob').val()), '* Please fill in date of birth');
					validation.addTest('individual_registration', checkNationality($('.input-nationality').val()), '* Please fill in nationality');
					validation.addTest('individual_registration', checkOccupation($('.input-occupation').val()), '* Please fill in occupation');
					validation.addTest('individual_registration', checkNRIC($('.input-nric').val()), '* Please fill in date of NRIC or passport number');
					validation.addTest('individual_registration', checkContactNo($('.input-contactNum').val()), '* Please fill in contact number');

					validationStatus = validation.triggerValidation();
					//data = buildXHRData(postData);
					//console.log(formData);
					if(validationStatus){
						//upload the file to server
						

						xhr = new Request(true, baseUrl, formData, 'POST', function(result){

						});	
					}

				}else if(type === 'company'){

				}

		}

	};
	// trigger the registration form according to the logged in user type
	TriggerForm.init();
	// trigger registration process
	Registration.init();

})();

var addFile = function(counter, array){
	var file = this.files[0],
		fileJson = {},
		fileName = file.name;

	fileJson.fileName = file;
	array[fileCounter] = fileJson;

	counter ++;
};

var showRegistrationError = function(msg){
	var errorMsg = document.createElement('h5');
	$(errorMsg).addClass('red-default');
	$(errorMsg).text(msg);
	$('#error-msg').append($(errorMsg));
};