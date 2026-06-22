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
                                                <th>Location</th>
                                                <th>Person name</th>
                                                <th>Contact number</th>
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

                                                <?php foreach($state as $row) {
                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                        echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
                                                    } ?>                           
                                               
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