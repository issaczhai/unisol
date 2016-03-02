(function(){
    $('.delete-project-btn').on('click',function(){
        var xhr,
            baseUrl,
            data,
            postData = {};
        baseUrl = '../process_project.php';
        postData.operation = 'delete';
        postData.projectId = $(this).data("projectid");
        data = buildXHRData(postData);
        xhr = new Request(false,baseUrl, data, 'POST', function(result){
            window.location.reload();
        });
    });
})();