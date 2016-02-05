(function(){
    $('.btn-view-application').on('click',function(){
        var xhr,
            baseUrl,
            data,
            postData = {};
        baseUrl = '../service_application.php';
        postData.operation = 'retrieveIndividualApplication';
        postData.studentid = $(this).data("studentid");
        postData.courseid = $(this).data("courseid");
        postData.sessionid = $(this).data("sessionid");
	data = buildXHRData(postData);
        xhr = new Request(false,baseUrl, data, 'POST', function(result){
            console.log(result);
            $('#studentid').val(result.student.studentID);
            $('.application-studentid').text(result.student.studentID);
            
            $('#fname').val(result.student.fisrtname);
            $('.application-fname').text(result.student.firstname);
            
            $('#lname').val(result.student.lastname);
            $('.application-lname').text(result.student.lastname);
            
            $('#nric').val(result.student.nric);
            $('.application-nric').text(result.student.nric);
            
            $('#nationality').val(result.student.nationality);
            $('.application-nationality').text(result.student.nationality);
            
            $('#dob').val(result.student.dateOfBirth);
            $('.application-dob').text(result.student.dateOfBirth);
            
            $('#contact').val(result.student.contactNo);
            $('.application-contact').text(result.student.contactNo);
            
            $('#occupation').val(result.student.occupation);
            $('.application-occupation').text(result.student.occupation);
            
            $('#courseid').val(result.course.courseID);
            $('.application-courseid').text(result.course.courseID);
            
            $('#coursename').val(result.course.name);
            $('.application-coursename').text(result.course.name);
            
            $('#startdate').val(result.session.startDate);
            $('.application-startdate').text(result.session.startDate);
            
            $('#sessionid').val(result.session.sessionID);
            $('.application-sessionid').text(result.session.sessionID);
            
            if(result.session.fulltime === ''){
               $('#coursetype').val(result.session.startDate);
               $('.application-coursetype').text('Part Time');
            }else{
               $('#coursetype').val(result.session.startDate);
               $('.application-coursetype').text('Full Time');
            }
            
            $('#language').val(result.session.languages);
            $('.application-language').text(result.session.languages);
            
            
        });
    });
    
    
})();

