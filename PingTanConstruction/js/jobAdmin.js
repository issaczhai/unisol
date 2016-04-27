(function(){
    $('.delete-job-btn').on('click',function(){
        $('#deleteJobModalId').html("Job ID: " + $(this).data("jobid"));
        $('#deleteJobModalName').html("Job Name: " + $(this).data("jobname"));
        var jobid = $(this).data("jobid");
        $('.delete-job-confirm-btn').attr('data-jobid', jobid);
    });
    
    $('.delete-job-confirm-btn').on('click',function(){
        var xhr,
            baseUrl,
            data,
            postData = {};
        baseUrl = '../process_job.php';
        postData.operation = 'delete';
        postData.jobid = $(this).data("jobid");
        data = buildXHRData(postData);
        xhr = new Request(false,baseUrl, data, 'POST', function(result){
            window.location.reload();
        });
    });
    
    $('.add-qualification-btn').on('click',function(){
        $(".qualification-div input:last-child").after('<input type="text" class="form-control" id="qualification" name="qualification[]" multiple required>')
        $(".add-qualification-btn-div").css({"height":$(".qualification-div").height()});
    });
    
    $('.delete-qualification-btn').on('click',function(){
        $(".qualification-div input:last-child:not(:first-child)").remove();
        $(".add-qualification-btn-div").css({"height":$(".qualification-div").height()});
    });
    
    $('.add-offer-btn').on('click',function(){
        $(".offer-div input:last-child").after('<input type="text" class="form-control" id="offer" name="offer[]" multiple required>')
        $(".add-offer-btn-div").css({"height":$(".offer-div").height()});
    });
    
    $('.delete-offer-btn').on('click',function(){
        $(".offer-div input:last-child:not(:first-child)").remove();
        $(".add-offer-btn-div").css({"height":$(".offer-div").height()});
    });
/************************************************************************************/

    $('.edit-job-btn').on('click',function(){
        var xhr,
            baseUrl,
            data,
            postData = {};
        baseUrl = '../process_job.php';
        postData.operation = 'populateJobInfo';
        postData.jobid = $(this).data("jobid");
        data = buildXHRData(postData);
        xhr = new Request(false,baseUrl, data, 'POST', function(result){
            $(".editInfo-qualification-div input:not(:first-child)").remove();
            $(".editInfo-offer-div input:not(:first-child)").remove();
            document.getElementById("editJob-jobid").value = result.jobid;
            document.getElementById("editJob-postdate").value = result.postdate;
            document.getElementById("editJob-jobname").value = result.jobname;
            document.getElementById("editJob-location").value = result.location;
            document.getElementById("editJob-category").value = result.category;
            $("textarea#editInfo-job_description").val(result.description);
            $("textarea#editInfo-contact").val(result.contact);
            var select = document.getElementById("editJob-type");
            for (var i = 0; i < select.options.length; i++) { 
                if(select.options[i].value === result.type){
                    select.options[i].selected = "selected";
                }
            }
            var qualifications = JSON.parse(result.qualification);
            var offers = JSON.parse(result.offer);
            for(var i = 0; i < qualifications.length; i++){
                var input = cloneComponent('editInfo-qualification', true, true);
                input.val(qualifications[i]);
                input.addClass('form-control input-medium');
                input.attr('required', true);
                input.css('display','');
                $('.editInfo-qualification-div').append(input); 
            }
            //$(".editInfo-qualification-div input:first-child").remove();
            for(var i = 0; i < offers.length; i++){
                var input = cloneComponent('editInfo-offer', true, true);
                input.val(offers[i]);
                input.addClass('form-control input-medium');
                input.attr('required', true);
                input.css('display','');
                $('.editInfo-offer-div').append(input); 
            }
            //$(".editInfo-offer-div input:first-child").remove();
        });
    });
/************************************************************************************/
    $('.editInfo-add-qualification-btn').on('click',function(){
        $(".editInfo-qualification-div input:last-child").after('<input class="form-control input-medium" name="qualification[]" type="text" multiple="" required="">');
        
    });
    
    $('.editInfo-delete-qualification-btn').on('click',function(){
        $(".editInfo-qualification-div input:last-child:not(:nth-child(2))").remove();
        
    });
    
    $('.editInfo-add-offer-btn').on('click',function(){
        $(".editInfo-offer-div input:last-child").after('<input class="form-control input-medium" name="offer[]" type="text" multiple="" required="">')
    });
    
    $('.editInfo-delete-offer-btn').on('click',function(){
        $(".editInfo-offer-div input:last-child:not(:nth-child(2))").remove();
    });
    
    
})();

