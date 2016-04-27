var listProjects = function(result){

    for (var i = 0; i < result.length; i++) { 
        var row = cloneComponent('project-row', true, true);
        row.find('.row-count').text(i+1);
        row.find('.row-projectName').text(result[i].projectName);
        row.find('.row-endDate').text(result[i].endDate);
        row.find('.row-value').text(result[i].value);
        row.find('.row-scopeOfWork').text(result[i].scopeOfWork);
        row.find('.row-client').text(result[i].client);
        row.find('.row-status').text(result[i].status);
        row.find('.edit-project-info-btn').attr('data-projectid', result[i].projectId);
        row.find('.edit-project-photo-btn').attr('data-projectid', result[i].projectId);
        row.find('.delete-project-btn').attr('data-projectid', result[i].projectId);
        row.find('.delete-project-btn').attr('data-projectname', result[i].projectName);
        row.css('display','');
        $('.project-list').append(row);
    }
};

var listJobs = function(result){
    for (var i = 0; i < result.length; i++) { 
        var row = cloneComponent('job-row', true, true);
        row.find('.row-jobid').text(result[i].jobid);
        row.find('.row-jobname').text(result[i].jobname);
        row.find('.row-type').text(result[i].type);
        row.find('.row-category').text(result[i].category);
        row.find('.row-postdate').text(result[i].postdate);
        row.find('.row-lastedit').text(result[i].lastedit);
        row.find('.row-status').text(result[i].status);
        row.find('.edit-job-btn').attr('data-jobid', result[i].jobid);
        row.find('.delete-job-btn').attr('data-jobid', result[i].jobid);
        row.find('.delete-job-btn').attr('data-jobname', result[i].jobname);
        row.css('display','');
        $('.job-list').append(row);
    }
}

var populateContact = function(result){
    document.getElementById("address").value = result.address;
    document.getElementById("freephone").value = result.freephone;
    document.getElementById("telephone").value = result.telephone;
    document.getElementById("fax").value = result.fax;
    document.getElementById("email").value = result.email;
};

var renderProjects = function (result) {
	 // render each project as thumbnail
	 	// set id for each li as project id 
	 	// set data-img = json string imgs for $('.gallery a.lightbox')
	if(result.error){
		// no projects are in DB
		
		return;
	}

	for(var i = 0; i < result.length; i++){
		/*console.log(result[i].photo);*/
		var project = result[i],
			photoListJson = $.parseJSON(project.photo),
			photoList;

		// convert the json object into array with all values
		photoList = convertJsonToValueArray(photoListJson);
		// set the first child of gallery as template and clone it
		//var projectThumb = $('ul.gallery li:first-child').clone(true, true);
		var projectThumb = $('.thumbnail-template').clone(true, true);
		projectThumb.removeClass('thumbnail-template');
		projectThumb.addClass('thumbnail');
		projectThumb.find('span.p6').text(project.projectName);
		projectThumb.find('div.block3 .description').text(project.contract);
		projectThumb.find('a.lightbox').attr('href', photoList[0]);
		projectThumb.find('a.lightbox img').attr('src', photoList[0]);
		projectThumb.data('id', project.projectId);
		projectThumb.data('imgList', project.photo);
		projectThumb.data('period', project.endDate);
		projectThumb.data('value', project.value);
		projectThumb.data('contract', project.contract);
		projectThumb.data('client', project.client);
		projectThumb.data('scope', project.scopeOfWork);
		$('.gallery').append(projectThumb);
	}
	// hide the first child of gallery as template
	//$('ul.gallery li:first-child').css('display', 'none');
	$('.thumbnail-template').css('display', 'none');

	// init the overlay carousel overlay
	$('.gallery a.lightbox').touchTouch();

};

(function(){
	var xhr,
		baseUrl,
		postData = {},
		index,
		callback,
		pathname = window.location.pathname;

	var service = getFileName(pathname);
	// Page Rendering Services
	switch(service){
            case "projects": 
                    baseUrl = '../process_project.php';
                    postData.operation = 'getProjectList';
                    data = buildXHRData(postData);
                    callback = listProjects;
                    break;
            case "contact": 
                    baseUrl = '../process_contact.php';
                    postData.operation = 'getContact';
                    data = buildXHRData(postData);
                    callback = populateContact;
                    break;
            case "project": 
                    baseUrl = './Service/service_projects.php';
                    postData.type = 'all';
                    data = buildXHRData(postData);
                    callback = renderProjects;

                    break;
            case "job": 
                    baseUrl = '../process_job.php';
                    postData.operation = 'getJobList';
                    data = buildXHRData(postData);
                    callback = listJobs;

                    break;

            default : callback = null;
	}

	xhr = new Request(false, baseUrl, data, 'POST', callback);
	
})();

 