<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <div class="row">
                    
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Template category Details</h4>
                                <?php if (has_permission('TEMPLATES_CATEGORY_CREATE')): ?>
                                        <a onclick="add_category()"  data-bs-target="#PackagecategoryModal" class="btn btn-rounded btn-secondary btn-md">+ New template category</a> 
                                <?php endif; ?>                                   
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Package_category_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Name</th>
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
        <div class="modal fade" id="PackagecategoryModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="packagecategorymodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="package_category_name">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 package_category_name">
                                            <input type="text" class="form-control" name="package_category_name" id="package_category_name" placeholder="Enter category name" required>
                                            <span class="help-block" style="color:red"></span>
                                            <b><span id="category_name_alert" style="color: red"></span></b>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="package_category_description">Description 
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" name="package_category_description" id="package_category_description"  rows="5" placeholder="Enter Description" required></textarea>
                                            <div class="invalid-feedback">
                                                Please enter a Description.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="packagecategorymodalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="package_category_name" id="package_category_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="packagecategorymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_category_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>