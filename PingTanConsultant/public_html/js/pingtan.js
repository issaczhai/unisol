var cloneComponent = function(className, childrenBool, eventBool){
	
	var component = $('.' + className);
	var copy = $('.' + className).clone(childrenBool, eventBool);
	copy.removeClass(className);

	return copy;
};

var createCourseThumbnail = function(jqueryObject, name, courseID, description, fulltime, parttime, languages, page){
	var c = new Cookie(),
		destUrl = './courses.php?logBack=true',
		urlDetail = './course_detail.php?courseID=' + courseID,
		btnViewDetails = jqueryObject.find('.course-thumbnail-btns .btn-view-details'),
		fullTimeAvailability, partTimeAvailability;

	jqueryObject.find('.title-course').text(name);
	jqueryObject.find('.block-ellipsis').text(description);
	if(page === 'courses'){
		fullTimeAvailability = fulltime ? 'Available' : 'Not Available';
		partTimeAvailability = parttime ? 'Available' : 'Not Available';
		jqueryObject.find('.title-lang').text(languages);
		jqueryObject.find('.title-fulltime').text('Full-time: ' + fullTimeAvailability);
		jqueryObject.find('.title-parttime').text('Part-time: ' + partTimeAvailability);
		btnRegister = jqueryObject.find('.course-thumbnail-btns .btn-register');
		//triggerCourseRegisterType(c.getCookie('userType'), btnRegister, c, courseID, destUrl);
	}else{
		// when the thumbnail is created for profile, the fulltime = parttime according to user registration type
		jqueryObject.find('.title-lang').text("Teaching Language: " + languages);
		jqueryObject.find('.title-calendar').text('Schedule: ' + fulltime);
	}
	btnRegister.prop('href', urlDetail);
	btnViewDetails.prop('href', urlDetail);
};

var gotoPage = function(url){
	window.location = url;
};

function $_GET(param) {
	var vars = {};
	window.location.href.replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var buildUrl = function(baseUrl, data){
    
    return baseUrl + '?' + data;
};

var buildXHRData = function(dataObject){
    var data = '';
    for(var eachData in dataObject){
        if(dataObject.hasOwnProperty(eachData)){
            data += (eachData + '=' + dataObject[eachData] + '&');
        }
    }

    return data;
};

var bindEvent = function(object, event, callback){
	object.on(event, callback);
};

var triggerCourseRegisterType = function(type, element, cookie, courseID, destUrl){
	if(type === 'company' || type === 'student'){
		$('.modal-title').text(courseID);
		/*url = './course_detail.php?courseID=' + courseID;
		element.prop('href', url);
	}else if(type === 'student'){
		bindEvent(element, 'click', function(){
			
			$('#register_individual_modal').modal('show');
		});*/
	}else{
	// direct user to login page if the userType cookie is not set
		cookie.setCookie('targetCourse', courseID, "null", "null");
		url = "./login.php?destUrl=" + destUrl;
		element.prop('href', url);
	}
};

var renderProfileThumbnail = function(array, row, template){
	var i;
	for(i = 0; i < array.length; i++){
		var each = array[i],
			name = each.name,
			courseID = each.courseID,
			description = each.description,
			type = each.type,
			language = each.language,
			thumbnail = cloneComponent(template,true, true);

		createCourseThumbnail(thumbnail, name, courseID, description, type, type, language, 'profile');
		$(row).append(thumbnail);
	}
};

var renderFileUpload = function(prerequisite){
	var upload = cloneComponent('file-upload-template', true, true);
	upload.find('label-prerequisite').text(prerequisite);
	upload.find('input').attr('id', 'file' + prerequisite);
	$('.form-individual-registration').append(upload);
};