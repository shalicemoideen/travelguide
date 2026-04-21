<style>
    .modal-quote {
    max-width: 95%;

    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
}
</style>
<style>
    .modal-lead {
    max-width: 80%;
}

/* input states */
.is-invalid {
  border-color: #dc3545 !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='0 0 16 16'%3E%3Cpath d='M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0 4.5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 5.5zm0 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.5rem center;
  background-size: 1rem;
}

.is-valid {
  border-color: #28a745 !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2328a745' viewBox='0 0 16 16'%3E%3Cpath d='M16 2.5 6 13 0 7l2-2 4 4 8-9z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.5rem center;
  background-size: 1rem;
}

/* --- field states (border + icon) --- */
/* .is-invalid {
  border-color: #dc3545 !important;
  padding-right: 2rem !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='0 0 16 16'%3E%3Cpath d='M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0 4.5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 5.5zm0 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.6rem center;
  background-size: 1rem;
}
.is-valid {
  border-color: #28a745 !important;
  padding-right: 2rem !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2328a745' viewBox='0 0 16 16'%3E%3Cpath d='M16 2.5 6 13 0 7l2-2 4 4 8-9z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.6rem center;
  background-size: 1rem;
} */

/* --- shake animation --- */
@keyframes shakeX {
  0%, 100% { transform: translateX(0); }
  20% { transform: translateX(-6px); }
  40% { transform: translateX(6px); }
  60% { transform: translateX(-4px); }
  80% { transform: translateX(4px); }
}
.shake {
  animation: shakeX 280ms ease-in-out;
}



</style>
<!--**********************************
			Content body start
		***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="d-flex justify-content-between align-items-center flex-wrap">
					<div class="card-action coin-tabs mb-2">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#Manualleads">B2C leads</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#Metaleads">Meta leads</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#B2Bleads">B2B Leads</a>
							</li>
						</ul>
					</div>
					<!-- <div class="d-flex align-items-center mb-2 flex-wrap"> 
						<div class="guest-calendar">
							<div id="reportrange" class="pull-right reportrange" style="width: 100%">
								<span></span><b class="caret"></b>
								<i class="fas fa-chevron-down ms-3"></i>
							</div>
						</div>
						<div class="newest ms-3">
							<select class="default-select">
								<option>Newest</option>
								<option>Oldest</option>
							</select>
						</div>	
					</div> -->
				</div>
				<div class="row mt-4">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body p-0">
								<div class="tab-content">                  
									<div class="tab-pane active show" id="Manualleads">
                    <a onclick="add_leads()"  data-bs-target="#LeadsModal" class="btn btn-rounded btn-secondary btn-md">+ New B2C Lead</a> 	
										<div class="table-responsive">
											<table class="table card-table display mb-4 shadow-hover default-table table-responsive-lg" id="B2C_Leads_table">
												<thead>
													<tr>
														<th>Sl no</th>
														<th>Lead no:</th>
														<th>Guest name</th>
														<th>whats app number</th>
														<th>Register date</th>
														<th>Start date</th>
                            <th>Duration</th>
                            <th>End date</th>
                            <th>Package</th>
                            <th>Status</th>
														<th class="text-center">Stage</th>
                            <th>Priority</th>
                            <th>Created by</th>
														<th class="bg-none">Action</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
										</div>	
									</div>	
									<div class="tab-pane" id="Metaleads">
										<div class="table-responsive">
											<table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="meta_Leads_table">
												<thead>
													<tr>
														<th>Sl no</th>
														<th>Lead no:</th>
														<th>Guest name</th>
														<th>whats app number</th>
														<th>Register date</th>
														<th>Start date</th>
                            <th>Duration</th>
                            <th>End date</th>
                            <th>Package</th>
                            <th>Status</th>
														<th class="text-center">Stage</th>
                            <th>Priority</th>
                            <th>Created by</th>
														<th class="bg-none">Action</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
										</div>	
									</div>
									<div class="tab-pane" id="B2Bleads">
                    <a onclick="add_b2bleads()"  data-bs-target="#LeadsB2BModal" class="btn btn-rounded btn-secondary btn-md">+ New B2B Lead</a> 	
										<div class="table-responsive">
											<table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="B2B_table">
												<thead>
													<tr>
														<th>Sl no</th>
														<th>Agent</th>
														<th>Total package cost</th>
														<th>Expense</th>
														<th>Margin</th>
														<th>Description</th>
                            <th>Created By</th>
														<th class="bg-none">Action</th>
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
			</div>
		</div>
		<!--**********************************
			Content body end
		***********************************-->

    <style>
/* Red border with exclamation for invalid */
.select2-container--default.is-invalid .select2-selection {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
    position: relative;
}
.select2-container--default.is-invalid .select2-selection::after {
    content: "!";
    color: #dc3545;
    font-weight: bold;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

/* Green border with tick for valid */
.select2-container--default.is-valid .select2-selection {
    border-color: #28a745 !important;
    box-shadow: 0 0 0 0.2rem rgba(40,167,69,.25);
    position: relative;
}
.select2-container--default.is-valid .select2-selection::after {
    content: "✔";
    color: #28a745;
    font-weight: bold;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

</style>
    <div class="modal fade" id="LeadsModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-lead" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" onclick="Leadsmodalclose()" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="#" id="form" novalidate>
                        <input type="hidden" value="" name="id" id="id"/>
                        <div class="row">
                          <div class="col-md-3">
                              <div class=" form-group">
                                    <label class="col-lg-4 col-form-label" for="transporter_name">Lead type <span class="text-danger">*</span>
                                    </label><br>
                                        <label class="col-lg-4 col-form-label" name="lead_type_txt"></label>
                                        <input type="hidden" name="lead_type" value=""/>
                                        <!-- <select name="lead_type" id="lead_type1" class="form-control input-lg lst-flt-select2-form" required>                                                                 
                                            <option value="B2C">B2C</option>
                                            <option value="B2B">B2B</option>
                                        </select> -->
                                        <span class="help-block" style="color:red"></span>
                              </div>
                          </div>

                            <div class="col-md-3 staff_id_fk1">
                                  <div class=" form-group">
                                      <label class="col-lg-5 col-form-label" for="transporter_address">Assigned to staff  <span class="text-danger">*</span>
                                      </label>
                                          <?php if($this->session->userdata('user_type') == 'A'){ ?>
                                          <select name="staff_id_fk" id="staff_id_fk1" class="form-control input-lg lst-flt-select2-form" required>                                     
                                              <option value="">Please Select staff</option>
                                              <?php foreach($staff as $row) {
                                                  // $sel = ($records->state==$row->state_id)?'selected':'';
                                                  echo '<option value="'.$row->user_id.'">'.$row->admin_name.'</option>';
                                              } ?>
                                          </select>
                                          <?php } else{ ?>
                                              <br><label class="col-lg-4 col-form-label"><?php echo $this->session->userdata('admin_name'); ?></label>
                                            <input type="hidden" name="staff_id_fk" value="<?php echo $this->session->userdata('user_id'); ?>"/>
                                          <?php } ?>
                                      
                                  </div>
                            </div>

                            <div class="col-md-3 source_id_fk">
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label" for="source_id_fk">Source <span class="text-danger">*</span>
                                    </label>
                                        <select name="source_id_fk" id="source_id_fk1" class="form-control input-lg lst-flt-select2-form" onchange="checkAddNewSource(this)" required>                                     
                                            <option value="">Please Select source</option>
                                            <option value="+">+ Add new</option>
                                            <?php foreach($source as $row) {
                                                // $sel = ($records->state==$row->state_id)?'selected':'';
                                                echo '<option value="'.$row->source_id.'">'.$row->source_name.'</option>';
                                            } ?>
                                        </select>
                                        <span class="help-block" style="color:red"></span>
                                </div>
                            </div>

                            <div class="col-md-3 guest_name">
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label" for="guest_name">Guest name <span class="text-danger">*</span>
                                    </label>
                                    
                                        <input type="text" class="form-control" name="guest_name" id="guest_name1" placeholder="Enter Guest name" required>
                                        <span class="help-block" style="color:red"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="col-md-3 country_id_fk">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_name1">Nationality <span class="text-danger">*</span>
                                        </label>
                                            <select name="country_id_fk" id="country_id_fk" class="form-control input-lg lst-flt-select2-form" required>                                     
                                                <option value="">Please Select country</option>
                                                <?php foreach($country as $row) {
                                                    // $sel = ($records->state==$row->state_id)?'selected':'';
                                                    echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3 priority_status_id_fk">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_email1">Priority status <span class="text-danger">*</span>
                                        </label>
                                            <select name="priority_status_id_fk" id="priority_status_id_fk" class="form-control input-lg lst-flt-select2-form" onchange="checkAddNewPriority(this)" required>                                     
                                                <option value="">Please Select Priority status</option>
                                                <option value="+">+ Add new</option>
                                                <?php foreach($priority_status as $row) {
                                                    // $sel = ($records->state==$row->state_id)?'selected':'';
                                                    echo '<option value="'.$row->priority_status_id.'">'.$row->priority_status_name.'</option>';
                                                } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 whats_number">
                                    <div class=" form-group">
                                        <label class="col-lg-6 col-form-label" for="whats_number">Whatsapp number <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" inputmode="numeric" pattern="[0-9]+" minlength="10" maxlength="15" name="whats_number" id="whats_number" placeholder="Enter Whatsapp number" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>

                                <div class="col-md-3 alternative_number">
                                    <div class=" form-group">
                                        <label class="col-lg-6 col-form-label" for="alternative_number">Alternative number 
                                        </label>
                                        
                                            <input type="text" class="form-control" inputmode="numeric"  pattern="[0-9]+" minlength="10" maxlength="15" name="alternative_number" id="alternative_number" placeholder="Enter Alternative number" >
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>

                                
                            </div>        
                            

                            <div class="row">
                              <div class="col-md-3 leads_email">
                                  <div class=" form-group">
                                      <label class="col-lg-6 col-form-label" for="leads_email">Email address 
                                      </label>
                                      
                                          <input type="email" class="form-control" name="leads_email" id="leads_email" placeholder="Enter Email address" >
                                          <span class="help-block" style="color:red"></span>
                                      
                                  </div>
                              </div>
                              <div class="col-md-3 leads_address">
                                  <div class=" form-group">
                                      <label class="col-lg-6 col-form-label" for="leads_address">Location 
                                      </label>
                                      
                                          <input type="text" class="form-control" name="leads_address" id="leads_address" placeholder="Enter Location" >
                                          <span class="help-block" style="color:red"></span>
                                      
                                  </div>
                              </div>
                              <div class="col-md-3 date_type">
                                  <div class="form-group">
                                      <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num12">Date type <span class="text-danger">*</span>
                                      </label>
                                          <select name="date_type" id="date_type" class="form-control input-lg lst-flt-select2-form" required>                                     
                                              <option value="">Please Select Date type</option>                            
                                              <option value="WITH">With date</option>
                                              <option value="WITHOUT">Without date</option>
                                          </select>
                                          <span class="help-block" style="color:red"></span>
                                  </div>
                              </div>
                              <div class="col-md-3">        
                                  <div class="form-group">
                                      <label class="col-lg-5 col-form-label" for="start_date">Start Date <span class="text-danger">*</span>
                                      </label>
                                          <input type="text" class="form-control" name="start_date" id="start_date1" placeholder="Enter Start Date" required>
                                          <span class="help-block" style="color:red"></span>
                                  </div>
                              </div>

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="col-lg-5 col-form-label" for="duration">Tour Duration <span class="text-danger">*</span>
                                      </label>
                                          <input type="number" class="form-control" name="duration" id="duration" placeholder="Enter Tour Duration" required>
                                          <span class="help-block" style="color:red"></span>
                                          <input type="text" class="form-control" name="end_date" id="end_date1" readonly>
                                  </div>
                              </div>

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num2">Packages <span class="text-danger">*</span>
                                      </label>
                                          <select name="package_id_fk" id="package_id_fk" class="form-control input-lg lst-flt-select2-form" required>                                     
                                              <option value="">Please Select Packages</option>                            
                                              <?php foreach($packages as $row) {
                                                  // $sel = ($records->state==$row->state_id)?'selected':'';
                                                  echo '<option value="'.$row->packages_id.'">'.$row->packages_title.'</option>';
                                              } ?>
                                          </select>
                                          <span class="help-block" style="color:red"></span>
                                          <small id="package_msg" class="text-danger d-none">
                                              No packages available for selected duration.
                                          </small>

                                  </div>
                              </div>

                              

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num22">Description
                                      </label>
                                          <textarea class="form-control" name="description" id="description"  rows="5" placeholder="Enter Description" ></textarea>
                                          <span class="help-block" style="color:red"></span>
                                  </div>
                              </div>
                            </div>                                           
                            

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Leadsmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="LeadsB2BModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-lead" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" onclick="Leadsb2bmodalclose()" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="#" id="form3" novalidate>
                        <input type="hidden" value="" name="id" id="id3"/>
                        <div class="row">
                          <div class="col-md-3">
                              <div class=" form-group">
                                    <label class="col-lg-4 col-form-label" for="transporter_name">Lead type <span class="text-danger">*</span>
                                    </label><br>
                                        <label class="col-lg-4 col-form-label" name="lead_type_txt_b2b"></label>
                                        <input type="hidden" name="lead_type_b2b" value=""/>
                                        <!-- <select name="lead_type" id="lead_type1" class="form-control input-lg lst-flt-select2-form" required>                                                                 
                                            <option value="B2C">B2C</option>
                                            <option value="B2B">B2B</option>
                                        </select> -->
                                        <span class="help-block" style="color:red"></span>
                              </div>
                          </div>
                          
                          <div class="col-md-3">
                            <div class=" form-group">
                                <label class="col-lg-4 col-form-label" for="transporter_name">Select agent <span class="text-danger">*</span>
                                </label>
                                
                                    <select name="agent_id_fk" id="agent_id_fk" class="form-control input-lg lst-flt-select2-form" required>                                                                 
                                        <option value="">Please Select agent</option>
                                        <!-- <option value="+">+ Add new</option> -->
                                        <?php foreach($b2b_partner as $row) {
                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                            echo '<option value="'.$row->b2b_partner_id.'">'.$row->b2b_partner_agent_name.'</option>';
                                        } ?>
                                    </select>
                                    <span class="help-block" style="color:red"></span>
                                
                            </div>
                          </div>

                            <div class="col-md-3 total_package_cost">
                                    <div class=" form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_name">Total package cost <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="number" class="form-control" name="total_package_cost" id="total_package_cost" placeholder="Enter total package cost" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                            </div>

                            <div class="col-md-3 expense">
                                <div class=" form-group">
                                    <label class="col-lg-4 col-form-label" for="transporter_name">Expense <span class="text-danger">*</span>
                                    </label>
                                    
                                        <input type="number" class="form-control" name="expense" id="expense" placeholder="Enter Expense" required>
                                        <span class="help-block" style="color:red"></span>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">  
                          <div class="col-md-3 margin">
                            <div class=" form-group">
                                <label class="col-lg-4 col-form-label" for="transporter_name">Margin <span class="text-danger">*</span>
                                </label>
                                
                                    <input type="number" class="form-control" name="margin" id="margin" placeholder="Enter Margin" required>
                                    <span class="help-block" style="color:red"></span>
                                
                            </div>  
                          </div>  
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num22">Description
                                  </label>
                                      <textarea class="form-control" name="description" id="description"  rows="5" placeholder="Enter Description" ></textarea>
                                      <span class="help-block" style="color:red"></span>
                              </div>
                          </div>                
                        </div>                                    
                            

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Leadsb2bmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave3" onclick="save_b2b()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Source Modal -->
<div class="modal fade" id="AddSourceModal" tabindex="-1" aria-labelledby="AddSourceModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Add New Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addSourceForm">
                    <div class="mb-3">
                        <label for="source_name_modal" class="form-label">Source Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="source_name_modal" name="source_name" placeholder="Enter Source Name" required>
                        <div class="invalid-feedback">Source name is required.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveSource()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Priority Status Modal -->
<div class="modal fade" id="AddPriorityModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Add New Priority Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addPriorityForm">
                    <div class="mb-3">
                        <label for="priority_name_modal" class="form-label">Priority Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="priority_name_modal" name="priority_status_name" placeholder="Enter Priority Name" required>
                        <div class="invalid-feedback">Priority name is required.</div>
                    </div>

                    <div class="mb-3">
                        <label for="priority_color_modal" class="form-label">Button Color <span class="text-danger">*</span></label>
                        <input type="color" class="form-control form-control-color" id="priority_color_modal" name="priority_color" value="#ff0000" title="Choose your color" required>
                        <div class="invalid-feedback">Please select a color.</div>
                    </div>

                    <div class="mb-3">
                        <label for="priority_description_modal" class="form-label">Description</label>
                        <textarea class="form-control" id="priority_description_modal" name="priority_status_description" rows="3" placeholder="Enter description"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePriorityStatus()">Save</button>
            </div>
        </div>
    </div>
</div>
<style>
#AddStageModal {
    z-index: 1065; /* higher than default 1055 */
}

#ChangeStatusModal {
    z-index: 1055;
}

</style>
<!-- Add Stage Modal -->
<div class="modal fade" id="AddStageModal" tabindex="-1" aria-labelledby="AddStageModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Add New Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addStageForm">
                    <div class="mb-3">
                        <label for="stage_name_modal" class="form-label">Stage Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="stage_name_modal" name="stages_name" placeholder="Enter Stage Name" required>
                        <div class="invalid-feedback">Stage name is required.</div>
                    </div>

                    <div class="mb-3">
                        <label for="stage_color_modal" class="form-label">Button Color <span class="text-danger">*</span></label>
                        <input type="color" class="form-control form-control-color" id="stage_color_modal" name="stage_color" value="#007bff" title="Choose your color" required>
                        <div class="invalid-feedback">Please select a color.</div>
                    </div>

                    <div class="mb-3">
                        <label for="stage_description_modal" class="form-label">Description</label>
                        <textarea class="form-control" id="stage_description_modal" name="stages_description" rows="3" placeholder="Enter description"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveStagelisting()">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ChangeStatusModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title2">Change Lead Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="changeStatusForm">
                    <input type="hidden" id="lead_id" name="lead_id">
                    <input type="hidden" id="prev_stage_id" name="prev_stage_id">
                    <input type="hidden" id="lead_type_stutus" name="lead_type_stutus">

                    <div class="mb-3">
                        <label class="form-label">Stage <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="stage_id" name="stage_id" onchange="checkAddNewStage(this)" required>
                            <option value="">Select Stage</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
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

<!-- Stage History Modal -->
<div class="modal fade" id="StageHistoryModal" tabindex="-1" aria-labelledby="StageHistoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-lead modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="StageHistoryLabel">Lead Stage History</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-striped table-bordered" id="stageHistoryTable">
          <thead>
            <tr>
              <th>Sl. No</th>
              <th>Current Stage</th>
              <th>Previous Stage</th>
              <th>Description</th>
              <th>Updated By</th>
              <th>Updated On</th>
              <th>Updated Time</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Guest Count Modal -->
<div class="modal fade" id="gusetcountModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-lead">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Guest Count</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="form2">

          <input type="hidden" id="guset_count_lead_id_fk" name="guset_count_lead_id_fk"/>
          <input type="hidden" id="guset_count_package_id_fk" name="guset_count_package_id_fk"/>
          <input type="hidden" id="guset_count_id" name="guset_count_id">
          <input type="hidden" id="lead_type_count" name="lead_type_count"/>


          <!-- Guest type -->
          <div class="mb-3">
            <label class="fw-bold">Guest count type</label><br>
            <input type="radio" name="guest_type" id="ds" value="S" checked>
            <label for="ds">Same guest count</label>

            <input type="radio" name="guest_type" id="df" value="D" class="ms-3">
            <label for="df">Different guest count</label>
          </div>

          <!-- Pax Table -->
          <table class="table table-bordered" id="inclusionTable">
            <thead class="table-dark">
              <tr>
                <th>Pax Plan</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

          <!-- ADD PLAN -->
          <button type="button" id="addInclusionBtn" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Pax Plan
          </button>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- 🔴 IMPORTANT: UNIQUE ID -->
        <button class="btn btn-primary" id="btnSaveGuest">Save</button>
      </div>

    </div>
  </div>
</div>

<!-- Accomodation Plan Modal -->
<div class="modal fade" id="accomodation_planModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
<!-- <div class="modal fade" id="accomodation_planModal" tabindex="-1"> -->
  <div class="modal-dialog modal-lg modal-lead">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"> Accomodation Plan </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="form4">

          <input type="hidden" id="lead_id_fk" name="lead_id_fk"/>
          <input type="hidden" id="pacakage_id_fk" name="pacakage_id_fk"/>
          <input type="hidden" id="accommodation_plan_guset_count_id_fk" name="accommodation_plan_guset_count_id_fk"/>
          <input type="hidden" id="lead_type_accomodation" name="lead_type_accomodation"/>
         <div class="row">
            <div class="col-12">

              <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                  <thead class="table-light">
                    <tr>
                      <th>Day</th>
                      <th>Accommodation Status</th>
                      <th>Stay Destination</th>
                      <th>Meal Plan</th>
                      <th>Pax Count Plan</th>
                    </tr>
                  </thead>

                  <tbody id="accommodationTableBody">
                    <tr>
                      <!-- Day -->
                      <td>
                        <input type="text" class="form-control" name="day[]" value="Day 1" readonly>
                      </td>

                      <!-- Accommodation Status -->
                      <td>
                        <select name="accommodation_status[]" class="form-control lst-flt-select2" required>
                          <option value="">Select</option>
                          <option value="R">Required</option>
                          <option value="N">Not Required</option>
                        </select>
                      </td>

                      <!-- Stay Destination -->
                      <td>
                        <select name="stay_destination_id[]" class="form-control lst-flt-select2" required>
                          <option value="">Select Destination</option>
                        </select>
                      </td>

                      <!-- Meal Plan -->
                      <td>
                        <select name="meal_plan_id[]" class="form-control lst-flt-select2" required>
                          <option value="">Select Meal Plan</option>
                        </select>
                      </td>

                      <!-- Pax Count Plan -->
                      <td>
                        <select name="pax_count_plan_id[]" class="form-control lst-flt-select2" required>
                          <option value="">Select Pax Plan</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>


        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- 🔴 IMPORTANT: UNIQUE ID -->
        <button class="btn btn-primary" id="btnSaveaccplan">Save</button>
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
                    <input type="hidden" value="" name="guest_name" id="guest_name2"/>
                    <input type="hidden" value="" name="lead_type_delete" id="lead_type_delete"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Leadsmodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_leads_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>