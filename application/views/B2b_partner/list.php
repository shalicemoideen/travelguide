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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="b2b_partner_id" name="b2b_partner_id" required>  
                            
                                                                    <option value="">Please Select b2b partner</option>
                                                                    <?php

                                                                    foreach($partner as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->b2b_partner_id.'" '.$sel.'>'.$row->b2b_partner_agent_name.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="b2b_partner_country_id_fk1" name="b2b_partner_country_id_fk" required>  
                            
                                                                    <option value="">Please Select Country</option>                            
                                                                    <?php foreach($country as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="b2b_partner_location_id_fk1" name="b2b_partner_location_id_fk" required>  
                            
                                                                   <option value="">Please Select Location</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="b2b_partner_person_name" id="b2b_partner_person_name1" placeholder="Enter person name" required>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="b2b_partner_contact_number" id="b2b_partner_contact_number1" placeholder="Enter contact number" required>
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="b2b_partner_createdby_user_id" id="b2b_partner_createdby_user_id" class="form-control input-lg lst-flt-select2" required>                                     
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
                                                        <a href="<?php echo base_url();?>B2b_partner">
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
                                <h4 class="card-title">B2B partner Details</h4>
                                <?php if (has_permission('B2B_PARTNER_CREATE')): ?>
                                <a onclick="add_b2bpartner()"  data-bs-target="#B2BpartnerModal" class="btn btn-rounded btn-secondary btn-md">+ New B2B partner</a> 
                                <?php endif; ?>   
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="B2B_partner_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Country</th>
                                                <th>Location</th>
                                                <th>Person name</th>
                                                <th>Contact number</th>
                                                <th>Mail address</th>
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
        <div class="modal fade" id="B2BpartnerModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg"modal-lg role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="b2bpartnermodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="b2b_partner_agent_name">Name
                                        </label>
                                        
                                            <input type="text" class="form-control" name="b2b_partner_agent_name" id="b2b_partner_agent_name" placeholder="Enter agent name" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="b2b_partner_address">Address 
                                        </label>
                                        
                                            <textarea class="form-control" name="b2b_partner_address" id="b2b_partner_address"  rows="5" placeholder="Enter Address" required></textarea>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-form-label" for="b2b_partner_country_id_fk">Country
                                        </label>
                                            <select name="b2b_partner_country_id_fk" id="b2b_partner_country_id_fk" class="form-control input-lg lst-flt-select2" required>                                     
                                                <option value="">Please Select Country</option>                            
                                                <?php foreach($country as $row) {
                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                    } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-form-label" for="b2b_partner_location_id_fk">Location
                                        </label>
                                        
                                            <select name="b2b_partner_location_id_fk" id="b2b_partner_location_id_fk" class="form-control input-lg lst-flt-select2" required>                                     
                                                <option value="">Please Select Location</option>                            
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="row">
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="b2b_partner_person_name">Person name
                                        </label>
                                            <input type="text" class="form-control" name="b2b_partner_person_name" id="b2b_partner_person_name" placeholder="Enter person name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="b2b_partner_contact_number">Contact number
                                        </label>
                                            <input type="text" class="form-control" name="b2b_partner_contact_number" id="b2b_partner_contact_number" placeholder="Enter contact number" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="b2b_partner_email_address">Email address
                                        </label>
                                            <input type="text" class="form-control" name="b2b_partner_email_address" id="b2b_partner_email_address" placeholder="Enter email address" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label" for="b2b_partner_description">Description 
                                        </label>
                                            <textarea class="form-control" name="b2b_partner_description" id="b2b_partner_description"  rows="5" placeholder="Enter description" required></textarea>
                                    </div>
                                </div>
                            </div>        
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="b2bpartnermodalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="b2b_partner_agent_name" id="b2b_partner_agent_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="b2bpartnermodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_b2bpartner_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>