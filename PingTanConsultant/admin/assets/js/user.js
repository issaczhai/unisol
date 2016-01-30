function resetStudentPassword(studentID){
        var postData = { //Fetch form data
            'operation'     :'resetPassword',
            'courseID'     : studentID
        };
        $.ajax({
            type: 'post',
            url: '../process_student.php',
            data: postData,
            success: function(data){
                var pos = data.indexOf("{");
                var dataValid = data.substring(pos);
                var jsonData = eval("("+dataValid+")");
                if(jsonData.status === 'used'){
                    document.getElementById('submit').disabled=true;
                }else if(jsonData.status === 'available'){
                    document.getElementById('submit').disabled=false;
                }
            }
        });
    }    
