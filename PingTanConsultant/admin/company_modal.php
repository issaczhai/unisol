<div class="modal fade" id="editContactModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="../process_company.php">
        <input type="hidden" name="operation" value="editContact">
        <input type="hidden" id="editID" name="companyID" value="">
        
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title" id="myModalLabel">Edit Contact</h4>
    </div>
    <div class="modal-body">
        <fieldset>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="cName">Contact Person Name</label>
              <div class="controls">
                <input id="cName" name="cName" type="text" class="form-control" class="input-medium" required>
              </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="cEmail">Email</label>
              <div class="controls">
                <input id="cEmail" name="cEmail" type="text" class="form-control" class="input-medium" required>
              </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="cTel">Tel</label>
              <div class="controls">
                <input id="cTel" name="cTel" type="text" class="form-control" class="input-medium" required>
              </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="cFax">Fax</label>
              <div class="controls">
                <input id="cFax" name="cFax" type="text" class="form-control" class="input-medium" required>
              </div>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Confirm</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </form>
  </div>
</div>
</div>


<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="../process_company.php">
        <input type="hidden" name="operation" value="editAddress">
        <input type="hidden" id="editAddressID" name="companyID" value="">
        
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title" >Edit Address</h4>
    </div>
    <div class="modal-body">
        <fieldset>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="cAddress">Address</label>
              <div class="controls">
                <input id="cAddress" name="cAddress" type="text" class="form-control" class="input-medium" required>
              </div>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Confirm</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </form>
  </div>
</div>
</div>
