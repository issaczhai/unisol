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
			if(this.userType === 'student'){

				$('#register_individual_modal').modal('show');

			}else if(this.userType === 'company'){

				window.location('./register_course_company.php');
				
			}
		}
	};

	var Registration = {

		fileJsonArr : [],

		fileCounter : 0,

		init : function(){
			this.btnIndividualRegister = $('.btn-individual-register');
			this.btnCompanyRegister = $('.btn-company-register');
			this.bindEvent();
		},

		bindEvent : function(){
			this.btnIndividualRegister.on('click', this.register);
			this.btnCompanyRegister.on('click', this.register);
			$('.input-prerequisite').on('change', function(){
				var file = this.files[0],
					fileJson = {},
					fileName = file.name;

				fileJson.fileName = file;
				Registration.fileJsonArr[Registration.fileCounter] = fileJson.fileName.name;

				Registration.fileCounter ++;
			});
		},

		register : function(){
			var type = $(this).hasClass('btn-individual-register') ? 'individual' : 'company',
				baseUrl = type === 'individual' ? './process_course_registration_individual.php' : 
										"./process_course_registration_company.php",
				postData = {}, data, xhr,
				validation = new Validation(),
				validationStatus = true;
				if(type === 'individual'){
				// construct POST request parameters
					postData.courseID = $('.hidden-courseID').val();
					postData.sessionID = $('.hidden-sessionID').val();
				    postData.courseType = $('.select-course-type option:selected').val();
				    postData.time = $('.parameter-dateTime span').text();
				    postData.language = $('.select-languages option:selected').val();
				    postData.startDate = $('.select-start-date option:selected').val();
					postData.nric = $('.input-nric').val();
					postData.nationality = $('.input-nationality').val();
					postData.contactNum = $('.input-contactNum').val();
					postData.dob = $('.input-dob').val();
					postData.occupation = $('.input-occupation').val();
					/*$('.input-prerequisite').each(function(index){
						console.log($(this).get(0).files.length);
						var file = this.files[0],
							fileJson = {},
							fileName = file.name;

						fileJson.fileName = file;
						fileJsonArr[index] = fileJson;
					});*/
					postData.fileList = Registration.fileJsonArr;
					validation.addTest();
					validationStatus = validation.triggerValidation();
					data = buildXHRData(postData);
					console.log(data);
					/*if(validationStatus){
						xhr = new Request(urlBase, data, 'POST', function(result){

						});	
					}
					*/

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