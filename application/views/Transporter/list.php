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
                                <h4 class="card-title">Transporter Details</h4>
                                <?php if (has_permission('TRANSPORTER_CREATE')): ?>
                                    <a onclick="add_Transporter()"  data-bs-target="#TransporterModal" class="btn btn-rounded btn-secondary btn-md">+ New Transporter</a> 
                                <?php endif; ?>                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Transporter_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Base station</th>
                                                <th>Vehicles</th>
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
        <div class="modal fade" id="TransporterModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Transportermodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="transporter_name">Name <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="transporter_name" id="transporter_name" placeholder="Enter transporter name" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="transporter_address">Address 
                                        </label>
                                        
                                            <textarea class="form-control" name="transporter_address" id="transporter_address"  rows="5" placeholder="Enter Address" required></textarea>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label" for="transporter_base_station_id_fk">Base station
                                        </label>
                                            <select name="transporter_base_station_id_fk" id="transporter_base_station_id_fk" class="form-control input-lg lst-flt-select2" required>                                     
                                                <option value="">Please Select Base station</option>                            
                                                <?php foreach($state as $row) {
                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                        echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
                                                    } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-form-label" for="vehicle_id_fk">Vehicle
                                        </label>
                                        
                                            <select name="vehicle_id_fk[]" id="vehicle_id_fk" class="form-control multi-select" multiple="multiple" required>                                     
                                                <option value="">Please Select Vehicle</option>

                                                <?php foreach($vehicle as $row) {
                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                        echo '<option value="'.$row->vehicle_id.'">'.$row->vehicle_name.'</option>';
                                                    } ?>                            
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="row">
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_name1">Person 1 name
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_name1" id="transporter_contact_person_name1" placeholder="Enter person 1 name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_email1">Email address
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_email1" id="transporter_contact_person_email1" placeholder="Enter email address" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num1">Contact number 1
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_contact_num1" id="transporter_contact_person_contact_num1" placeholder="Enter contact number 1" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num12">Contact number 2
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_contact_num12" id="transporter_contact_person_contact_num12" placeholder="Enter contact number 2" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>        
                            
                            <div class="row">
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_name2">Person 2 name
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_name2" id="transporter_contact_person_name2" placeholder="Enter person 2 name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_email2">Email address
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_email2" id="transporter_contact_person_email2" placeholder="Enter email address" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num2">Contact number 1
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_contact_num2" id="transporter_contact_person_contact_num2" placeholder="Enter contact number 1" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num22">Contact number 2
                                        </label>
                                            <input type="text" class="form-control" name="transporter_contact_person_contact_num22" id="transporter_contact_person_contact_num22" placeholder="Enter contact number 2" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_bank_name">Bank Name
                                        </label>
                                            <input type="text" class="form-control" name="transporter_bank_name" id="transporter_bank_name" placeholder="Enter Bank Name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_bank_account_number">Account No
                                        </label>
                                            <input type="text" class="form-control" name="transporter_bank_account_number" id="transporter_bank_account_number" placeholder="Enter Account No" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_bank_account_name">Account Name
                                        </label>
                                            <input type="text" class="form-control" name="transporter_bank_account_name" id="transporter_bank_account_name" placeholder="Enter Account Name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_bank_account_ifsc_code">IFSC Code
                                        </label>
                                            <input type="text" class="form-control" name="transporter_bank_account_ifsc_code" id="transporter_bank_account_ifsc_code" placeholder="Enter IFSC Code" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_bank_account_branch">Bank branch
                                        </label>
                                            <input type="text" class="form-control" name="transporter_bank_account_branch" id="transporter_bank_account_branch" placeholder="Enter Bank branch" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_bank_swift_code">Swift code
                                        </label>
                                            <input type="text" class="form-control" name="transporter_bank_swift_code" id="transporter_bank_swift_code" placeholder="Enter Swift code" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>                                
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Transportermodalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="transporter_name" id="transporter_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Transportermodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_transporter_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>