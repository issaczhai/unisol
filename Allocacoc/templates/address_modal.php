<!-- Modal -->
<div class="modal fade bs-modal-sm" id="address_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="login_modal_content">
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
	        <div class="tab-pane fade active in" id="add_address">
	            <fieldset>
	            <!-- Sign In Form -->
	            <!-- Error Massage-->
	            <div class="control-group">
	              <div class="controls">
	                  <p style="color:#FF0000"id="add_errorMsg"></p>
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="lastname">Last Name</label>
	              <div class="controls">
	                <input id="lastname" name="lastname" type="text" class="form-control" placeholder="lastname" class="input-medium" required="">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="firstname">First Name</label>
	              <div class="controls">
	                <input id="firstname" name="firstname" type="text" class="form-control" placeholder="firstname" class="input-medium" required="">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="street">Street</label>
	              <div class="controls">
	                <input required="" id="street" name="street" class="form-control" placeholder="xxx road" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="blockno">Block No</label>
	              <div class="controls">
	                <input required="" id="blockno" name="blockno" class="form-control" placeholder="eg. 69" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="floor">Floor</label>
	              <div class="controls">
	                <input required="" id="floor" name="floor" class="form-control" placeholder="" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="unit">Unit</label>
	              <div class="controls">
	                <input required="" id="unit" name="unit" class="form-control" placeholder="" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Text input-->
	            <div class="control-group">
	              <label class="control-label" for="postalcode">Postal Code</label>
	              <div class="controls">
	                <input required="" id="postalcode" name="postalcode" class="form-control" placeholder="" type="text" class="input-medium">
	              </div>
	            </div>
	            <!-- Button -->
	            <div class="control-group">
	              <label class="control-label" for="add"></label>
	              <div class="controls">
	                  <button type="button" onclick='add_address()' id="add" name="add" class="btn btn-success">Add</button>
	              </div>
	            </div>
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