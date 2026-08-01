<style>
    .modal-lg {
    max-width: 80%;
}
</style>
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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="user_id_filter" name="user_id_filter" required>  
                            
                                                                    <option value="">Please Select staff</option>
                                                                    <?php

                                                                    foreach($staff as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->user_id.'" '.$sel.'>'.$row->admin_name.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="role_id_filter" name="role_id_filter" required>  
                            
                                                                    <option value="">Please Select Role</option>                            
                                                                    <?php foreach($roles as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->roles_id.'">'.$row->roles_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg" id="designation_id_filter" name="designation_id_filter"  required>  
                            
                                                                   <option value="">Please Select Designation</option>

                                                                    <?php foreach($designation as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->designation_id.'">'.$row->designation_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                           
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="user_phone_number_filter" id="user_phone_number_filter" placeholder="Enter phone number" required>
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
                                                        <a href="<?php echo base_url();?>Staff">
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
                                <h4 class="card-title">Staff Details</h4>
                               
                                    <?php if (has_permission('STAFF_CREATE')): ?>
                                    <a onclick="add_Staff()"  data-bs-target="#StaffModal" class="btn btn-rounded btn-secondary btn-md">+ New Staff</a> 
                                    <?php endif; ?> 
                                    
                                                          
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="StaffTable" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Staff Name</th>
                                                <th>Phone no:</th>
                                                <th>Role</th>
                                                <th>Designation</th>
                                                <th>Date of joining</th>
                                                <th>User name</th>
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
        <div class="modal fade" id="StaffModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Staffmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="admin_name">Name <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Enter staff name" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="admin_name">Profile pic 
                                        </label>
                                        
                                            <input id="user_profile_pic" name="user_profile_pic" class="form-control" type="file" required>
                                            <span class="help-block" style="color:red"></span>
                                            <input id="user_profile_pic_txt" name="user_profile_pic_txt" type="hidden">
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="user_address">Address 
                                        </label>
                                        
                                            <textarea class="form-control" name="user_address" id="user_address"  rows="5" placeholder="Enter Address" required></textarea>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label" for="role_id_fk">Role <span class="text-danger">*</span>
                                        </label>
                                            <select name="role_id_fk" id="role_id_fk" class="form-control input-lg lst-flt-select2" required>                                     
                                                <option value="">Please Select Role</option>                            
                                                <?php foreach($roles as $row) {
                                                    // $sel = ($records->state==$row->state_id)?'selected':'';
                                                    // echo '<option value="'.$row->roles_id.'">'.$row->roles_name.'</option>';
                                                    echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                
                            </div>
                                    
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-form-label" for="designation_id_fk">Designation
                                        </label>
                                        
                                            <select name="designation_id_fk" id="designation_id_fk" class="form-control multi-select"  required>                                     
                                                <option value="">Please Select Designation</option>

                                                <?php foreach($designation as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->designation_id.'">'.$row->designation_name.'</option>';
                                                                        } ?>
                                                                                     
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="user_email_address">Email address
                                        </label>
                                            <input type="text" class="form-control" name="user_email_address" id="user_email_address" placeholder="Enter email address" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="user_phone_number">Contact number 
                                        </label>
                                            <input type="text" class="form-control" name="user_phone_number" id="user_phone_number" placeholder="Enter contact number " required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="user_lan_number">Lan number
                                        </label>
                                            <input type="text" class="form-control" name="user_lan_number" id="user_lan_number" placeholder="Enter lan number" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                

                                
                            </div>        
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="user_date_of_joining">Date of joining
                                        </label>
                                            <input type="text" class="form-control" name="user_date_of_joining" id="user_date_of_joining" placeholder="Enter date of joining" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="user_name">User name <span class="text-danger">*</span>
                                        </label>
                                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter user name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="password">Password <span class="text-danger">*</span>
                                        </label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" autocomplete="new-password">
                                                <span class="input-group-text" style="cursor:pointer;" onclick="toggleStaffPwd(this)"><i class="fa fa-eye"></i></span>
                                            </div>
                                            <small class="form-text text-muted">Min 8 characters with at least one letter and one number. Leave blank when editing to keep the current password.</small>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="confirm_password">Confirm Password <span class="text-danger">*</span>
                                        </label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-enter password" autocomplete="new-password">
                                                <span class="input-group-text" style="cursor:pointer;" onclick="toggleStaffPwd(this)"><i class="fa fa-eye"></i></span>
                                            </div>
                                            <small class="form-text text-muted">Must match the password above.</small>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="user_description">Force stop 
                                        </label>
                                            <input type="checkbox" class="form-check-input sc_chkbox"  id="meta_force_stop" name="meta_force_stop" value="Y" required="">
                                        
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="device_user_id">Device Employee Code
                                        </label>
                                            <input type="text" class="form-control" name="device_user_id" id="device_user_id" placeholder="Enter biometric device code">
                                            <small class="text-muted">eSSL device employee code</small>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-form-label" for="languages">Languages
                                        </label>
                                            <select name="languages[]" id="languages" class="form-control multi-select" multiple="multiple">                                     
                                                <option value="">Please Select Languages</option>

                                                <?php foreach($languages as $row) {
                                                                            echo '<option value="'.$row->language_id.'">'.$row->language_name.'</option>';
                                                                        } ?>
                                                                                     
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-form-label" for="shift_id_fk">Shift <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="shift_id_fk" id="shift_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Please Select Shift</option>

                                                <?php foreach($shift as $row) {

                                                    $start = date("h:i A", strtotime($row->shift_start_time));
                                                    $end   = date("h:i A", strtotime($row->shift_end_time));

                                                    echo '<option value="'.$row->shift_id.'">'.$start.' - '.$end.'</option>';
                                                } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="user_description">Description 
                                        </label>
                                        
                                            <textarea class="form-control" name="user_description" id="user_description"  rows="5" placeholder="Enter Address" required></textarea>
                                        
                                    </div>
                                </div>
                            </div>

                            

                            

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Staffmodalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="admin_name" id="admin_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Staffmodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_staff_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>