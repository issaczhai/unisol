<div class="modal fade" id="viewapplicationModal" tabindex="-1" role="dialog" aria-labelledby="Add News" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
  <div class="modal-content">
      <form method="post" action="../service_application.php">
        <input type="hidden" name="operation" value="admin_operation">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title" id="myModalLabel">Application</h4>
    </div>
    <div class="modal-body">
        <fieldset>
            <!-- Text input-->
            <div class="row">
                <p class="col-sm-2" style="font-weight: bold">Student ID</p>
                <p class="col-sm-2 application-studentid"></p>
                <input id="studentid" name="studentid" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">First Name</p>
                <p class="col-sm-2 application-fname"></p>
                <input id="fname" name="fname" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Last Name</p>
                <p class="col-sm-2 application-lname"></p>
                <input id="lname" name="lname" type="hidden" required>
            </div>
                
            <!-- Text input-->
            <div class="row">
                <p class="col-sm-2" style="font-weight: bold">NRIC/Passport</p>
                <p class="col-sm-2 application-nric"></p>
                <input id="nric" name="nric" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Nationality</p>
                <p class="col-sm-2 application-nationality"></p>
                <input id="nationality" name="nationality" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Date of Birth</p>
                <p class="col-sm-2 application-dob"></p>
                <input id="dob" name="dob" type="hidden" required>
            </div>
            
            <!-- Text input-->
            <div class="row">
                <p class="col-sm-2" style="font-weight: bold">Contact</p>
                <p class="col-sm-2 application-contact"></p>
                <input id="contact" name="contact" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Occupation</p>
                <p class="col-sm-2 application-occupation"></p>
                <input id="occupation" name="occupation" type="hidden" required>
            </div>
            
            <div class="row">
                <p class="col-sm-2" style="font-weight: bold">Course ID</p>
                <p class="col-sm-2 application-courseid"></p>
                <input id="courseid" name="courseid" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Course Name</p>
                <p class="col-sm-2 application-coursename"></p>
                <input id="coursename" name="coursename" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Start Date</p>
                <p class="col-sm-2 application-startdate"></p>
                <input id="startdate" name="startdate" type="hidden" required>
            </div>
            
            <div class="row">
                <p class="col-sm-2" style="font-weight: bold">Session ID</p>
                <p class="col-sm-2 application-sessionid">G2</p>
                <input id="sessionid" name="sessionid" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Type</p>
                <p class="col-sm-2 application-coursetype">Full Time</p>
                <input id="coursetype" name="coursetype" type="hidden" required>
                
                <p class="col-sm-2" style="font-weight: bold">Language</p>
                <p class="col-sm-2 application-language">Chinese</p>
                <input id="language" name="language" type="hidden" required>
            </div>
            
            <div class="row">
                <p class="col-sm-4" style="font-weight: bold">Document Submitted</p>
                <p class="col-sm-2 application-documents"></p>
                <input id="documents" name="documents" type="hidden" required>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
      <button type="submit" name="approve" class="btn btn-primary" value="approve">Confirm</button>
      <button type="submit" name="reject" class="btn btn-danger" value="reject">Reject</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </form>
  </div>
</div>
</div>