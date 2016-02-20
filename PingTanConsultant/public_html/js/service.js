var listAllCourses = function(result){
		
		if(result.error === undefined){
			for(index = 0; index < result.length; index ++){
				var courseID = result[index].courseID,
					name = result[index].name,
					instructor = result[index].instructor,
					price = result[index].price,
					description = result[index].description;

				if(result[index].session){
					partTime = result[index].partTime;
					fullTime = result[index].fullTime;
					languageList = result[index].languages;// the language is string seperated by ','
					var courseThumbnail = cloneComponent('thumbnail-course-template', true, true);
					createCourseThumbnail(courseThumbnail, name, courseID, description, fullTime, partTime, languageList, 'courses');

					$('.result-courses').append(courseThumbnail);
				}
				
			}
			c = new Cookie();
			if($_GET('logBack') && c.getCookie('userType')==='individual'){
				
				targetCourse = c.getCookie('targetCourse');
				
				$('.modal-title').text(targetCourse);
				$('#register_individual_modal').modal('show');

			}
		}
		
};

var populateSessionDropdowns = function(sessions, selectStartDate, selectLanguage, selectCourseType, btnEnrollment){
	sessions.forEach( function(element, index) {
			var optionStartDate = document.createElement('option'),
				optionLanguage = document.createElement('option'),
				languageExist = false,
				language = element.languages,
				_courseType = element.fulltime ? 'fullTime' : 'partTime',
				_typeValue = element.fulltime ? element.fulltime : element.parttime,
				fullTime = element.fulltime ? element.fulltime : 'Not Available',
				partTime = element.parttime ? element.parttime : 'Not Available',
				classList = element.classlist.split(','),
				vacancy = element.classlist === '' ? element.vacancy : (element.vacancy - classList.length);
				
				if(vacancy <= 0 || _typeValue === 'Not Available'){
					btnEnrollment.addClass('disabled');
				}
				optionStartDate.value = element.startDate;
				optionStartDate.text = element.startDate;
				optionStartDate.dataset.vacancy = vacancy;
				optionStartDate.dataset.language = language;
				optionStartDate.dataset.sessionID = element.sessionID;
				optionStartDate.dataset.typeValue = _typeValue;
				optionStartDate.dataset.courseType = _courseType;
				optionStartDate.dataset.partTime = partTime;
				optionStartDate.dataset.fullTime = fullTime;
				selectStartDate.append($(optionStartDate));
				$(optionStartDate).css('display', 'none');
				// set the default session vacancy and start dates for default language
				if(index === 0){
					$(optionStartDate).css('display', 'block');
					$('.vacancy span').text(vacancy === 0 ? 'Full house, please choose other session' : vacancy);
					$('.dateTime span').text(_typeValue);
					$('option.option-fullTime').val('fullTime');
					$('option.option-fullTime').data('time', fullTime);
					$('option.option-partTime').val('partTime');
					$('option.option-partTime').data('time', partTime);
					if(_courseType === 'fullTime'){
						selectCourseType.val('fullTime');
					}else{
						selectCourseType.val('partTime');
					}

				}
				//populate the distinct languages of selected course
				$('.select-languages option').each(function(){
					var option = $(this);
					if(option.val() === language){
						languageExist = true;
						return false;
					}
					
				});
				
				if(!languageExist){
					optionLanguage.value = language;
					optionLanguage.text = language;
					optionLanguage.dataset.partTime = partTime;
					optionLanguage.dataset.fullTime = fullTime;
					selectLanguage.append($(optionLanguage));
				}
				
		});

	// check the vacancy accroding to the start date selected by user
	// set the start date of course registration form tally with user selection
	bindEvent(selectStartDate, 'change', function(){
		btnEnrollment.removeClass('disabled');
		var vacancy = $(".select-start-date option:selected").data('vacancy'),
			_typeValue = $(".select-start-date option:selected").data('typeValue');
		
		$('.select-start-date').val($(this).val());
		$('option.option-fullTime').data('time', $(".select-start-date option:selected").data('fullTime'));
		$('option.option-partTime').data('time', $(".select-start-date option:selected").data('partTime'));
		if($(".select-start-date option:selected").data('courseType') === 'fullTime'){

			$('.select-course-type').val('fullTime');
			$('option.option-fullTime').data('startDate', $(this).val());
			$('option.option-fullTime').data('language', $(this).val());

		}else{

			$('.select-course-type').val('partTime');
			$('option.option-partTime').data('startDate', $(this).val());
			$('option.option-fullTime').data('language', $(this).val());
		}
		$('.vacancy span').text(vacancy === 0 ? 'Full house, please choose other session' : vacancy);
		if(vacancy <= 0 || _typeValue === 'Not Available'){
			btnEnrollment.addClass('disabled');
		}
	});

	//set the language of course registration form tally with the user selection
	bindEvent(selectLanguage, 'change', function(){
		var selectLanguage = $(this).val(),
			firstStart = 0;
		btnEnrollment.removeClass('disabled');
		$('.select-languages').val(selectLanguage);
		$('.select-start-date option').each(function(){
			if($(this).data('language') === selectLanguage){
				//set the start date select default value to the earliest start date of selected language
				if(firstStart < 1){
					$('.select-start-date').val($(this).val());
					$('.vacancy span').text($(this).data('vacancy'));
					$('option.option-fullTime').data('time', $(this).data('fullTime'));
					$('option.option-partTime').data('time', $(this).data('partTime'));
					if($(this).data('courseType') === 'fullTime'){
						$('.select-course-type').val('fullTime');
						$('.dateTime span').text($(this).data('fullTime'));
					}else{
						$('.select-course-type').val('partTime');
						$('.dateTime span').text($(this).data('partTime'));
					}
					
					if($(this).data('typeValue') === 'Not Available'){
						btnEnrollment.addClass('disabled');
					}
					
					firstStart ++;
				}
				$(this).css('display', 'block');
			}else{
				$(this).css('display', 'none');
			}
		});
	});

	//set the language of course registration form tally with the user selection
	bindEvent($('.select-course-type'), 'change', function(){
		btnEnrollment.removeClass('disabled');
		$('.select-course-type').val($(this).val());
		//$(this).val($('.select-course-type option:selected').data('type'));
		var _type = $(this).val() === 'fullTime' ? 'fullTime' : 'partTime',
			option = 'option.option-' + _type;
		$('.dateTime span').text($(this).children(option).data('time'));
		console.log($('.dataTime span').text());
		if($(this).children(option).data('time') === 'Not Available'){
			btnEnrollment.addClass('disabled');
		}
	});

};

var setDefaultDropdownValues = function(defaultObject, selectStartDate, selectLanguage, selectCourseType, dateTime){
	selectStartDate.val(defaultObject.startDate);
	selectLanguage.val(defaultObject.language);
	selectCourseType.val(defaultObject.courseType);
	dateTime.text(defaultObject.dateTime);
};

//This method will also render the individual registration form
var render_course_detail = function(result){
	var course = result.course,
		sessions = result.sessions,
		student = result.student,
		cookie = new Cookie(),
		destUrl = './course_detail.php?courseID=' + course.courseID + '&logBack=true',
		prerequsites = result.prerequisites,
		name = course.name,
		description = course.description,
		//assume universal price for each session and course type
		price = course.price,
		syllabus = JSON.parse(course.syllabus),
		objective = course.objective,
		selectStartDate = $('.select-start-date'),
		selectLanguage = $('.select-languages'),
		selectCourseType = $('.select-course-type'),
		btnEnrollment = $('.btn-enrollment');

	//set hidden courseID input 
	$('.hidden-courseID').val(course.courseID);

	btnEnrollment.removeClass('disabled');
	$('h3.title-session').text(name);
	$('.detail-price').text("SGD " + price + " (GST Inclusive)");
	$('.detail-description').text(description);
	$('.detail-objective').text(objective);
	// set the direction of the register button
	triggerCourseRegisterType(cookie.getCookie('userType'), btnEnrollment, cookie, course.courseID, destUrl);
	//update syllabus
	for(var list in syllabus){
		if(syllabus.hasOwnProperty(list)){
			var listSyllabus = document.createElement('li'),
				spanWeek = document.createElement('span'),
				spanTitle = document.createElement('span');
			
			spanWeek.innerHTML = list + ": ";
			spanTitle.innerHTML = syllabus[list];

			$(listSyllabus).append($(spanWeek));
			$(listSyllabus).append($(spanTitle));

			$('.list-course-content').append($(listSyllabus));
		}
	}
	// render prerequisite
	if(prerequsites.length > 0){
		//display the msg to inform user to upload prerequisite
		$('.hd-prerequisite-msg').css('display', 'block');
		// render prerequisites
		prerequsites.forEach( function(element, index) {
			var prerequisite = document.createElement('h5'),
				preLink = document.createElement('a');
			// populate prerequisite in the course detail
			$(preLink).prop('href', './course_detail.php?courseID=' + element.courseID);
			$(preLink).prop('target', '_blank');
			$(preLink).text(element.courseName);
			$(preLink).addClass('yellow-default');
			$(prerequisite).addClass('prerequisite');
			$(prerequisite).append($(preLink));
			$('.course-prerequisite').append($(prerequisite));
			//populate prerequisite file upload inputs
			renderFileUpload(element.courseName, $('.form-individual-registration'));
		});	
	}else{
		var prerequisiteMsg = document.createElement('h5');
		$(prerequisiteMsg).addClass('prerequisite');
		$(prerequisiteMsg).addClass('yellow-default');
		$(prerequisiteMsg).text('No Prerequisite Required');
		$('.course-prerequisite').append($(prerequisiteMsg));
	}

	if(sessions.length > 0){
		populateSessionDropdowns(sessions, selectStartDate, selectLanguage, selectCourseType, btnEnrollment);
	}else{
		$('.warning-no-session').css('display', 'block');
		btnEnrollment.addClass('disabled');
	}
	/*** TO-DO: handle the course without any future session ***/

	//Populate the student personal information in registration form 
	//if user registered other course before
	if(student){
		populateStudentPersonalData(student);
	}

	
};

var render_student_profile = function(result){
	var cookie = new Cookie(),
		courseThumbnail,
		allDocument = result.document,
		error = result.error,
		upcoming = result.upcoming,
		taking = result.taking,
		taken = result.taken,
		i, j, k, l;

	$('.title-student-name a').text(cookie.getCookie('username'));

	//render the documents
	

	//render taking courses
	renderProfileThumbnail(taking, '.row-taking', 'thumbnail-taking-template');

	//render upcoming courses
	renderProfileThumbnail(upcoming, '.row-upcoming', 'thumbnail-upcoming-template');
	 // set the link for un-register

	//render taken courses
	renderProfileThumbnail(taken, '.row-taken', 'thumbnail-taken-template');

};

var listStudentApplication = function(result){

    for (var i = 0; i < result.length; i++) { 
        var row = cloneComponent('student-application-row', true, true);
        row.find('.input-checkbox').val(result[i].studentID+','+result[i].courseID+','+result[i].sessionID);
        row.find('.row-count').text(i+1);
        row.find('.row-studentid').text(result[i].studentID);
        row.find('.row-courseid').text(result[i].courseID);
        row.find('.row-sessionid').text(result[i].sessionID);
        row.find('.row-startdate').text(result[i].session.startDate);
        row.find('.btn-view-application').attr('data-studentid', result[i].studentID);
        row.find('.btn-view-application').attr('data-courseid', result[i].courseID);
        row.find('.btn-view-application').attr('data-sessionid', result[i].sessionID);
        row.css('display','');
        $('.student-application-list').append(row);
    }
};

var render_company_registration = function(result){
	var prerequisites = result.prerequisites,
		sessions = result.sessions,
		course = result.course,
		defaultChoice = result.default,
		companyStudentList = result.companyStudents,
		selectStartDate = $('.select-start-date'),
		selectLanguage = $('.select-languages'),
		selectCourseType = $('.select-course-type'),
		dateTime = $('.dateTime span'),
		duration = $('.duration span'),
		btnEnrollment = $('#btn-company-register');

		$('.hidden-courseID').val(course.courseID);

		// set the course title in the page
		$('#title-course').text(course.name);

		// render prerequisite file upload input
		if(prerequisites.length > 0){
			// render prerequisites
			prerequisites.forEach( function(element, index) {
				
				//populate prerequisite file upload inputs
				renderFileUpload(element.courseName, $('.participant'));
			});	
		}

		//render the existing user
		if(companyStudentList > 0){
			for(var index =0; index < companyStudentList.length; index++){
				var li = document.createElement('li'),
					eachStudent = companyStudentList(index);
				$(li).text(eachStudent.firstname + ' ' + eachStudent.lastname);
				$(li).data('nric', eachStudent.nric);
				$(li).data('firstName', eachStudent.firstname);
				$(li).data('lastName', eachStudent.lastname);
				$(li).data('nationality', eachStudent.nationality);
				$(li).data('contactNo', eachStudent.contactNo);
				$(li).data('email', eachStudent.email);
				$(li).data('dob', eachStudent.dateOfBirth);
				$(li).data('occupation', eachStudent.occupation);
			}
		}

		//render remove participan button
		var btnRemoveParticipant = cloneComponent('btn-remove-participant-template', true, true);
		$('.participant').append(btnRemoveParticipant);

		// populate default dropdown lists and set other options for each session
		if(sessions.length > 0){
			populateSessionDropdowns(sessions, selectStartDate, selectLanguage, selectCourseType, 
				btnEnrollment);

			// set the values of the user previous selection
			setDefaultDropdownValues(defaultChoice, selectStartDate, selectLanguage, selectCourseType, 
										dateTime, duration);
		}

};

(function(){
	var xhr,
		baseUrl,
		postData = {},
		index,
		targetCourse,
		c,
		courseID,
		callback;

	var service = window.location.pathname.split(/\.|\//)[window.location.pathname.split(/\.|\//).length - 2];
	c = new Cookie();
	// Page Rendering Services
	switch(service){
		case "courses": 
			baseUrl = './service_courses.php';
			postData.type = 'all';
			data = buildXHRData(postData);
			callback = listAllCourses;
			
			break;

		case "course_detail":
			courseID = $_GET('courseID');
			postData.courseID = courseID;
			data = buildXHRData(postData);
			baseUrl = './service_course_detail.php';
			callback = render_course_detail;

			break;

		case "register_course_company":
			courseID = $_GET('courseID');
			var _startDate = $_GET('startDate'),
				_courseType = $_GET('courseType'),
				_language = $_GET('language'),
				_dateTime = $_GET('dateTime'),
				_sessionID = $_GET('sessionID');

			postData.courseID = courseID;
			postData.startDate = _startDate;
			postData.courseType = _courseType;
			postData.language = _language;
			postData.dateTime = _dateTime;
			postData.sessionID = _sessionID;

			data = buildXHRData(postData);
			baseUrl = './service_company_registration.php';
			callback = render_company_registration;

			break;

		case "profile_student":
			var email = c.getCookie("email"),
				studentID = c.getCookie("studentID");
			postData.email = email;
			postData.studentID = studentID;
			data = buildXHRData(postData);
			baseUrl = './service_student_profile.php';
			callback = render_student_profile;
			
			break;

		case "application": 
			baseUrl = '../service_application.php';
                        postData.operation = 'retrievePendingList';
			data = buildXHRData(postData);
			callback = listStudentApplication;

			break;

		default : callback = null;
	}

	xhr = new Request(false, baseUrl, data, 'POST', callback);
	

})();

 