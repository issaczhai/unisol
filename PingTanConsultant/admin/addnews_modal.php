<div class="modal fade" id="addnewsModal" tabindex="-1" role="dialog" aria-labelledby="Add News" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="../process_news.php">
        <input type="hidden" name="operation" value="add">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title" id="myModalLabel">Add News</h4>
    </div>
    <div class="modal-body">
        <fieldset>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="title">Title</label>
              <div class="controls">
                <input id="title" name="title" type="text" class="form-control" class="input-medium" required>
              </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="content">Content</label>
              <div class="controls">
                  <textarea id="content" name="content" class="form-control" style="height: 300px;" required=""></textarea>
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