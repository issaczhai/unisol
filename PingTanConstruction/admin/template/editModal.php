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
                            <label class="control-label" for="endDate">End Date(Estimated)</label>
                            <div class="controls">
                                <input id="editInfo-endDate" name="endDate" type="text" class="form-control" class="input-medium" maxlength="20" required>
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

<!--Delete Project Modal-->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    Delete Project
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this project?</p>
                    <p id="deleteModalId"></p>
                    <p id="deleteModalName"></p>
                </div>     
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-confirm-btn">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!--Delete Job Modal-->
<div class="modal fade" id="deleteJobModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    Delete Job
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Job?</p>
                    <p id="deleteJobModalId"></p>
                    <p id="deleteJobModalName"></p>
                </div>     
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-job-confirm-btn">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>


<!--Edit Job Modal-->
<div class="modal fade" id="editJobModal" tabindex="-1" role="dialog" aria-labelledby="Add News" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="editJobForm" action="../process_job.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="operation" value="edit">
                <input type="hidden" id="editJob-jobid" name="jobid">
                <input type="hidden" id="editJob-postdate" name="postdate">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modalLabel">Edit Job</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="jobname">Job Name</label>
                            <div class="controls">
                                <input id="editJob-jobname" name="jobname" type="text" maxlength="50" class="form-control" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="location">Location</label>
                            <div class="controls">
                                <input id="editJob-location" name="location" type="text" class="form-control" class="input-medium" maxlength="50" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="value">Type</label>
                            <div class="controls">
                                <select id="editJob-type" name="type" type="text" class="form-control" class="input-medium" required>
                                    <option class="fulltime" value="Full-Time">Full-Time</option>
                                    <option class="parttime" value="Part-Time">Part-Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="category">Category</label>
                            <div class="controls">
                                <input id="editJob-category" name="category" type="text" class="form-control" maxlength="50" class="input-medium" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="job_description">Job Description</label>
                            <div class="controls">
                                <textarea id="editInfo-job_description" name="job_description" class="form-control" class="input-medium" rows="4" cols="50" required></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="qualification">Qualification</label>
                            <div class="controls editInfo-qualification-div">
                                <input class="editInfo-qualification form-control input-medium" name="qualification[]" type="text" multiple style="display:none">
                            </div>
                            <button class="btn btn-primary editInfo-add-qualification-btn" type="button"><i class="icon_plus"></i></button>
                            <button class="btn btn-danger editInfo-delete-qualification-btn" type="button"><i class="icon_minus-06"></i></button>

                        </div>
                        <div class="control-group">
                            <label class="control-label" for="offer">Offer</label>
                            <div class="controls editInfo-offer-div">
                                <input class="editInfo-offer form-control input-medium" name="offer[]" type="text" multiple style="display:none">
                            </div>
                            <button class="btn btn-primary editInfo-add-offer-btn" type="button"><i class="icon_plus"></i></button>
                            <button class="btn btn-danger editInfo-delete-offer-btn" type="button"><i class="icon_minus-06"></i></button>
                            
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="contact">Contact</label>
                            <div class="controls">
                                <textarea id="editInfo-contact" name="contact" class="form-control" class="input-medium" rows="4" cols="50" required></textarea>
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