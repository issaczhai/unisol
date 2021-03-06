(function(){
    $('.delete-project-btn').on('click',function(){
        $('#deleteModalId').html("Project ID: " + $(this).data("projectid"));
        $('#deleteModalName').html("Project Name: " + $(this).data("projectname"));
        var projectid = $(this).data("projectid");
        $('.delete-confirm-btn').attr('data-projectid', projectid);
    });
    
    $('.delete-confirm-btn').on('click',function(){
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
    
    $('.edit-project-info-btn').on('click',function(){
        var xhr,
            baseUrl,
            data,
            postData = {};
        baseUrl = '../process_project.php';
        postData.operation = 'populateProjectInfo';
        postData.projectId = $(this).data("projectid");
        data = buildXHRData(postData);
        xhr = new Request(false,baseUrl, data, 'POST', function(result){
            document.getElementById("editInfo-projectId").value = result.projectId;
            document.getElementById("editInfo-projectName").value = result.projectName;
            document.getElementById("editInfo-endDate").value = result.endDate;
            document.getElementById("editInfo-value").value = result.value;
            document.getElementById("editInfo-scopeOfWork").value = result.scopeOfWork;
            document.getElementById("editInfo-contract").value = result.contract;
            document.getElementById("editInfo-client").value = result.client;
            var select = document.getElementById("editInfo-status");
            for (var i = 0; i < select.options.length; i++) { 
                if(select.options[i].value === result.status){
                    select.options[i].selected = "selected";
                }
            }
        
        });
    });
    
    $('.edit-project-photo-btn').on('click',function(){
        var xhr,
            baseUrl,
            data,
            postData = {};
        baseUrl = '../process_project.php';
        postData.operation = 'populateProjectPhoto';
        postData.projectId = $(this).data("projectid");
        data = buildXHRData(postData);
        xhr = new Request(false,baseUrl, data, 'POST', function(result){
            document.getElementById("editPhoto-projectId").value = result.projectId;
            document.getElementById("editPhoto-projectName").value = result.projectName;
            var photoList = JSON.parse(result.photo);
            var keys = [];
            for (var key in photoList) {
                if (photoList.hasOwnProperty(key)) {
                  keys.push(key);
                }
            }
            //delete previous record
            $('.image-row').find('.appended').remove();
            $('#editPhotoForm').find('.delId').remove();
            for(var i = 0 ; i<keys.length; i++ ){
                var thumb = cloneComponent('image-thumb', true, true);
                thumb.addClass('appended');
                thumb.find('.project-photo_thumb').attr('src','../'+photoList[keys[i]]);
                thumb.find('.delete-photo-btn').attr('data-photoid', keys[i]);
                thumb.css('display','');
                $('.image-row').append(thumb);
            }
//            var thumb = cloneComponent('image-thumb', true, true);
//            thumb.find('img').src = ;
        });
    });
    
    $('.delete-photo-btn').on('click',function(){
        var photoid = $(this).data("photoid");
        //hide the parent div
        $(this).parent().css("display", "none");
        //add photoid into delId input
        $('#editPhotoForm').append('<input type="hidden" name="delId[]" class="delId" value="'+photoid+'"/>');
    });
   
    
})();