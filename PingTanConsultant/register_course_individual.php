<div class="modal fade course_register_modal" id="register_individual_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="register_individual_modal_content">
        <div class="modal-header">
          <h4 class="modal-title">Course Name</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-padding-none form-individual-registration">
                    <div id="error-msg" class="col-md-12">
                      
                    </div>
                    <input class="hidden-courseID" type="hidden">
                    <input class="hidden-sessionID" type="hidden">
                    <div class="col-md-6 form-login-row">
                      <label for="course-type">Course Type:</label>
                      <div class="col-md-12 col-padding-none">
                        <select class="select-course-type select-default" name="course-type">
                          <option class="option-fullTime" value="full-time">Full-Time</option>
                          <option class="option-partTime" value="part-time">Part-Time</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="languages">Language:</label>
                      <div class="col-md-12 col-padding-none">
                        <select class="select-languages select-default" name="languages">
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="dateTime">Date and Time:</label>
                      <div class="col-md-12 col-padding-none dateTime parameter-dateTime">
                        <span>Monday - Friday, 9AM - 6PM</span>
                      </div>
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="duration">Total Hours:</label>
                      <div class="col-md-12 col-padding-none duration">
                        <span>40 Hours</span>
                      </div>
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="start-date">Start Date:</label>
                      <div class="col-md-12 col-padding-none">
                        <select class="select-start-date select-default" name="start-date">
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="ic">NRIC / Passport No.</label>
                      <input class="input-default input-nric" type="text" name="ic" placeholder="NRIC or Passport">
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="nationality">Nationality</label>
                      <input class="input-default input-nationality" type="text" name="nationality" placeholder="">
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="contact">Contact No.</label>
                      <input class="input-default input-contactNum" type="text" name="contact" placeholder="">
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="dob">Date of Birth</label>
                      <input class="input-default input-dob" type="text" name="dob" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="col-md-6 form-login-row">
                      <label for="occupation">Occupation</label>
                      <input class="input-default input-occupation" type="text" name="occupation" placeholder="">
                    </div>
                    <h5 class="hd-prerequisite-msg">Please upload certificates for all prerequisites of this course before registration</h5>
                    <div class="col-md-12 form-login-row file-upload-template">
                      <h5 class="label-prerequisite">Prerequisite</h5>
                      <div class="col-md-8">
                        <input class="input-default" type="file">
                      </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="modal-footer">
        <center>
          <button class="btn btn-close" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary btn-checkout btn-individual-register">Register</button>
        </center>
    </div>
    </div>
    
  </div>
</div>