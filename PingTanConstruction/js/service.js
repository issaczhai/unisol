
var listProjects = function(result){

    for (var i = 0; i < result.length; i++) { 
        var row = cloneComponent('project-row', true, true);
        row.find('.row-count').text(i+1);
        row.find('.row-projectName').text(result[i].projectName);
        row.find('.row-startDate').text(result[i].startDate);
        row.find('.row-endDate').text(result[i].endDate);
        row.find('.row-value').text(result[i].value);
        row.find('.row-scopeOfWork').text(result[i].scopeOfWork);
        row.find('.row-client').text(result[i].client);
        row.find('.row-status').text(result[i].status);
        row.find('.edit-project-info-btn').attr('data-projectid', result[i].projectId);
        row.find('.edit-project-photo-btn').attr('data-projectid', result[i].projectId);
        row.find('.delete-project-btn').attr('data-projectid', result[i].projectId);
        row.css('display','');
        $('.project-list').append(row);
    }
};

var populateContact = function(result){
    document.getElementById("address").value = result.address;
    document.getElementById("freephone").value = result.freephone;
    document.getElementById("telephone").value = result.telephone;
    document.getElementById("fax").value = result.fax;
    document.getElementById("email").value = result.email;
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
		default : callback = null;
	}

	xhr = new Request(false, baseUrl, data, 'POST', callback);
	

})();

 