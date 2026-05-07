<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<button type="button" id="btn" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>
				<!-- <div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
					</ol>
                </div> -->
                <!-- row -->
                <form id="exampleValidation" method="POST" action="" enctype="multipart/form-data">
                                    <div class="card-header" id="Create" style="display:none">
                                        <div class="d-flex align-items-center">
                                            <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="priority_status_id" name="priority_status_id" required>  
                            
                                                                    <option value="">Please Select Priorty Status</option>
                                                                    <?php

                                                                    foreach($priority as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->priority_status_id.'" '.$sel.'>'.$row->priority_status_name.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="priority_status_created_user_id" id="priority_status_created_user_id" class="form-control input-lg lst-flt-select2" required>                                     
                                                                <option value="">Please Select Created by</option>                            
                                                                <?php foreach($staff as $row) {
                                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                        echo '<option value="'.$row->user_id.'">'.$row->admin_name.'</option>';
                                                                    } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-3">
                                                    <div class="card">
                                                        <button type="button" class="btn btn-warning btn-md" id="search">
                                                            <span class="btn-label">
                                                                <i class="fas fa-search"></i>
                                                            </span>
                                                            Search
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-3">
                                                    <div class="card">
                                                        <a href="<?php echo base_url();?>index.php/Priority_status">
                                                        <button type="button" class="btn btn-secondary btn-md" id="search">
                                                            <span class="btn-label">
                                                                <i class="icon-refresh"></i>
                                                            </span>
                                                            Refresh
                                                        </button>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>
                                    </form>

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
                                                <th>Created by</th>
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