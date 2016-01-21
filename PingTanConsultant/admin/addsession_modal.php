<!-- Modal -->
<div class="modal fade" id="addSessionModal">
  <div class="modal-dialog">
    <div class="modal-content" id="login_modal_content">
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
	        <div class="tab-pane fade active in" id="add_address">
	            <fieldset>
                    <form id="addSessionForm" action="../process_course.php" method="post">
	            <!-- Sign In Form -->
	            <!-- Error Massage-->
	            <div class="control-group">
	              <div class="controls">
	                  <p style="color:#FF0000"id="add_errorMsg"></p>
	              </div>
	            </div>
                    <input name="operation" value="addSession" type="hidden">
                    <input id="addSessionCourseID" name="courseID" value="" type="hidden">
                    
                    <div class="control-group">
	              <label class="control-label" for="lang">Display Language</label>
	              <div class="controls">
                          <p class="form-control-static" style="font-weight: bold">English</p>
	                <input name="lang" value="en" type="hidden">
                      </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="sessionID">Session ID</label>
	              <div class="controls">
	                <input id="addSessionSessionID" name="sessionID" type="text" class="form-control" placeholder="Session ID" class="input-medium" required="" onchange="checkSession()">
	              </div>
	            </div>
                    <div class="control-group">
                        <label class="control-label" for="timeType">Time Type</label>
                    </div>
	            <!-- Text input-->
	            <div class="control-group">
                        <div class="radio inline-block">
                            <label>
                              <input type="radio" name="timeType" id="timeType1" value="fulltime" checked>
                              Full Time
                            </label>
                        </div>
                        <div class="radio inline-block">
                            <label>
                                <input type="radio" name="timeType" id="timeType2" value="parttime">
                                Part Time
                            </label>
                        </div>
	            </div>
                    <div class="control-group">
	              <label class="control-label" for="time">Time</label>
	              <div class="controls">
	                <input required="" id="time" name="time" class="form-control" placeholder="" type="text" class="input-medium">
	              </div>
	            </div>
                    <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="startDate">Start Date</label>
	              <div class="controls">
	                <input required="" id="startDate" name="startDate" class="form-control" placeholder="" type="date" class="input-medium">
	              </div>
	            </div>
                    <div class="control-group">
	              <label class="control-label" for="endDate">End Date</label>
	              <div class="controls">
	                <input required="" id="endDate" name="endDate" class="form-control" placeholder="" type="date" class="input-medium">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="venue">Venue</label>
	              <div class="controls">
	                <input required="" id="venue" name="venue" class="form-control" placeholder="" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="vacancy">Vacancy</label>
	              <div class="controls">
	                <input required="" id="vacancy" name="vacancy" class="form-control" placeholder="" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="languages">Language</label>
	              <div class="controls">
	                <input required="" id="languages" name="languages" class="form-control" placeholder="" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Button -->
	            <div class="control-group">
	              <label class="control-label" for="addSessionBtn"></label>
	              <div class="controls">
	                  <button type="submit" id="addSessionBtn" name="addSessionBtn" class="btn btn-success">Add</button>
	              </div>
	            </div>
                    </form>
	            </fieldset>
	        </div>
        
    	</div>
      </div>
      <div class="modal-footer">
      	<center>
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </center>
      </div>
    </div>
  </div>
</div>