<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Priority status Details</h4>
                                    
                                    <?php if (has_permission('PRIORITY_STATUS_CREATE')): ?>
                                        <a onclick="add_priority_status()"  data-bs-target="#priortystatusModal" class="btn btn-rounded btn-secondary btn-md">+ New Source</a> 
                                    <?php endif; ?>
                                   
                                    
                              
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="priortystatus_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Priorty status</th>
                                                <th>Priorty label</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					
					
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!-- Modal -->
        <div class="modal fade" id="priortystatusModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="priortystatusmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-xl-10">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="priority_status_name">Priorty status Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 priority_status_name">
                                            <input type="text" class="form-control" name="priority_status_name" id="priority_status_name" placeholder="Enter Priorty status name" required>
                                            <span class="help-block" style="color:red"></span>
                                            <b><span id="priority_status_name_alert" style="color: red"></span></b>
                                        </div>
                                    </div>

                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="priority_status_button">Label color 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 priority_status_button">
                                            <input type="color" class="form-control form-control-color" name="priority_status_button" id="priority_status_button" value="#ff0000" title="Choose your color" required>

                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="priority_status_description">Description                                            
                                        </label>
                                        <div class="col-lg-8 priority_status_description">
                                            <textarea class="form-control" name="priority_status_description" id="priority_status_description"  rows="5" placeholder="Enter Description" required></textarea>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="priortystatusmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()" >Save</button>
                    </div>
                </div>
            </div>
        </div>


<!-- Modal -->
<div class="modal fade" id="deleterowModal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form1" >
                    <input type="hidden" value="" name="id" id="id1"/> 
                    <input type="hidden" value="" name="source_name" id="source_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="priortystatusmodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_priority_status_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>