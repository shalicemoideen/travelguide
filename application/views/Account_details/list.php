<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <div class="row">
                    
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Account Details</h4>
                                <?php if (has_permission('ACCOUNT_DETAILS_CREATE')): ?>
                                    <a onclick="add_account_details()"  data-bs-target="#AccountDetailsModal" class="btn btn-rounded btn-secondary btn-md">+ New account</a> 
                                <?php endif; ?>                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Account_details_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Account name</th>
                                                <th>Account number</th>
                                                <th>IFSC code</th>
                                                <th>Branch name</th>
                                                <th>UPI ID</th>
                                                <th>QR code</th>
                                                <th>Bank logo</th>
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
        <div class="modal fade" id="AccountDetailsModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="AccountDetailsModalClose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" enctype="multipart/form-data">
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="account_name">Account name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 account_name">
                                            <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Enter account name" required>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="account_number">Account number
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 account_number">
                                            <input type="text" class="form-control" name="account_number" id="account_number" placeholder="Enter account number" required>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="ifsc_code">IFSC code</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC code">
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="branch_name">Branch name</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Enter branch name">
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="up_id">UPI ID</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="up_id" id="up_id" placeholder="Enter UPI ID">
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="qr_code">QR code</label>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" name="qr_code" id="qr_code" accept="image/*">
                                            <input type="hidden" name="qr_code_old" id="qr_code_old">
                                            <div id="qr_code_preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="bank_logo">Bank logo</label>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" name="bank_logo" id="bank_logo" accept="image/*">
                                            <input type="hidden" name="bank_logo_old" id="bank_logo_old">
                                            <div id="bank_logo_preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="AccountDetailsModalClose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="account_name" id="account_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_account_details_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>
