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
			$('#error-msg').find('h5').remove();
			if(this.userType === 'student'){
				$('#register_individual_modal').modal('show');

			}else if(this.userType === 'company'){
				var _courseID = $_GET('courseID'),
					_startDate = $('.select-start-date option:selected').val(),
					_courseType = $('.select-course-type option:selected').val(),
					_language = $('.select-languages option:selected').val(),
					_dateTime = $('.parameter-dateTime span').text(),
					_selectSessionID = $('.hidden-sessionID').val();
					_duration = $('.duration span').text();

				window.location = './register_course_company.php?courseID=' + _courseID + '&startDate=' +
					_startDate + '&courseType=' + _courseType + '&language=' + _language + '&dateTime=' +
					_dateTime + '&duration=' + _duration + '&sessionID=' + _selectSessionID;
			}
		}
	};

	var Registration = {

		init : function(){
			this.btnIndividualRegister = $('.btn-individual-register');
			this.btnCompanyRegister = $('#btn-company-register');
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
				validationStatus = true,
				numOfUplodingFile = 0,
				participantArr = [],
				jsonParticipantList;

				// clear all error Msg
				$('#error-msg').find('h5').remove();

				// Register as individual student
				if(type === 'individual'){
				// construct POST request parameters
					$('input.input-prerequisite').each(function(){
						var file = $(this).get(0).files[0];
						if (file === undefined) return false;

						numOfUplodingFile ++;	
						formData.append($(this).data('file'), file, file.name);
					});
					
					formData.append('courseID', $('.hidden-courseID').val());
					formData.append('sessionID', $('.select-start-date option:selected').data('sessionID'));
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
					validation.addTest('individual_registration', checkNumOfPrerequisitesUpload($('.input-prerequisite').size(), numOfUplodingFile), '* Please upload all prerequisite certifications required by this course');
					
					validationStatus = validation.triggerValidation();

					if(validationStatus){
						//upload the file to server
						xhr = new Request(true, baseUrl, formData, 'POST', function(result){
							
							if(result.error.length === 0) $('#register_individual_modal').modal('hide');
							// TO-DO: direct the user to payment page
							
						});	
					}

				}else if(type === 'company'){
					formData.append('courseID', $('.hidden-courseID').val());
					formData.append('sessionID', $('.select-start-date option:selected').data('sessionID'));
					formData.append('courseType', $('.select-course-type option:selected').val());
					formData.append('dateTime', $('.parameter-dateTime span').text());
					formData.append('language', $('.select-languages option:selected').val());
					formData.append('startDate', $('.select-start-date option:selected').val());

					$('.participant').each(function(index, element) {
						var participant = {},
							_nric = $(this).find("input[name='ic']").val(),
							_firstName = $(this).find("input[name='firstName']").val(),
							_lastName = $(this).find("input[name='lastName']").val(),
							_nationality = $(this).find("input[name='nationality']").val(),
							_contact = $(this).find("input[name='contact']").val(),
							_email = $(this).find("input[name='email']").val(),
							_dob = $(this).find("input[name='dob']").val(),
							_occupation = $(this).find("input[name='occupation']").val();

						participant.nric = _nric;
						participant.firstName = _firstName;
						participant.lastName = _lastName;
						participant.nationality = _nationality;
						participant.contact = _contact;
						participant.email = _email;
						participant.dob = _dob;
						participant.occupation = _occupation;
						participantArr.push(participant);
						jsonParticipantList = JSON.stringify(participantArr);

						$(this).find('input.input-prerequisite').each(function(){
							var file = $(this).get(0).files[0],
								prerequisiteName = $(this).data('file'),
								username = _lastName + _firstName;
							if (file === undefined) return false;

							formData.append(prerequisiteName + '_' + username, file, file.name);
						});

					});

					formData.append('jsonParticipantList', jsonParticipantList);

					xhr = new Request(true, baseUrl, formData, 'POST', function(result){
							
						
					});	
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