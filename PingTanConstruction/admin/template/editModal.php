<!--Edit Project Modal-->
<div class="modal fade" id="editInfoModal" tabindex="-1" role="dialog" aria-labelledby="Add News" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../process_project.php" method="post">
                <input type="hidden" name="operation" value="editProjectInfo">
                <input type="hidden" id="editInfo-projectId" name="projectId">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modalLabel">Edit Project Information</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="projectName">Project Name</label>
                            <div class="controls">
                                <input id="editInfo-projectName" name="projectName" type="text" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="startDate">Start Date</label>
                            <div class="controls">
                                <input id="editInfo-startDate" name="startDate" type="date" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="endDate">End Date(Estimated)</label>
                            <div class="controls">
                                <input id="editInfo-endDate" name="endDate" type="date" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="value">Value</label>
                            <div class="controls">
                                <input id="editInfo-value" name="value" type="text" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="scopeOfWork">Scope of Work</label>
                            <div class="controls">
                                <input id="editInfo-scopeOfWork" name="scopeOfWork" type="text" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="contract">Contract</label>
                            <div class="controls">
                                <input id="editInfo-contract" name="contract" type="text" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="client">Client</label>
                            <div class="controls">
                                <input id="editInfo-client" name="client" type="text" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="status">Status</label>
                            <div class="controls">
                                <select id="editInfo-status" name="status" class="form-control" class="input-medium" required>
                                    <option value="Upcoming">Upcoming</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                </select>
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


<!--Edit Photo Modal-->
<div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="Add News" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPhotoForm" method="post" action="../process_project.php" enctype="multipart/form-data">
                <input type="hidden" name="operation" value="editProjectPhoto">
                <input type="hidden" id="editPhoto-projectId" name="projectId">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modalLabel">Edit Project Photo</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="projectName">Project Name</label>
                            <div class="controls">
                                <input id="editPhoto-projectName" disabled type="text" class="form-control" class="input-medium" value="Project Karaoke">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for=""></label>
                            <div class="row image-row">
                                <div class="col-lg-3 image-thumb" style="display:none">
                                    <img class="project-photo_thumb" style="width: 100%;height:inherit;margin:5px">
                                    <button type="button" class="delete-photo-btn">x</button>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="photo">Photo</label>
                            <div class="controls">
                                <input id="editPhoto-photo" name="photo[]" type="file" multiple class="form-control" class="input-medium">
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