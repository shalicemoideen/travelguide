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
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg" id="quotation_number_filter" name="quotation_number_filter" required>  
                            
                                                                    <option value="">Please Select Quotation number</option>
                                                                    <?php

                                                                    foreach($quotation as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->quotation_id.'" '.$sel.'>'.$row->quotation_number.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg " id="package_id_filter" name="package_id_filter"  required>  
                            
                                                                   <option value="">Please Select package</option>

                                                                    <?php foreach($packages as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->packages_id.'">'.$row->packages_title.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg " id="leads_id_filter" name="leads_id_filter"  required>  
                            
                                                                   <option value="">Please Select lead</option>

                                                                    <?php foreach($leads as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->leads_id.'">'.$row->leads_number.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg " id="trips_current_status_filter" name="trips_current_status_filter"  required>  
                            
                                                                   <option value="">Please Select status</option>
                                                                   <option value="1">Generated</option>
                                                                   <option value="2">Draft</option>
                                                                   <option value="3">Sent</option>
                                                                   <option value="4">Rejected</option>
                                                                   <option value="5">Accepted</option>

                                                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Arriving destination" id="arriving_destination_filter" name="arriving_destination_filter" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Departuring destination" id="departuring_destination_filter" name="departuring_destination_filter" required>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-6 col-md-3">
                                                  <div class="card">
                                                      <div class="input-group">
                                                          <input type="text" class="form-control" placeholder="Start date" id="start_date" name="start_date" required>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-sm-6 col-md-3">
                                                  <div class="card">
                                                      <div class="input-group">
                                                          <input type="text" class="form-control" placeholder="End date" id="end_date" name="end_date" required>
                                                      </div>
                                                  </div>
                                              </div>                         
                                                <div class="col-sm-6 col-md-3 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="trips_created_by_userid" id="trips_created_by_userid" class="form-control input-lg " required>                                     
                                                                <option value="">Please Select Created by</option>                            
                                                                <?php foreach($users as $row) {
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
                                                        <a href="<?php echo base_url();?>Trips">
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
                                <h2 class="card-title"><b>Trip Details</b></h2>                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Trip_registration">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Quotation no:</th>
                                                <th>Lead no:</th>
                                                <th>Guest name:</th>
                                                <th>Phone number</th>
                                                <th>Arriving destination</th>
                                                <th>Departuring destination</th>
                                                <th>Travel date</th>
                                                <th>Duration</th>
                                                <th>End Date</th>
                                                <th>Status</th>
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

        




<div class="modal fade" id="ChangeStatusModal" tabindex="-1" data-bs-backdrop="static"> 
    <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> 
            <h5 class="modal-title2">Change quotation Status</h5> 
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button> 
          </div> 
          <div class="modal-body"> 
            <form id="changeStatusForm"> <input type="hidden" id="lead_id" name="lead_id"> 
            <input type="hidden" id="quotation_id" name="quotation_id"> <div class="mb-3"> 
              <label class="form-label">Status <span class="text-danger">*</span></label> 
                <select class="form-control select2" id="quotation_current_status" name="quotation_current_status" required> 
                  <option value="">Select Status</option> 
                </select> 
              </div> 
            </form> 
          </div> 
          <div class="modal-footer"> 
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
            <button type="button" class="btn btn-primary" onclick="saveChangeStatus()">Save</button> 
          </div> 
        </div> 
      </div> 
    </div>