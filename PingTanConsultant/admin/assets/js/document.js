/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    function deleteCourse(cID){
        var postData = {'operation': 'delete','courseID':cID};
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : '../process_course.php', //Your form processing file URL
            data      : postData, //Forms name
            success   : function(data) {
    //            var pos = data.indexOf("{");
    //            var dataValid = data.substring(pos);
    //            var jsonData = eval("("+dataValid+")");
                location.reload();
            }
        });
        event.preventDefault(); //Prevent the default submit
    }
    
    function deleteSession(sID,cID){
        var postData = {'operation': 'deleteSession','courseID':cID,'sessionID':sID};
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : '../process_course.php', //Your form processing file URL
            data      : postData, //Forms name
            success   : function(data) {
                location.reload();
            }
        });
        event.preventDefault(); //Prevent the default submit
    }
    
    function showSession(cID){
        var courseID = cID;
        $("#sessionRow"+courseID).css('display','');
        $("#showBtn"+courseID).css('display','none');
        $("#closeBtn"+courseID).css('display','');
    }
    
    function closeSession(cID){
        var courseID = cID;
        $("#sessionRow"+courseID).css('display','none');
        $("#showBtn"+courseID).css('display','');
        $("#closeBtn"+courseID).css('display','none');
    }
    
    function populateAddModal(cID){
        var courseID = cID;
        document.getElementById('addSessionCourseID').value = courseID;
    }
    
    function checkSession(){
        var courseID=document.getElementById('addSessionCourseID').value;
        var sessionID=document.getElementById('addSessionSessionID').value;
        var postData = { //Fetch form data
            'operation'     :'checkSession',
            'courseID'     : courseID,
            'sessionID'     : sessionID,
            'lang'          :'en'
        };
        $.ajax({
            type: 'post',
            url: '../process_course.php',
            data: postData,
            success: function(data){
                var pos = data.indexOf("{");
                var dataValid = data.substring(pos);
                var jsonData = eval("("+dataValid+")");
                if(jsonData.status === 'used'){
                    document.getElementById('addSessionBtn').disabled=true;
                    console.log("used");
                }else if(jsonData.status === 'available'){
                    document.getElementById('addSessionBtn').disabled=false;
                    console.log("available");
                }
            }
        });
    }
    
    function populateEditSessionModal(lang,sID,cID){
        var postData = { //Fetch form data
            'operation'     :'retrieveSession',
            'courseID'     : cID,
            'sessionID'     : sID,
            'lang'          :lang
        };
        $.ajax({
            type: 'post',
            url: '../process_course.php',
            data: postData,
            success: function(data){
                console.log(data.length);
                if(data.length === 2){
                    document.getElementById('edit'+cID+sID+'SessionCourseID').value = cID;
                    document.getElementById('edit'+cID+sID+'SessionSessionID').value = sID;
                    document.getElementById('edit'+cID+sID+'SessionLang').value = lang;
                    document.getElementById('edit'+cID+sID+'SessionOperation').value = "addSession";
                    document.getElementById('edit'+cID+sID+'SessionLanguages').value = "";
                    document.getElementById('edit'+cID+sID+'SessionStartDate').value = "";
                    document.getElementById('edit'+cID+sID+'SessionVacancy').value = "";
                    document.getElementById('edit'+cID+sID+'SessionVenue').value = "";
                    document.getElementById('edit'+cID+sID+'SessionTime').value = "";
                }else{
                    var pos = data.indexOf("{");
                    var dataValid = data.substring(pos);
                    var jsonData = eval("("+dataValid+")");
                    //document.getElementById('addSessionBtn').disabled=true;
                    document.getElementById('edit'+cID+sID+'SessionCourseID').value = cID;
                    document.getElementById('edit'+cID+sID+'SessionSessionID').value = sID;
                    document.getElementById('edit'+cID+sID+'SessionLang').value = lang;
                    document.getElementById('edit'+cID+sID+'SessionOperation').value = "editSession";
                    document.getElementById('edit'+cID+sID+'SessionLanguages').value = jsonData.languages;
                    document.getElementById('edit'+cID+sID+'SessionStartDate').value = jsonData.startDate;
                    document.getElementById('edit'+cID+sID+'SessionVacancy').value = jsonData.vacancy;
                    document.getElementById('edit'+cID+sID+'SessionVenue').value = jsonData.venue;
                    document.getElementById('edit'+cID+sID+'SessionTime').value = jsonData.parttime+jsonData.fulltime;
                    if(jsonData.fulltime.length === 0){
                        document.getElementById('edit'+cID+sID+'SessionTimeType1').checked = false;
                        document.getElementById('edit'+cID+sID+'SessionTimeType2').checked  = true;
                    }
                }
                
                
            }
        });
    }



function removeDocument(documentPath, catRow, documentRow){
        var courseID=document.getElementById('courseID').value;
        if(catRow === ''){
            var row = document.getElementById('contentRow'+documentRow);
            row.parentNode.removeChild(row);
             var postData = { //Fetch form data
                'operation'     :'deleteDocument',
                'courseID'      :courseID,
                'documentPath'     : documentPath
            };
            //pass data to backend to delete with ajax
            $.ajax({
                type: 'post',
                url: '../process_course.php',
                data: postData,
                success: function(data){

                }
            });
        }else{
            //delete row
            var row = document.getElementById('Cat'+catRow+'Row'+documentRow);
            row.parentNode.removeChild(row);
            var postData = { //Fetch form data
                'operation'     :'deleteDocument',
                'courseID'      :courseID,
                'documentPath'     : documentPath
            };
            //pass data to backend to delete with ajax
            $.ajax({
                type: 'post',
                url: '../process_course.php',
                data: postData,
                success: function(data){

                }
            });
        }
        
        
    }
    
    function addCat(){
        var catRowNo = parseInt(document.getElementById('catRowNo').value);
        if(catRowNo===0){
            catRowNo = catRowNo + 1;
            var catRowNoStr = catRowNo.toString();
            
            $('#reference').after('<div class="form-group" id="cat'+catRowNoStr+'Div">'
                    +'<label class="col-sm-2 col-sm-2 control-label">'
                    +'<p class="form-control-static">Week '+catRowNoStr+'</p>'
                    +'<input type="hidden" id="cat'+catRowNoStr+'" name="cat'+catRowNoStr+'" value="Week '+catRowNoStr+'"/></label>'
                    +'<div class="col-sm-4"><input type="file" name="cat'+catRowNoStr+'Upload[]" multiple="multiple"></div></div>');
                           
        }else{
            var currentCatRowNoStr = catRowNo.toString();
            catRowNo = catRowNo + 1;
            var catRowNoStr = catRowNo.toString();
            $('#cat'+currentCatRowNoStr+'Div').after('<div class="form-group" id="cat'+catRowNoStr+'Div">'
                    +'<label class="col-sm-2 col-sm-2 control-label">'
                    +'<p class="form-control-static">Week '+catRowNoStr+'</p>'
                    +'<input type="hidden" id="cat'+catRowNoStr+'" name="cat'+catRowNoStr+'" value="Week '+catRowNoStr+'"/></label>'
                    +'<div class="col-sm-4"><input type="file" name="cat'+catRowNoStr+'Upload[]" multiple="multiple"></div></div>');
                           
        }
        document.getElementById('catRowNo').value = catRowNo;
    }
    
    function removeCat(){
        var courseID=document.getElementById('courseID').value;
        var catRowNo = parseInt(document.getElementById('catRowNo').value);
        if(catRowNo > 0){
            var arr = [];            
            $('input[name^=cat'+catRowNo.toString()+'Documents]').each(function(){
                arr.push($(this).val());
            });
            $("#cat"+catRowNo.toString()+"Div").remove();
            console.log(JSON.stringify(arr));
            var postData = { //Fetch form data
                'operation'     :'deleteDocumentByCategory',
                'courseID'      :courseID,
                'pathArr'     :  JSON.stringify(arr)
            };
            //pass data to backend to delete with ajax
            $.ajax({
                type: 'post',
                url: '../process_course.php',
                data: postData,
                success: function(data){

                }
            });
            
            
            catRowNo = catRowNo - 1;
            document.getElementById('catRowNo').value = catRowNo;
        }
    }