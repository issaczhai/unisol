/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function displayStudentList(courseID,sessionID){
    var postData = {'operation': 'getClassList','courseID':courseID,'sessionID':sessionID};
    $.ajax({ //Process the form using $.ajax()
        type      : 'POST', //Method type
        url       : '../process_course.php', //Your form processing file URL
        data      : postData, //Forms name
        success   : function(data) {
            var html = "";
            html+="<div class='form-group'><p>&nbsp&nbsp&nbsp "+courseID+" "+sessionID+"</p></div>";
            html+="<input type='hidden' name='operation' value='certify'/>";
            html+="<input type='hidden' name='courseID' value='"+courseID+"'/>";
            html+="<input type='hidden' name='sessionID' value='"+sessionID+"'/>";
            var pos = data.indexOf("[");
            var dataValid = data.substring(pos);
            var jsonData = eval("("+dataValid+")");
            for (i = 0; i < jsonData.length; i++) {
                html+="<div class='form-group'><label class='col-sm-1 col-sm-1 control-label'>"+jsonData[i].studentID+"<input type='hidden' name='student[]' value='"+jsonData[i].studentID+"'></label><label class='col-sm-2 col-sm-2 control-label'>"+jsonData[i].name+"</label><input class='col-sm-3' name='"+jsonData[i].studentID+"certName' type='text' maxlength='50' required><div class='col-sm-6'><input type='file' name='"+jsonData[i].studentID+"cert' required></div></div>";
            }
            
            html+="<div class='control-group'><label class='control-label'></label><div class='controls'><button type='submit' name='certifyBtn' class='btn btn-success'> Confirm </button><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div></div>";
            $('#certifyForm').html(html);
            $('#certifyModal').modal('show');
        }
    });
        event.preventDefault(); //Prevent the default submit
}

