(function(){
	$('#select-filter').on('change', function(event) {
		$('.thumbnail-template').css('display', 'inline');
		$('.thumbnail').remove();
		var xhr,
			baseUrl,
			postData = {},
			index,
			callback,
			type;
		switch ($(this).val()) {
			case "all projects":
				type = 'all';
				break;
			case "ongoing projects":
				type = 'Ongoing';
				break;
			case "completed projects":
				type = 'Completed';
				break;
			default:
				// statements_def
				break;
		}
		baseUrl = './Service/service_projects.php';
        postData.type = type;
		data = buildXHRData(postData);
		callback = renderProjects;
		xhr = new Request(false, baseUrl, data, 'POST', callback);
	});
})();